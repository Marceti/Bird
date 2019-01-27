<div class="bg-white p-4 rounded sm:shadow lg:w-1/3 md:w-1/2 w-full" style="height: 200px" >
    <h3 class="pb-3 font-normal text-xl">{{$project->title}}</h3>
    <div>{{str_limit( $project->description,100)}}</div>
</div>