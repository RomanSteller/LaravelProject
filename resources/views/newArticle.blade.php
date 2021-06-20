<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Новая статья</title>
</head>
<body>
    <div>
        <h1 style="text-align: center;font-family: Arial,sans-serif">Добавление поста</h1>
        <form action="{{route('newArticle')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" placeholder="Заголовок" name="caption" id="caption">
            <div id="new_input">
            </div>
            <button>Отправить</button>
        </form>
        <div class="buttons">
            <button class="add" id="add_text">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                    <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                </svg></button>
            <button class="add" id="add_img">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                    <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
                </svg>
            </button>
        </div>
    </div>
    <script>

            let i = 0,
                max = 5;

            $('#add_text').click(function(){
                if (i > max) return;
                else i++;
                $('#new_input').append($(`<div class="input_element" id="${i}"><button type="button" class="delete" id='${i}'>x</button><div><textarea class='text-content' type='text' id='${i}text' name='${i}text'/></div></div>`));
            });
            $('#add_img').click(function(){
                if (i > max) return;
                else i++;
                $('#new_input').append($(`<div class="input_element" id="${i}"><button type="button" class="delete" id='${i}'>x</button><div><input class='image-content' type='file' id='${i}img' name='${i}img'/></div></div>`));
            });
            $('#new_input').on('click','.delete',function(e){
                max++;
                let click_id = $(this).attr('id');
                $('#'+click_id).remove();
            })
    </script>

</body>
</html>
<style>
    form{
        display: flex;
        flex-direction: column;
        width: 550px;
        margin: 0 auto;
    }

    #caption{
        padding: 5px 20px;
        outline: none;
        border:none;
        border-bottom: 1px solid #b3b7bb;
        font-size: 18px;
    }

    button{
        margin-top: 10px;
        border: none;
        padding: 10px 25px;
        background-color: #303b44;
        color: white;
    }

    textarea{
        margin-top: 10px;
        resize: none;
        width: 547px;
        height: 150px;
        border:1px solid #b3b7bb;
        outline: none;
    }

    .add{
        padding-top: 20px;
        padding-bottom: 20px;
        border-radius: 40px;
    }

    .buttons{
        margin-left: 50px;
        position: absolute;
        top:0
    }

    .image-content{
        margin-top: 20px;
        margin-bottom: 10px;
    }


</style>
