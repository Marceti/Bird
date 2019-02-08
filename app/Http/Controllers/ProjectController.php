<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller {


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $projects = auth()->user()->projects()->latest('updated_at')->get();

        return view('projects.index', compact('projects'));
    }


    public function store()
    {
        //validate
        $attributes = request()->validate([
            'title'       => 'required',
            'description' => 'required',
            'notes'       => 'max:255'
        ]);

        //persist
        auth()->user()->projects()->create($attributes);

        //redirect
        return redirect()->route('projects');
    }

    public function show(Project $project)
    {
       $this->authorize('view',$project);

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function update(Project $project)
    {
        //todo:validate


        //authenticate
        $this->authorize('update',$project);

        //persist
        $project->update(['notes' => request('notes')]);

        //redirect
        return redirect($project->path());
    }
}
