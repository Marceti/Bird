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
        $attributes=request()->validate([
            'title'=>'required',
            'description'=>'required'
        ]);

        //persist
        auth()->user()->projects()->create($attributes);

        //redirect
        return redirect()->route('projects');
    }

    public function show(Project $project)
    {
        if (auth()->user()->isNot($project->owner)){
            abort(403);
        }
        return view('projects.show',compact('project'));
    }

    public function create()
    {
return view('projects.create');
    }
}
