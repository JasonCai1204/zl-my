@extends('layouts.user')

@section('title','我的-肿瘤名医')

@section('content')
<!--个人中心部分-->
<div class="container" id="container_account">
    <div class="my_mine_list">

        <!--图片+姓名-->
        <div class="weui-cells">
            <div class="weui-panel weui-panel_access">
                <a href="javascript:;" class="weui-media-box weui-media-box_appmsg">
                    <div class="weui-media-box__hd">
                        <img src="/storage/images/app/web/www/user-mobile-minepage-default-avatar.png" alt="" class="weui-media-box__thumb">
                    </div>
                    <div class="weui-media-box__bd">
                        @if(!isset($user))
                        <h4 class="weui-media-box__title">未登录用户</h4>
                        <p class="weui-media-box__desc">请登陆</p>
                        @endif
                    </div>
                    <div class="weui-cell__ft"></div>
                </a>
            </div>
        </div>

        <!--未登录时不添加-->
        <!--<div class="weui-cells__title">我是患者</div>-->
        @if(isset($user))
        <div class="weui-cells">
            <a href="/account/user/orders/?user_id={{$user->id or ''}}" class="weui-cell weui-cell_access">
                <div class="weui-cell__bd">
                    <p>预约单</p>
                </div>
                <div class="weui-cell__ft"></div>
            </a>
        </div>
        @endif

        <!--常见问题等-->
        <div class="weui-cells">
            <a href="/support/qa" class="weui-cell weui-cell_access">
                <div class="weui-cell__bd">
                    <p>常见问题</p>
                </div>
                <div class="weui-cell__ft"></div>
            </a>
            <a href="/about" class="weui-cell weui-cell_access">
                <div class="weui-cell__bd">
                    <p>关于我们</p>
                </div>
                <div class="weui-cell__ft"></div>
            </a>
            <a href="tel:400-8120533" class="weui-cell weui-cell_access">
                <div class="weui-cell__bd">
                    <p>联系我们</p>
                </div>
                <div class="weui-cell__ft">
                    4008-120-533
                </div>
            </a>
        </div>

        <!--登录&注册   登录后不显示-->
        @if(!isset($user))
        <div class="my_mine_operate">
            <a href="/signin" class="btnLogin">登录</a>
            <a href="/signup" class="btnLogin my_has_before">注册</a>
        </div>
        @endif

        <!--退出登录  未登录时不添加-->
        @if(isset($user))
        <div class="my_mine_logoff">
            <a href="/signout" class="btnLogin">退出登录</a>
        </div>
        @endif
    </div>

    <!--actionSheet 未登录时不添加-->
    <div id="actionSheet_wrap">
        <div class="weui-mask_transparent actionsheet__mask" id="mask" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1); display: none;"></div>
        <div class="weui-actionsheet" id="weui-actionsheet">
            <div class="weui-actionsheet__menu">
                <a href="/account/user/profile/?user_id={{$user->id or ''}}" class="weui-actionsheet__cell my_order_reuploader">查看我的信息</a>
                <a href="/account/password/reset/?user_id={{$user->id or ''}}" class="weui-actionsheet__cell my_order_delimg" style="display: block;">修改密码</a>
            </div>
            <div class="weui-actionsheet__action">
                <div class="weui-actionsheet__cell" id="actionsheet_cancel" style="color: red;">取消</div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/js/user/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/js/user/user.js"></script>

@endsection