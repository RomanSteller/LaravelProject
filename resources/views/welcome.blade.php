@extends('app.articles')
@section('articleContent')
    @foreach($articles as $article)
        <div class="post">
            <div class="post_user">
                <a href="/article/{{$article->id}}">
                    <div class="post_user_logo">
                        <img src="{{$article->user->photo}}">
                    </div>
                </a>
                <a href="">
                    <div class="post_user_name">
                        {{$article->user->name}}
                    </div>
                </a>
                <div class="post_date_time">
                    {{$article->created_time}}
                </div>
            </div>
            <div class="post_name"> <!-- Название поста -->
                <a href="/article/{{$article->id}}"><H2>{{$article->name}}</H2></a>
            </div>
            <div class="post_tags"> <!-- Теги постов -->
                @foreach($article->tags as $tag)
                    <a href="tag/{{$tag->tag_name}}">{{$tag->tag_name}}</a>
                @endforeach
            </div>
            <div class="post_content">
                @foreach($article->images as $article_image)
                <img src="{{Storage::url($article_image->photo)}}" alt="">
                @endforeach
                {!!$article->content!!}
            </div>
            <div class="post_statistic">
                <div> <!-- Глазик -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                    </svg>
                    <span>25k</span>
                </div>
                <div> <!-- Сохранить -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
                        <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z"/>
                        <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z"/>
                    </svg>
                    <span>{{$article->save_count}}</span>
                </div>
                <div> <!-- Комментарии -->

                </div>
            </div>
        </div>
    @endforeach
@endsection
<style>
    .post{
        margin-top: 20px;
    }
</style>
