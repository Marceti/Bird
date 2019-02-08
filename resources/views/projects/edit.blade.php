@extends('layouts.master')

@section('content')

    <main class="container">
    <h1 class="mx-4">Edit your Project</h1>
    <form method="POST" action="{{$project->path()}}">
        {{csrf_field()}}
        @method('PATCH')
        <div class="d-flex flex-column bd-highlight mb-1">

            {{-- Title --}}

            <div class="p-2 bd-highlight form-group">
                <label for="title_field">Title:</label>
                <input type="text"
                       class="form-control"
                       id="title_field"
                       name="title"
                       placeholder="Your Title Here"
                       value="{{$project->title}}"
                       required>
            </div>

            {{-- Description --}}

            <div class="p-2 bd-highlight form-group">
                <label for="description_field">Description:</label>
                <textarea type="text"
                          class="form-control"
                          id="description_field"
                          name="description"
                          placeholder="Your Description Here"
                          required
                          rows="3"
                >{{$project->description}}</textarea>
            </div>

            {{-- Submit Button --}}

            <button type="submit" class="p-2 mx-2 btn btn-primary">Save Updates</button>
            <a href="{{$project->path()}}" class="no-underline text-base text-blue text-center py-3">Cancel</a>
        </div>

    </form>
        @include('layouts.partials._errors')
    </main>
@endsection