<?php

namespace App\Http\Controllers;

use App\HorseClub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\HorseClubRequest;

class HorseClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'horse_clubs');

        // Retrieve the full horse list
        $horseClubsList = DB::connection($this->getUser()->getRole->name)->table('horse_clubs')->paginate(20);

        return view('horseClubs.index', array(
            'horseClubs' => $horseClubsList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'horse_clubs');

        return view('horseClubs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\HorseClubRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HorseClubRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'horse_clubs');
        // Set the connection to use after having checked the permissions
        $horseClub = new HorseClub();
        $horseClub->setConnection($this->getUser()->getRole->name);

        $horseClub->fill($request->all());

        if ($horseClub->save()) {
            return redirect()->route('horseClubs.index')->with('success', 'Horse club successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the horse club. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HorseClub  $horse
     * @return \Illuminate\Http\Response
     */
    public function show(int $idHorseClub)
    {
        $this->getUser()->hasPermission(['select'], 'horse_clubs');

        $horseClub = new HorseClub();
        $horseClub->setConnection($this->getUser()->getRole->name);
        $horseClub = $horseClub->findOrFail($idHorseClub);

        return view('horseClubs.show', ['horseClub' => $horseClub]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HorseClub  $horseClub
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idHorseClub)
    {
        $this->getUser()->hasPermission(['select'], 'horse_clubs');

        $horseClub = new HorseClub();
        $horseClub->setConnection($this->getUser()->getRole->name);

        $horseClub = $horseClub->findOrFail($idHorseClub);

        return view('horseClubs.edit', array(
            'horseClub' => $horseClub
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HorseClub  $horseClub
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HorseClub $horseClub)
    {
        $this->getUser()->hasPermission(['update'], 'horseClubs');

        $horseClub->setConnection($this->getUser()->getRole->name);

        $horseClub->fill($request->all());

        if ($horseClub->save()) {
            return redirect()->route('horseClubs.show', ['idHorseClubs' => $horseClub->id])->with('success', 'Horse  clubsuccessfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the horse club. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $idHorseClub
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idHorseClub)
    {
        $this->getUser()->hasPermission(['delete'], 'horse_clubs');

        if ($idHorseClub !== 0) {
            $horseClub = new HorseClub();
            $horseClub->setConnection($this->getUser()->getRole->name);
            $horseClub = $horseClub->findOrFail($idHorseClub);

            if ($horseClub->delete()) {
                return redirect()->route('horseClubs.index')->with('success', 'Horse club successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the horse club');
            }
        } else {
            $horseClubsToDelete = $request->input('list');
            $result = true;

            foreach ($horseClubsToDelete as $key => $horseClubId) {
                $horseClub = new HorseClub();
                $horseClub->setConnection($this->getUser()->getRole->name);
                $horseClub = $horseClub->findOrFail($horseClubId);

                if ($horseClub->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected horse clubs were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected horse clubs');
            }

            return 'horseClubs';
        }
    }
}
