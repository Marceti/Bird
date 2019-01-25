@extends('layouts.master')

@section('content')
    <ul class="list-unstyled">
        @forelse($projects as $project)

            @include('projects.partials._projectIndexCard')

        @empty

            <li> No projects yet.</li>

        @endforelse
    </ul>

    <a href="/projects/create" class="badge badge-light font-weight-normal py-3 shadow-sm ">Create Project</a>
@endsection