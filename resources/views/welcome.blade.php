@extends('app.articles')
@section('articleContent')
    @foreach($articles as $article)
        @include('app.articleContent')
    @endforeach

    <style>
        .post{
            margin-top: 20px;
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
    </script>
@endsection
