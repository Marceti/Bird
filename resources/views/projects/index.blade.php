@extends('layouts.master')

@section('content')

    <header class="flex items-center mb-4 mx-2" >
        <div class="flex justify-between  items-center w-full">
            <h2 class=" text-grey text-base font-medium"> My Projects</h2>
            <a href="/projects/create" class="button-1">Create Project</a>
        </div>
    </header>


    <main class="flex flex-wrap">

        @forelse($projects as $project)

            @include('projects.partials._projectIndexCard')

        @empty

            <div> No projects yet.</div>

        @endforelse
    </main>


@endsection