<?php

namespace App\Http\Controllers;

use App\RidingStable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RidingStableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'riding_stables');

        // Retrieve the full horse ridingStable list
        $ridingStablesList = DB::connection($this->getUser()->getRole->name)->table('riding_stables')->paginate(20);

        return view('ridingStables.index', array(
            'ridingStables' => $ridingStablesList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'riding_stables');

        return view('ridingStables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->getUser()->hasPermission(['insert'], 'riding_stables');
        // Set the connection to use after having checked the permissions
        $ridingStable = new RidingStable();
        $ridingStable->setConnection($this->getUser()->getRole->name);

        $ridingStable->fill($request->all());

        $validList = $this->validateItemLists($request->input('infraList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the infrastructures list');
        }
        $ridingStable->infraList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('autoTaskList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the automated tasks list');
        }
        $ridingStable->autoTaskList = json_encode($validList);

        if ($ridingStable->save()) {
            return redirect()->route('ridingstables.index')->with('success', 'Riding stable successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the riding stable. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idRidingStable
     * @return \Illuminate\Http\Response
     */
    public function show(Int $idRidingStable)
    {
        $this->getUser()->hasPermission(['select'], 'riding_stables');

        $ridingStable = new RidingStable();
        $ridingStable->setConnection($this->getUser()->getRole->name);
        $ridingStable = $ridingStable->findOrFail($idRidingStable);

        $ridingStable->infraList = json_decode($ridingStable->infraList);
        $ridingStable->autoTaskList = json_decode($ridingStable->autoTaskList);

        return view('ridingStables.show', ['ridingStable' => $ridingStable]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idRidingStable
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $idRidingStable)
    {
        $this->getUser()->hasPermission(['select'], 'riding_stables');

        $ridingStable = new RidingStable();
        $ridingStable->setConnection($this->getUser()->getRole->name);

        $ridingStable = $ridingStable->findOrFail($idRidingStable);
        $ridingStable->infraList = implode('/', json_decode($ridingStable->infraList));
        $ridingStable->autoTaskList = implode('/', json_decode($ridingStable->autoTaskList));

        return view('ridingStables.edit', array(
            'ridingStable' => $ridingStable
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $ridingStableId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $ridingStableId)
    {
        $this->getUser()->hasPermission(['update'], 'riding_stables');

        $ridingStable = new RidingStable();
        $ridingStable->setConnection($this->getUser()->getRole->name);
        $ridingStable = $ridingStable->findOrFail($ridingStableId);
        $ridingStable->fill($request->all());

        $validList = $this->validateItemLists($request->input('infraList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the infrastructures list');
        }
        $ridingStable->infraList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('autoTaskList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the automated tasks list');
        }
        $ridingStable->autoTaskList = json_encode($validList);

        if ($ridingStable->save()) {
            return redirect()->route('ridingstables.show', $ridingStable->id)->with('success', 'Riding stable successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the riding stable. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idRidingStable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idRidingStable)
    {
        $this->getUser()->hasPermission(['delete'], 'riding_stables');

        if ($idRidingStable !== 0) {
            $ridingStable = new RidingStable();
            $ridingStable->setConnection($this->getUser()->getRole->name);
            $ridingStable = $ridingStable->findOrFail($idRidingStable);

            if ($ridingStable->delete()) {
                return redirect()->route('ridingstables.index')->with('success', 'Riding stable successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the riding stable');
            }
        } else {
            $ridingStablesToDelete = $request->input('list');
            $result = true;

            foreach ($ridingStablesToDelete as $key => $ridingStableId) {
                $ridingStable = new RidingStable();
                $ridingStable->setConnection($this->getUser()->getRole->name);
                $ridingStable = $ridingStable->findOrFail($ridingStableId);

                if ($ridingStable->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected riding stables were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected riding stable');
            }

            return 'ridingstables';
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
            if (is_int($item) && $item > 0 && $item <= 1000000) {
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
