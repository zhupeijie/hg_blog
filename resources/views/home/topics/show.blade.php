@extends('home.layouts.app')

@section('style')
    <link href="{{ asset('css/topic.css') }}" rel="stylesheet">
    <link href="{{ asset('css/highlight/styles/default.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tocify/tocify.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fluidbox/fluidbox.min.css') }}" rel="stylesheet">
    <link href="https://cdn.bootcss.com/social-share.js/1.0.16/css/share.min.css" rel="stylesheet">
    <style>
        .ui.card {
            margin: 1em 0.3em;
            max-width: 100%;
            position: relative;
            display: -webkit-box;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            flex-direction: column;
            width: 290px;
            min-height: 0px;
            background: #FFFFFF;
            padding: 0em;
            border: none;
            border-radius: 0.28571429rem;
            box-shadow: 0px 1px 3px 0px #d3e0e9, 0px 0px 0px 1px #d3e0e9;
            -webkit-transition: box-shadow 0.1s ease, -webkit-transform 0.1s ease;
            transition: box-shadow 0.1s ease, -webkit-transform 0.1s ease;
            transition: box-shadow 0.1s ease, transform 0.1s ease;
            transition: box-shadow 0.1s ease, transform 0.1s ease, -webkit-transform 0.1s ease;
        }
        /*******************************
            Sticky
         *******************************/
        .ui.sticky {
            position: static;
            -webkit-transition: none;
            transition: none;
            z-index: 800;
            box-sizing: inherit;
        }

        /*******************************
                    States
        *******************************/
        /* Bound */
        .ui.sticky.bound {
            position: absolute;
            left: auto;
            right: auto;
        }

        /* Fixed */
        .ui.sticky.fixed {
            position: fixed;
            left: auto;
            right: auto;
        }

        /* Bound/Fixed Position */
        .ui.sticky.bound.top,
        .ui.sticky.fixed.top {
            top: 0px;
            bottom: auto;
        }

        .ui.sticky.bound.bottom,
        .ui.sticky.fixed.bottom {
            top: auto;
            bottom: 0px;
        }

        /******/
        .tocify-extend-page {
            height: 0px!important;
        }

        /*******************************
            toc
*******************************/
        #toc {
            padding: 22px 4px;
        }

        #toc ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        #toc li {
            line-height: 28px;
        }

        #toc a {
            text-decoration: none;
            display: block;
        }

        #toc .toc-h2 {
            padding-left: 10px;
        }

        #toc .toc-h3 {
            padding-left: 20px;
        }

        #toc .toc-active {
            background: #ccc;
        }

        #toc {
            /*
               * jquery.tocify.css 1.9.0
               * Author: @gregfranko
               */
            /* The Table of Contents is composed of multiple nested unordered lists.  These styles remove the default styling of an unordered list because it is ugly. */
            /* Top level header elements */
            /* Top level subheader elements.  These are the first nested items underneath a header element. */
            /* Makes the font smaller for all subheader elements. */
            /* Further indents second level subheader elements. */
            /* Further indents third level subheader elements. You can continue this pattern if you have more nested elements. */
            /* Twitter Bootstrap Override Style */
            /* Twitter Bootstrap Override Style */
        }

        #toc .tocify ul, #toc .tocify li {
            list-style: none;
            margin: 0;
            padding: 0;
            border: none;
            line-height: 30px;
        }

        #toc .tocify-header {
            text-indent: 0px;
            padding: 0px 8px;
        }

        #toc .tocify-subheader {
            text-indent: 10px;
            display: none;
        }

        #toc .tocify-subheader li {
            font-size: 13px;
        }

        #toc .tocify-subheader .tocify-subheader {
            text-indent: 30px;
        }

        #toc .tocify-subheader .tocify-subheader .tocify-subheader {
            text-indent: 40px;
        }

        #toc .nav-list > li > a, #toc .nav-list .nav-header {
            margin: 0px;
        }

        #toc .nav-list > li > a {
            padding: 5px;
            color: inherit;
        }

        #toc li.tocify-item:hover {
            background: rgba(241, 244, 247, 0.78);
        }

        #toc li.tocify-item.active {
            border-bottom: 1px solid #00b5ad;
            margin-bottom: -1px;
        }

    </style>

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
                            </div>
                            {{--<article-follow-button article="{{ $topic->id }}" counts="{{ $topic->followers_count }}"></article-follow-button>--}}

                            <div class="text-right">
                                @foreach($topic->labels as $label)
                                    <a class="article-label" href="/label/{{ $label->id }}"> {{ $label->name }} </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="markdown-body topic-body" style="min-height: 110px;">
                        {!! Parsedown::instance()->setMarkupEscaped(true)->text($topic->body) !!}
                    </div>

                    <div class="actions operate">
                        @if(Auth::check() && Auth::user()->isAuthorOf($topic))
                            <span class="edit">
                                <a href="{{ route('p.edit', [hashIdEncode($topic->id)]) }}" class="btn btn-default btn-xs" role="button">
                                    <i class="glyphicon glyphicon-edit"></i> 编辑
                                </a>
                            </span>
                            <form action="{{ route('p.destroy', [hashIdEncode($topic->id)]) }}" method="post" class="delete-form">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-default btn-xs" style="margin-left: 6px">
                                    <i class="glyphicon glyphicon-trash"></i> 删除
                                </button>
                            </form>
                        @endif
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
    <script type="text/javascript" src="{{ asset('js/fluidbox/jquery.fluidbox.min.js') }}"></script>
    <script src="https://cdn.bootcss.com/social-share.js/1.0.16/js/social-share.min.js"></script>

    <script type="text/javascript" src="{{ asset('js/jqueryui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/tocify/tocify.js') }}"></script>
    <script>
        $(function () {
            $('.topic-body img:not(.emoji)').each(function() {
                $(this).wrap("<a href='"+ $(this).attr('src') +"' class='fluidbox'></a>");
            }).promise().done(function () {
                $('a.fluidbox').fluidbox();
            });

            $("#toc").tocify({
                context: '.topic-body',
                selectors: "h2,h3,h4"
            });
        })
    </script>
@stop