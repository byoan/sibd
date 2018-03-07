<?php

namespace App\Http\Controllers;

use App\InjuriesList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\InjuriesListRequest;

class InjuriesListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'injuries_lists');

        // Retrieve the full injuries association list
        $injuriesList = DB::connection($this->getUser()->getRole->name)->table('injuries_lists')->paginate(20);

        return view('injurieslists.index', array(
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
        $this->getUser()->hasPermission(['insert'], 'injuries_lists');

        return view('injurieslists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\InjuriesListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InjuriesListRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'injuries_lists');
        // Set the connection to use after having checked the permissions
        $injury = new InjuriesList();
        $injury->setConnection($this->getUser()->getRole->name);

        $injury->fill($request->all());

        if ($injury->save()) {
            return redirect()->route('injurieslists.index')->with('success', 'Injury association successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the injury association. Please try again later.');
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
        $this->getUser()->hasPermission(['select'], 'injuries_lists');

        $injury = new InjuriesList();
        $injury->setConnection($this->getUser()->getRole->name);
        $injury = $injury->findOrFail($idInjury);

        return view('injurieslists.show', ['injury' => $injury]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idInjury
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idInjury)
    {
        $this->getUser()->hasPermission(['select'], 'injuries_lists');

        $injury = new InjuriesList();
        $injury->setConnection($this->getUser()->getRole->name);

        $injury = $injury->findOrFail($idInjury);

        return view('injurieslists.edit', array(
            'injury' => $injury
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\InjuriesListRequest  $request
     * @param  int  $idInjury
     * @return \Illuminate\Http\Response
     */
    public function update(InjuriesListRequest $request, int $idInjury)
    {
        $this->getUser()->hasPermission(['update'], 'injuries_lists');

        $injury = new InjuriesList();
        $injury->setConnection($this->getUser()->getRole->name);
        $injury = $injury->findOrFail($idInjury);
        $injury->fill($request->all());

        if ($injury->save()) {
            return redirect()->route('injurieslists.show', ['idInjury' => $injury->id])->with('success', 'Injury association successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the injury association. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $idInjury
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idInjury)
    {
        $this->getUser()->hasPermission(['delete'], 'injuries_lists');

        if ($idInjury !== 0) {
            $injury = new InjuriesList();
            $injury->setConnection($this->getUser()->getRole->name);
            $injury = $injury->findOrFail($idInjury);

            if ($injury->delete()) {
                return redirect()->route('injurieslists.index')->with('success', 'Injury association successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the injury association');
            }
        } else {
            $injuriesToDelete = $request->input('list');
            $result = true;

            foreach ($injuriesToDelete as $key => $injuryId) {
                $injury = new InjuriesList();
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
                $request->session()->flash('success', 'The selected injuries associations were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected injuries associations');
            }

            return 'injurieslists';
        }
    }
}
