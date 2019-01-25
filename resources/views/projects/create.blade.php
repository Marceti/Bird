@extends('layouts.master')

@section('content')
    <h1 class="mx-4">Create a Project</h1>
    <form method="POST" action="/projects">
        {{csrf_field()}}

        <div class="d-flex flex-column bd-highlight mb-1">
            <div class="p-2 bd-highlight form-group">
                <label for="title_field">Title:</label>
                <input type="text" class="form-control" id="title_field" name="title" placeholder="Your Title Here"
                       required>
            </div>
            <div class="p-2 bd-highlight form-group">
                <label for="description_field">Description:</label>
                <textarea type="text" class="form-control" id="description_field" name="description"
                          placeholder="Your Description Here" required rows="3"></textarea>
            </div>

            <button type="submit" class="p-2 mx-2 btn btn-primary">Create Post</button>
        </div>

    </form>







@endsection