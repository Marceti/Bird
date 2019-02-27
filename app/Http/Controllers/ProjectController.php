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


    public function create()
    {
        return view('projects.create');
    }


    public function store()
    {
        //validate
        $attributes = request()->validate([
            'title'       => 'required|min:3',
            'description' => 'required|min:3',
            'notes'       => 'max:255'
        ]);

        //persist
        auth()->user()->projects()->create($attributes);

        //redirect
        return redirect()->route('projects');
    }


    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.edit', compact('project'));
    }


    public function show(Project $project)
    {
        $this->authorize('view', $project);

        return view('projects.show', compact('project'));
    }


    public function update(Project $project)
    {
        //validate
        $attributes = request()->validate([
            'title'       => 'required|min:3',
            'description' => 'required|min:3',
            'notes'       => 'max:255'
        ]);

        //authenticate
        $this->authorize('update', $project);

        //persist
        $project->update($attributes);

        //redirect
        return redirect($project->path());
    }


    public function destroy(Project $project)
    {
        //authenticate
        $this->authorize('delete', $project);
        //persist
        $project->delete();
        //redirect
        return redirect(route('projects'));
    }


}
