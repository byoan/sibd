<?php

namespace App\Http\Controllers;

use App\HorseAtt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\HorseAttRequest;

class HorseAttController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'horse_atts');

        // Retrieve the full horse att list
        $attsList = DB::connection($this->getUser()->getRole->name)->table('horse_atts')->paginate(20);

        return view('horseatts.index', array(
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
        $this->getUser()->hasPermission(['insert'], 'horse_atts');

        return view('horseatts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\HorseAttRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HorseAttRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'horse_atts');
        // Set the connection to use after having checked the permissions
        $att = new HorseAtt();
        $att->setConnection($this->getUser()->getRole->name);

        $att->fill($request->all());

        if ($att->save()) {
            return redirect()->route('horseatts.index')->with('success', 'Horse-Attribute relation successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the Horse-Attribute relation. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HorseAtt  $horseAtt
     * @return \Illuminate\Http\Response
     */
    public function show(int $horseAttId)
    {
        $this->getUser()->hasPermission(['select'], 'horse_atts');

        $horseAtt = new HorseAtt();
        $horseAtt->setConnection($this->getUser()->getRole->name);
        $horseAtt = $horseAtt->findOrFail($horseAttId);

        return view('horseatts.show', ['att' => $horseAtt]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $horseAttId
     * @return \Illuminate\Http\Response
     */
    public function edit(int $horseAttId)
    {
        $this->getUser()->hasPermission(['select'], 'horse_atts');

        $horseAtt = new HorseAtt();
        $horseAtt->setConnection($this->getUser()->getRole->name);
        $horseAtt = $horseAtt->findOrFail($horseAttId);

        return view('horseatts.edit', array(
            'att' => $horseAtt
        ));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $horseAttId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $horseAttId)
    {
        $this->getUser()->hasPermission(['update'], 'horse_atts');
        $horseAtt = new HorseAtt();
        $horseAtt->setConnection($this->getUser()->getRole->name);

        $horseAtt = $horseAtt->findOrFail($horseAttId);
        $horseAtt->fill($request->all());

        if ($horseAtt->save()) {
            return redirect()->route('horseatts.show', ['idHorseAtt' => $horseAtt->id])->with('success', 'Horse-Attribute relation successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the Horse-Attribute relation. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $horseAttId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $horseAttId)
    {
        $this->getUser()->hasPermission(['delete'], 'horse_atts');

        if ($horseAttId !== 0) {
            $horseAtt = new HorseAtt();
            $horseAtt->setConnection($this->getUser()->getRole->name);
            $horseAtt = $horseAtt->findOrFail($horseAttId);

            if ($horseAtt->delete()) {
                return redirect()->route('horseatts.index')->with('success', 'Horse-Attribute relation successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the Horse-Attribute relation');
            }
        } else {
            $horseAttsToDelete = $request->input('list');
            $result = true;

            foreach ($horseAttsToDelete as $key => $idHorseAtt) {
                $horseAtt = new HorseAtt();
                $horseAtt->setConnection($this->getUser()->getRole->name);
                $horseAtt = $horseAtt->findOrFail($idHorseAtt);

                if ($horseAtt->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected horse-attribute relations were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected horse-attribute relation');
            }

            return 'horseatts';
        }

    }
}
