<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="/css/user/weui.min.css">
    <link rel="stylesheet" href="/css/user/home.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<body>
<div class="logo_part">
    <div class="logo">
        <a href="/" style="background-image: url('/storage/images/app/M_27w.png');"></a>
    </div>
</div>

@yield('content')

<script src="/js/user/jquery-1.11.3.min.js"></script>
<script src="/js/user/searchbar.js"></script>
@yield('script')
</body>
</html>
