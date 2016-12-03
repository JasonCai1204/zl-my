@extends('web.layouts.user-basic')

@section('title','注册 - 肿瘤名医')

@section('content')

{{-- Errors tips. --}}
@if (count($errors) > 0)
    <div class="my_form_warn" >
            <span>{{ $errors->first() }}</span>
    </div>
@endif

{{-- Body --}}
<div class="container" id="my_info_container">
    <form action="/register" method="POST">
        {{ csrf_field() }}

        <div class="weui-cells weui-cells_form" style="margin-top: 30px;">
            <div class="weui-cell {{ $errors->has('name') ? ' weui-cell_warn' : '' }}">
                <div class="weui-cell__hd">
                    <label class="weui-label">姓名</label>
                </div>

                <div class="weui-cell__bd">
                    <input type="text" class="weui-input" placeholder="请填写真实姓名" name="name" value="{{ old('name') }}" required />
                </div>

                @if($errors->has('name'))
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                @endif
            </div>

            <div class="weui-cell {{ $errors->has('phone_number') ? ' weui-cell_warn' : '' }}">
                <div class="weui-cell__hd">
                    <label class="weui-label">手机号码</label>
                </div>

                <div class="weui-cell__bd">
                    <input type="tel" class="weui-input" pattern="[0-9]*" placeholder="必填" name="phone_number" value="{{ old('phone_number' )}}" required />
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
                    <input type="password" class="weui-input" placeholder="不少于 6 位" name="password" required />
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

        <label for="weuiAgree" class="weui-agree">
            <input type="checkbox" id="weuiAgree" class="weui-agree__checkbox" name="terms" checked>
            <span class="weui-agree__text">已阅读并同意<a href="/legal/terms">《服务条款》</a></span>
        </label>

        <input type="submit" class="btnCommon" value="注册">
    </form>
</div>

@endsection

@section('script')
    <script>
        $(function(){
            var checkedfilg = true;
            var textflig = true;
            $("[type = 'submit']").addClass('btnDisable');
            for(var i = 0 ;i<$('[required]').length; i++){
                if($('[required]').eq(i).val() == ''){
                    textflig = false;
                    break;
                }
            }
            $('[required]').on('input propertychange',function () {
                for(var i = 0 ;i<$('[required]').length; i++){
                    if($(this).parents('div.weui-cell').hasClass('weui-cell_warn')){
                        $(this).parents('div.weui-cell').removeClass('weui-cell_warn');
                        $(this).parents('div.weui-cell').find('div.weui-cell__ft').remove();
                    }
                    if($('[required]').eq(i).val() == ''){
                        textflig = false;
                        break;
                    }else{
                        textflig = true;
                    }
                }
                if(checkedfilg == true && textflig == true){
                    $("[type = 'submit']").removeClass('btnDisable')
                }else{
                    $("[type = 'submit']").addClass('btnDisable')
                }
            });
            $("#weuiAgree").on('click',function () {
                checkedfilg = !checkedfilg;
                if(checkedfilg == true && textflig == true){
                    $("[type = 'submit']").removeClass('btnDisable')
                }else{
                    $("[type = 'submit']").addClass('btnDisable')
                }
            });
            if(checkedfilg == true && textflig == true){
                $("[type = 'submit']").removeClass('btnDisable')
            }else{
                $("[type = 'submit']").addClass('btnDisable')
            }
        })
    </script>

@endsection
