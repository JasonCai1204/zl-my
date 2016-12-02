@extends('layouts.user-basic')

@section('title','预约成功-肿瘤名医')

@section('content')

<!--主体部分-->
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

@endsection