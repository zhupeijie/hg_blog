@extends('home.layouts.app')

@section('content')
@section('css')
    {!! editor_css() !!}

    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endsection

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">编辑文章</div>
                <div class="panel-body">
                    <form action="/article/{{ hashIdEncode($article->id) }}" method="post">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">标题</label>
                            <input id="title" name="title" type="text" class="form-control" placeholder="文章标题" value="{{ $article->title }}">

                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('labels') ? ' has-error' : '' }}">
                            <label for="labels" class="control-label">标签</label>
                            <select class="js-example-placeholder-multiple form-control" name="labels[]" multiple="multiple">
                                @foreach($article->labels as $label)
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
                                <textarea name="body" style="display:none;">{{ $article->body }}</textarea>
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
</div>


@section('js')
    {!! editor_js() !!}
    <script>
        var api_get_topic_like = '{{ route('api.get_topic_like') }}';
    </script>
    <script type="text/javascript" src="{{ asset('js/article.js') }}"></script>
@endsection
@stop