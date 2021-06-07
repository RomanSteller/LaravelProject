@extends('app.app')
@section('title')
    Главная
@endsection
@section('content')
    <nav>
        <ul>
            <li><a href="#">Статьи</a></li>
            <li><a href="#">Новости</a></li>
            <li><a href="#">Авторы</a></li>
        </ul>
    </nav>
    <div class="switch_sort">
        <div class="switch_best_or_all">
            <ul>
                <li><a href="{{route('home')}}">Всё</a></li>
                <li><a href="{{route('best')}}">Лучшее</a></li>
            </ul>
        </div>
        <div class="switch_of_time">
            <ul>
                <li><a href="#">Сегодня</a></li>
                <li><a href="#">Неделя</a></li>
                <li><a href="#">Всё время</a></li>
            </ul>
        </div>
    </div>
    @yield('articleContent')
@endsection
