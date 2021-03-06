<div class="panel panel-default">
    <div class="panel-body">
        <a href="{{ route('p.create') }}" class="btn btn-success btn-block" aria-label="Left Align">
            <i class="icon iconfont icon-pencil"></i> 新建帖子
        </a>
    </div>
</div>

@if (count($activeUsers))
    <div class="panel panel-default">
        <div class="panel-body active-users">

            <div class="text-center">活跃用户</div>
            <hr>
            @foreach ($activeUsers as $activeUser)
                <a class="media" href="{{ route('users.show', $activeUser->id) }}">
                    <div class="media-left media-middle">
                        <img src="{{ $activeUser->avatar }}" width="24px" height="24px" class="img-circle media-object">
                    </div>

                    <div class="media-body">
                        <span class="media-heading">{{ $activeUser->name }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif

{{--@if (count($links))--}}
    {{--<div class="panel panel-default">--}}
        {{--<div class="panel-body active-users">--}}
{{----}}
            {{--<div class="text-center">资源推荐</div>--}}
            {{--<hr>--}}
            {{--@foreach ($links as $link)--}}
                {{--<a class="media" href="{{ $link->link }}">--}}
                    {{--<div class="media-body">--}}
                        {{--<span class="media-heading">{{ $link->title }}</span>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--@endforeach--}}

        {{--</div>--}}
    {{--</div>--}}
{{--@endif--}}