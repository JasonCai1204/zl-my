@extends('web.layouts.user-basic')

@section('title','找医生 - 肿瘤名医')

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
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
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
                                <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
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
                                        @foreach ($type->instances()->orderBy('sort')->get() as $instance)
                                        <option value="{{ $instance->id }}">{{ $instance->name }}</option>
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

    <div class="container" id="container_doctor">

        @if (count($doctors) > 0)
            <div class="weui-cells" style="margin-top: 30px">
                @foreach ($doctors as $doctor)

                    <a href="doctor/{{ $doctor->id }}" class="weui-cell weui-cell_access my_doctor_cell">
                        <div class="weui-cell__bd">

                            <p>{{ $doctor->name }}</p>
                            <span class="my_cell_index">{{ $doctor->hospital->name }}</span>
                        </div>
                        <div class="weui-cell__ft">
                            {{ $doctor->grading }}
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
    <script src="/js/user/jquery-1.11.3.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var filter_panel = false, c_id = '', h_id = '', i_id = '';
            function getdoctors(c_id, h_id, i_id) {
                $(".container").hide();
                $("#nodata").hide();
                $("#loading").show();
                $.getJSON("doctors", { "city_id":c_id, "hospital_id":h_id, "instance_id":i_id })
                        .done(function (data) {
                            var alldoctor = '';
                            var cityId = $("#city_id").val() == ''?'':'city_id='+$("#city_id").val();
                            var hospitalId = $("#hospital_id").val() == ''?'':'hospital_id='+$("#hospital_id").val();
                            var instanceId = $("#instance_id").val() == ''?'':'instance_id='+$("#instance_id").val();
                            if(cityId != '' && hospitalId != '' && instanceId != ''){
                                hospitalId = '&'+hospitalId;
                                instanceId = '&'+instanceId
                            }else if(cityId != '' && hospitalId != ''){
                                hospitalId = '&'+hospitalId
                            }else if(cityId != '' && instanceId != ''){
                                instanceId = '&'+instanceId
                            }else if(hospitalId != '' && instanceId != ''){
                                instanceId = '&'+instanceId
                            }

                            if(data.data.doctors != undefined){
                                for(var i = 0; i<data.data.doctors.length;i++){
                                    alldoctor += '<a href="doctor/' +
                                            data.data.doctors[i].id + '&'+cityId+hospitalId+instanceId
                                            + '" class="weui-cell weui-cell_access my_doctor_cell"><div class="weui-cell__bd"><p>' +
                                            data.data.doctors[i].name
                                            + '</p><span class="my_cell_index">' +
                                            data.data.doctors[i].hospital_name
                                            + '</span></div><div class="weui-cell__ft">' +
                                            data.data.doctors[i].grading
                                            + '</div></a>'
                                };
                                $(".container .weui-cells").html(
                                        alldoctor
                                        + "<input type='hidden' name='city_id' value='" +
                                        $("#city_id").val()
                                        + "'><input type='hidden' name='hospital_id' value='" +
                                        $("#hospital_id").val()
                                        + "'><input type='hidden' name='instence_id' value='" +
                                        $("#instance_id").val()
                                        + "'>");
                                $(".container").show();
                                $("#loading").hide();
                            }else{
                                $("#loading").hide();
                                $("#nodata").show()
                            }
                        })
            };
            function gethospital(c_id) {
                $.getJSON('hospitals',{city_id:c_id})
                        .done(function (data) {
                            if(data.data.hospitals.length > 0){
                                var hospitals = '';
                                for(var i=0 ; i<data.data.hospitals.length ; i++){
                                    hospitals += "<option value='" + data.data.hospitals[i].id + "'>" + data.data.hospitals[i].name + "</option>"
                                }
                                $("#hospital_id").html("<option value=''>不筛选</option>" + hospitals);
                            }
                        })
            }
            $("#filter_btn").on('click',function () {
                filter_panel = !filter_panel;
                if(filter_panel){
                    $(".filter_panel_base").slideDown(240);
                    $(".blocking").fadeIn();
                    $(".blocking").click(function () {
                        filter_panel = false;
                        $(".filter_panel_base").slideUp(240)
                        $(".blocking").fadeOut();
                    })
                }else{
                    $(".filter_panel_base").slideUp(240);
                    $(".blocking").fadeOut();
                }
            });
            $(".panel_list select").click(function () {
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
            })
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
