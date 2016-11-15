@extends('layouts.doctor')

@section('title','我的信息-肿瘤名医')

@section('content')

<!--主体部分-->
<div class="container" id="my_info_container">
        <form action="">
        <div class="weui-cells weui-cells_form" style="margin-top: 30px;">
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">姓名</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" class="weui-input" value="周岱翰" readonly />
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">所在医院</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" class="weui-input" value="中山大学肿瘤防治中心" readonly />
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">职称</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" class="weui-input" value="主任医师" readonly />
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">手机号码</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="number" class="weui-input" value="18512345678" readonly />
                </div>
            </div>
        </div>
            <div class="my_mine_logoff">
                <a href="" class="btnLogin">退出登录</a>
            </div>
            <a href="" class="btnLink">修改密码</a>
    </form>
</div>

@endsection

@section('script')

<script type="text/javascript" src="/js/doctor/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/js/doctor/my_submitdisable.js"></script>

@endsection
