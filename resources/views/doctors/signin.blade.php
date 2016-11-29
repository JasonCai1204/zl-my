@extends('layouts.user-basic')

@section('title','登录-肿瘤名医')

@section('content')

<!--不错误 不显示-->
@if(isset($errors))
    @if (count($errors) > 0)
        <div class="my_form_warn">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        <span>{{ $error }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endif


<!--主体部分-->
<div class="container" id="my_info_container">
    <form action="/doctor/signin" method="post">
        {{csrf_field()}}
        <!--
            当输入错误时,在weui_cell类名后面接上 weui-cell_warn 类,
            并在weui_cell块的最后加入 <div class="weui-cell__ft"> <i class="weui-icon-warn"></i> </div>
            若已经有weui-cell__ft 块 则直接在该块中加  <i class="weui-icon-warn"></i> 如下注释,并显示  my_form_warn
        -->
        <div class="weui-cells weui-cells_form" style="margin-top: 30px;">
            <div class="weui-cell ">
                <div class="weui-cell__hd">
                    <label class="weui-label">手机号码</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="number" class="weui-input" placeholder="必填" required name="phone_number" value="{{ old('phone_number') }}"/>
                </div>
                <!--<div class="weui-cell__ft">-->
                    <!--<i class="weui-icon-warn"></i>-->
                <!--</div>-->
            </div>
            <div class="weui-cell ">
                <div class="weui-cell__hd">
                    <label class="weui-label">密码</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="password" class="weui-input" placeholder="必填" required name="password" value="{{'password'}}"/>
                </div>
            </div>
        </div>
        <input type="submit" class="btnCommon" value="登录">
    </form>
</div>

@endsection

@section('script')

<script src="js/doctor/jquery-1.11.3.min.js"></script>
<script src="js/doctor/my_submitdisable.js"></script>

@endsection