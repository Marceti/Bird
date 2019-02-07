<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{

    public function store(Project $project)
    {

        request()->validate([
            'body'=>'required'
        ]);

        abort_if(auth()->user()->isNot($project->owner),403);


        $project->addTask(request('body'));

        return redirect($project->path());

    }

    public function update(Project $project, Task $task)
    {
        abort_if(auth()->user()->isNot($project->owner),403);

        request()->validate([
            'body'=>'required',
        ]);

        $task->update([
            'body'=>request('body'),
            'completed'=> request()->has('completed')
        ]);
        return redirect($project->path());
    }
}
