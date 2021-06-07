@extends('app.app')
@section('content')

    <div class="wrapper">
        <img src="{{Storage::url($user->photo)}}" alt="">
        <h2>{{$user->name}}</h2>

    </div>

{{--    <p><img src="{{Storage::url($user->photo)}}" alt="" class="w-25"></p>--}}
@endsection
<style>
    .wrapper{
        display: flex;
        flex-direction: column;
    }
</style>


