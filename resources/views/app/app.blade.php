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
        <div class="header_user_nickname">
            <p>Steellsey</p>
        </div>
    </div>
</header>
<main>
    @yield('content')
</main>
</body>
</html>