@extends('layouts.user-basic')

@section('title','联系我们-肿瘤名医')

@section('content')

<!--主体部分-->
<div class="container" id="container_contactus">
    <div>
        <p class="my_contactus_hd">客户服务中心</p>
        <div class="bd">
            <div>
                <div class="my_contactus_cell my_contactus_hasbefore">
                    <p>
                        <a href="tel:400-812053">热线：4008 120 533</a>
                    </p>
                </div>
                <div class="my_contactus_cell my_contactus_hasbefore">
                    <p>
                        <a href="tel:020-36660236">电话：020-3666 0236</a>
                    </p>
                </div>
                <div class="my_contactus_cell my_contactus_hasbefore">
                    <p>
                        <a href="http://zl-my.com">网站：zl-my.com</a>
                    </p>
                </div>
                <div class="my_contactus_cell my_contactus_hasbefore">
                    <p>
                        <a href="javascript:;">
                            地址：广州市越秀区中山三路 33 号中华国际中心 B 座 5903
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="my_phone_qrcode">
        <img src="/storage/images/user/mobile-contactus-qrcode.png" alt="">
        <p>关注微信公众号</p>
        <span>长按二维码 - 识别图中二维码</span>
    </div>
</div>

@endsection