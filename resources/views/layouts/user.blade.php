<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="css/user/weui.min.css">
    <link rel="stylesheet" href="css/user/home.css">
    <link rel="stylesheet" href="css/user/swiper-3.3.1.min.css">
    @yield('head')
</head>
<body>
<!--固定在屏幕上部的logo-->
<div class="logo_part">
    <div class="logo">
        <a href="" style="background-image: url('/storage/images/user/mobile-titlebar-logo.png');"></a>
    </div>
</div>

@yield('content')

        <!--固定在屏幕下部的nav-->
<div class="my_home_footer">
    <div class="weui-tabbar" id="my_footer_tabber">
        <a href="/" class="weui-tabbar__item my_tabbar_click">
            <img src="/storage/images/user/user-mobile-item-index.svg" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">首页</p>
        </a>
        <a href="news" class="weui-tabbar__item">
            <img src="/storage/images/user/user-mobile-item-advice.svg" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">资讯</p>
        </a>
        <a href="recommends" class="weui-tabbar__item">
            <img src="/storage/images/user/user-mobile-item-recommend.svg" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">推荐</p>
        </a>
        <a href="account" class="weui-tabbar__item">
            <img src="/storage/images/user/user-mobile-item-mine.svg" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">个人中心</p>
        </a>
    </div>
</div>
<script type="text/javascript" src="js/user/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/user/swiper-3.3.1.jquery.min.js"></script>
<script type="text/javascript" src="js/user/index.js"></script>
</body>
</html>