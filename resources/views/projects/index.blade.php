@extends('layouts.master')

@section('content')

    <div class="flex align-items-center mb-4" >
        <h1 class="mr-auto"> My Projects</h1>
        <p class="ml-auto"><a href="/projects/create" class="badge badge-light font-weight-normal py-2 shadow-sm my-2">Create Project</a></p>
    </div>


    <div class="flex">

        @forelse($projects as $project)

            @include('projects.partials._projectIndexCard')

        @empty

            <div> No projects yet.</div>

        @endforelse
    </div>


@endsection