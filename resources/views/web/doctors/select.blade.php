@extends('web.layouts.user-basic')

@section('title','选择医生 - 肿瘤名医')

@section('content')
    <div id="filter_base">
        <div id="filter">
            <span>找医生</span>
            <a id="filter_btn">
                <span>筛选</span>
                <div class="chevron"></div>
            </a>
            <div class="filter_panel_base" style="display: none;">
                <div class="filter_panel">
                    <div class="panel_chevron"></div>
                    <div class="panel_chevron_bg"></div>
                    <label for="city_id" class="panel_list">
                        <span>按 城市 筛选</span>
                        <select id="city_id">
                            <option value="">不筛选</option>
                            @if (isset($cities))
                                @foreach($cities as $city )
                                    <option value="{{ $city->id }}"{{isset( $city_id ) && $city->id == $city_id ?'selected' : ''}}>{{ $city->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </label>
                    <label for="hospital_id" class="panel_list">
                        <span>按 医院 筛选</span>
                        <select id="hospital_id">
                            <option value="">不筛选</option>
                            @if (isset($hospitals))
                                @foreach ($hospitals as $hospital)
                                    <option value="{{ $hospital->id }}"{{isset( $hospital_id ) && $hospital->id == $hospital_id ?'selected' : ''}}>{{ $hospital->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </label>
                    <label for="instance_id" class="panel_list">
                        <span>按 疾病 筛选</span>
                        <select id="instance_id">
                            <option value="">不筛选</option>
                            @if (isset($types))
                                @foreach ($types as $type)
                                    <option value="" disabled>{{ $type->name }}</option>
                                    @foreach ($type->instances as $instance)
                                        <option value="{{ $instance->id }}"{{isset( $instance_id ) && $instance->id == $instance_id ?'selected' : ''}}>{{ $instance->name }}</option>
                                    @endforeach
                                @endforeach
                            @endif
                        </select>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="blocking" style="display: none;"></div>
    <div class="my_app_coming" id="loading" style="display: none;">
        <div class="weui-loadmore">
            <i class="weui-loading"></i>
        </div>
    </div>
    <div class="my_app_coming" id="nodata" style="display: none;">
        <span>暂无满足条件的医生。</span>
    </div>

    <div class="container" id="order_choice_hospital">

        <form action="/orders/create" method="GET" style="margin-top: 30px;">

                <input type="hidden" name="city_id" value="{{ $city_id or '' }}"/>

                <input type="hidden" name="hospital_id" value="{{ $hospital_id or '' }}"/>

                <input type="hidden" name="instance_id" value="{{ $instance_id or '' }}"/>


            @if (count($doctors) > 0 )

                <div class="weui-cells weui-cells_radio">
                    @foreach ($doctors as $doctor)
                        <label class="weui-cell weui-check__label">
                            <div class="weui-cell__bd">

                                <p>{{ $doctor->name }}</p>
                                <span class="my_cell_index">{{ $doctor->hospital->name }}</span>
                            </div>

                            <div class="weui-cell__ft">
                                <input type="radio" class="weui-check" name="doctor_id"
                                       value="{{ $doctor->id }}" {{ isset($doctor_id) && $doctor->is_recommended != 1 && $doctor->id == $doctor_id ? 'checked' : ''  }} />

                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                    @endforeach
                </div>
            @endif


            <div class="fixedbash">
                <div class="btnPosition">
                    <input type="submit" value="完成" class="btnfixed">
                </div>
            </div>
        </form>
    </div>
    <script src="/js/user/jquery-1.11.3.min.js"></script>
    <script type="text/javascript">
    $(function () {
        $("#city_id").find('option:selected').val() != ''?$("[for = 'city_id'] span").text("按城市筛选："+$("#city_id").find('option:selected').text()):$("[for = 'city_id'] span").text('按 城市 筛选');
        $("#hospital_id").find('option:selected').val() != ''?$("[for = 'hospital_id'] span").text("按医院筛选："+$("#hospital_id").find('option:selected').text()):$("[for = 'hospital_id'] span").text('按 医院 筛选');
        $("#instance_id").find('option:selected').val() != ''?$("[for = 'instance_id'] span").text("按疾病筛选："+$("#instance_id").find('option:selected').text()):$("[for = 'instance_id'] span").text('按 疾病 筛选');
        var filter_panel = false, c_id = '', h_id = '', i_id = '';
        function getdoctors(c_id, h_id, i_id) {
            $(".container").hide();
            $("#nodata").hide();
            $("#loading").show();
            $.getJSON("/doctors", { "city_id":c_id, "hospital_id":h_id, "instance_id":i_id })
                    .done(function(data){
                        var alldoctor = '';
                        if (data.data.doctors != undefined) {
                            for (var i = 0; i < data.data.doctors.length; i++) {
                                alldoctor += "<label class='weui-cell weui-check__label my_doctor_cell'><div class='weui-cell__bd'><p>" +
                                        data.data.doctors[i].name
                                        + "</p><span class='my_cell_index'>" +
                                        data.data.doctors[i].hospital_name
                                        + "</span></div><div class='weui-cell__ft'><input type='radio' class='weui-check' name='doctor_id' value='" +
                                        data.data.doctors[i].id
                                        + "'><span class='weui-icon-checked'></span></div></label>"
                            }
                            ;
                            $(".container form").html("<div class='weui-cells weui-cells_radio'>" +
                                    alldoctor
                                    + "<input type='hidden' name='city_id' value='" +
                                    $("#city_id").val()
                                    + "'><input type='hidden' name='hospital_id' value='" +
                                    $("#hospital_id").val()
                                    + "'><input type='hidden' name='instence_id' value='" +
                                    $("#instance_id").val()
                                    + "'></div><div class='fixedbash'><div class='btnPosition'><input type='submit' value='完成' class='btnfixed btnDisable'></div></div>"
                            );
                            $(".weui-check__label").on('click', function () {
                                $("[type = 'submit']").removeClass('btnDisable');
                            });
                            $(".container").show();
                            $(".weui-check__label").on('click',function () {
                                $("[type = 'submit']").removeClass('btnDisable');
                            });
                            $("#loading").hide();
                        } else {
                            $("#loading").hide();
                            $("#nodata").show()
                        }
                    })
        }
//        function gethospital() {
//            $.getJSON('/hospitals',{city_id:c_id})
//                .done(function (data) {
//                    if(data.data.hospitals.length > 0){
//                        var hospitals = '';
//                        for(var i=0 ; i<data.data.hospitals.length ; i++){
//                            hospitals += "<option value='" + data.data.hospitals[i].id + "'>" + data.data.hospitals[i].name + "</option>"
//                        }
//                        if($("#hospital_id").val() == ''){
//                            $("#hospital_id").html("<option value=''>不筛选</option>" + hospitals);
//                        }else{
//                            $("#hospital_id").html("<option value='"+ $("#hospital_id").val() +"' selected disabled> " + $("#hospital_id").find('option:selected').text() + " </option><option value=''>不筛选</option>" + hospitals);
//                        }
//                    }
//                })
//        }
        function gethospital() {
            $.getJSON('/hospitals',{city_id:c_id})
                .done(function (data) {
                    var flag = false;
                    if(data.data.hospitals.length > 0){
                        var hospitals = '';
                        for(var i=0 ; i<data.data.hospitals.length ; i++){
                            if($("#hospital_id").find('option:selected').val() == data.data.hospitals[i].id){
                                hospitals += "<option value='" + data.data.hospitals[i].id + "' selected>" + data.data.hospitals[i].name + "</option>"
                                flag = true;
                            }else{
                                hospitals += "<option value='" + data.data.hospitals[i].id + "'>" + data.data.hospitals[i].name + "</option>"
                            }
                        }
                        if($("#hospital_id").val() == ''){
                            $("#hospital_id").html("<option value=''>不筛选</option>" + hospitals);
                        }else{
                            if(flag){
                                $("#hospital_id").html("<option value=''>不筛选</option>" + hospitals);
                            }else{
                                $("#hospital_id").html(
                                    "<option value='"+
                                    $("#hospital_id").find('option:selected').val() +
                                    "' selected disabled> " +
                                    $("#hospital_id").find('option:selected').text() +
                                    " </option><option value=''>不筛选</option>" +
                                    hospitals);
                            }
                        }
                    }
                })
        }
        $("#filter_btn").on('click',function () {
            filter_panel = !filter_panel;
            if(filter_panel){
                $(".chevron").css({
                    'transform':'rotate(45deg)',
                    'margin-bottom':'0px'
                });//按钮箭头向上
                $(".filter_panel_base").slideDown(240);
                $(".panel_chevron").show(120,function () {
                    $(".panel_chevron_bg").show();
                });//面板箭头显示
                $(".blocking").fadeIn();
                $(".blocking").click(function () {
                    filter_panel = false;
                    $(".chevron").css({
                        'transform':'rotate(225deg)',
                        'margin-bottom':'3px'
                    })//按钮箭头向下
                    $(".filter_panel_base").slideUp(240)
                    $(".panel_chevron_bg").fadeOut(20,function () {
                        $(".panel_chevron").fadeOut(120);
                    });//面板箭头隐藏
                    $(".blocking").fadeOut();
                })
            }else{
                $(".chevron").css({
                    'transform':'rotate(225deg)',
                    'margin-bottom':'3px'
                })//按钮箭头向下
                $(".filter_panel_base").slideUp(240);
                $(".panel_chevron_bg").fadeOut(20,function () {
                    $(".panel_chevron").fadeOut(120);
                });//面板箭头隐藏
                $(".blocking").fadeOut();
            }
        });
        $(".panel_list select").click(function () {
            $(".chevron").css({
                'transform':'rotate(225deg)',
                'margin-bottom':'3px'
            })//按钮箭头向下
            $(".filter_panel_base").css({
                'height':0,
                'paddingTop':0
            });
            $(".blocking").fadeOut();
        }).blur(function () {
            filter_panel = false;
            $(".filter_panel_base").css({
                'display':'none',
                'height':'initial',
                'paddingTop':'9px'
            });
        }).change(function () {
            filter_panel = false;
            var selecttext = $(this).find('option:selected').text();
            $(".filter_panel_base").css({
                'display':'none',
                'height':'initial',
                'paddingTop':'9px'
            });
            if($(this).find('option:selected').val() == ''){
                if($(this).attr('id') == 'city_id'){
                    $(this).parent('label').find('span').text("按 城市 筛选");
                    c_id = $(this).val();
                    gethospital(c_id);
                }else if($(this).attr('id') == 'hospital_id'){
                    $(this).find('option:disabled').remove();
                    $(this).parent('label').find('span').text("按 医院 筛选");
                    h_id = $(this).val();
                }else if($(this).attr('id') == 'instance_id'){
                    $(this).parent('label').find('span').text("按 疾病 筛选");
                    i_id = $(this).val();
                }
            }else{
                if($(this).attr('id') == 'city_id'){
                    $(this).parent('label').find('span').text("按城市筛选："+selecttext);
                    c_id = $(this).val();
                    gethospital(c_id);
                }else if($(this).attr('id') == 'hospital_id'){
                    $(this).find('option:disabled').remove();
                    $(this).parent('label').find('span').text("按医院筛选："+selecttext);
                    h_id = $(this).val();
                }else if($(this).attr('id') == 'instance_id'){
                    $(this).parent('label').find('span').text("按疾病筛选："+selecttext);
                    i_id = $(this).val();
                }
            }
            getdoctors(c_id, h_id, i_id)
        });
        document.addEventListener('touchmove', function (event) {
            if($(".blocking").css('display') == 'block'){
                event.preventDefault();
            }
        });
        document.addEventListener('scroll',function () {
            var offsetH = $("#filter_base").offset().top;
            if($(window).scrollTop() >= offsetH){
                $("#filter").addClass('filter_fixed')
            }else{
                $("#filter").removeClass('filter_fixed')
            };
        })
    })
    </script>
@endsection

@section('script')
    <script type="text/javascript" src="/js/user/my_choicebtn.js"></script>
@endsection
