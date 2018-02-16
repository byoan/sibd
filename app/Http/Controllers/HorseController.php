<?php

namespace App\Http\Controllers;

use App\Horse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;

class HorseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'horses');

        // Retrieve the full horse list
        $horsesList = DB::connection($this->getUser()->getRole->name)->table('horses')->paginate(20);

        return view('horses.index', array(
            'horses' => $horsesList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'horses');

        return view('horses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->getUser()->hasPermission(['insert'], 'horses');
        // Set the connection to use after having checked the permissions
        $item = new Item();
        $item->setConnection($this->getUser()->getRole->name);

        $item->fill($request->all());

        if ($item->save()) {
            return redirect()->route('horses.index')->with('success', 'Horse successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the horse. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function show(int $idHorse)
    {
        $this->getUser()->hasPermission(['select'], 'horses');

        $horse = new Horse();
        $horse->setConnection($this->getUser()->getRole->name);
        $horse = $horse->findOrFail($idHorse);

        return view('horses.show', ['horse' => $horse]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idHorse)
    {
        $this->getUser()->hasPermission(['select'], 'horses');

        $horse = new Horse();
        $horse->setConnection($this->getUser()->getRole->name);

        $horse = $horse->findOrFail($idHorse);

        return view('horses.edit', array(
            'horse' => $horse
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horse $horse)
    {
        $this->getUser()->hasPermission(['update'], 'horses');

        $horse->setConnection($this->getUser()->getRole->name);

        $horse->fill($request->all());

        if ($horse->save()) {
            return redirect()->route('horses.show', ['idHorse' => $horse->id])->with('success', 'Horse successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the horse. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idHorse)
    {
        $this->getUser()->hasPermission(['delete'], 'horses');

        if ($idHorse !== 0) {
            $horse = new Horse();
            $horse->setConnection($this->getUser()->getRole->name);
            $horse = $horse->findOrFail($idHorse);

            if ($horse->delete()) {
                return redirect()->route('horses.index')->with('success', 'Horse successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the horse');
            }
        } else {
            $horsesToDelete = $request->input('list');
            $result = true;

            foreach ($horsesToDelete as $key => $horseId) {
                $horse = new Horse();
                $horse->setConnection($this->getUser()->getRole->name);
                $horse = $horse->findOrFail($horseId);

                if ($horse->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected horses were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected horses');
            }

            return 'horses';
        }
    }
}
