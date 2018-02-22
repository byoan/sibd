<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'contests');

        // Retrieve the full contests list
        $contestsList = DB::connection($this->getUser()->getRole->name)->table('contests')->paginate(20);

        return view('contests.index', array(
            'contests' => $contestsList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'contests');

        return view('contests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->getUser()->hasPermission(['insert'], 'contests');
        // Set the connection to use after having checked the permissions
        $contest = new Contest();
        $contest->setConnection($this->getUser()->getRole->name);

        $contest->fill($request->all());

        if ($contest->save()) {
            return redirect()->route('contests.index')->with('success', 'Contest successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the contest. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $idContest
     * @return \Illuminate\Http\Response
     */
    public function show(Int $idContest)
    {
        $this->getUser()->hasPermission(['select'], 'contests');

        $contest = new Contest();
        $contest->setConnection($this->getUser()->getRole->name);
        $contest = $contest->findOrFail($idContest);

        return view('contests.show', ['contest' => $contest]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $idContext
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $idContest)
    {
        $this->getUser()->hasPermission(['select'], 'contests');

        $contest = new Contest();
        $contest->setConnection($this->getUser()->getRole->name);

        $contest = $contest->findOrFail($idContest);

        return view('contests.edit', array(
            'contest' => $contest
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contest $contest)
    {
        $this->getUser()->hasPermission(['update'], 'contests');

        $contest->setConnection($this->getUser()->getRole->name);

        $contest->fill($request->all());

        if ($contest->save()) {
            return redirect()->route('contests.show', ['idContest' => $contest->id])->with('success', 'Contest successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the contest. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param \Illuminate\Http\Request $request
     * @param  int $idContest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idHorse)
    {
        $this->getUser()->hasPermission(['delete'], 'contests');

        if ($idContest !== 0) {
            $contest = new Contest();
            $contest->setConnection($this->getUser()->getRole->name);
            $contest = $contest->findOrFail($idContest);

            if ($contest->delete()) {
                return redirect()->route('contests.index')->with('success', 'Contest successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the contest');
            }
        } else {
            $contestToDelete = $request->input('list');
            $result = true;

            foreach ($contestToDelete as $key => $contestId) {
                $contest = new Contest();
                $contest->setConnection($this->getUser()->getRole->name);
                $contest = $contest->findOrFail($contestId);

                if ($contest->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected contests were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected horses');
            }

            return 'contests';
        }
    }
}
