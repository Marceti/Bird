<div class="bird-card flex flex-col justify-between" style="height: 200px">
    <div class="">
        <h3 class="bird-card-header">
            <a class="no-underline text-black" href="{{$project->path()}}">{{$project->title}}</a>
        </h3>
        <div class="text-grey">{{str_limit( $project->description,100)}}</div>
    </div>
    <div class="self-end">
        <form method="POST" action="{{$project->path()}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="bird-button">delete</button>
        </form>
    </div>
</div>
