@extends('web.layouts.user-basic')

@section('title','快速预约 - 肿瘤名医')

@section('content')

    @if ( count($errors) > 0)
        <div class="my_form_warn">
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <div class="container" id="container_order">
        <form action="/orders/create" method="post">
            {{ csrf_field() }}

            <div class="weui-cells weui-cells_form" style="margin-top: 30px;">
                <div class="weui-cell {{ $errors->has('patient_name') ? ' weui-cell_warn' : '' }} ">

                    <div class="weui-cell__hd">
                        <label class="weui-label">患者姓名</label>
                    </div>

                    <div class="weui-cell__bd">
                        <input name="patient_name" type="text" class="weui-input" placeholder="必填" required/>
                    </div>

                    @if ( $errors->has('patient_name') )
                        <div class="weui-cell__ft">
                            <i class="weui-icon-warn"></i>
                        </div>
                    @endif

                </div>

                <div class="weui-cell {{ $errors->has('phone_number') ? 'weui-cell_warn' :''}}">

                    <div class="weui-cell__hd">
                        <label class="weui-label">手机号码</label>
                    </div>

                    <div class="weui-cell__bd">
                        <input name="phone_number" type="number" class="weui-input" pattern="[0-9]*" placeholder="必填"
                               required/>
                    </div>

                    @if ( $errors->has('phone_number') )
                        <div class="weui-cell__ft">
                            <i class="weui-icon-warn"></i>
                        </div>
                    @endif

                </div>
            </div>

            <div class="weui-cells__title">可选填写</div>
            <div class="weui-cells">

                <a href="/hospital/select?{{ isset($hospital) ? 'hospital_id=' . $hospital->id . '&' : ''}}{{ isset($doctor) ? 'doctor_id=' . $doctor->id . '&' : '' }}{{ isset($instance) ? 'instance_id=' . $instance->id : '' }}"
                   class="weui-cell  weui-cell_access" id="order_hospital">
                    <div class="weui-cell__bd">
                        <p>预约医院</p>
                    </div>

                    <input type="hidden" name="hospital_id"{{ isset($hospital) ? ' value=' . $hospital->id : '' }} />

                    <div class="weui-cell__ft">
                        <p>{{ isset($hospital) ? $hospital->name : '' }}</p>
                    </div>
                </a>

                <a href="/doctor/select?{{ isset($hospital) ? 'hospital_id=' . $hospital->id . '&' : ''}}{{ isset($doctor) ? 'doctor_id=' . $doctor->id . '&' : '' }}{{ isset($instance) ? 'instance_id=' . $instance->id : '' }}"
                   class="weui-cell weui-cell_access" id="order_doctor">
                    <div class="weui-cell__bd">
                        <p>预约医生</p>
                    </div>

                    <input type="hidden" name="doctor_id"{{ isset($doctor) ? ' value=' . $doctor->id : '' }} />

                    <div class="weui-cell__ft">
                        <p>{{ isset($doctor) ? $doctor->name : '' }}</p>
                    </div>
                </a>

                <a href="/instance/select?{{ isset($hospital) ? 'hospital_id=' . $hospital->id . '&' : ''}}{{ isset($doctor) ? 'doctor_id=' . $doctor->id . '&' : '' }}{{ isset($instance) ? 'instance_id=' . $instance->id : '' }}"
                   class="weui-cell weui-cell_access" id="order_cancer">
                    <div class="weui-cell__bd">
                        <p>所患疾病</p>
                    </div>

                    <input type="hidden" name="instance_id"{{ isset($instance) ? ' value=' . $instance->id : '' }} />

                    <div class="weui-cell__ft">
                        <p>{{ isset($instance) ? $instance->name : '' }}</p>
                    </div>
                </a>

                <div class="weui-cell weui-cell_select weui-cell_select-after">
                    <div class="weui-cell__hd">
                        <label for class="weui-label">性别</label>
                    </div>
                    <div class="weui-cell__bd">
                        <select name="gender" class="weui-select">
                            <option value="" disabled selected></option>
                            <option value="1">男</option>
                            <option value="0">女</option>
                        </select>
                    </div>
                </div>

                <div class="weui-cell">
                    <div class="weui-cell__hd">
                        <label class="weui-label">
                            出生年月
                        </label>
                    </div>
                    <div class="weui-cell__bd" style="color: #999999;">
                        <input name="birthday" type="month" class="weui-input"
                               style="display: block;text-align: right;float: right;">
                    </div>
                </div>

                <div class="weui-cell weui-cell_select weui-cell_select-after">
                    <div class="weui-cell__hd">
                        <label for class="weui-label">体重</label>
                    </div>
                    <div class="weui-cell__bd">
                        <select name="weight" class="weui-select">
                            <option value="" disabled selected></option>
                            <option value="31-36">31-36KG</option>
                            <option value="36-41">36-41KG</option>
                            <option value="41-46">41-46KG</option>
                            <option value="46-51">46-51KG</option>
                            <option value="51-56">51-56KG</option>
                            <option value="56-61">56-61KG</option>
                            <option value="61-66">61-66KG</option>
                            <option value="66-71">66-71KG</option>
                            <option value="71-76">71-76KG</option>
                            <option value="76-81">71-76KG</option>
                            <option value="81-86">81-86KG</option>
                            <option value="86-91">86-91KG</option>
                        </select>
                    </div>
                </div>

                <div class="weui-cell weui-cell_select weui-cell_select-after">
                    <div class="weui-cell__hd">
                        <label for class="weui-label">是否抽烟</label>
                    </div>
                    <div class="weui-cell__bd">
                        <select name="smoking" class="weui-select">
                            <option value="" disabled selected></option>
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </div>
                </div>

                <div class="weui-cell">
                    <div class="weui-cell__hd">
                        <label class="weui-label">微信号码</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input name="wechat_id" type="text" class="weui-input" placeholder="方便我们与您联系">
                    </div>
                </div>
            </div>

            <div class="weui-cells__title" style="margin: 15px 0 6px 5px;">病情描述</div>
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                            <textarea name="detail" class="weui-textarea" style="font-size: 15px;" rows="4.5"
                                      placeholder="请详细描述患者的症状、疼痛部位、疼痛持续时间、精神状态等"></textarea>
                    </div>
                </div>
            </div>

            <div class="weui-cells__tips my_tips">
                <a href="javascript:;" class="my_drop1"
                   style="background-image: url('/storage/images/app/condition_tips_downwords_arrow.jpg')"></a>
                现在症状，部位？<br>
                什么时间发病，持续了多长时间，是逐渐加重？有缓解吗？<br>
                饮食状况？有症状后有消瘦程度？<br>
                有什么病史，有什么家族史？<br>
                有无采取什么治疗措施？<br>
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
                                    <input id="uploaderInput" type="file" class="weui-uploader__input"
                                           accept="image/*" name="file" multiple>
                                    <input class="my_hidden" type="hidden" name="photos" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="weui-cells__tips my_tips">
                <a href="javascript:;" class="my_drop2"
                   style="background-image: url('/storage/images/app/material_tips_downwords_arrow.jpg')"></a>
                基本资料（血生化，常规，电解质，肿瘤标志物）。<br>
                同时补充：<br>
                食道肿瘤：胃镜检查和病理检查，肝胆脾B超，肺部x检查；<br>
                肺部肿瘤：胸片和肺部CT或增强CT；<br>
                乳腺肿瘤：乳腺钼靶x拍摄，乳腺B超，或MR；<br>
                胃肠肿瘤：胃肠镜加取组织病理检查，肝胆脾B超；<br>
                肝胆胰腺：肝胆脾胰B超，腹部CT，胸片；<br>
                头颅肿瘤：头颅核磁共振检查，胸片，腹部B超；<br>
                妇科肿瘤：B超。<br>
            </div>

            <div class="fixedbash">
                <div class="btnPosition">
                    <input type="submit" value="预约" class="btnfixed">
                </div>
            </div>

        </form>
    </div>

    <div id="actionSheet_wrap">
        <div class="weui-mask_transparent actionsheet__mask" id="mask"
             style="text-decoration: none;transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1); display: none;"></div>
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

    <script src="../js/user/jquery.ui.widget.js"></script>
    <script src="../js/user/jquery.iframe-transport.js"></script>
    <script src="../js/user/jquery.fileupload.js"></script>
    <script type="text/javascript">
        var cookiearr = ['patient_name', 'phone_number', 'birthday', 'wechat_id', 'detail', 'gender', 'weight', 'smoking', 'ImgUrlList'];
        //        写入cookie
        function setCookie(NameOfCookie, value) {
            document.cookie = NameOfCookie + " = " + escape(value) + "; expires= -1";
        }
        //        获取cookie
        function getCookie(NameOfCookie) {
            if (document.cookie.length > 0) {
                begin = document.cookie.indexOf(NameOfCookie + "=");
                if (begin != -1) {
                    begin += NameOfCookie.length + 1;//cookie值的初始位置
                    end = document.cookie.indexOf(";", begin);//结束位置
                    if (end == -1) end = document.cookie.length;//没有;则end为字符串结束位置
                    return unescape(document.cookie.substring(begin, end));
                }
            } else {
                return null;
            }
        }
        //        cookietoform
        function writeCookie() {
            setCookie('patient_name', $("[name='patient_name']").val());
            setCookie('phone_number', $("[name='phone_number']").val());
            setCookie('birthday', $("[name = 'birthday']").val());
            setCookie('wechat_id', $("[name = 'wechat_id']").val());
            setCookie('detail', $("[name = 'detail']").val());
            setCookie('gender', $("[name = 'gender']").get(0).selectedIndex);
            setCookie('weight', $("[name = 'weight']").get(0).selectedIndex);
            setCookie('smoking', $("[name = 'smoking']").get(0).selectedIndex);
            setCookie('ImgUrlList', $("[name='photos']").val());
        }
        ;
        $('#order_hospital').on('click', function () {
            writeCookie();
        });
        $('#order_doctor').on('click', function () {
            writeCookie();
        });
        $('#order_cancer').on('click', function () {
            writeCookie();
        });
        $('[type = "submit"]').on('click', function () {
            writeCookie();
        })

        //        显示|隐藏ActionSheet
        function hideActionSheet(weuiActionsheet, mask) {
            weuiActionsheet.removeClass('weui-actionsheet_toggle');
            mask.removeClass('actionsheet__mask_show');
            weuiActionsheet.on('transitionend', function () {
                mask.css({
                    'display': 'none',
                    'background-color': 'transparent'
                });
            }).on('webkitTransitionEnd', function () {
                mask.css({
                    'display': 'none',
                    'background-color': 'transparent'
                });
            })
        }
        //        预览图click
        function clickPhoto($obj) {
            thisfile = $obj;
            var fileindex = $obj.index();
            var url = thisfile.css('background-image');
            if (thisfile.has($(".weui-icon-warn")).length >= 1) {
                weuiActionsheet.addClass('weui-actionsheet_toggle');
                mask.show().focus().addClass('actionsheet__mask_show').css('background-color', 'rgba(0,0,0,.6)').one('click', function () {
                    hideActionSheet(weuiActionsheet, mask);
                });
                $('#actionsheet_cancel').one('click', function () {
                    hideActionSheet(weuiActionsheet, mask);
                });
                weuiActionsheet.unbind('transitionend').unbind('webkitTransitionEnd');
            } else {
                $("#gallery").show().css({
                    'background-image': url,
                    'background-size': '100%',
                    'background-repeat': 'no-repeat',
                    'background-position': 'center center',
                    'opacity': 1
                }).on('click', function () {
                    $("#gallery").hide().css('opacity', 0)
                });
                $('.weui-icon_gallery-delete').on('click', function () {
                    $("#gallery").hide().css('opacity', 0);
                    thisfile.remove();
                    ImgUrlList.splice(fileindex, 1);
                    $("[name='photos']").val(ImgUrlList.join(','));
                    setCookie('ImgUrlList', $("[name='photos']").val());
                })
            }
        }
        ;

        var mask = $('#mask');
        var weuiActionsheet = $('#weui-actionsheet');
        var ImgUrlLis, thisfile;
        var drop1 = false, drop2 = false;
        var checkedfilg = true;
        var textflig = true;
        if (getCookie('ImgUrlList')) {
            ImgUrlList = getCookie('ImgUrlList').split(",");
        } else {
            ImgUrlList = [];
        }
        ;

        if (document.cookie != "") {
            $("[name='patient_name']").val(getCookie('patient_name'));
            $("[name='phone_number']").val(getCookie('phone_number'));
            $("[name = 'birthday']").val(getCookie('birthday'));
            $("[name='wechat_id']").val(getCookie('wechat_id'));
            $("[name='detail']").val(getCookie('detail'));
            $("[name = 'weight']").get(0).selectedIndex = getCookie('weight');
            $("[name = 'smoking']").get(0).selectedIndex = getCookie('smoking');
            $("[name = 'gender']").get(0).selectedIndex = getCookie('gender');
            if (getCookie('ImgUrlList')) {
                $("[name = 'photos']").val(getCookie('ImgUrlList'));
                var ImgUrlListArr = getCookie('ImgUrlList').split(",");
                for (var i = 0; i < ImgUrlListArr.length; i++) {
                    ($("<li class='weui-uploader__file'></li>")
                            .css('background-image', 'url(/storage/' + ImgUrlListArr[i] + ')')
                            .attr("onclick", "clickPhoto($(this))")
                            .prependTo($(".weui-uploader__files")) );
                }
            }
            for (var i = 0; i < cookiearr.length; i++) {
                if (getCookie(cookiearr[i])) {
                    setCookie(cookiearr[i], '');
                }
            }
        }

        $(".weui-uploader__input")
                .fileupload({
                    dataType: 'json',
                    url: '/order/postPhotos',
                    formData: {
                        _token: '{{ csrf_token() }}'
                    },

                    add: function (e, data) {
                        data.context = ($("<li class='weui-uploader__file weui-uploader__file_status'></li>")
                                .css('background-image', 'url()')
                                .html("<div class='weui-uploader__file-content'>" + "<i class='weui-loading'></i>" + "</div>")
                                .appendTo($(".weui-uploader__files")) );
                        data.submit();

                    },

                    done: function (e, data) {
                        var url = '/storage/' + encodeURI(data.result.file.url);
                        console.log(url);
                        data.context
                                .css("background-image", "url('" + url + "')")
                                .removeClass('weui-uploader__file_status')
                                .attr("onclick", "clickPhoto($(this))")
                                .children('div').remove();
                        ImgUrlList.push(data.result.file.url);
                        $("[name='photos']").val(ImgUrlList.join(','));
                    },
                    fail: function (e, data) {
                        data.context
                                .attr({
                                    'data_flag': 'false',
                                    'onclick': 'clickPhoto($(this))'
                                })
                                .html("<div class='weui-uploader__file-content'>" + "<i class='weui-icon-warn'></i>" + "</div>");
                    }

                });
        $(".my_order_reuploader").on('click', function () {
            hideActionSheet(weuiActionsheet, mask);
            thisfile.remove();
            $(".weui-uploader__input").click();
        });
        $(".my_order_delimg").on('click', function () {
            hideActionSheet(weuiActionsheet, mask);
            thisfile.remove();
            ImgUrlList.splice(fileindex, 1);
            $("[name='photos']").val(ImgUrlList.join(','));
        });

        //        按钮点击展示
        $(".my_drop1")
                .on('click', function () {
                    drop1 = !drop1;
                    if (drop1) {
                        $(this).css('background-image', 'url(/storage/images/app/condition_tips_upwords_arrow.jpg)');
                        $(this).parent('.my_tips').css("height", "initial");
                    } else {
                        $(this).css('background-image', 'url(/storage/images/app/condition_tips_downwords_arrow.jpg)');
                        $(this).parent('.my_tips').css("height", "25px");
                    }
                });
        $(".my_drop2")
                .on('click', function () {
                    drop2 = !drop2;
                    if (drop2) {
                        $(this).css('background-image', 'url(/storage/images/app/material_tips_upwords_arrow.jpg)');
                        $(this).parent('.my_tips').css("height", "initial");
                    } else {
                        $(this).css('background-image', 'url(/storage/images/app/material_tips_downwords_arrow.jpg)');
                        $(this).parent('.my_tips').css("height", "25px");
                    }
                });
    </script>
    <script src="../js/user/my_submitdisable.js"></script>
@endsection
