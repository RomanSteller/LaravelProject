@extends('app.app')
@section('content')

    <div class="container-admin">

        <table class="table">
            <thead>
            <tr>
                <th>Название поста</th>
                <th>Автор поста</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $article)
            <tr>
                <td>{{$article->name}}</td>
                <td>{{$article->user->name}}</td>
                <td><a href="{{route('articleUnModer',['id'=>$article->id])}}}" class="check-post">Посмотреть пост</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
<style>
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

    .check-post{
        text-decoration: none;
        color: white;
        background-color: #303b44;
        border: 1px solid grey;
        padding: 5px 15px;

    }

    .container-admin{
        overflow-x:auto;
    }

    @media screen and (max-width: 1042px) {
        .table {
            border: 0;
        }



        .table thead {
            border: none;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        .table tr {
            border-bottom: 1px solid #ddd;
            display: block;
            margin-bottom: 30px;
        }

        .table td {
            display: block;
            text-align: left;
        }

        .table td::before {
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        .table td:last-child {
            border-bottom: 0;
        }
    }
</style>
