@extends('layouts.user-basic')

@section('title','医生介绍--肿瘤名医')

@section('content')
<!--主体部分-->
<div class="container">
    <div class="my_doctor_hd">
        <!--医生头像-->
        <img src="{{$doctor->avatar}}" alt="" class="my_doctor_pt">
        <p class="my_doctor_name">
            <!--医生姓名-->
            {{$doctor->name}}<span>{{$doctor->grading}}</span>

            @if($doctor->is_recommended == 1)
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
            <a href="" class="btnfixed">预约医生</a>
        </div>
    </div>
</div>
@endsection