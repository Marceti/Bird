@extends('layouts.master')

@section('content')

    <div class="card bg-light mb-3" style="max-width: 18rem;">
        <h5 class="card-header">{{$project->title}}</h5>
        <div class="card-body">
            <h5 class="card-title">Description :</h5>
            <p class="card-text">{{$project->description}}</p>
            <a href="#">owner</a>
        </div>
    </div>

@endsection