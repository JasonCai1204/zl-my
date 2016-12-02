@extends('web.layouts.user-basic')

@section('title','预约单 - 肿瘤名医')

@section('content')

<!--主体部分-->
<div class="container" style="margin-top: 30px;">
    <div class="weui-panel weui-panel_access">
        <div class="weui-panel__hd">
            预约单
        </div>
        <div class="weui-panel__bd">
            @if(isset($orders))
                @foreach($orders as $order)
            <div class="weui-media-box weui-media-box_text">
                <span class="my_mine_date">{{$order->created_at->format('Y-m-d')}}</span>
                <h4 class="weui-media-box__title">
                    {{$order->patient_name or ''}}
                </h4>
                <p class="weui-media-box__desc">
                    预约医院:{{$order->hospital->name or ''}}
                </p>
                <p class="weui-media-box__desc">
                    预约医生:{{$order->doctor->name or ''}}
                </p>
                <p class="my_mine_desc">
                    {{$order->instance->name or ''}}
                </p>
            </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection