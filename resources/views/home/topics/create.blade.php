@extends('home.layouts.app')

@section('css')
    {!! editor_css() !!}

    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon-edit"></i> 新建话题
                    </div>
                    <div class="panel-body">
                        <form action="/article" method="post">
                            {{ csrf_field() }}
                             <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="control-label">标题</label>
                                <input id="title" name="title" type="text" class="form-control" placeholder="文章标题" value="{{ old('title') }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="category_id" required>
                                    <option value="" hidden disabled selected>请选择分类</option>
                                    @foreach ($categories as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('labels') ? ' has-error' : '' }}">
                                <label for="labels" class="control-label">标签</label>
                                <select class="js-example-placeholder-multiple form-control" name="labels[]" multiple="multiple"></select>

                                @if ($errors->has('labels'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('labels') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <label for="body" class="control-label">内容</label>
                                <div id="editormd_id">
                                    <textarea name="body" style="display:none;">{{ old('body') }}</textarea>
                                </div>

                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success">发布文章</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@stop

@section('js')
    {!! editor_js() !!}
    <script>
    </script>
    <script type="text/javascript" src="{{ asset('js/article.js') }}"></script>
@endsection