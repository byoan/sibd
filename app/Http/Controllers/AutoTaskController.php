<?php

namespace App\Http\Controllers;

use App\AutoTask;
use Illuminate\Http\Request;
use App\Http\Requests\AutoTaskRequest;
use Illuminate\Support\Facades\Db;

class AutoTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'auto_tasks');

        // Retrieve the full task list
        $taskList = DB::connection($this->getUser()->getRole->name)->table('auto_tasks')->paginate(20);

        return view('autotasks.index', array(
            'autotasks' => $taskList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'auto_tasks');

        return view('autotasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AutoTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AutoTaskRequest $request)
    {
        $this->getUser()->hasPermission(['insert'], 'auto_tasks');
        // Set the connection to use after having checked the permissions
        $task = new AutoTask();
        $task->setConnection($this->getUser()->getRole->name);

        $task->fill($request->all());

        if ($task->save()) {
            return redirect()->route('autotasks.index')->with('success', 'Auto task successfully created');
        } else {
            return back()->withErrors('An error occurred while saving the task. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idTask
     * @return \Illuminate\Http\Response
     */
    public function show(int $idTask)
    {
        $this->getUser()->hasPermission(['select'], 'auto_tasks');

        $task = new AutoTask();
        $task->setConnection($this->getUser()->getRole->name);
        $task = $task->findOrFail($idTask);

        return view('autotasks.show', ['autoTask' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idTask
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idTask)
    {
        $this->getUser()->hasPermission(['select'], 'auto_tasks');

        $task = new AutoTask();
        $task->setConnection($this->getUser()->getRole->name);

        $task = $task->findOrFail($idTask);

        return view('autotasks.edit', array(
            'autoTask' => $task
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AutoTaskRequest  $request
     * @param  \App\AutoTask  $autoTask
     * @return \Illuminate\Http\Response
     */
    public function update(AutoTaskRequest $request, AutoTask $autoTask)
    {
        $this->getUser()->hasPermission(['update'], 'auto_tasks');

        $autoTask->setConnection($this->getUser()->getRole->name);

        $autoTask->fill($request->all());

        if ($autoTask->save()) {
            return redirect()->route('autotasks.show', $autoTask->id)->with('success', 'Auto task successfully updated');
        } else {
            return back()->withErrors('An error occurred while saving the task. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $idTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $idTask)
    {
        $this->getUser()->hasPermission(['delete'], 'auto_tasks');

        if ($idTask !== 0) {
            $task = new AutoTask();
            $task->setConnection($this->getUser()->getRole->name);
            $task = $task->findOrFail($idTask);

            if ($task->delete()) {
                return redirect()->route('autotasks.index')->with('success', 'Auto task successfully deleted');
            } else {
                return back()->with('errors', 'An error occurred while deleting the task');
            }
        } else {
            $tasksToDelete = $request->input('list');
            $result = true;

            foreach ($tasksToDelete as $key => $taskId) {
                $task = new AutoTask();
                $task->setConnection($this->getUser()->getRole->name);
                $task = $task->findOrFail($taskId);

                if ($task->delete()) {
                    continue;
                } else {
                    $result = false;
                    break;
                }
            }

            if ($result) {
                $request->session()->flash('success', 'The selected tasks were successfully deleted');
            } else {
                $request->session()->flash('errors', 'An error occurred while deleting the selected tasks');
            }

            return 'autotasks';
        }
    }
}
