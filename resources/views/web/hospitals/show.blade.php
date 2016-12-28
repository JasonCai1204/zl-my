@extends('web.layouts.user-basic')

@section('title','医院介绍 - 肿瘤名医')

@section('content')

    <div class="container">
        <div class="my_hospital_hd">

            <p class="my_hospital_name">
                {{ $hospital->name }}
            </p>
            <p class="my_hospital_explain">
                <span>{{ $hospital->city }}</span>&nbsp;|&nbsp;<span>{{ $hospital->grading }}</span>
            </p>
        </div>
        <div class="my_hospital_bd">

            <p>
                {{ $hospital->introduction }}
            </p>
        </div>
        <div class="fixedbash">
            <div class="btnPosition">

                <a href="/orders/create{{ isset($hospital_id) ? '?hospital_id='.$hospital_id :'' }}{{ isset($city_id) ? '&city_id='.$city_id :'' }}" class="btnfixed">预约医院</a>
            </div>
        </div>
    </div>

@endsection