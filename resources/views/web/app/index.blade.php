@extends('web.layouts.user')

@section('title','肿瘤名医')

@section('content')

<div class="container" id="container_home">
    <div class="my_home_header" style=" background-image: url('/storage/images/app/4_doctors.jpeg');">
        <div class="bd">
            <a href="search">
                <div class="my_home_inner">
                    <i class="weui-icon-search"></i><span>搜索医院、医生</span>
                </div>
            </a>
        </div>
    </div>
    <div class="my_home_askorder my_has_after">
        <a href="orders/create" class="my_home_quickorder">
            <div class="my_quickorder_icon">
                <img src="/storage/images/app/lighting_form.png" alt="">
            </div>
            <p class="my_quickorder_label">快速预约</p>
            <span>医院、医生</span>
        </a>
        <div class="my_home_askpart my_has_leftbefore">
            <a href="javascript:;" class="my_home_ask" id="askonline">
                <div class="my_ask_icon">
                    <img src="/storage/images/app/seerscker_qusetion_mark.png" alt="">
                </div>
                <div class="my_ask_label">
                    <p>在线咨询</p>
                    <span>立即聊天</span>
                </div>
            </a>
            <a href="tel:400-8120533" class="my_home_ask my_has_before" style="border: 0;">
                <div class="my_ask_icon">
                    <img src="/storage/images/app/ring_phone.png" alt="">
                </div>
                <div class="my_ask_label">
                    <p>电话咨询</p>
                    <span>4008-120-533</span>
                </div>
            </a>
        </div>
    </div>

    <div class="my_swiper my_has_after">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($news as $new)
                <div class="swiper-slide">
                    <a href="news/{{$new->id}}" style="background-image:url('{{$new->cover_image}}')"></a>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div class="my_home_find my_has_after">
        <a href="/hospital" class="my_home_findhospital">
            <div class="my_findbtn_icon">
                <img src="/storage/images/app/green_hospital.png" alt="">
            </div>
            <div class="my_findbtn_label">
                <p>找医院</p>
                <span>顶级医院</span>
            </div>
        </a>
        <a href="/doctor" class="my_home_finddoctor my_has_leftbefore">
            <div class="my_findbtn_icon">
                <img src="/storage/images/app/green_doctor_magnifying_glass.png" alt="">
            </div>
            <div class="my_findbtn_label">
                <p>找医生</p>
                <span>精选名医</span>
            </div>
        </a>
    </div>

    <div class="my_home_msg">
        <div class="weui-footer">
            <p class="weui-footer__text">广州德之网络有限公司 保留所有权利</p>
            <p class="weui-footer__text"><a href="http://www.miibeian.gov.cn">粤备1100020001号</a></p>
        </div>
    </div>

    <div class="js_dialog" id="iosDialog2" style="display: none;">
        <div class="weui-mask"></div>
        <div class="weui-dialog">
            <div class="weui-dialog__bd">
                即将开放，敬请期待。
            </div>
            <div class="weui-dialog__ft">
                <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary">好的</a>
            </div>
        </div>
    </div>
</div>
@endsection
