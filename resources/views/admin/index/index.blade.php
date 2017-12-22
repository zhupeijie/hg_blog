@extends('admin.layouts.app')

@section('content')
<div id="wrapper">
    <!--左侧导航开始-->
    @include('admin.layouts._left_navbar')
    <!--左侧导航结束-->

    <!--右侧部分开始-->
    @include('admin.layouts._right_content')
    <!--右侧部分结束-->

    <!--右侧边栏开始-->
    @include('admin.layouts._right_siderbar')
    <!--右侧边栏结束-->

    <!--mini聊天窗口开始-->
    @include('admin.layouts._small_chatbox')

</div>
@stop