@extends('web.layouts.doctor')

@section('title','修改密码-肿瘤名医')

@section('content')

<!--不错误 不显示-->
@if(isset($errors))
    @if (count($errors) > 0)
        <div class="my_form_warn">
            <ul>
                @foreach ($errors->all() as $error)
                    <span>
                        {{ $error }}
                    </span>
                @endforeach
            </ul>
        </div>
     @endif
@endif

<!--主体部分-->
<div class="container">
    <form action="/password/reset" method="post">
        {{csrf_field()}}
        <!--
            当输入错误时,在weui_cell类名后面接上 weui-cell_warn 类,
            并在weui_cell块的最后加入 <div class="weui-cell__ft"> <i class="weui-icon-warn"></i> </div>
            若已经有weui-cell__ft 块 则直接在该块中加  <i class="weui-icon-warn"></i> 如下注释,并显示  my_form_warn
        -->
        <div class="weui-cells__title">修改密码</div>
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell {{ $errors->has('password') ? ' weui-cell_warn' : '' }}">
                <div class="weui-cell__hd">
                    <label class="weui-label">当前密码</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="password" class="weui-input" placeholder="必填" name="password" required />
                </div>
                @if($errors->has('password'))
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                @endif
            </div>
            <div class="weui-cell {{ $errors->has('newPassword') ? ' weui-cell_warn' : '' }}">
                <div class="weui-cell__hd">
                    <label class="weui-label">新密码</label>
                </div>
                @if($errors->has('newPassword'))
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                @endif
                <div class="weui-cell__bd">
                    <input type="password" class="weui-input" placeholder="不少于 6 位" name="newPassword" required />
                </div>
            </div>
            <div class="weui-cell {{ $errors->has('password_confirmation') ? ' weui-cell_warn' : '' }}">
                <div class="weui-cell__hd">
                    <label class="weui-label">确认密码</label>
                </div>
                @if($errors->has('password_confirmation'))
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                @endif
                <div class="weui-cell__bd">
                    <input type="password" class="weui-input" placeholder="再次输入密码" name="newPassword_confirmation" required />
                </div>
            </div>
        </div>
        <input type="submit" class="btnCommon" value="完成">
        <a href="/profile" class="btnCommon btnCencel">取消</a>
    </form>
    <script src="/js/doctor/jquery-1.11.3.min.js"></script>
    <script src="/js/doctor/my_submitdisable.js"></script>
    <!--通用js代码 10-17-->
</div>

@endsection