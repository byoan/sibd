<?php

namespace App\Http\Controllers;

use App\DiseasesList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DiseasesListRequest;

class DiseaseListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'diseases_lists');

        // Retrieve the full diseases lists list
        $diseasesList = DB::connection($this->getUser()->getRole->name)->table('diseases_lists')->paginate(20);

        return view('diseaselists.index', array(
            'diseases' => $diseasesList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'diseases_lists');

        return view('diseaselists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DiseasesListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiseasesListRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'diseases_lists');
        // Set the connection to use after having checked the permissions
        $disease = new DiseasesList();
        $disease->setConnection($this->getUser()->getRole->name);

        $disease->fill($request->all());

        if ($disease->save()) {
            return redirect()->route('diseasesLists.index')->with('success', 'Horse disease relation successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the horse disease relation. Please try again later.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $diseasesListId
     * @return \Illuminate\Http\Response
     */
    public function show(int $diseasesListId)
    {
        $this->getUser()->hasPermission(['select'], 'diseases_lists');

        $disease = new DiseasesList();
        $disease->setConnection($this->getUser()->getRole->name);
        $disease = $disease->findOrFail($diseasesListId);

        return view('diseaselists.show', ['disease' => $disease]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $diseasesListId
     * @return \Illuminate\Http\Response
     */
    public function edit(int $diseasesListId)
    {
        $this->getUser()->hasPermission(['select'], 'diseases_lists');

        $disease = new DiseasesList();
        $disease->setConnection($this->getUser()->getRole->name);

        $disease = $disease->findOrFail($diseasesListId);

        return view('diseaselists.edit', array(
            'disease' => $disease
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DiseasesListRequest  $request
     * @param  \App\DiseasesList  $diseasesList
     * @return \Illuminate\Http\Response
     */
    public function update(DiseasesListRequest $request, DiseasesList $diseasesList)
    {
        $this->getUser()->hasPermission(['update'], 'diseases_lists');

        $diseasesList->setConnection($this->getUser()->getRole->name);

        $diseasesList->fill($request->all());

        if ($diseasesList->save()) {
            return redirect()->route('diseasesLists.show', $diseasesList->id)->with('success', 'Disease list successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the disease list . Please try again later.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $diseasesListId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $diseasesListId)
    {
        $this->getUser()->hasPermission(['delete'], 'diseases_lists');

        if ($diseasesListId !== 0) {
            $disease = new DiseasesList();
            $disease->setConnection($this->getUser()->getRole->name);
            $disease = $disease->findOrFail($diseasesListId);

            if ($disease->delete()) {
                return redirect()->route('diseasesLists.index')->with('success', 'Disease list entry successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the entry from the diseases list');
            }
        } else {
            $diseasesToDelete = $request->input('list');
            $result = true;

            foreach ($diseasesToDelete as $key => $diseaseId) {
                $disease = new DiseasesList();
                $disease->setConnection($this->getUser()->getRole->name);
                $disease = $disease->findOrFail($diseaseId);

                if ($disease->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected diseases list entries were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected diseases list entries');
            }

            return 'diseasesLists';
        }
    }
}
