<?php

namespace App\Http\Controllers;

use App\Weather;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'weathers');

        // Retrieve the full horse weather list
        $weathersList = DB::connection($this->getUser()->getWeather->name)->table('weathers')->paginate(20);
        
        return view('weathers.index', array(
            'weathers' => $weathersList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'weathers');

        return view('weathers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->getUser()->hasPermission(['insert'], 'weathers');
        // Set the connection to use after having checked the permissions
        $weather = new Weather();
        $weather->setConnection($this->getUser()->getWeather->name);

        $weather->fill($request->all());

        if ($weather->save()) {
            return redirect()->route('weathers.index')->with('success', 'Weather successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the weather. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idWeather
     * @return \Illuminate\Http\Response
     */
    public function show(Int $idWeather)
    {
        $this->getUser()->hasPermission(['select'], 'weathers');

        $weather = new Weather();
        $weather->setConnection($this->getUser()->getWeather->name);
        $weather = $weather->findOrFail($idWeather);

        return view('weathers.show', ['weather' => $weather]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idWeather
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $idWeather)
    {
        $this->getUser()->hasPermission(['select'], 'weathers');

        $weather = new Weather();
        $weather->setConnection($this->getUser()->getWeather->name);

        $weather = $weather->findOrFail($idWeather);

        return view('weathers.edit', array(
            'weather' => $weather
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Weather  $weather
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Weather $weather)
    {
        $this->getUser()->hasPermission(['update'], 'weathers');

        $weather->setConnection($this->getUser()->getWeather->name);

        $weather->fill($request->all());

        if ($weather->save()) {
            return redirect()->route('weathers.show', $weather->id)->with('success', 'Weather successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the weather. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idweather
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idWeather)
    {
        $this->getUser()->hasPermission(['delete'], 'weathers');

        if ($idWeather !== 0) {
            $weather = new Weather();
            $weather->setConnection($this->getUser()->getWeather->name);
            $weather = $weather->findOrFail($idWeather);

            if ($weather->delete()) {
                return redirect()->route('weathers.index')->with('success', 'Weather successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the weather');
            }
        } else {
            $weathersToDelete = $request->input('list');
            $result = true;

            foreach ($weathersToDelete as $key => $weatherId) {
                $weather = new Weather();
                $weather->setConnection($this->getUser()->getWeather->name);
                $weather = $weather->findOrFail($weatherId);

                if ($weather->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected weathers were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected weather');
            }

            return 'weathers';
        }
    }
}