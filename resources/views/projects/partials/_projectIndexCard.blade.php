<div class="flex sm:p-3 lg:w-1/3 md:w-1/2 w-full" style="height: 200px" >
    <div class="sm:p-2 bg-white items-stretch rounded sm:shadow">
        <h3 class="sm:mb-3 sm:py-3 text-xl font-semibold">{{$project->title}}</h3>
        <div class="text-grey">{{str_limit( $project->description,100)}}</div>
    </div>
</div>