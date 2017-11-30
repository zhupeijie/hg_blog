@extends('home.layouts.app')

@section('style')
    <link href="{{ asset('css/topic.css') }}" rel="stylesheet">
    <link href="{{ asset('css/highlight/styles/default.css') }}" rel="stylesheet">
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1 class="text-center">{{ $topic->title }}</h1>

                        <div class="article-meta text-center">
                            <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            {{ $topic->created_at->diffForHumans() }}
                            ⋅
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            {{ $topic->view_count }}
                            ⋅
                            <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                            {{ $topic->replies_count }}
                        </div>
                        {{--<article-follow-button article="{{ $topic->id }}" counts="{{ $topic->followers_count }}"></article-follow-button>--}}

                        <div class="pull-right">
                            {{--@foreach($topic->labels as $label)--}}
                            {{--<a class="article-label" href="/label/{{ $label->id }}"> {{ $label->name }} </a>--}}
                            {{--@endforeach--}}
                        </div>

                        <div class="markdown-body topic-body">
                            {!! Parsedown::instance()->setMarkupEscaped(true)->text($topic->body) !!}
                        </div>
                    </div>

                    <div class="actions operate">
                        @if(Auth::check() && Auth::user()->owns($topic))
                            <span class="edit">
                                <a href="/article/{{ hashIdEncode($topic->id) }}/edit">编辑文章</a>
                            </span>
                            <form action="/article/{{ hashIdEncode($topic->id) }}" method="post" class="delete-form">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="button is-naked delete-btn">删除</button>
                            </form>
                        @endif

                            {{--<a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-default btn-xs" role="button">--}}
                                {{--<i class="glyphicon glyphicon-edit"></i> 编辑--}}
                            {{--</a>--}}
                            {{--<a href="#" class="btn btn-default btn-xs" role="button">--}}
                                {{--<i class="glyphicon glyphicon-trash"></i> 删除--}}
                            {{--</a>--}}
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 hidden-sm hidden-xs author-info">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            作者：{{ $topic->user->name }}
                        </div>
                        <hr>
                        <div class="media">
                            <div align="center">
                                <a href="{{ route('users.show', $topic->user->id) }}">
                                    <img class="thumbnail img-responsive" src="{{ $topic->user->avatar }}" width="300px" height="300px">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('javascript')
    <script>hljs.initHighlightingOnLoad();</script>
@endsection