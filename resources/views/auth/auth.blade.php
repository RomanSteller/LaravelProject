<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
</head>
<body>
<div class="wrapper">
    <main>
        <div class="container main_container">
            <form action="{{route('auth')}}" class="user_data_input" method="post">
                @csrf
                <div class="user_input_name">
                    <div class="current_form"><h2>Вход</h2></div>
                    <div class="form_href"><h3><a href="{{route('regInput')}}">Регистрация</a></h3></div>
                </div>

                <div class="user_input_cell">
                    <label for="login_input"><h4>Логин</h4></label>
                    <input type="text" id="login_input" name="login_input">
                </div>
                <div class="user_input_cell">
                    <label for="password_input"><h4>Пароль</h4></label>
                    <input type="password" id="password_input" name="password_input">
                    <div class="user_input_error"><label for="password_input">Неверный пароль</label></div>
                </div>
                <div class="user_input_cell">
                    <button>Отправить</button>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>
