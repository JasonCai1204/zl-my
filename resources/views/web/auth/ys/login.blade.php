@extends('web.layouts.user-basic')

@section('title','医生登录 - 肿瘤名医')

@section('content')

@if (count($errors) > 0)
    <div class="my_form_warn" >
        <span>{{ $errors->first() }}</span>
    </div>
@endif

{{-- Body --}}
<div class="container" id="my_info_container">
    <form action="/login" method="post">
        {{ csrf_field() }}

        <div class="weui-cells weui-cells_form" style="margin-top: 30px;">
            <div class="weui-cell {{ $errors->has('phone_number') ? ' weui-cell_warn' : '' }}">
                <div class="weui-cell__hd ">
                    <label class="weui-label">手机号码</label>
                </div>

                <div class="weui-cell__bd">
                    <input type="number" class="weui-input" placeholder="必填" name="phone_number" value="{{ old('phone_number') }}" required/>
                </div>

                @if($errors->has('phone_number'))
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                @endif
            </div>

            <div class="weui-cell {{ $errors->has('password') ? ' weui-cell_warn' : '' }}">
                <div class="weui-cell__hd">
                    <label class="weui-label">密码</label>
                </div>

                <div class="weui-cell__bd">
                    <input type="password" class="weui-input" placeholder="必填" name="password" required/>
                </div>

                @if($errors->has('password'))
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                @endif
            </div>
        </div>

        <input type="submit" class="btnCommon" value="登录">
    </form>
</div>
@endsection

@section('script')
    <script src="/js/user/my_submitdisable.js"></script>
@endsection
