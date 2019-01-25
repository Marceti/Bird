@extends('layouts.master')

@section('content')


    <div class="card bg-light mb-3">
        <h5 class="card-header">{{$project->title}}</h5>
        <div class="card-body d-flex flex-column  mx-md-0 px-md-0 pb-0">
            <div class="container pt-2">
                <h5 class="card-title">Description :</h5>
                <p class="card-text">{{$project->description}}</p>
                <hr class="mb-3">
            </div>
            <p class="py-0 ml-auto pr-3"><a class="text-decoration-none" href="#"> {{$project->owner->name}} </a> posted {{$project->created_at->diffForHumans()}}</p>
        </div>
    </div>

    <a class="text-decoration-none" href="{{url()->previous()}}">back</a>
@endsection