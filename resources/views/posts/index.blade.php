<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
        <x-slot name="header">
            header
        </x-slot>
        <body>
            <h1>Blog Name</h1>
            <a href='/posts/create'>create</a>
            <div class='posts'>
                @foreach ($examples as $example)
                    <div class='post'>
                        <h2 class='title'>
                            <a href="/posts/{{ $example->id }}">{{ $example->title }}</a>
                        </h2>
                        <a href="/categories/{{ $example->category->id }}">{{ $example->category->name }}</a>
                        <p class='body'>{{ $example->body }}</p>
                        <form action="/posts/{{ $example->id }}" id="form_{{ $example->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deletePost({{ $example->id }})">delete</button> 
                        </form>
                    </div>
                @endforeach
            </div>
            <div class='paginate'>
                {{ $examples->links() }}
            </div>
            <script>
                function deletePost(id) {
                    'use strict'
                    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                        document.getElementById(`form_${id}`).submit();
                    }
                }
            </script>
            <p>ログインユーザー:{{ Auth::user()->name }}</p>
            <div>
                @foreach($questions as $question)
                    <div>
                        <a href="https://teratail.com/questions/{{ $question['id'] }}">
                            {{ $question['title'] }}
                        </a>
                    </div>
                @endforeach
    </div>
        </body>
    </x-app-layout>
</html>