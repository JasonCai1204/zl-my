@extends('web.layouts.user-basic')

@section('title','医生介绍 - 肿瘤名医')

@section('content')

    <div class="container">
        <div class="my_doctor_hd">
            <div class="my_doctor_pt"
                 style="background-image: url('{{ Storage::url($doctor->avatar ?: 'images/doctor/avatar/default.png') }}');"></div>

            <p class="my_doctor_name">
                {{ $doctor->name }}<span>{{ $doctor->grading }}</span>
            </p>
        </div>
        <div class="my_doctor_bd">
            <p class="my_doctor_explain">{{ $doctor->introduction }}</p>
        </div>

        <div class="fixedbash" style="{{ $doctor->is_certified == 0 ? 'height: 123px' : '' }}">
            <div class="btnPosition">
                @if ($doctor->is_certified != 0)
                    <a href="/orders/create?{{ isset($doctor) ? 'doctor_id=' . $doctor_id . '&' : '' }}{{ isset($hospital) ? 'hospital_id=' . $hospital_id . '&' : ''}}{{ isset($instance) ? 'instance_id=' . $instance_id : '' }}{{isset($city) ? 'city_id=' . $city_id : '' }}"
                       class="btnfixed">预约医生</a>
                @else
                    <a href="javascript:;" class="btnfixed" id="showIOSDialog1">预约医生</a>
                @endif
            </div>
        </div>
    </div>

    <div id="dialogs">
        <div class="js_dialog" id="iosDialog1" style="display: none;">
            <div class="weui-mask"></div>
            <div class="weui-dialog">
                <div class="weui-dialog__bd">此医生未签约，预约时间可能稍长。</div>
                <div class="weui-dialog__ft">
                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_default">取消</a>
                    <a href="/orders/create?{{ isset($doctor) ? 'doctor_id=' . $doctor_id . '&' : '' }}{{ isset($hospital) ? 'hospital_id=' . $hospital_id . '&' : ''}}{{ isset($instance) ? 'instance_id=' . $instance_id : '' }}{{isset($city) ? 'city_id=' . $city_id : '' }}" class="weui-dialog__btn weui-dialog__btn_primary">预约</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
$(function(){
    var $iosDialog1 = $('#iosDialog1');

    $('#dialogs').on('click', '.weui-dialog__btn', function(){
        $(this).parents('.js_dialog').fadeOut(200);
    });

    $('#showIOSDialog1').on('click', function(){
        $iosDialog1.fadeIn(200);
    });
});
</script>
@endsection
