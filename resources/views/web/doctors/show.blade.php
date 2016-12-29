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

        <div class="fixedbash">
            <div class="btnPosition">

                <a href="/orders/create?{{ isset($doctor) ? 'doctor_id=' . $doctor_id . '&' : '' }}{{ isset($hospital) ? 'hospital_id=' . $hospital_id . '&' : ''}}{{ isset($instance) ? 'instance_id=' . $instance_id : '' }}{{isset($city) ? 'city_id=' . $city_id : '' }}"
                   class="btnfixed">预约医生</a>

                @if ($doctor->is_certified == 0)
                    <span class="unsignedtips">此医生未签约，预约时间可能稍长。</span>
                @endif
            </div>
        </div>
    </div>
@endsection
