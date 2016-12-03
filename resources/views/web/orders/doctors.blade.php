@extends('web.layouts.doctor')

@section('title','我的预约单 - 肿瘤名医')

@section('content')

<!--主体部分-->
<div class="container" style="margin-top: 30px;">
    <div class="weui-panel">
        <div class="weui-panel__hd">
            预约单
        </div>
        @if($orders)
            @if(count($orders)>0)
        <div class="weui-panel__bd">
            <div class="weui-media-box weui-media-box_small-appmsg">
                <div class="weui-cells">
                    @foreach($orders as $order)
                    <a href="orders/condition_report/?id={{$order->id}}" class="weui-cell weui-cell_access">
                        <div class="weui-cell__bd weui-cell_primary">
                            <p>{{$order->patient_name}}</p>
                            <span class="my_mine_desc">
                                {{$order->instance->name}}
                            </span>
                        </div>
                        <span class="weui-cell__ft">
                            <span class="doctor_order_date">{{ $order->send_to_the_doctor_at->format('Y-m-d')? : ''}}</span>
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
            @endif
        @endif
    </div>
</div>

@endsection
