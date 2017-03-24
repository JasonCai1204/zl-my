@extends('web.layouts.user-basic')

@section('title','修改密码 - 肿瘤名医')

@section('content')

@if (count($errors) > 0)
    <div class="my_form_warn" >
            <span>{{ $errors->first() }}</span>
    </div>
@endif

<!--主体部分-->
<div class="container">
    <form action="/account/password/reset" method="post">
        {{ csrf_field() }}

        <div class="weui-cells__title">修改密码</div>

        <div class="weui-cells weui-cells_form">
            <div class="weui-cell {{ $errors->has('current_password') ? ' weui-cell_warn' : '' }}">
                <div class="weui-cell__hd">
                    <label class="weui-label">当前密码</label>
                </div>

                <div class="weui-cell__bd">
                    <input type="password" class="weui-input" placeholder="必填" name="current_password" required />
                </div>

                @if($errors->has('current_password'))
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                @endif
            </div>

            <div class="weui-cell {{ $errors->has('password') ? ' weui-cell_warn' : '' }}">
                <div class="weui-cell__hd">
                    <label class="weui-label">新密码</label>
                </div>

                <div class="weui-cell__bd">
                    <input type="password" class="weui-input" placeholder="不少于 8 位" name="password" required />
                </div>

                @if($errors->has('password'))
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                @endif
            </div>

            <div class="weui-cell {{ $errors->has('password_confirmation') ? ' weui-cell_warn' : '' }}">
                <div class="weui-cell__hd">
                    <label class="weui-label">确认密码</label>
                </div>

                <div class="weui-cell__bd">
                    <input type="password" class="weui-input" placeholder="再次输入密码" name="password_confirmation" required />
                </div>

                @if($errors->has('password_confirmation'))
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                @endif
            </div>
        </div>

        <input type="submit" class="btnCommon" value="完成">
        <a href="/account/profile" class="btnCommon btnCencel">取消</a>
    </form>

</div>

@endsection

@section('script')

<script src="/js/user/my_submitdisable.js"></script>

@endsection
