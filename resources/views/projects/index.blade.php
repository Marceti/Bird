@extends('layouts.master')

@section('content')
    <ul class="list-unstyled">
        @forelse($projects as $project)

            @include('projects.partials._projectIndexCard')

        @empty

            <li> No projects yet.</li>

        @endforelse
    </ul>


@endsection