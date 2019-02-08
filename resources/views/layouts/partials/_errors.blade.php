@if($errors)
    @foreach($errors->all() as $error)
        <li class="text-red text-sm list-reset">{{$error}}</li>
    @endforeach
@endif