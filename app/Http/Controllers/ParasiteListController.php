<?php

namespace App\Http\Controllers;

use App\ParasiteList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParasiteListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'parasite_lists');

        // Retrieve the full horse parasiteList list
        $parasiteListsList = DB::connection($this->getUser()->getRole->name)->table('parasite_lists')->paginate(20);

        return view('parasiteLists.index', array(
            'parasiteLists' => $parasiteListsList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'parasite_lists');

        return view('parasiteLists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->getUser()->hasPermission(['insert'], 'parasite_lists');
        // Set the connection to use after having checked the permissions
        $parasiteList = new ParasiteList();
        $parasiteList->setConnection($this->getUser()->getRole->name);

        $parasiteList->fill($request->all());

        if ($parasiteList->save()) {
            return redirect()->route('parasitelists.index')->with('success', 'ParasiteList successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the parasiteList. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idParasiteList
     * @return \Illuminate\Http\Response
     */
    public function show(int $idParasiteList)
    {
        $this->getUser()->hasPermission(['select'], 'parasite_lists');

        $parasiteList = new ParasiteList();
        $parasiteList->setConnection($this->getUser()->getRole->name);
        $parasiteList = $parasiteList->findOrFail($idParasiteList);

        return view('parasitelists.show', ['parasiteList' => $parasiteList]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idParasiteList
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idParasiteList)
    {
        $this->getUser()->hasPermission(['select'], 'parasite_lists');

        $parasiteList = new ParasiteList();
        $parasiteList->setConnection($this->getUser()->getRole->name);

        $parasiteList = $parasiteList->findOrFail($idParasiteList);

        return view('parasiteLists.edit', array(
            'parasiteList' => $parasiteList
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParasiteList  $parasiteList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParasiteList $parasiteList)
    {
        $this->getUser()->hasPermission(['update'], 'parasite_lists');

        $parasiteList->setConnection($this->getUser()->getRole->name);

        $parasiteList->fill($request->all());

        if ($parasiteList->save()) {
            return redirect()->route('parasitelists.show', $parasiteList->id)->with('success', 'ParasiteList successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the parasiteList. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idParasiteList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idParasiteList)
    {
        $this->getUser()->hasPermission(['delete'], 'parasite_lists');

        if ($idParasiteList !== 0) {
            $parasiteList = new ParasiteList();
            $parasiteList->setConnection($this->getUser()->getRole->name);
            $parasiteList = $parasiteList->findOrFail($idParasiteList);

            if ($parasiteList->delete()) {
                return redirect()->route('parasitelists.index')->with('success', 'ParasiteList successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the parasiteList');
            }
        } else {
            $parasiteListsToDelete = $request->input('list');
            $result = true;

            foreach ($parasiteListsToDelete as $key => $parasiteListId) {
                $parasiteList = new ParasiteList();
                $parasiteList->setConnection($this->getUser()->getRole->name);
                $parasiteList = $parasiteList->findOrFail($parasiteListId);

                if ($parasiteList->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected parasiteLists were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected parasiteList');
            }

            return 'parasitelists';
        }
    }
}
