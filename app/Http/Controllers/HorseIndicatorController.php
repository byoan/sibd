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

        // Retrieve the full horse indicators list
        $horseIndicatorsList = DB::connection($this->getUser()->getRole->name)->table('horse_indicators')->paginate(20);

        return view('horseIndicators.index', array(
            'horseIndicators' => $horseIndicatorsList
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

        return view('horseIndicators.create');
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
        $horseIndicator = new HorseIndicator();
        $horseIndicator->setConnection($this->getUser()->getRole->name);

        $horseIndicator->fill($request->all());

        if ($horseIndicator->save()) {
            return redirect()->route('horseIndicators.index')->with('success', 'Horse indicator successfully created');
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

        $horseIndicator = new HorseIndicator();
        $horseIndicator->setConnection($this->getUser()->getRole->name);
        $horseIndicator = $horseIndicator->findOrFail($idHorseIndicator);

        return view('horseIndicators.show', ['horseIndicator' => $horseIndicator]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idHorseIndicator
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idHorseIndicator)
    {
        $this->getUser()->hasPermission(['select'], 'horse_indicators');

        $horseIndicator = new HorseIndicator();
        $horseIndicator->setConnection($this->getUser()->getRole->name);

        $horseIndicator = $horseIndicator->findOrFail($idHorseIndicator);

        return view('HorseIndicators.edit', array(
            'HorseIndicator' => $HorseIndicator
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HorseIndicator  $horseIndicator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HorseIndicator $horseIndicator)
    {
        $this->getUser()->hasPermission(['update'], 'horse_indicators');

        $horseIndicator->setConnection($this->getUser()->getRole->name);

        $horseIndicator->fill($request->all());

        if ($horseIndicator->save()) {
            return redirect()->route('horseIndicators.show', ['idHorseIndicators' => $horseIndicator->id])->with('success', 'Horse indicator successfully updated');
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
                return redirect()->route('horseIndicators.index')->with('success', 'Horse indicator successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the horse indicator');
            }
        } else {
            $horseIndicatorsToDelete = $request->input('list');
            $result = true;

            foreach ($horseIndicatorsToDelete as $key => $horseIndicatorId) {
                $horseIndicator = new HorseIndicator();
                $horseIndicator->setConnection($this->getUser()->getRole->name);
                $horseIndicator = $horseIndicator->findOrFail($horseIndicatorId);

                if ($horseIndicator->delete()) {
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

            return 'horseindicators';
        }
    }
}
