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
        <form action="{{route('newArticle')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" placeholder="Заголовок" name="caption" id="caption" name="caption">
            <div id="new_input">

            </div>
            <button>Отправить</button>
        </form>
        <button id="add_text">Текст</button>
        <button id="add_img">Картинка</button>

    </div>

    <script>
        let i = 0;

        $('#add_text').click(function(){
            //let i = count();
            if (i > 5) return;
            else i++;
            $('#new_input').append($(`<input type='text' id='${i}text' name='${i}text'/>`));
        });

        $('#add_img').click(function(){
            //let i = count();
            if (i > 5) return;
            else i++;
            $('#new_input').append($(`<input type='file' id='${i}img' name='${i}img'/>`));
        });
    </script>

</body>
</html>
