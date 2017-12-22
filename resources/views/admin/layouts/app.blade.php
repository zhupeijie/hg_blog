<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <title>@yield('title', 'hg_blog') | 记录让编码更高效@show - Powered by Evan</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link href="{{ asset('admin/css/bootstrap.min14ed.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/font-awesome.min93e3.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.min862f.css') }}?v=4.1.0" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />

    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>;
    </script>

    @yield('style')

</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">

@yield('content')

</body>

<script src="{{ asset('admin/js/jquery.min.js') }}?v=2.1.4"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}?v=3.3.6"></script>
<script src="{{ asset('admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/layer/layer.min.js') }}"></script>
<script src="{{ asset('admin/js/hplus.min.js') }}?v=4.1.0"></script>
<script type="text/javascript" src="{{ asset('admin/js/contabs.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/pace/pace.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });
</script>

@include('flashy::message')

@yield('javascript')

</html>