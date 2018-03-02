<?php

namespace App\Http\Controllers;

use App\Disease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DiseaseRequest;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'diseases');

        // Retrieve the full task list
        $diseasesList = DB::connection($this->getUser()->getRole->name)->table('diseases')->paginate(20);

        return view('diseases.index', array(
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
        $this->getUser()->hasPermission(['insert'], 'diseases');

        return view('diseases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DiseaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiseaseRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'diseases');
        // Set the connection to use after having checked the permissions
        $disease = new Disease();
        $disease->setConnection($this->getUser()->getRole->name);

        $disease->fill($request->all());

        if ($disease->save()) {
            return redirect()->route('diseases.index')->with('success', 'Disease successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the disease. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idDisease
     * @return \Illuminate\Http\Response
     */
    public function show(int $idDisease)
    {
        $this->getUser()->hasPermission(['select'], 'diseases');

        $disease = new Disease();
        $disease->setConnection($this->getUser()->getRole->name);
        $disease = $disease->findOrFail($idDisease);

        return view('diseases.show', ['disease' => $disease]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idDisease
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idDisease)
    {
        $this->getUser()->hasPermission(['select'], 'diseases');

        $disease = new Disease();
        $disease->setConnection($this->getUser()->getRole->name);

        $disease = $disease->findOrFail($idDisease);

        return view('diseases.edit', array(
            'disease' => $disease
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DiseaseRequest  $request
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(DiseaseRequest $request, Disease $disease)
    {
        $this->getUser()->hasPermission(['update'], 'diseases');

        $disease->setConnection($this->getUser()->getRole->name);

        $disease->fill($request->all());

        if ($disease->save()) {
            return redirect()->route('diseases.show', $disease->id)->with('success', 'Disease successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the disease. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $idDisease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idDisease)
    {
        $this->getUser()->hasPermission(['delete'], 'diseases');

        if ($idDisease !== 0) {
            $disease = new Disease();
            $disease->setConnection($this->getUser()->getRole->name);
            $disease = $disease->findOrFail($idDisease);

            if ($disease->delete()) {
                return redirect()->route('diseases.index')->with('success', 'Disease successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the disease');
            }
        } else {
            $diseasesToDelete = $request->input('list');
            $result = true;

            foreach ($diseasesToDelete as $key => $diseaseId) {
                $disease = new Disease();
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
                $request->session()->flash('success', 'The selected diseases were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected diseases');
            }

            return 'diseases';
        }
    }
}
