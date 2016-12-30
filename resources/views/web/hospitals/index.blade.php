@extends('web.layouts.user-basic')

@section('title','找医院 - 肿瘤名医')

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
                        <option value="" selected>不筛选</option>
                        @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </label>
                <div class="chevron"></div>
            </div>
        </div>
    </div>

<div class="container">
    @if (count($hospitals) > 0)
        <div class="weui-cells" style="margin-top: 30px">
            @foreach ($hospitals as $hospital)

                <a href="hospital/{{ $hospital->id }}" class="weui-cell weui-cell_access">
                    <div class="weui-cell__bd">
                        <p>{{ $hospital->name }}</p>
                    </div>
                    <div class="weui-cell__ft">
                        {{ $hospital->grading }}
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>

<div class="my_app_coming" id="loading" style="display: none;">
    <div class="weui-loadmore">
        <i class="weui-loading"></i>
    </div>
</div>

<div class="my_app_coming" id="nodata" style="display: none;">
    <span>暂无满足条件的医院。</span>
</div>

<script src="/js/user/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#city_id").on('change',function () {
            if($(this).find('option:selected').val() != ''){
                $("[for = 'city_id'] span").text($(this).find('option:selected').text());
            }else{
                $("[for = 'city_id'] span").text("筛选");
            }
            var c_id = $(this).val();
            $("#nodata").hide();
            $(".container").hide();
            $("#loading").show();
            $.getJSON('hospitals',{city_id:c_id})
                    .done(function (data) {
                        var hospitals = '';
                        var cityId = $("#city_id").val() == "" ? '' : '?city_id='+$("#city_id").val();
                        if(data.data.hospitals != undefined){
                            for(var i=0 ; i<data.data.hospitals.length ; i++){
                                hospitals += '<a href="hospital/' +
                                        data.data.hospitals[i].id + cityId
                                        + '" class="weui-cell weui-cell_access"><div class="weui-cell__bd"><p>' +
                                        data.data.hospitals[i].name
                                        + '</p></div><div class="weui-cell__ft">' +
                                        data.data.hospitals[i].grading
                                        + '</div></a>'
                            }
                            $(".container .weui-cells").html(hospitals);
                            $("#loading").hide();
                            $(".container").show();
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
