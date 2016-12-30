@extends('web.layouts.user-basic')

@section('title','医院介绍 - 肿瘤名医')

@section('content')

    <div class="container">
        <div class="my_hospital_hd">

            <p class="my_hospital_name">
                {{ $hospital->name }}
            </p>
            <p class="my_hospital_explain">
                <span>{{ $hospital->city->name }}</span>&nbsp;|&nbsp;<span>{{ $hospital->grading }}</span>
            </p>
        </div>
        <div class="my_hospital_bd">

            <p>
                {{ $hospital->introduction }}
            </p>
        </div>
        <div class="fixedbash">
            <div class="btnPosition">

                <a href="/orders/create{{ isset($hospital) ? '?hospital_id='.$hospital->id :'' }}{{ isset($hospital) ? '&city_id='.$hospital->city->id :'' }}" class="btnfixed">预约医院</a>
            </div>
        </div>
    </div>

@endsection