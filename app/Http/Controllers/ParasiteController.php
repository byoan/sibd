<?php

namespace App\Http\Controllers;

use App\Parasite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParasiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'parasites');

        // Retrieve the full horse parasite list
        $parasitesList = DB::connection($this->getUser()->getRole->name)->table('parasites')->paginate(20);
        
        return view('parasites.index', array(
            'parasites' => $parasitesList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'parasites');

        return view('parasites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->getUser()->hasPermission(['insert'], 'parasites');
        // Set the connection to use after having checked the permissions
        $parasite = new Parasite();
        $parasite->setConnection($this->getUser()->getRole->name);

        $parasite->fill($request->all());

        if ($parasite->save()) {
            return redirect()->route('parasites.index')->with('success', 'Parasite successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the parasite. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idParasite
     * @return \Illuminate\Http\Response
     */
    public function show(Int $idParasite)
    {
        $this->getUser()->hasPermission(['select'], 'parasites');

        $parasite = new Parasite();
        $parasite->setConnection($this->getUser()->getRole->name);
        $parasite = $parasite->findOrFail($idParasite);

        return view('parasites.show', ['parasite' => $parasite]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idParasite
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $idParasite)
    {
        $this->getUser()->hasPermission(['select'], 'parasites');

        $parasite = new Parasite();
        $parasite->setConnection($this->getUser()->getRole->name);

        $parasite = $parasite->findOrFail($idParasite);

        return view('parasites.edit', array(
            'parasite' => $parasite
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parasite  $parasite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parasite $parasite)
    {
        $this->getUser()->hasPermission(['update'], 'parasites');

        $parasite->setConnection($this->getUser()->getRole->name);

        $parasite->fill($request->all());

        if ($parasite->save()) {
            return redirect()->route('parasites.show', $parasite->id)->with('success', 'Parasite successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the parasite. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idParasite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idParasite)
    {
        $this->getUser()->hasPermission(['delete'], 'parasites');

        if ($idParasite !== 0) {
            $parasite = new Parasite();
            $parasite->setConnection($this->getUser()->getRole->name);
            $parasite = $parasite->findOrFail($idParasite);

            if ($parasite->delete()) {
                return redirect()->route('parasites.index')->with('success', 'Parasite successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the parasite');
            }
        } else {
            $parasitesToDelete = $request->input('list');
            $result = true;

            foreach ($parasitesToDelete as $key => $parasiteId) {
                $parasite = new Parasite();
                $parasite->setConnection($this->getUser()->getRole->name);
                $parasite = $parasite->findOrFail($parasiteId);

                if ($parasite->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected parasites were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected parasite');
            }

            return 'parasites';
        }
    }
}
