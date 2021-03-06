<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="/css/doctor/weui.min.css">
    <link rel="stylesheet" href="/css/doctor/home.css">
</head>
<body>

<!--固定在屏幕顶部-->
<div class="logo_part">
    <div class="logo">
        <a href="" style="background-image: url('/storage/images/doctor/mobile-titlebar-logo.png');"></a>
        <a href="" class="doctor_logo" style="background-image: url('/storage/images/doctor/doctor-mobile-minepage-default-avatar.png')"></a>
    </div>
</div>

@yield('content')

@yield('script')

</body>
</html>