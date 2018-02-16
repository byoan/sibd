<?php

namespace App\Http\Controllers;

use App\Indicator;
use Illuminate\Http\Request;
use App\Http\Requests\IndicatorRequest;
use Illuminate\Support\Facades\Db;

class IndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'indicators');

        // Retrieve the full ads list
        $indicatorsList = DB::connection($this->getUser()->getRole->name)->table('indicators')->paginate(20);

        return view('indicators.index', array(
            'indicators' => $indicatorsList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'indicators');

        return view('indicators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\IndicatorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndicatorRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'indicators');
        // Set the connection to use after having checked the permissions
        $indicator = new Indicator();
        $indicator->setConnection($this->getUser()->getRole->name);

        $indicator->fill($request->all());

        if ($indicator->save()) {
            return redirect()->route('indicators.index')->with('success', 'Indicator successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the indicator. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idAndicator
     * @return \Illuminate\Http\Response
     */
    public function show(int $idIndicator)
    {
        $this->getUser()->hasPermission(['select'], 'indicators');

        $indicator = new Indicator();
        $indicator->setConnection($this->getUser()->getRole->name);
        $indicator = $indicator->findOrFail($idIndicator);

        return view('indicators.show', ['indicator' => $indicator]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idIndicator
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idIndicator)
    {
        $this->getUser()->hasPermission(['select'], 'indicators');

        $indicator = new Indicator();
        $indicator->setConnection($this->getUser()->getRole->name);

        $indicator = $indicator->findOrFail($idIndicator);

        return view('indicators.edit', array(
            'indicator' => $indicator
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\IndicatorRequest  $request
     * @param  \App\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function update(IndicatorRequest $request, Indicator $indicator)
    {
        $this->getUser()->hasPermission(['update'], 'indicators');

        $indicator->setConnection($this->getUser()->getRole->name);

        $indicator->fill($request->all());

        if ($indicator->save()) {
            return redirect()->route('indicators.show', ['idIndicator' => $indicator->id])->with('success', 'Indicator successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the indicator. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $idIndicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idIndicator)
    {
        $this->getUser()->hasPermission(['delete'], 'indicators');

        if ($idIndicator !== 0) {
            $indicator = new Indicator();
            $indicator->setConnection($this->getUser()->getRole->name);
            $indicator = $indicator->findOrFail($idIndicator);

            if ($indicator->delete()) {
                return redirect()->route('indicators.index')->with('success', 'Indicator successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the ad');
            }
        } else {
            $indicatorsToDelete = $request->input('list');
            $result = true;

            foreach ($indicatorsToDelete as $key => $indicatorId) {
                $indicator = new Indicator();
                $indicator->setConnection($this->getUser()->getRole->name);
                $indicator = $indicator->findOrFail($indicatorId);

                if ($indicator->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected indicators were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected indicators');
            }

            return 'indicators';
        }
    }
}
