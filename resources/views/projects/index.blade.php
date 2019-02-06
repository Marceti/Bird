@extends('layouts.master')

@section('content')

    <header class="flex items-center mb-4 mx-1" >
        <div class="flex justify-between  items-end w-full">
            <h2 class=" text-grey text-base font-medium"> My Projects</h2>
            <a href="/projects/create" class="bird-button">Create Project</a>
        </div>
    </header>


    <main class="flex flex-wrap">

        @forelse($projects as $project)
            <div class="flex p-3 lg:w-1/3 md:w-1/2 sm:w-full" >
            @include('projects.partials._projectIndexCard')
            </div>
        @empty

            <div> No projects yet.</div>

        @endforelse
    </main>


@endsection