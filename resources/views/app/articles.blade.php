@extends('app.app')
@section('title')
    Главная
@endsection
@section('content')
    <div class="switch_sort">
        <div class="switch_best_or_all">
            <ul>
                <li><a href="{{route('home')}}">Всё</a></li>
                <li><a href="{{route('best')}}">Лучшее</a></li>
            </ul>
        </div>
        <div class="switch_of_time">
            <ul>
                <li><a href="{{route('articleForTime',['interval'=>'today'])}}">Сегодня</a></li>
                <li><a href="{{route('articleForTime',['interval'=>'oneWeak'])}}">Неделя</a></li>
                <li><a href="{{route('articleForTime',['interval'=>'forYear'])}}">За год</a></li>
            </ul>
        </div>
    </div>
    @yield('articleContent')
@endsection
