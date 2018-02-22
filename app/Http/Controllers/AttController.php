<?php

namespace App\Http\Controllers;

use App\Att;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'atts');

        // Retrieve the full horse att list
        $attsList = DB::connection($this->getUser()->getRole->name)->table('atts')->paginate(20);
        
        return view('atts.index', array(
            'atts' => $attsList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'atts');

        return view('atts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->getUser()->hasPermission(['insert'], 'atts');
        // Set the connection to use after having checked the permissions
        $att = new Att();
        $att->setConnection($this->getUser()->getRole->name);

        $att->fill($request->all());

        if ($att->save()) {
            return redirect()->route('atts.index')->with('success', 'Attribute successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the attribute. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idAtt
     * @return \Illuminate\Http\Response
     */
    public function show(Int $idAtt)
    {
        $this->getUser()->hasPermission(['select'], 'atts');

        $att = new Att();
        $att->setConnection($this->getUser()->getRole->name);
        $att = $att->findOrFail($idAtt);

        return view('atts.show', ['att' => $att]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idAtt
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $idAtt)
    {
        $this->getUser()->hasPermission(['select'], 'atts');

        $att = new Att();
        $att->setConnection($this->getUser()->getRole->name);

        $att = $att->findOrFail($idAtt);

        return view('atts.edit', array(
            'att' => $att
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Att  $att
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Att $att)
    {
        $this->getUser()->hasPermission(['update'], 'atts');

        $att->setConnection($this->getUser()->getRole->name);

        $att->fill($request->all());

        if ($att->save()) {
            return redirect()->route('atts.show', $att->id)->with('success', 'Attribute successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the attribute. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idAtt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idAtt)
    {
        $this->getUser()->hasPermission(['delete'], 'atts');

        if ($idAtt !== 0) {
            $att = new Att();
            $att->setConnection($this->getUser()->getRole->name);
            $att = $att->findOrFail($idAtt);

            if ($att->delete()) {
                return redirect()->route('atts.index')->with('success', 'Attribute successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the attribute');
            }
        } else {
            $attsToDelete = $request->input('list');
            $result = true;

            foreach ($attsToDelete as $key => $attId) {
                $att = new Att();
                $att->setConnection($this->getUser()->getRole->name);
                $att = $att->findOrFail($attId);

                if ($att->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected attributes were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected attribute');
            }

            return 'atts';
        }
    }
}
