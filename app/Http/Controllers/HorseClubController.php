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

        // Retrieve the full horse club list
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

        $validList = $this->validateItemLists($request->input('infraList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the infrastructures list');
        }
        $horseClub->infraList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('contestList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the contests list');
        }
        $horseClub->contestList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('userList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the members list');
        }
        $horseClub->userList = json_encode($validList);

        if ($horseClub->save()) {
            return redirect()->route('horseclubs.index')->with('success', 'Horse club successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the horse club. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idHorseClub
     * @return \Illuminate\Http\Response
     */
    public function show(int $idHorseClub)
    {
        $this->getUser()->hasPermission(['select'], 'horse_clubs');

        $horseClub = new HorseClub();
        $horseClub->setConnection($this->getUser()->getRole->name);
        $horseClub = $horseClub->findOrFail($idHorseClub);

        $horseClub->infraList = json_decode($horseClub->infraList);
        $horseClub->contestList = json_decode($horseClub->contestList);
        $horseClub->userList = json_decode($horseClub->userList);

        return view('horseClubs.show', ['horseClub' => $horseClub]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idHorseClub
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idHorseClub)
    {
        $this->getUser()->hasPermission(['select'], 'horse_clubs');

        $horseClub = new HorseClub();
        $horseClub->setConnection($this->getUser()->getRole->name);

        $horseClub = $horseClub->findOrFail($idHorseClub);
        $horseClub->infraList = implode('/', json_decode($horseClub->infraList));
        $horseClub->contestList = implode('/', json_decode($horseClub->contestList));
        $horseClub->userList = implode('/', json_decode($horseClub->userList));

        return view('horseClubs.edit', array(
            'horseClub' => $horseClub
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\HorseClubRequest  $request
     * @param  int  $horseClubId
     * @return \Illuminate\Http\Response
     */
    public function update(HorseClubRequest $request, int $horseClubId)
    {
        $this->getUser()->hasPermission(['update'], 'horse_clubs');
        $horseClub = new HorseClub();
        $horseClub->setConnection($this->getUser()->getRole->name);

        $horseClub = $horseClub->findOrFail($horseClubId);
        $horseClub->fill($request->all());

        $validList = $this->validateItemLists($request->input('infraList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the infrastructures list');
        }
        $horseClub->infraList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('contestList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the contests list');
        }
        $horseClub->contestList = json_encode($validList);

        $validList = $this->validateItemLists($request->input('userList'));
        if (!$validList) {
            return back()->withErrors('Please enter a valid list of ids for the members list');
        }
        $horseClub->userList = json_encode($validList);

        if ($horseClub->save()) {
            return redirect()->route('horseclubs.show', ['idHorseClub' => $horseClub->id])->with('success', 'Horse club successfully updated');
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
                return redirect()->route('horseclubs.index')->with('success', 'Horse club successfully deleted');
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

            return 'horseclubs';
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
