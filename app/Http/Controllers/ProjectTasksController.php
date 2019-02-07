<?php

namespace App\Http\Controllers;

use App\Project;
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
}
