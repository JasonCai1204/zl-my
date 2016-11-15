@extends('layouts.user-basic')

@section('title','快速预约-肿瘤名医')

@section('content')

<!--不输入错误 不显示-->
<div class="my_form_warn" style="display: none;">
    <span>输入错误</span>
</div>

<!--主体部分-->
<div class="container" id="container_order">
    <form action="messages" method="post" enctype="multipart/form-data" >
        {{ csrf_field() }}
                <!--
            当输入错误时,在weui_cell类名后面接上 weui-cell_warn 类,
            并在weui_cell块的最后加入 <div class="weui-cell__ft"> <i class="weui-icon-warn"></i> </div>
            若已经有weui-cell__ft 块 则直接在该块中加  <i class="weui-icon-warn"></i> 如下注释,并显示  my_form_warn
        -->
        <!--必须填写-->
        <div class="weui-cells weui-cells_form" style="margin-top: 30px;">
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">患者姓名</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" class="weui-input" placeholder="必填" required />
                </div>
                <!--<div class="weui-cell__ft">-->
                    <!--<i class="weui-icon-warn"></i>-->
                <!--</div>-->
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">手机号码</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="number" class="weui-input" placeholder="必填" required />
                </div>
            </div>
        </div>

        <!--可选填写-->
        <div class="weui-cells__title">可选填写</div>
        <div class="weui-cells">
            @if($hospitals || $doctors || $instances)
                    @if(count($hospitals) > 0 && count($doctors)>0)
                        <a href="/hospital/select" class="weui-cell  weui-cell_access" id="order_hospital">
                            <div class="weui-cell__bd">
                                <p>预约医院</p>
                            </div>
                            @foreach($hospitals as $hospital )
                                <div class="weui-cell__ft">
                                    {{$hospital->name}}
                                </div>
                            @endforeach
                        </a>
                        <a href="/doctor/select" class="weui-cell weui-cell_access" id="order_doctor">
                            <div class="weui-cell__bd">
                                <p>预约医生</p>
                            </div>
                            @foreach($doctors as $doctor)
                                <div class="weui-cell__ft">
                                    {{$doctor->name}}
                                </div>
                            @endforeach
                        </a>
                        @endif

                        <!--跳转 choice_hospital页面-->
                        @if( count($hospitals) > 0 || count($doctors) > 0)
                            <a href="/hospital/select" class="weui-cell  weui-cell_access" id="order_hospital">
                                <div class="weui-cell__bd">
                                    <p>预约医院</p>
                                </div>
                                @foreach($hospitals as $hospital )
                                <div class="weui-cell__ft">
                                    {{$hospital->name}}
                                </div>
                                @endforeach
                            </a>
                            <a href="/doctor/hospital/select?id={{$hospital->id}}" class="weui-cell weui-cell_access" id="order_doctor">
                                <div class="weui-cell__bd">
                                    <p>预约医生</p>
                                </div>
                                <div class="weui-cell__ft">
                                </div>
                            </a>
                        @endif
            @endif

                        {{--<!--跳转 choice_doctor页面-->--}}
                        {{--<a href="/doctor/select" class="weui-cell weui-cell_access" id="order_doctor">--}}
                            {{--<div class="weui-cell__bd">--}}
                                {{--<p>预约医生</p>--}}
                            {{--</div>--}}
                            {{--<div class="weui-cell__ft">--}}
                            {{--</div>--}}
                        {{--</a>--}}

                {{--<!--跳转 choice_cancer页面-->--}}
                {{--<a href="/instance/select" class="weui-cell weui-cell_access" id="order_cancer">--}}
                    {{--<div class="weui-cell__bd">--}}
                        {{--<p>所患疾病</p>--}}
                    {{--</div>--}}
                    {{--<div class="weui-cell__ft">--}}
                        {{--肺癌--}}
                    {{--</div>--}}
                {{--</a>--}}
                {{--@endif--}}
            {{--@endif--}}

                <!--跳转 choice_hospital页面-->
                <a href="/hospital/select" class="weui-cell  weui-cell_access" id="order_hospital">
                    <div class="weui-cell__bd">
                        <p>预约医院</p>
                    </div>
                    <div class="weui-cell__ft">

                    </div>
                </a>

                <!--跳转 choice_doctor页面-->
                <a href="/doctor/select" class="weui-cell weui-cell_access" id="order_doctor">
                    <div class="weui-cell__bd">
                        <p>预约医生</p>
                    </div>
                    <div class="weui-cell__ft">

                    </div>
                </a>

                <!--跳转 choice_cancer页面-->
                <a href="/select/instance" class="weui-cell weui-cell_access" id="order_cancer">
                    <div class="weui-cell__bd">
                        <p>所患疾病</p>
                    </div>
                    <div class="weui-cell__ft">

                    </div>
                </a>

            <!--选择性别-->
            <div class="weui-cell weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for class="weui-label">性别</label>
                </div>
                <div class="weui-cell__bd">
                    <select name="" class="weui-select">
                        <option value="" disabled selected></option>
                        <option value="">男</option>
                        <option value="">女</option>
                    </select>
                </div>
            </div>

            <!--选择出生年月-->
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">
                        出生年月
                    </label>
                </div>
                <div class="weui-cell__bd" style="color: #999999;">
                    <input type="month" class="weui-input" style="display: block;text-align: right;float: right;">
                </div>
            </div>

            <!--选择体重-->
            <div class="weui-cell weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for class="weui-label">体重</label>
                </div>
                <div class="weui-cell__bd">
                    <select name="" class="weui-select">
                        <option value="" disabled selected></option>
                        <option value="">50-60KG</option>
                        <option value="">40-50KG</option>
                    </select>
                </div>
            </div>

            <!--选择是否成抽烟-->
            <div class="weui-cell weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for class="weui-label">是否抽烟</label>
                </div>
                <div class="weui-cell__bd">
                    <select name="" class="weui-select">
                        <option value="" disabled selected></option>
                        <option value="">是</option>
                        <option value="">否</option>
                    </select>
                </div>
            </div>

            <!--微信号码-->
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">微信号码</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" class="weui-input" placeholder="方便我们与您联系">
                </div>
            </div>
        </div>

        <!--多文本输入病例-->
        <div class="weui-cells__title" style="margin: 15px 0 6px 5px;">病情描述</div>
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <textarea class="weui-textarea" style="font-size: 15px;" rows="4.5" placeholder="请详细描述患者的症状、疼痛部位、疼痛持续时间、精神状态等"></textarea>
                </div>
            </div>
        </div>

        <!--上传图片-->
        <div class="weui-cells__title">上传病例报告</div>
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell" style="padding: 14px 15px;">
                <div class="weui-cell__bd">
                    <div class="weui-gallery" id="gallery" style="opacity: 0;display: none;">
                        <span class="weui-gallery__img" id="gallertImg"></span>
                        <div class="weui-gallery__opr">
                            <a href="javascript:" class="weui-gallery__del"></a>
                            <i class="weui-icon-delete weui-icon_gallery-delete"></i>
                        </div>
                    </div>
                    <div class="weui-uploader">
                        <div class="weui-uploader__bd">
                            <ul class="weui-uploader__files"></ul>
                            <div class="weui-uploader__input-box">
                                <input id="uploaderInput" type="file" class="weui-uploader__input" accept="image/*" multiple>
                                <input type="hidden" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-cells__tips">请确保照片清晰可见</div>
        <div class="fixedbash">
            <div class="btnPosition">
                <input type="submit" value="预约" class="btnfixed">
            </div>
        </div>
    </form>
</div>
<!--上传失败弹窗-->
<div id="actionSheet_wrap">
    <div class="weui-mask_transparent actionsheet__mask" id="mask" style="text-decoration: none;transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1); display: none;"></div>
    <div class="weui-actionsheet" id="weui-actionsheet">
        <span class="my_order_uploadertitle" style="background-color: white">上传失败</span>
        <div class="weui-actionsheet__menu">
            <div class="weui-actionsheet__cell my_order_reuploader">重试</div>
            <div class="weui-actionsheet__cell my_order_delimg">删除</div>
        </div>
        <div class="weui-actionsheet__action">
            <div class="weui-actionsheet__cell" id="actionsheet_cancel" style="color: red;">取消</div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script type="text/javascript" src="../js/user/my_order_uploaderImg.js"></script>
<script type="text/javascript" src="../js/user/my_submitdisable.js"></script>

@endsection