<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller {

    public function index()
    {
        //TODO:filter result
        $projects = Project::all();

        //TODO:show filtered projects
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
}
