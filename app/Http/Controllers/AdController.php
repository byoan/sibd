<?php

namespace App\Http\Controllers;

use App\Ad;
use Illuminate\Http\Request;
use App\Http\Requests\AdRequest;
use Illuminate\Support\Facades\DB;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'ads');

        // Retrieve the full ads list
        $adsList = DB::connection($this->getUser()->getRole->name)->table('ads')->paginate(20);

        return view('ads.index', array(
            'ads' => $adsList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'ads');

        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AdRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'ads');
        // Set the connection to use after having checked the permissions
        $ad = new Ad();
        $ad->setConnection($this->getUser()->getRole->name);

        $ad->fill($request->all());

        if ($ad->save()) {
            return redirect()->route('ads.index')->with('success', 'Ad successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the ad. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idAd
     * @return \Illuminate\Http\Response
     */
    public function show(int $idAd)
    {
        $this->getUser()->hasPermission(['select'], 'ads');

        $ad = new Ad();
        $ad->setConnection($this->getUser()->getRole->name);
        $ad = $ad->findOrFail($idAd);

        return view('ads.show', ['ad' => $ad]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idAd
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idAd)
    {
        $this->getUser()->hasPermission(['select'], 'ads');

        $ad = new Ad();
        $ad->setConnection($this->getUser()->getRole->name);

        $ad = $ad->findOrFail($idAd);

        return view('ads.edit', array(
            'ad' => $ad
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\AdRequest  $request
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(AdRequest $request, Ad $ad)
    {
        $this->getUser()->hasPermission(['update'], 'ads');

        $ad->setConnection($this->getUser()->getRole->name);

        $ad->fill($request->all());

        if ($ad->save()) {
            return redirect()->route('ads.show', ['idAd' => $ad->id])->with('success', 'Ad successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the ad. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idAd)
    {
        $this->getUser()->hasPermission(['delete'], 'ads');

        if ($idAd !== 0) {
            $ad = new Ad();
            $ad->setConnection($this->getUser()->getRole->name);
            $ad = $ad->findOrFail($idAd);

            if ($ad->delete()) {
                return redirect()->route('ads.index')->with('success', 'Ad successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the ad');
            }
        } else {
            $adsToDelete = $request->input('list');
            $result = true;

            foreach ($adsToDelete as $key => $adId) {
                $ad = new Ad();
                $ad->setConnection($this->getUser()->getRole->name);
                $ad = $ad->findOrFail($adId);

                if ($ad->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected ads were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected ads');
            }

            return 'ads';
        }
    }
}
