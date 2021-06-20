@extends('app.articles')
@section('articleContent')
    <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.js"></script>
    @if(Session::has('successArticle'))
        <span style="color: forestgreen;text-align: center; padding-top: 10px;font-size: 20px">{{Session::get('successArticle')}}</span>
    @endif
    <div style="position: absolute;bottom: 5px;position: fixed;right: 5px;width: 300px" id="div_success">
        <div class="successPost" style="position: relative">
            <svg xmlns="http://www.w3.org/2000/svg" style="position: absolute;right: 0" id="closed" width="10" height="10" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
            </svg>
            <div class="successText" >
                <h3>Клоун ёбаный</h3>
            </div>
        </div>
    </div>

    @foreach($articles as $article)
        @include('app.articleContent')
    @endforeach

@endsection

<style>
    .post{
        margin-top: 20px;
    }

    .successText{

    }

    .successPost{
        text-align: center;
        border: 1px solid green;
        padding: 5px 20px;
        background-color: #2fa360;
        margin-top: 5px;
        position: absolute;
        bottom: 0;
        position: fixed;
    }
</style>

<script type="text/javascript">
    $('.favorite_button').click(function(e){
        let click_id = $(this).attr('id'),
            save_count = $('.save_count'+click_id).html();
        $.ajax({
            url: "{{route('addFavorite')}}",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                article_id:click_id
            },
            success:function(response){
                console.log(response);
            },
        });
        if ($(this).hasClass('addedFavorites')){
            $(this).removeClass('addedFavorites');
            $('.save_count'+click_id).text(+save_count-1);
        }else{
            $(this).addClass('addedFavorites');
            $('.save_count'+click_id).text(+save_count+1);
        }
    });

    $('#closed').click(function (){
        $('#div_success').remove();
    });
</script>