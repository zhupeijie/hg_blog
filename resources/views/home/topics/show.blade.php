@extends('home.layouts.app')

@section('style')
    <link href="{{ asset('css/topic.css') }}" rel="stylesheet">
    <link href="{{ asset('css/highlight/styles/default.css') }}" rel="stylesheet">
    <link href="https://cdn.bootcss.com/social-share.js/1.0.16/css/share.min.css" rel="stylesheet">
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1 class="panel-title topic-title text-left">{{ $topic->title }}</h1>
                        <div class="inline-block">
                            <div class="article-meta text-left" style="float: left;">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                <abbr class="topic-create-time" aria-label="{{ $topic->created_at }}" data-microtip-position="top" role="tooltip">{{ $topic->created_at->diffForHumans() }}</abbr>
                                ⋅
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                {{ $topic->view_count }}
                                ⋅
                                <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                {{ $topic->replies_count }}

                                <div class="actions operate">
                                    @if(Auth::check() && Auth::user()->isAuthorOf($topic))
                                        <span class="edit">
                                            <a href="{{ route('p.edit', [hashIdEncode($topic->id)]) }}" class="btn btn-default btn-xs" role="button">
                                                <i class="icon iconfont icon-bianji"></i>
                                            </a>
                                        </span>
                                        <form action="{{ route('p.destroy', [hashIdEncode($topic->id)]) }}" method="post" class="delete-form">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-default btn-xs" style="margin-left: 6px">
                                                <i class="icon iconfont icon-shanchu"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            {{--<article-follow-button article="{{ $topic->id }}" counts="{{ $topic->followers_count }}"></article-follow-button>--}}

                            <div class="text-right">
                                <i class="icon iconfont icon-tag"></i>
                                @foreach($topic->labels as $label)
                                    <a class="topic-label" href="/label/{{ $label->id }}"> {{ $label->name }} </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="markdown-body topic-body" style="min-height: 110px;">
                        {!! Parsedown::instance()->setMarkupEscaped(true)->text($topic->body) !!}
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
                                    <img class="img-thumbnail img-circle img-responsive" src="{{ $topic->user->avatar }}" width="300px" height="300px">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <backtop-roll></backtop-roll>
        </div>

        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9">
                <div class="panel panel-default" style="padding-top: 10px;padding-bottom: 10px;">
                    <div class="panel-body" style="padding-top: 0px;padding-bottom: 0px;">
                        <div class="social-share" data-disabled="google,twitter,facebook,diandian" data-description="Share.js - 一键分享到微博，QQ空间，腾讯微博，人人，豆瓣"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 ui sticky fixed top" style="padding-top: 20px; left: 1141.5px; width: 270px !important; height: 520px !important; margin-top: 0px; top: 0px;">
            <div class="ui card column author-box grid tocify" id="toc"></div>
        </div>
    </div>

@stop

@section('javascript')
    <script>hljs.initHighlightingOnLoad();</script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
    <script src="https://cdn.bootcss.com/social-share.js/1.0.16/js/social-share.min.js"></script>
@stop