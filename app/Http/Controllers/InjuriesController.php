<?php

namespace App\Http\Controllers;

use App\Injuries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\InjuriesRequest;

class InjuriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'injuries');

        // Retrieve the full injuries list
        $injuriesList = DB::connection($this->getUser()->getRole->name)->table('injuries')->paginate(20);

        return view('injuries.index', array(
            'injuries' => $injuriesList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'injuries');

        return view('injuries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\InjuriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InjuriesRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'injuries');
        // Set the connection to use after having checked the permissions
        $injury = new Injuries();
        $injury->setConnection($this->getUser()->getRole->name);

        $injury->fill($request->all());

        if ($injury->save()) {
            return redirect()->route('injuries.index')->with('success', 'injury successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the injury. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idInjury
     * @return \Illuminate\Http\Response
     */
    public function show(int $idInjury)
    {
        $this->getUser()->hasPermission(['select'], 'injuries');

        $injury = new Injuries();
        $injury->setConnection($this->getUser()->getRole->name);
        $injury = $injury->findOrFail($idInjury);

        return view('injuries.show', ['injury' => $injury]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idInjury
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idInjury)
    {
        $this->getUser()->hasPermission(['select'], 'injuries');

        $injury = new Injuries();
        $injury->setConnection($this->getUser()->getRole->name);

        $injury = $injury->findOrFail($idInjury);

        return view('injuries.edit', array(
            'injury' => $injury
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\InjuriesRequest  $request
     * @param  \App\Injuries  $injuries
     * @return \Illuminate\Http\Response
     */
    public function update(InjuriesRequest $request, Injuries $injury)
    {
        $this->getUser()->hasPermission(['update'], 'injuries');

        $injury->setConnection($this->getUser()->getRole->name);

        $injury->fill($request->all());

        if ($injury->save()) {
            return redirect()->route('injuries.show', ['idInjury' => $injury->id])->with('success', 'Injury successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the injury. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idInjury
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idInjury)
    {
        $this->getUser()->hasPermission(['delete'], 'injuries');

        if ($idInjury !== 0) {
            $injury = new Injuries();
            $injury->setConnection($this->getUser()->getRole->name);
            $injury = $injury->findOrFail($idInjury);

            if ($injury->delete()) {
                return redirect()->route('injuries.index')->with('success', 'Injury successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the injury');
            }
        } else {
            $injuriesToDelete = $request->input('list');
            $result = true;

            foreach ($injuriesToDelete as $key => $injuryId) {
                $injury = new Injuries();
                $injury->setConnection($this->getUser()->getRole->name);
                $injury = $injury->findOrFail($injuryId);

                if ($injury->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected injuries were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected injuries');
            }

            return 'injuries';
        }
    }
}
