@extends('home.layouts.app')

@section('title', isset($category) ? $category->name : (isset($label) ? $label->name : '话题列表'))

@section('style')
    <link href="{{ asset('css/topic.css') }}" rel="stylesheet">
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 topic-list">

                @if (isset($category))
                    <div class="alert alert-info" role="alert">
                        {{ $category->name }} ：{{ $category->description }}
                    </div>
                @endif

                @if (isset($label))
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object img-thumbnail img-responsive" src="{{ $label->image }}"
                                         alt="{{ $label->name }}" style="width: 100px;height: 100px;">
                                </a>
                            </div>
                            <div class="media-body" style="padding-top: 5px;">
                                <h3 class="media-heading"> {{ $label->name }} </h3>
                                <span>{{ $label->description }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="topic-lists">
                    <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li class="{{ active_class(( ! if_query('order', 'heat') )) }}"><a href="{{ Request::url() }}?order=default">最新发布</a></li>
                            <li class="{{ active_class(if_query('order', 'heat')) }}"><a href="{{ Request::url() }}?order=heat">热门话题</a></li>
                        </ul>
                    </div>

                    <div class="panel-body">
                        {{-- 话题列表 --}}
                        @include('home.topics._topic_list', ['topics' => $topics])
                        {{-- 分页 --}}
                        {!! $topics->render() !!}
                    </div>
                </div>

            </div>

            <div class="col-lg-3 col-md-3 sidebar">
            @include('home.topics._sidebar')
            </div>
        </div>
    </div>

@stop