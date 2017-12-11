@if (count($topics))

    <ul class="list-group">
        @foreach ($topics as $topic)
            <li class="media list-group-item">
                <div class="media-left">
                    <a href="{{ route('users.show', [$topic->user_id]) }}">
                        <img class="media-object img-circle" style="width: 64px; height: 64px;" src="{{ $topic->user->avatar }}" title="{{ $topic->user->name }}">
                    </a>
                </div>

                <div class="media-body">

                    <div class="media-heading">
                        <a href="{{ route('p.show', [hashIdEncode($topic->id)]) }}" title="{{ $topic->title }}">
                            {{ $topic->title }}
                        </a>
                        <a class="pull-right" href="{{ route('p.show', [hashIdEncode($topic->id)]) }}" >
                            <span class="badge"> {{ $topic->reply_count }} </span>
                        </a>
                    </div>

                    <div class="media-body meta">
                        <a href="{{ route('categories.show', $topic->category->id) }}" title="{{ $topic->category->name }}">
                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                             {{ $topic->category->name }}
                        </a>

                        <span> • </span>
                        <a href="{{ route('users.show', [$topic->user_id]) }}" title="{{ $topic->user->name }}">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            {{ $topic->user->name }}
                        </a>
                        <span> • </span>
                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                        <span class="timeago" title="最后活跃于">{{ $topic->updated_at->diffForHumans() }}</span>
                    </div>

                </div>
            </li>

        @endforeach
    </ul>

@else
   <div class="empty-block">暂无数据 ~_~ </div>
@endif