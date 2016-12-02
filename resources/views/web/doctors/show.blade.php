@extends('web.layouts.user-basic')

@section('title','医生介绍 - 肿瘤名医')

@section('content')
<!--主体部分-->
<div class="container">
    <div class="my_doctor_hd">
        <!--医生头像-->
        <div class="my_doctor_pt" style="background-image: url('{{ Storage::url($doctor->avatar ?: '/images/app/web/www/user-mobile-doctor-default-avatar.png') }}');"></div>
        <p class="my_doctor_name">
            <!--医生姓名-->
            {{$doctor->name}}<span>{{$doctor->grading}}</span>

            @if($doctor->is_certified == 1)
            <!--签约医生  当没有签约时不加入-->
            <span class="my_doctor_sign">签约医生</span>
            @endif
        </p>
    </div>
    <div class="my_doctor_bd">
        <!--医生介绍-->
        <p class="my_doctor_explain">{{$doctor->introduction}}</p>
    </div>

    <div class="fixedbash">
        <div class="btnPosition">
            <a href="/orders/create?hospital_id={{$hospital_id or ''}}&doctor_id={{$doctor_id or ''}}" class="btnfixed">预约医生</a>
            <!--未签约时显示以下文字-->
            @if($doctor->is_certified == 0)
            <span class="unsignedtips">此医生未签约，预约时间可能稍长。</span>
            @endif
        </div>
    </div>
</div>
@endsection