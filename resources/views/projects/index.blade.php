@extends('layouts.master')

@section('content')

    @foreach($projects as $project)
        @include('projects.partials._projectIndexCard')
    @endforeach



@endsection