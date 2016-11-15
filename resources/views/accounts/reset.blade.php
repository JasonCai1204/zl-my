@extends('layouts.user-basic')

@section('title','修改密码-肿瘤名医')

@section('content')

<!--不错误  不显示-->
<div class="my_form_warn" style="display: none;">
    <span>输入错误</span>
</div>

<!--主体部分-->
<div class="container">
    <form action="">
        <!--
            当输入错误时,在weui_cell类名后面接上 weui-cell_warn 类,
            并在weui_cell块的最后加入 <div class="weui-cell__ft"> <i class="weui-icon-warn"></i> </div>
            若已经有weui-cell__ft 块 则直接在该块中加  <i class="weui-icon-warn"></i> 如下注释,并显示  my_form_warn
        -->
        <div class="weui-cells__title">修改密码</div>
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">当前密码</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="password" class="weui-input" placeholder="必填" required />
                </div>
                <!--<div class="weui-cell__ft">-->
                    <!--<i class="weui-icon-warn"></i>-->
                <!--</div>-->
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">新密码</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="password" class="weui-input" placeholder="不少于 8 位" required />
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">确认密码</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="password" class="weui-input" placeholder="再次输入密码" required />
                </div>
            </div>
        </div>
        <input type="submit" class="btnCommon" value="完成">
        <a href="" class="btnCommon btnCencel">取消</a>
    </form>

</div>

@endsection

@section('script')

<script src="/js/user/my_submitdisable.js"></script>

@endsection