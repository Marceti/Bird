<div class="flex p-3 lg:w-1/3 md:w-1/2 sm:w-full" style="height: 200px" >
    <div class="bird-card">
        <h3 class="bird-card-header">
            <a class="no-underline text-black" href="{{$project->path()}}">{{$project->title}}</a>
        </h3>
        <div class="text-grey">{{str_limit( $project->description,100)}}</div>
    </div>
</div>