<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskValidation;
use App\Http\Requests\EditValidation;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
        {
            $id = Auth::id();

        $task = Task::orderBy('created_at','desc')->where('user_id','=',$id)->paginate(2);
        return view('task.index')->with('storedTasks', $task);
        }
        else
            return redirect()->route('login');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskValidation $request, Task $task)
    {
        $newPost = $task->create([
            'task' => $request->get('new_task'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('task');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::check()) {
            $task = Task::find($id);
            return view('task.popup')->with('popname', $task);
        }
        else
            return redirect()->route('login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::check()) {
            $task = Task::find($id);
            if (!empty($request->updatedtask) || strlen($request->updatedtask) != 0) {
                if (strlen($request->updatedtask) > 4) {
                    $task->task = $request->updatedtask;
                    $task->save();
                } else {
                    session()->flash('min_5_char', 'Task should be minimum 5 Characters!');
                    return redirect()->back();
                }


                return redirect()->route('task');
            } else {
                session()->flash('empty', 'Task should be minimum 5 Characters!');
                return redirect()->back();
            }
        }
        else
            return redirect()->route('login');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::check()) {
            $task = Task::find($id);
            $task->delete();

            return redirect()->route('task');
        }
        else
            return redirect()->route('login');
    }
}
