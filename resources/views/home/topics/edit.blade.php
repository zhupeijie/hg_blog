@extends('home.layouts.app')

@section('style')
    {!! editor_css() !!}

    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="icon iconfont icon-bianji"></i> 编辑文章</div>
                <div class="panel-body">
                    <form action="/p/{{ hashIdEncode($topic->id) }}" method="post">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">标题</label>
                            <input id="title" name="title" type="text" class="form-control" placeholder="文章标题" value="{{ $topic->title }}">

                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <select class="form-control" name="category_id" required>
                                <option value="" hidden disabled selected>请选择分类</option>
                                @foreach ($categories as $value)
                                    <option value="{{ $value->id }}" {{ $topic->category_id == $value->id ? 'selected' : '' }} >{{ $value->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('category_id'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('labels') ? ' has-error' : '' }}">
                            <label for="labels" class="control-label">标签</label>
                            <select class="js-example-placeholder-multiple form-control" name="labels[]" multiple="multiple">
                                @foreach($topic->labels as $label)
                                    <option value="{{ $label->id }}" selected>{{ $label->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('labels'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('labels') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="control-label">内容</label>
                            <div id="editormd_id">
                                <textarea name="body" style="display:none;">{{ $topic->body }}</textarea>
                            </div>

                            @if ($errors->has('body'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success"><i class="icon iconfont icon-send"></i> 发布文章</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
    {!! editor_js() !!}
    <script>
        var api_get_label_like = '{{ route('api.get_label_like') }}';
    </script>
    <script type="text/javascript" src="{{ asset('js/label.js') }}"></script>
@stop