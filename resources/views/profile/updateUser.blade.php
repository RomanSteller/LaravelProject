@extends('app.app')
@section('content')
    <h1>Редактирование профиля</h1>
    <div class="settings_user_data">
        <img src="{{Storage::url($user->photo)}}" alt="">
        <p>{{$user->login}}</p>
    </div>
    <div class="settings">

        <div class="form_settings">
            <h3>Общее</h3>
            <hr>
            <form action="{{route('updateUser')}}" method="post">
                @csrf
                <div class="form_group">
                    <label for="name">Имя</label>
                    <input class="input-settings" type="text" id="name" name="name" value="{{$user->name}}" onchange="">
                </div>
                <input type="submit" id="name_input">
            </form>
            <form action="{{route('updateUser')}}" method="post">
                @csrf
                <div class="form_group">
                    <label for="description">Описание</label>
                    <input class="input-settings" type="text" value="{{$user->description}}" id="description" name="description">
                </div>
                <input type="submit" id="description_input">
            </form>
        </div>

        <div class="form_settings secure">
            <h3 class="h3-sec">Безопасность</h3>
            <hr>
            <form action="{{route('updateUser')}}" method="post">
                @csrf
                <h4>Смена электронной почты</h4>
                <div class="form_group">
                    <label for="email">Электронная почта</label>
                    <input class="input-settings" name="email" type="text" id="email" value="{{$user->email}}">
                </div>
                <input type="submit" id="email_input">
            </form>
            <form action="{{route('updateUser')}}" method="post">
                @csrf
                <h4>Смена пароля</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form_group">
                    <label for="password">Пароль</label>
                    <input class="input-settings" name="password" id="password" type="password">
                </div>
                <div class="form_group">
                    <label for="confirm-password">Повтор пароля</label>
                    <input class="input-settings" name="password-confirm" id="confirm-password" type="password">
                </div>
                <input type="submit" id="password_input">
            </form>
        </div>
    </div>

    
@endsection
<style>
    .settings_user_data{
        display: flex;
        align-items: center;
    }

    .h3-sec{
        margin-top: 20px;
    }

    form{
        width: 300px;
        margin-top: 25px;

    }

    .form_group{
        display: flex;
        flex-direction: column;
        margin-top: 10px;
    }

    .input-settings{
        outline: none;
        border-radius: 0;
        border: 1px solid #b3b7bb;
        padding: 5px 20px;
    }

    .secure{
        margin-top: 80px;
    }

    label{
        margin-bottom: 5px;
    }

    input[type="submit"]{
        display: none;
        margin-top: 10px;
        border-radius: 0;
        border: 1px solid #b3b7bb;
        padding: 5px 20px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // let input = document.getElementById('name');
    // input.oninput = () =>{
    //     let name_input = document.getElementById('name_input');
    //     name_input.style.display = 'block';
    //
    // };

    $(document).ready(()=>{

        $('#name').on('input',()=>{
            $('#name_input').show();
        });

        $('#description').on('input',()=>{
            $('#description_input').show();
        })

        $('#email').on('input',()=>{
            $('#email_input').show();
        })

        $('#password').on('input',()=>{
            $('#password_input').show();
        })

        $('#confirm-password').on('input',()=>{
            $('#password_input').show();
        })
    })



</script>