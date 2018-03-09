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
        $ridingStablesList = DB::connection($this->getUser()->getRidingStable->name)->table('ridingStables')->paginate(20);
        
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
        $this->getUser()->hasPermission(['insert'], 'ridingStables');

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
        $this->getUser()->hasPermission(['insert'], 'ridingStables');
        // Set the connection to use after having checked the permissions
        $ridingStable = new RidingStable();
        $ridingStable->setConnection($this->getUser()->getRidingStable->name);

        $ridingStable->fill($request->all());

        if ($ridingStable->save()) {
            return redirect()->route('ridingStables.index')->with('success', 'Riding stable successfully created');
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
        $this->getUser()->hasPermission(['select'], 'ridingStables');

        $ridingStable = new RidingStable();
        $ridingStable->setConnection($this->getUser()->getRidingStable->name);
        $ridingStable = $ridingStable->findOrFail($idRidingStable);

        return view('ridingStables.show', ['ridingStables' => $ridingStables]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idRidingStable
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $idRidingStable)
    {
        $this->getUser()->hasPermission(['select'], 'ridingStables');

        $ridingStable = new RidingStable();
        $ridingStable->setConnection($this->getUser()->getRidingStable->name);

        $ridingStable = $ridingStable->findOrFail($idRidingStable);

        return view('ridingStables.edit', array(
            'ridingStable' => $ridingStable
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RidingStable  $ridingStable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RidingStable $ridingStable)
    {
        $this->getUser()->hasPermission(['update'], 'ridingStables');

        $ridingStable->setConnection($this->getUser()->getRidingStable->name);

        $ridingStable->fill($request->all());

        if ($ridingStable->save()) {
            return redirect()->route('ridingStables.show', $ridingStable->id)->with('success', 'Riding stable successfully updated');
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
        $this->getUser()->hasPermission(['delete'], 'ridingStables');

        if ($idRidingStable !== 0) {
            $ridingStable = new RidingStable();
            $ridingStable->setConnection($this->getUser()->getRidingStable->name);
            $ridingStable = $ridingStable->findOrFail($idRidingStable);

            if ($ridingStable->delete()) {
                return redirect()->route('ridingStables.index')->with('success', 'Riding stable successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the riding stable');
            }
        } else {
            $ridingStablesToDelete = $request->input('list');
            $result = true;

            foreach ($ridingStablesToDelete as $key => $ridingStableId) {
                $ridingStable = new RidingStable();
                $ridingStable->setConnection($this->getUser()->getRidingStable->name);
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

            return 'ridingStables';
        }
    }
}