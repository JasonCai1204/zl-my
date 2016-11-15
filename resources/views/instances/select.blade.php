@extends('layouts.user-basic')

@section('title','选择所患疾病-肿瘤名医')

@section('content')

<!--主体部分-->
<div class="container" id="order_choice_cancer">
    <form action="">
        <div class="weui-cells__title">所有肿瘤</div>
        <div class="weui-cells weui-cells_radio">
            <label class="weui-cell weui-check__label">
                <div class="weui-cell__bd">
                    <p>咽喉癌</p>
                </div>
                <div class="weui-cell__ft">
                    <input type="radio" class="weui-check">
                    <span class="weui-icon-checked"></span>
                </div>
            </label>
            <label class="weui-cell weui-check__label">
                <div class="weui-cell__bd">
                    <p>肺癌</p>
                </div>
                <div class="weui-cell__ft">
                    <input type="radio" class="weui-check">
                    <span class="weui-icon-checked"></span>
                </div>
            </label>
            <label class="weui-cell weui-check__label">
                <div class="weui-cell__bd">
                    <p>其他胸部肿瘤</p>
                </div>
                <div class="weui-cell__ft">
                    <input type="radio" class="weui-check">
                    <span class="weui-icon-checked"></span>
                </div>
            </label>
        </div>
        <div class="fixedbash">
            <div class="btnPosition">
                <input type="submit" value="完成" class="btnfixed">
            </div>
        </div>
    </form>
</div>

@endsection

@section('script')

<script type="text/javascript" src="/js/user/my_choicebtn.js"></script>

@endsection
