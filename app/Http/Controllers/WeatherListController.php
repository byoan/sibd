<?php

namespace App\Http\Controllers;

use App\WeatherList;
use Illuminate\Http\Request;
use App\Http\Requests\StoreWeathersListRequest;
use App\Http\Requests\UpdateWeathersListRequest;
use Illuminate\Support\Facades\DB;

class WeatherListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'weather_lists');

        // Retrieve the full horse weatherList list
        $weatherListsList = DB::connection($this->getUser()->getRole->name)->table('weather_lists')->paginate(20);

        return view('weatherLists.index', array(
            'weatherLists' => $weatherListsList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'weather_lists');

        return view('weatherLists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWeathersListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWeathersListRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'weather_lists');
        // Set the connection to use after having checked the permissions
        $weatherList = new WeatherList();
        $weatherList->setConnection($this->getUser()->getRole->name);

        $weatherList->fill($request->all());

        if ($weatherList->save()) {
            return redirect()->route('weatherlists.index')->with('success', 'WeatherList successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the weatherList. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idWeatherList
     * @return \Illuminate\Http\Response
     */
    public function show(int $idWeatherList)
    {
        $this->getUser()->hasPermission(['select'], 'weather_lists');

        $weatherList = new WeatherList();
        $weatherList->setConnection($this->getUser()->getRole->name);
        $weatherList = $weatherList->findOrFail($idWeatherList);

        return view('weatherLists.show', ['weatherList' => $weatherList]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idWeatherList
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idWeatherList)
    {
        $this->getUser()->hasPermission(['select'], 'weather_lists');

        $weatherList = new WeatherList();
        $weatherList->setConnection($this->getUser()->getRole->name);

        $weatherList = $weatherList->findOrFail($idWeatherList);

        return view('weatherLists.edit', array(
            'weatherList' => $weatherList
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWeathersListRequest  $request
     * @param  \App\WeatherList  $weatherList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWeathersListRequest $request, WeatherList $weatherList)
    {
        $this->getUser()->hasPermission(['update'], 'weather_lists');

        $weatherList->setConnection($this->getUser()->getRole->name);

        $weatherList->fill($request->all());

        if ($weatherList->save()) {
            return redirect()->route('weatherlists.show', $weatherList->id)->with('success', 'WeatherList successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the weatherList. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idWeatherList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idWeatherList)
    {
        $this->getUser()->hasPermission(['delete'], 'weather_lists');

        if ($idWeatherList !== 0) {
            $weatherList = new WeatherList();
            $weatherList->setConnection($this->getUser()->getRole->name);
            $weatherList = $weatherList->findOrFail($idWeatherList);

            if ($weatherList->delete()) {
                return redirect()->route('weatherlists.index')->with('success', 'WeatherList successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the weatherList');
            }
        } else {
            $weatherListsToDelete = $request->input('list');
            $result = true;

            foreach ($weatherListsToDelete as $key => $weatherListId) {
                $weatherList = new WeatherList();
                $weatherList->setConnection($this->getUser()->getRole->name);
                $weatherList = $weatherList->findOrFail($weatherListId);

                if ($weatherList->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected weatherLists were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected weatherList');
            }

            return 'weatherlists';
        }
    }
}
