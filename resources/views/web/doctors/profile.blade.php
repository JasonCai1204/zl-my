<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <title>我的信息 - 肿瘤名医</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="/css/doctor/weui.min.css">
    <link rel="stylesheet" href="/css/doctor/home.css">
</head>
<body>
<!--固定在屏幕顶部-->
<div class="logo_part">
    <div class="logo">
        <a href="/" style="background-image: url('/storage/images/app/M_32w.png');"></a>
    </div>
</div>
<!--主体部分-->
<div class="container" id="my_info_container">
        <form action="">
        <div class="weui-cells weui-cells_form" style="margin-top: 30px;">
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">姓名</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" class="weui-input" value="{{$doctor->name}}" readonly />
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">所在医院</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" class="weui-input" value="{{$doctor->hospital->name}}" readonly />
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">职称</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" class="weui-input" value="{{$doctor->grading}}" readonly />
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">手机号码</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="number" class="weui-input" value="{{$doctor->phone_number}}" readonly />
                </div>
            </div>
        </div>
            <div class="my_mine_logoff">
                <a href="{{ url('/logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="btnLogin">退出登录</a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
            
            <a href="/password/reset" class="btnLink">修改密码</a>
    </form>
</div>
<script type="text/javascript" src="/js/doctor/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/js/doctor/my_submitdisable.js"></script>

</body>
</html>