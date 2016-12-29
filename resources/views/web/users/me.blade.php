@extends('web.layouts.user')

@section('title','我的 - 肿瘤名医')

@section('content')

    <div class="container" id="container_account">
        <div class="my_mine_list">
            <div class="weui-cells">
                <div class="weui-panel weui-panel_access">

                    <a href="{{ Auth::guest() ? '/login' : 'javascript:;' }}"
                       class="weui-media-box weui-media-box_appmsg" style="padding-top: 15px;">
                        <div class="weui-media-box__hd">

                            <img src="/storage/images/user/avatar/default.png" class="weui-media-box__thumb">
                        </div>
                        <div class="weui-media-box__bd">

                            <h4 class="weui-media-box__title">{{ Auth::guest() ? '未登录用户' : Auth::user()->name }}</h4>
                            <p class="weui-media-box__desc">{{ Auth::guest() ? '请登录' : '' }}</p>
                        </div>
                        <div class="weui-cell__ft"></div>
                    </a>
                </div>
            </div>

            @if (!Auth::guest())
                <div class="weui-cells">

                    <a href="/account/user/orders" class="weui-cell weui-cell_access">
                        <div class="weui-cell__bd">
                            <p>预约单</p>
                        </div>
                        <div class="weui-cell__ft"></div>
                    </a>
                </div>
            @endif

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

            @if (Auth::guest())
                <div class="my_mine_operate">

                    <a href="/login" class="btnLogin">登录</a>
                    <a href="/register" class="btnLogin my_has_before">注册</a>
                </div>
            @endif

            @if (!Auth::guest())
                <div class="my_mine_logoff">

                    <a href="{{ url('/logout') }}"
                       onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="btnLogin">退出登录</a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            @endif
        </div>

        @if (!Auth::guest())
            <div id="actionSheet_wrap">
                <div class="weui-mask_transparent actionsheet__mask" id="mask"
                     style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1); display: none;"></div>
                <div class="weui-actionsheet" id="weui-actionsheet">
                    <div class="weui-actionsheet__menu">

                        <a href="/account/user/profile" class="weui-actionsheet__cell my_order_reuploader">查看我的信息</a>
                        <a href="/account/password/reset" class="weui-actionsheet__cell my_order_delimg"
                           style="display: block;">修改密码</a>
                    </div>
                    <div class="weui-actionsheet__action">
                        <div class="weui-actionsheet__cell" id="actionsheet_cancel" style="color: red;">取消</div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script type="text/javascript" src="/js/user/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="/js/user/user.js"></script>
@endsection
