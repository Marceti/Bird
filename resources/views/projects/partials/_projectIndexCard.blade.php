    <div class="bird-card" style="height: 200px">
        <h3 class="bird-card-header">
            <a class="no-underline text-black" href="{{$project->path()}}">{{$project->title}}</a>
        </h3>
        <div class="text-grey">{{str_limit( $project->description,100)}}</div>
    </div>
