<?php

namespace App\Http\Controllers;

use App\HorseIndicator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\HorseIndicatorRequest;

class HorseIndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'horse_indicators');

        // Retrieve the full horse list
        $HorseIndicatorsList = DB::connection($this->getUser()->getRole->name)->table('horse_indicators')->paginate(20);

        return view('HorseIndicators.index', array(
            'HorseIndicators' => $HorseIndicatorsList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'horse_indicators');

        return view('HorseIndicators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\HorseIndicatorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HorseIndicatorRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'horse_indicators');
        // Set the connection to use after having checked the permissions
        $HorseIndicator = new HorseIndicator();
        $HorseIndicator->setConnection($this->getUser()->getRole->name);

        $HorseIndicator->fill($request->all());

        if ($HorseIndicator->save()) {
            return redirect()->route('HorseIndicators.index')->with('success', 'Horse indicator successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the horse indicator. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HorseIndicator  $horse
     * @return \Illuminate\Http\Response
     */
    public function show(int $idHorseIndicator)
    {
        $this->getUser()->hasPermission(['select'], 'horse_indicators');

        $HorseIndicator = new HorseIndicator();
        $HorseIndicator->setConnection($this->getUser()->getRole->name);
        $HorseIndicator = $HorseIndicator->findOrFail($idHorseIndicator);

        return view('HorseIndicators.show', ['HorseIndicator' => $HorseIndicator]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HorseIndicator  $HorseIndicator
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idHorseIndicator)
    {
        $this->getUser()->hasPermission(['select'], 'horse_indicators');

        $HorseIndicator = new HorseIndicator();
        $HorseIndicator->setConnection($this->getUser()->getRole->name);

        $HorseIndicator = $HorseIndicator->findOrFail($idHorseIndicator);

        return view('HorseIndicators.edit', array(
            'HorseIndicator' => $HorseIndicator
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HorseIndicator  $HorseIndicator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HorseIndicator $HorseIndicator)
    {
        $this->getUser()->hasPermission(['update'], 'horse_indicators');

        $HorseIndicator->setConnection($this->getUser()->getRole->name);

        $HorseIndicator->fill($request->all());

        if ($HorseIndicator->save()) {
            return redirect()->route('HorseIndicators.show', ['idHorseIndicators' => $HorseIndicator->id])->with('success', 'Horse  indicator successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the horse indicator. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $idHorseIndicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idHorseIndicator)
    {
        $this->getUser()->hasPermission(['delete'], 'horse_indicators');

        if ($idHorseIndicator !== 0) {
            $HorseIndicator = new HorseIndicator();
            $HorseIndicator->setConnection($this->getUser()->getRole->name);
            $HorseIndicator = $HorseIndicator->findOrFail($idHorseIndicator);

            if ($HorseIndicator->delete()) {
                return redirect()->route('HorseIndicators.index')->with('success', 'Horse indicator successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the horse indicator');
            }
        } else {
            $HorseIndicatorsToDelete = $request->input('list');
            $result = true;

            foreach ($HorseIndicatorsToDelete as $key => $HorseIndicatorId) {
                $HorseIndicator = new HorseIndicator();
                $HorseIndicator->setConnection($this->getUser()->getRole->name);
                $HorseIndicator = $HorseIndicator->findOrFail($HorseIndicatorId);

                if ($HorseIndicator->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected horse indicators were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected horse indicators');
            }

            return 'HorseIndicators';
        }
    }
}
