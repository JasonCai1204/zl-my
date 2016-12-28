@extends('web.layouts.user-basic')

@section('title','选择医院 - 肿瘤名医')

@section('content')

    <div id="filter_base">
        <div id="filter">
            <span>找医院</span>
            <div id="filter_btn">
                <label for="city_id">
                    <span>筛选</span>
                    <select id="city_id">
                        <!--前两个option保留，以下循环插入城市数据（ city_id & city_name ）-->
                        <option value="" disabled>按城市筛选：</option>
                        <option value="" >不筛选</option>
                        @if (isset($cities))
                            @foreach ($cities as $city)
                            <option value="{{ $city->id }}"{{isset( $city_id ) && $city->id == $city_id ?'selected' : ''}}>{{ $city->name }}</option>
                            @endforeach`
                        @endif
                    </select>
                </label>
                <div class="chevron"></div>
            </div>
        </div>
    </div>
    <div class="container" id="order_choice_hospital">

        <form action="/orders/create" method="GET" style="margin-top: 30px">
            <input type="hidden" name="city_id" value="{{ $city_id or '' }}"/>

            <input type="hidden" name="doctor_id" value="{{ $doctor_id or '' }}"/>

            <input type="hidden" name="instance_id" value="{{ $instance_id or '' }}"/>

            @if (count($hospitals) > 0 )

                <div class="weui-cells weui-cells_radio">
                    @foreach ( $hospitals as $hospital )
                        <label class="weui-cell weui-check__label">
                            <div class="weui-cell__bd">
                                <p>{{ $hospital->name }}</p>
                            </div>

                            <div class="weui-cell__ft">
                                <input type="radio" class="weui-check" name="hospital_id"
                                       value="{{ $hospital->id }}" {{ isset($hospital_id) && $hospital->is_recommended != 1 && $hospital->id == $hospital_id ? 'checked' : ''  }} />

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
            $("#city_id").find('option:selected').val() != ''?$("[for = 'city_id'] span").text($("#city_id").find('option:selected').text()):$("[for = 'city_id'] span").text('筛选');
            var doctorId = $("input [name = 'doctor_id']").val() != undefined? '<input type="hidden" name="doctor_id" value="'+$("input [name = 'doctor_id']").val()+'">':'';
            var instanceId = $("input [name = 'instance_id']").val() != undefined? '<input type="hidden" name="instance_id" value="'+$("input [name = 'instance_id']").val()+'">':'';
            $("#city_id").on('change',function () {
                $(this).find('option:selected').val() != ''?$("[for = 'city_id'] span").text($("#city_id").find('option:selected').text()):$("[for = 'city_id'] span").text('筛选');
                var c_id = $(this).val();
                $(".container").hide();
                $("#loading").show();
                $.getJSON('/hospitals',{city_id:c_id})
                        .done(function (data) {
                            if(data.data.hospitals.length > 0){
                                var hospitals = '';
                                for(var i=0 ; i<data.data.hospitals.length ; i++){
                                    hospitals += '<label class="weui-cell weui-check__label"><div class="weui-cell__bd"><p>'+
                                            data.data.hospitals[i].name +
                                            '</p></div><div class="weui-cell__ft"><input type="radio" class="weui-check" name="hospital_id" value="' +
                                            data.data.hospitals[i].id +
                                            '" ><span class="weui-icon-checked"></span></div></label>'
                                }
                                $(".container form").html("<div class='weui-cells weui-cells_radio'>"+
                                        hospitals
                                        + "<input type='hidden' name='city_id' value='"+
                                        $("#city_id").val()
                                        +"'>" + doctorId
                                        + instanceId
                                        +"</div>" +
                                        "<div class='fixedbash'><div class='btnPosition'><input type='submit' value='完成' class='btnfixed btnDisable'></div></div>"

                                );
                                $(".container").show();
                                $(".weui-check__label").on('click',function () {
                                    $("[type = 'submit']").removeClass('btnDisable');
                                });
                                $("#loading").hide();
                            }else{
                                $("#loading").hide();
                                $("#nodata").show();
                            }
                        })
            })
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
            });
        })
    </script>
@endsection

@section('script')
    <script type="text/javascript" src="/js/user/my_choicebtn.js"></script>
@endsection
