<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller {

    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }


    public function store()
    {
        //validate
        request()->validate([
            'title'=>'required',
            'description'=>'required'
        ]);

        //persist
        Project::create(request()->only(['title', 'description']));

        //redirect
        return redirect()->route('projects');
    }

    public function show(Project $project)
    {
        //Todo:Pune path la proiect : $project->path() , minutul 3:30
        return view('projects.show',compact('project'));
    }
}
