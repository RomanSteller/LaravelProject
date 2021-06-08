@extends('app.app')
@section('content')

    <div class="wrapper">
        <div class="container">
        <img src="{{Storage::url($user->photo)}}" alt="">
        <h2>{{$user->name}}</h2>

        <ul>
            <li><a href="{{route('getUserArticles',['id'=>$_SESSION['user']['id'],'statistic_name'=>'articles'])}}">Статьи</a></li>
            <li><a href="#">Избранное</a></li>
            <li><a href="#">Комментарии</a></li>
            <li><a href="#">История просмотра</a></li>
        </ul>

            @yield('statistic')
        </div>
    </div>

{{--    <p><img src="{{Storage::url($user->photo)}}" alt="" class="w-25"></p>--}}
@endsection
<style>
    .wrapper{
        display: flex;
        flex-direction: column;
    }

    ul{
        display: flex;

    }

    ul>li{
        margin-left: 20px;
    }

    a:active{
        border-bottom: 2px solid cornflowerblue;
    }
</style>


