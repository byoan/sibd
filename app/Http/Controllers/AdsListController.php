<?php

namespace App\Http\Controllers;

use App\AdList;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdsListRequest;
use App\Http\Requests\UpdateAdsListRequest;
use Illuminate\Support\Facades\DB;

class AdsListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'ad_lists');

        // Retrieve the full ads list
        $adsList = DB::connection($this->getUser()->getRole->name)->table('ad_lists')->paginate(20);

        return view('adslist.index', array(
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
        $this->getUser()->hasPermission(['insert'], 'ad_lists');

        return view('adslist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdsListRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdsListRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'ad_lists');
        // Set the connection to use after having checked the permissions
        $adList = new AdList();
        $adList->setConnection($this->getUser()->getRole->name);

        $adList->fill($request->all());

        if ($adList->save()) {
            return redirect()->route('adslist.index')->with('success', 'Ad list successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the ad list. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idAdList
     * @return \Illuminate\Http\Response
     */
    public function show(int $idAdList)
    {
        $this->getUser()->hasPermission(['select'], 'ad_lists');

        $adList = new AdList();
        $adList->setConnection($this->getUser()->getRole->name);
        $adList = $adList->findOrFail($idAdList);

        return view('adslist.show', ['ad' => $adList]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idAdList
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idAdList)
    {
        $this->getUser()->hasPermission(['select'], 'ad_lists');

        $adList = new AdList();
        $adList->setConnection($this->getUser()->getRole->name);

        $adList = $adList->findOrFail($idAdList);

        return view('adslist.edit', array(
            'ad' => $adList
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdsListRequest $request
     * @param  \App\AdList  $adList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdsListRequest $request, AdList $adList)
    {
        $this->getUser()->hasPermission(['update'], 'ad_lists');

        $adList->setConnection($this->getUser()->getRole->name);

        $adList->fill($request->all());

        if ($adList->save()) {
            return redirect()->route('adslist.show', ['idAdList' => $adList->id])->with('success', 'Ad list successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the ad list. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request
     * @param  int  $idAdList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idAdList)
    {
        $this->getUser()->hasPermission(['delete'], 'ad_lists');

        if ($idAdList !== 0) {
            $adList = new AdList();
            $adList->setConnection($this->getUser()->getRole->name);
            $adList = $adList->findOrFail($idAdList);

            if ($adList->delete()) {
                return redirect()->route('adslist.index')->with('success', 'Ad list successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the ad list');
            }
        } else {
            $adsToDelete = $request->input('list');
            $result = true;

            foreach ($adsToDelete as $key => $adId) {
                $adList = new AdList();
                $adList->setConnection($this->getUser()->getRole->name);
                $adList = $adList->findOrFail($adId);

                if ($adList->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected ad lists were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected ad lists');
            }

            return 'adslist';
        }
    }
}
