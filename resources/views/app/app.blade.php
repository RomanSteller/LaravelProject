<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Document</title>
</head>
<body>
<header>
    <div class="container header_container">
        <div class="header_logo">
            <a href=""><img src="{{Storage::url('logo/logo.png')}}" alt=""></a>
        </div>
        {{session('id')}}
        @if(is_null(session('id')))
        <div class="header_user_nickname">
            <a href="{{route('auth')}}" style="color: white">Авторизоваться</a>
            @dd(session('id'))
        </div>
        @else
            <div class="header_user_nickname">
                <a href="">Ты авторизован</a>
                <a href="{{route('logout')}}">Дропнуть сессию</a>
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

                    <div class="publicist">
                        <div class="publicist_data">
                            <div class="publicist_logo">

                            </div>
                            <div class="publicist_name">
                                <a href=""><h3>Steellsey</h3></a>
                            </div>
                        </div>
                        <div class="publicist_views">
                            <span>228</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="top_articles">
                <div class="top_text">
                    <a href=""><h2>Топ статей</h2></a>
                </div>
                <div class="articles">
                    <div class="article_name">
                        <a href=""><h3>Работа программиста</h3></a>
                    </div>
                    <div class="article_statistic">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg> <span>25k</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
                            <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z"/>
                            <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z"/>
                        </svg> <span>133</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
</body>
</html>
