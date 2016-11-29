<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <!--XX 为用户输入的搜索关键词 未输入关键词时未空-->

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="/css/user/weui.min.css">
    <link rel="stylesheet" href="/css/user/home.css">
</head>
<body>
<!--固定在屏幕上部的logo-->
<div class="logo_part">
    <div class="logo">
        <a href="http://zl-my.com" style="background-image: url('/storage/images/user/app/web/mobile-titlebar-logo.png');"></a>
    </div>
</div>

@yield('content')
<script type="text/javascript" src="/js/user/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/js/user/searchbar.js"></script>
@yield('script')
</body>
</html>