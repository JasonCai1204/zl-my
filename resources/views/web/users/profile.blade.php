@extends('web.layouts.user-basic')

@section('title','我的信息 - 肿瘤名医')

@section('content')

@if (count($errors) > 0)
    <div class="my_form_warn" >
        <span>{{ $errors->first() }}</span>
    </div>
@endif

<!--主体部分-->
<div class="container" id="my_info_container">
        <form action="/account/user/profile" method="post">
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

                @if ( $errors->has('name') )
                    <div class="weui-cell__bd">
                        <input type="text" class="weui-input" value="{{ old('name') }}" name="name" required />
                    </div>
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                @else
                    <div class="weui-cell__bd">
                        <input type="text" class="weui-input" value="{{ old('name') ? : $user->name }}" name="name" required />
                    </div>
                @endif

            </div>

            <div class="weui-cell {{ $errors->has('phone_number') ? ' weui-cell_warn' : '' }}">
                <div class="weui-cell__hd">
                    <label class="weui-label">手机号码</label>
                </div>

                @if ( $errors->has('phone_number') )
                    <div class="weui-cell__bd">
                        <input type="number" class="weui-input" value="{{ old('phone_number') }}" name="phone_number" required />
                    </div>
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                @else
                    <div class="weui-cell__bd">
                        <input type="number" class="weui-input" value="{{ old('phone_number')? : $user->phone_number }}" name="phone_number" required />
                    </div>
                @endif

            </div>
        </div>
        <input type="submit" class="btnCommon" value="完成">
        <a href="/account" class="btnCommon btnCencel">取消</a>
    </form>
</div>

@endsection

@section('script')

<script type="text/javascript" src="/js/user/my_submitdisable.js"></script>

@endsection