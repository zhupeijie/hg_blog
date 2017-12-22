<div id="page-wrapper" class="gray-bg dashbard-1">

    @include('admin.layouts._right_navbar')

    {{--内容部分--}}
    <div class="row J_mainContent" id="content-main">
        <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="{{ route('admin.dashboard') }}" frameborder="0" data-id="index_v1.html" seamless></iframe>
    </div>
    <div class="footer">
        <div class="pull-right">&copy; Since 2017 <a href="" target="_blank">Evan's Blog</a>
        </div>
    </div>
</div>