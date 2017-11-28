@extends('home.layouts.app')

@section('content')
    @section('css')
        <link href="{{ asset('css/article.css') }}" rel="stylesheet">
        <link href="{{ asset('css/highlight/styles/default.css') }}" rel="stylesheet">
    @endsection
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $article->title }}

                        {{--<article-follow-button article="{{ $article->id }}" counts="{{ $article->followers_count }}"></article-follow-button>--}}

                        <div class="pull-right">
                            @foreach($article->labels as $label)
                                <a class="article-label" href="/label/{{ $label->id }}"> {{ $label->name }} </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="panel-body markdown-body">
                        {!! Parsedown::instance()->setMarkupEscaped(true)->text($article->body) !!}
                    </div>
                    <div class="actions">
                        @if(Auth::check() && Auth::user()->owns($article))
                            <span class="edit">
                                <a href="/article/{{ hashIdEncode($article->id) }}/edit">编辑文章</a>
                            </span>
                            <form action="/article/{{ hashIdEncode($article->id) }}" method="post" class="delete-form">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="button is-naked delete-btn">删除</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    @section('js')
        <script>hljs.initHighlightingOnLoad();</script>
    @endsection
@stop