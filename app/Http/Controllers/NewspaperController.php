<?php

namespace App\Http\Controllers;

use App\Newspaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreNewspaperRequest;
use App\Http\Requests\UpdateNewspaperRequest;

class NewspaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'newspapers');

        // Retrieve the full newspapers list
        $newspapers = DB::connection($this->getUser()->getRole->name)->table('newspapers')->orderBy('dayDate', 'desc')->paginate(20);

        return view('newspapers.index', array(
            'newspapers' => $newspapers
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'newspapers');

        return view('newspapers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNewspaperRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewspaperRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'newspapers');
        // Set the connection to use after having checked the permissions
        $newspaper = new Newspaper();
        $newspaper->setConnection($this->getUser()->getRole->name);

        $newspaper->fill($request->all());
        $explodedList = explode("\r\n", $newspaper->previousDayBestMoments);
        $explodedAgenda= explode("\r\n", $newspaper->agenda);

        $newspaper->previousDayBestMoments = json_encode($explodedList);
        $newspaper->agenda = json_encode($explodedAgenda);

        if ($newspaper->save()) {
            return redirect()->route('newspapers.index')->with('success', 'Newspaper successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the newspaper. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idNewspaper
     * @return \Illuminate\Http\Response
     */
    public function show(int $idNewspaper)
    {
        $this->getUser()->hasPermission(['select'], 'newspapers');

        $newspaper = new Newspaper();
        $newspaper->setConnection($this->getUser()->getRole->name);
        $newspaper = $newspaper->findOrFail($idNewspaper);

        $newspaper->previousDayBestMoments = json_decode($newspaper->previousDayBestMoments);
        $newspaper->agenda = json_decode($newspaper->agenda);

        return view('newspapers.show', ['newspaper' => $newspaper]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idNewspaper
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idNewspaper)
    {
        $this->getUser()->hasPermission(['select'], 'newspapers');

        $newspaper = new Newspaper();
        $newspaper->setConnection($this->getUser()->getRole->name);

        $newspaper = $newspaper->findOrFail($idNewspaper);

        $newspaper->previousDayBestMoments = implode("\r\n", json_decode($newspaper->previousDayBestMoments));
        $newspaper->agenda = implode("\r\n", json_decode($newspaper->agenda));

        return view('newspapers.edit', array(
            'newspaper' => $newspaper
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewspaperRequest  $request
     * @param  \App\Newspaper  $newspaper
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewspaperRequest $request, Newspaper $newspaper)
    {
        $this->getUser()->hasPermission(['update'], 'newspapers');

        $newspaper->setConnection($this->getUser()->getRole->name);

        $newspaper->fill($request->all());
        $explodedList = explode("\r\n", $newspaper->previousDayBestMoments);
        $explodedAgenda= explode("\r\n", $newspaper->agenda);

        $newspaper->previousDayBestMoments = json_encode($explodedList);
        $newspaper->agenda = json_encode($explodedAgenda);

        if ($newspaper->save()) {
            return redirect()->route('newspapers.show', ['idNewspaper' => $newspaper->id])->with('success', 'Newspaper successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the newspaper. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request
     * @param  int $idNewspaper
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idNewspaper)
    {
        $this->getUser()->hasPermission(['delete'], 'newspapers');

        if ($idNewspaper !== 0) {
            $newspaper = new News();
            $newspaper->setConnection($this->getUser()->getRole->name);
            $newspaper = $newspaper->findOrFail($idNewspaper);

            if ($newspaper->delete()) {
                return redirect()->route('newspapers.index')->with('success', 'Newspaper successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the item');
            }
        } else {
            $newspapersToDelete = $request->input('list');
            $result = true;

            foreach ($newspapersToDelete as $key => $newspaperId) {
                $newspaper = new Newspaper();
                $newspaper->setConnection($this->getUser()->getRole->name);
                $newspaper = $newspaper->findOrFail($newspaperId);

                if ($newspaper->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected newspapers were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected newspapers');
            }

            return 'newspapers';
        }
    }
}
