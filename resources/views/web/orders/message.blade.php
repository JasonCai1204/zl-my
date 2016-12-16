@extends('web.layouts.user-basic')

@section('title','预约成功 - 肿瘤名医')

@section('content')

<div class="container" id="results_container">

    <div class="weui-msg">
        <div class="weui-msg__icon-area">

            <i class="weui-icon-success weui-icon_msg"></i>
        </div>
        <div class="weui-msg__text-area">
            <h2 class="weui-msg__title">预约成功</h2>
            <p class="weui-msg__desc ">
                我们的工作人员将在 24 小时内与您联系 请保持电话畅通。
            </p>
        </div>
        <a href="/" class="btnCommon">返回首页</a>
    </div>
</div>
<script src="../js/user/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
    $(function () {
        function setCookie(NameOfCookie, value) {
            document.cookie = NameOfCookie + " = " + escape(value) + "; expires= -1";
        }

        function getCookie(NameOfCookie) {
            if (document.cookie.length > 0) {
                begin = document.cookie.indexOf(NameOfCookie + "=");
                if (begin != -1) {
                    begin += NameOfCookie.length + 1;//cookie值的初始位置
                    end = document.cookie.indexOf(";", begin);//结束位置
                    if (end == -1) end = document.cookie.length;//没有;则end为字符串结束位置
                    return unescape(document.cookie.substring(begin, end));
                }
            } else {
                return null;
            }
        }

        var cookiearr = ['patient_name', 'phone_number', 'birthday', 'wechat_id', 'detail', 'gender', 'weight', 'smoking', 'ImgUrlList'];
        for (var i = 0; i < cookiearr.length; i++) {
            if (getCookie(cookiearr[i])) {
                setCookie(cookiearr[i], '');
            }
        }
    })
</script>
@endsection