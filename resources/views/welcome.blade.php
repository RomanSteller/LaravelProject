@extends('app.articles')
@section('articleContent')
    @foreach($articles as $article)
        <div class="post">
            <p>{{$article->name}}</p>
            <p>{{$article->user->name}}</p>
            <p>{!! $article->content !!} </p>
        </div>
    @endforeach
@endsection
<style>
    .post{
        margin-top: 20px;
    }
</style>
