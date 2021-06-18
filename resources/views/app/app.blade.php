<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="shortcut icon" href="{{Storage::url('logo/favicon.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
</head>
<body>
<header>

    <div class="container header_container">

        <div class="header_logo">
            <a href="{{route('home')}}"><img src="{{Storage::url('logo/logo.png')}}" alt=""></a>
        </div>
        @if(!isset($_SESSION['user']))
        <div class="header_user_nickname">
            <a href="{{route('auth')}}" style="color: white">Авторизоваться</a>
        </div>
        @else
            <div class="header_user_nickname">
                <ul>
                    <li class="top-li" id="top-li"><a href="#" class="user-a">{{$_SESSION['user']['login']}}</a>
                        <ul class="child-ul" id="child-ul">
                            <li class="li li-top"><a href="{{route('getUserArticles',['id'=>$_SESSION['user']['id'],'statistic_name'=>'articles'])}}" class="li-a">Профиль</a></li>
                            <li class="li"><a href="{{route('newArticleForm')}}" class="li-a">Новый пост</a></li>
                            @if($_SESSION['user']['role'] === 'admin')
                                <li class="li"><a href="{{route('admin')}}" class="li-a">Войти в админ-панель</a></li>
                            @endif
                            <li class="li"><a href="{{route('logout')}}" class="li-a">Выйти из аккаунта</a></li>
                        </ul>
                </ul>
            </div>
        @endif
    </div>
</header>
<main>
    <div class="container main_container">
        <div class="content">
            @yield('content')
        </div>
        <div class="charts">
            <div class="tops">
                <div class="top_text">
                    <a href=""><h2>Топ публицистов</h2></a>
                </div>
                <div class="top_publicists">
                    @foreach($usersChart as $userChart)
                        <div class="publicist">
                            <div class="publicist_data">
                                <div class="publicist_logo">
                                    <img src="{{Storage::url($userChart->photo)}}" alt="">
                                </div>
                                <div class="publicist_name">
                                    <a href="{{route('getUserArticles',['id'=>$userChart->id,'statistic_name'=>'articles'])}}"><h3>{{$userChart->name}}</h3></a>
                                </div>
                            </div>
                            <div class="publicist_views">
                                <span>{{$userChart->save_count}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="top_articles">
                    <div class="top_text">
                        <a href=""><h2>Топ статей</h2></a>
                    </div>
                    @foreach($articlesChart as $chartArticle)
                        <div class="articles">
                            <div class="article_name">
                                <a href="{{route('article',['id'=>$chartArticle->id])}}"><h3>{{$chartArticle->name}}</h3></a>
                            </div>
                            <div class="article_statistic">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg> <span>{{$chartArticle->views_count}}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
                                    <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z"/>
                                    <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z"/>
                                </svg> <span>{{$chartArticle->save_count}}</span>
                            </div>
                        </div>
                    @endforeach
            </div>

        </div>
    </div>
</main>
</body>
<script>
    let el = document.getElementById('top-li');
    let childUl = document.getElementById('child-ul');

    el.addEventListener('click',()=>{
        childUl.classList.toggle('active');
    });

</script>
</html>
