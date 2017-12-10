<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                喵大侠
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class="{{ active_class(if_route('p.index')) }}"><a href="{{ route('p.index') }}">话题</a></li>
                {{--<li class="{{ active_class((if_route('categories.show') && if_route_param('category', 1))) }}"><a href="{{ route('categories.show', 1) }}">分享</a></li>--}}
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li class="topics-search">
                    <form class="navbar-form navbar-left" action="{{ route('p.index') }}">
                        <div class="form-group">
                            <input type="text" class="form-control" name="q" value="{{ query_param('q') }}" placeholder="Search...">
                        </div>
                        <button type="submit" class="btn btn-default" style="padding: 4px 10px;"><i class="icon iconfont icon-search"></i></button>
                    </form>
                </li>

                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">登录</a></li>
{{--                    <li><a href="{{ route('register') }}">注册</a></li>--}}
                @else
                    <li class="topics-create">
                        <a href="{{ route('p.create') }}">
                            <i class="icon iconfont icon-xinjian" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                                <img src="{{ Auth::user()->avatar }}" class="img-responsive img-circle" width="30px" height="30px">
                            </span>
                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu animated flipInY" role="menu">
                            <li>
                                <a href="{{ route('users.show', Auth::id()) }}">
                                    <i class="icon iconfont icon-user" aria-hidden="true"></i>
                                    个人中心
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.edit', Auth::id()) }}">
                                    <i class="icon iconfont icon-bianji" aria-hidden="true"></i>
                                    编辑资料
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <i class="icon iconfont icon-exit" aria-hidden="true"></i>
                                    退出登录
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>