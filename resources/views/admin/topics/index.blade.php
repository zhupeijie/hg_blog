@extends('admin.layouts.app')

@section('style')

    <!-- Data Tables -->
    <link href="/admin/css/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">

@stop

@section('content')
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>话题列表</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-5 m-b-xs"></div>
                        <div class="col-sm-4 m-b-xs"></div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" placeholder="请输入关键词" class="input-sm form-control">
                                <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> 搜索</button> </span>
                            </div>
                        </div>
                    </div>

                    @if (count($topics))

                        <table class="table table-striped table-bordered table-hover" data-toggle="table" data-card-view="true" data-mobile-responsive="true" style="margin-top: 10px;">
                            <thead>
                            <tr>
                                <th style="width: 10px;"></th>
                                <th class="col-sm-2" data-field="title">标题</th>
                                <th class="col-sm-3" data-field="excerpt">概述</th>
                                <th class="col-sm-1 text-center" data-field="author">作者</th>
                                <th class="col-sm-2 text-center" data-field="time">发布时间</th>
                                <th class="col-sm-1 text-center" data-field="views">查看次数</th>
                                <th class="col-sm-1 text-center" data-field="status">状态</th>
                                <th class="col-sm-2 text-center" data-field="status">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($topics as $topic)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="i-checks" name="input[]">
                                    </td>
                                    <td>{{ $topic->title }}</td>
                                    <td>{{ $topic->excerpt }}</td>
                                    <td class="text-center">{{ $topic->user->name }}</td>
                                    <td class="text-center">{{ $topic->created_at }}</td>
                                    <td class="text-center">{{ $topic->view_count }}</td>
                                    <td class="text-center">
                                        @if ($topic->is_delete)
                                            <span class="text-danger">已删除</span>
                                        @elseif ($topic->is_hidden)
                                            <span class="text-warning">已隐藏</span>
                                        @else
                                            <span class="text-navy">正常</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-info" href="{{ route('admin.topics.edit', ['topic' => $topic->id]) }}">修改</a>
                                        @if ($topic->is_hidden)
                                            <button class="btn btn-sm btn-default">发布</button>
                                        @else
                                            <button class="btn btn-sm btn-warning">隐藏</button>
                                        @endif

                                        @if ($topic->is_delete)
                                            <button class="btn btn-sm btn-default">草稿</button>
                                        @else
                                            <button class="btn btn-sm btn-danger">删除</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    @else

                        暂无数据 ~ 😄

                    @endif

                    <div class="pages-links pull-right">
                        {{ $topics->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

@stop

@section('javascript')

    <script>
        $(function () {
            $('.gohome').children('a').attr('href', '/admin');
        })
    </script>
    <script src="/admin/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/admin/js/content.min.js?v=1.0.0"></script>
    <script src="/admin/js/plugins/iCheck/icheck.min.js"></script>
    <script src="/admin/js/demo/peity-demo.min.js"></script>

@stop