@extends('profile.profile')
@section('statistic')
    @if(!empty($articles))
        @foreach($articles as $article)
            @include('app.articleContent')
        @endforeach
    @elseif(!empty($comments))
        <div class="user_comments">
            <table class="table">
                <thead>
                <tr>
                    <th>Название поста</th>
                    <th>Автор комментария</th>
                    <th>Содержимое комментария</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{$comment->article->name}}</td>
                        <td>{{$comment->user->name}}</td>
                        <td>{{$comment->comments}}</td>
                        <td><a href="{{route('article',['id'=>$comment->article->id])}}" class="check-post">Перейти к посту</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @elseif(!empty($favorites))empty

            <table class="table">
                <thead>
                <tr>
                    <th>Название поста</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($favorites as $favorite)
                    <tr>
                        <td>{{$favorite->article->name}}</td>
                        <td><a href="{{route('article',['id'=>$favorite->article->id])}}" class="check-post">Перейти к посту</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

    @endif
@endsection
<style>

    .table{
        font-size: 14px;
    }

    .check-post{
        text-decoration: none;
        color: white;
        background-color: #303b44;
        border: 1px solid grey;
        padding: 5px 10px;
    }

    .user_comments{
        margin-top: 20px;
    }
    .table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
    }


    .table tr {
        background-color: #f8f8f8;
    }

    .table th,
    .table td {
        text-align: left;
        padding: 8px;
        border: 1px solid #ddd;
    }
</style>
