<?php

namespace App\Http\Controllers;

use App\Infrastructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;
use App\Http\Requests\InfrastructureRequest;

class InfrastructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'infrastructures');

        // Retrieve the full infrastructures list
        $infrastructuresList = DB::connection($this->getUser()->getRole->name)->table('infrastructures')->paginate(20);

        return view('infrastructures.index', array(
            'infrastructures' => $infrastructuresList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'infrastructures');

        return view('infrastructures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\InfrastructureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InfrastructureRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'infrastructures');
        // Set the connection to use after having checked the permissions
        $infrastructure = new Infrastructure();
        $infrastructure->setConnection($this->getUser()->getRole->name);

        $infrastructure->fill($request->all());

        $validList = $this->validateItemLists($request->input('itemList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the items list');
        }

        $infrastructure->itemList = json_encode($validList);

        if ($infrastructure->save()) {
            return redirect()->route('infrastructures.index')->with('success', 'Infrastructure successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the infrastructure. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idInfrastructure
     * @return \Illuminate\Http\Response
     */
    public function show(int $idInfrastructure)
    {
        $this->getUser()->hasPermission(['select'], 'infrastructures');

        $infrastructure = new Infrastructure();
        $infrastructure->setConnection($this->getUser()->getRole->name);
        $infrastructure = $infrastructure->findOrFail($idInfrastructure);
        $infrastructure->itemList = json_decode($infrastructure->itemList);

        return view('infrastructures.show', ['infrastructure' => $infrastructure]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idInfrastructure
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idInfrastructure)
    {
        $this->getUser()->hasPermission(['select'], 'infrastructures');

        $infrastructure = new Infrastructure();
        $infrastructure->setConnection($this->getUser()->getRole->name);

        $infrastructure = $infrastructure->findOrFail($idInfrastructure);
        $infrastructure->itemList = implode('/', json_decode($infrastructure->itemList));

        return view('infrastructures.edit', array(
            'infrastructure' => $infrastructure
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\InfrastructureRequest  $request
     * @param  \App\Infrastructure  $infrastructure
     * @return \Illuminate\Http\Response
     */
    public function update(InfrastructureRequest $request, Infrastructure $infrastructure)
    {
        $this->getUser()->hasPermission(['update'], 'infrastructures');

        $infrastructure->setConnection($this->getUser()->getRole->name);

        $infrastructure->fill($request->all());

        $validList = $this->validateItemLists($request->input('itemList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the items list');
        }

        $infrastructure->itemList = json_encode($validList);

        if ($infrastructure->save()) {
            return redirect()->route('infrastructures.show', ['idInfrastructure' => $infrastructure->id])->with('success', 'Infrastructure successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the infrastructure. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idInfrastructure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idInfrastructure)
    {
        $this->getUser()->hasPermission(['delete'], 'infrastructures');

        if ($idInfrastructure !== 0) {
            $infrastructure = new Infrastructure();
            $infrastructure->setConnection($this->getUser()->getRole->name);
            $infrastructure = $infrastructure->findOrFail($idInfrastructure);

            if ($infrastructure->delete()) {
                return redirect()->route('infrastructures.index')->with('success', 'Infrastructure successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the infrastructure');
            }
        } else {
            $infrastructuresToDelete = $request->input('list');
            $result = true;

            foreach ($infrastructuresToDelete as $key => $infraId) {
                $infrastructure = new Infrastructure();
                $infrastructure->setConnection($this->getUser()->getRole->name);
                $infrastructure = $infrastructure->findOrFail($infraId);

                if ($infrastructure->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected infrastructures were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected infrastructures');
            }

            return 'infrastructures';
        }
    }

    /**
     * Validates the received string as the items list
     *
     * @param string $list The items list sent in the update/store form
     */
    private function validateItemLists(string $list)
    {
        $valid = true;

        $explodedItemsList = explode('/', $list);
        foreach ($explodedItemsList as $item) {
            $item = (int)$item;
            if (is_int($item) && $item > 0 && $item <= 100000) {
                continue;
            }
            $valid = false;
        }

        if ($valid) {
            return $explodedItemsList;
        } else {
            return false;
        }
    }
}
