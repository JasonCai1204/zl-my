@extends('web.layouts.user')

@section('title','肿瘤名医')

@section('content')
<div class="container" id="container_home">
    <div class="my_home_header" style=" background-image: url('/storage/images/app/4_doctors.png');">
        <div class="bd">
            <div class="weui-search-bar testshearch" id="searchBar">
                <form action="/search" class="weui-search-bar__form" style="background-color: transparent">

                    <div class="weui-search-bar__box">
                        <i class="weui-icon-search" style="top: 5.5px;"></i>
                        <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索医院、医生"
                               name="q" autofocus/>
                        <a href="javascript:;" class="weui-icon-clear" id="searchClear"></a>
                    </div>

                    <label class="weui-search-bar__label" id="searchText">
                        <i class="weui-icon-search"></i>
                        <span>搜索医院、医生</span>
                    </label>
                </form>
                <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
            </div>
        </div>
    </div>
    <div id="searchbd" style="display: none;"></div>
    <div id="searchhidden">
        <div class="my_home_askorder my_has_after">
            <a href="orders/create" class="my_home_quickorder">

                <div class="my_quickorder_icon">
                    <img src="/storage/images/app/lighting_form.png" alt="">
                </div>
                <p class="my_quickorder_label">快速预约</p>
                <span>医院、医生</span>
            </a>

            <div class="askpart my_has_leftbefore">

                <a href="javascript:;" class="askbtn" id="askonline" style="border-top: 1px solid #d9d9d9;">
                    <div class="askbtn_inner" style="width: 137px;">
                        <img src="/storage/images/app/seerscker_qusetion_mark.png" alt="" class="askbtn_icon">
                        <p class="askbtn_tittle" style="width: 77px;">在线咨询</p>
                        <p class="askbtn_tips" style="width: 77px;">立即聊天</p>
                    </div>
                </a>

                <a href="tel:400-8120533" class="askbtn my_has_before" style="top: -7px;">
                    <div class="askbtn_inner" style="width: 137px;">
                        <img src="/storage/images/app/ring_phone.png" alt="" class="askbtn_icon" style="margin-right: 20px;">
                        <p class="askbtn_tittle" style="width: 77px;">电话咨询</p>
                        <p class="askbtn_tips" style="width: 77px;">4008-120-533</p>
                    </div>
                </a>

            </div>
        </div>

        <div class="my_swiper my_has_after">
            <div class="swiper-container">
                <div class="swiper-wrapper">

                    @foreach ($news as $new)
                        <div class="swiper-slide">
                            <a href="news/{{ $new->id }}"
                               style="background-image:url('/storage/{{$new->cover_image}}')"></a>
                        </div>
                    @endforeach

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <div class="findbar my_has_after">
            <a href="/hospital" class="findbtn">
                <div class="findbtn_inner">
                    <img src="/storage/images/app/green_hospital_building.png" alt="" class="findbtn_icon" style="padding-top: 2px;">
                    <p class="findbtn_title">找医院</p>
                    <p class="findbtn_tips">精选医院</p>
                </div>
            </a>
            <a href="/doctor" class="findbtn my_has_leftbefore" style="position: absolute;top: 0; right: 0;">
                <div class="findbtn_inner">
                    <img src="/storage/images/app/green_doctor_magnifying_glass.png" alt="" class="findbtn_icon">
                    <p class="findbtn_title">找医生</p>
                    <p class="findbtn_tips">顶级名医</p>
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
</div>
@endsection
