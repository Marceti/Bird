@if($errors->any())
    <div class="p-4 mx-4">

        @foreach($errors->all() as $error)
            <li class="text-red text-sm list-reset">{{$error}}</li>
        @endforeach

    </div>
@endif