@extends('layouts.user-basic')

@section('title','注册 - 肿瘤名医')

@section('content')

<!--不输入错误 不显示-->

@if (count($errors) > 0)
    <div class="my_form_warn" >
            <span>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </span>
    </div>
@endif

<!--主体部分-->
<div class="container" id="my_info_container">
    <form action="/signup" method="post">
        {{csrf_field()}}
        <!--
            当输入错误时,在weui_cell类名后面接上 weui-cell_warn 类,
            并在weui_cell块的最后加入 <div class="weui-cell__ft"> <i class="weui-icon-warn"></i> </div>
            若已经有weui-cell__ft 块 则直接在该块中加  <i class="weui-icon-warn"></i> 如下注释,并显示  my_form_warn
        -->
        <div class="weui-cells weui-cells_form" style="margin-top: 30px;">
            <div class="weui-cell {{ $errors->has('name') ? ' weui-cell_warn' : '' }}">
                <div class="weui-cell__hd">
                    <label class="weui-label">姓名</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" class="weui-input" placeholder="请填写真实姓名" name="name" value="{{old('name')}}" required />
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
                @if($errors->has('phone_number'))
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                @endif
                <div class="weui-cell__bd">
                    <input type="number" class="weui-input" placeholder="必填" name="phone_number" value="{{old('phone_number')}}" required />
                </div>
            </div>
            <div class="weui-cell {{ $errors->has('password') ? ' weui-cell_warn' : '' }}">
                <div class="weui-cell__hd">
                    <label class="weui-label">密码</label>
                </div>
                @if($errors->has('password'))
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                @endif
                <div class="weui-cell__bd">
                    <input type="password" class="weui-input" placeholder="不少于 6 位" name="password" required />
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
                    <input type="password" class="weui-input" placeholder="再次输入" name="password_confirmation" required />
                </div>
            </div>
        </div>
        <!--协议-->
        <label for="weuiAgree" class="weui-agree">
            <input type="checkbox" id="weuiAgree" class="weui-agree__checkbox" checked name="">
            <span class="weui-agree__text">已阅读并同意<a href="/legal/terms">《借款额度合同及相关授权》</a></span>
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