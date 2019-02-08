@extends('layouts.master')

@section('content')

    <header class="flex items-center mb-4 mx-1">
        <div class="flex justify-between  items-end w-full">
            <h2 class="text-grey text-base font-medium">
                <a href="/projects" class="no-underline text-grey text-base font-medium">My Projects </a>
                / {{$project->title}}
            </h2>
        </div>
    </header>

    <main class="lg:flex -mx-3 mb-6">
        <div class="max-h-screen h-auto lg:w-3/4 px-3">{{--Left--}}

            {{-- TASK Section --}}

            <div class="mb-6">
                <h2 class="text-grey font-normal text-lg mb-3">Tasks</h2>

                {{--tasks --}}

                @foreach($project->tasks as $task)

                    <div class="bird-card mb-3">
                        <form method="POST" action="{{$task->path()}}">
                            @csrf
                            @method('PATCH')
                            <div class="flex justify-between w-full">
                                <input class="w-full {{$task->completed ? 'text-grey' : ''}}" value="{{$task->body}}"
                                       name="body">
                                <input type="checkbox" name="completed"
                                       {{$task->completed ? 'checked' : ''}} onchange="this.form.submit()">
                            </div>

                        </form>
                    </div>

                @endforeach

                <div class="bird-card mb-3">
                    <form method="POST" action="{{$project->path().'/tasks'}}">
                        {{csrf_field()}}
                        <input class="w-full" placeholder="Add a new task" name="body">
                    </form>
                </div>

            </div>

            {{-- GENERAL NOTES Section --}}

            <div class="mb-6">
                <h2 class="text-grey font-normal text-lg mb-3">General Notes</h2>
                <form method="POST" action="{{$project->path()}}">
                    {{csrf_field()}}
                    @method('PATCH')

                <textarea
                        class="bird-card w-full"
                        name="notes"
                        placeholder="Anything special that you want to make a note of?"
                        style="min-height: 200px"
                >{{$project->notes}}</textarea>

                    <button type="submit" class="bird-button">Save</button>

                </form>

            </div>


        </div>

        <div class="lg:w-1/4 px-3">{{--Right--}}

            @include('projects.partials._projectShowCard')

        </div>

    </main>

@endsection