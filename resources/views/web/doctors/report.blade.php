@extends('web.layouts.doctor')

@section('title','患者报告详情-肿瘤名医')

@section('content')


<!--主体部分-->
<div class="container" id="news_container" style="background-color: white;">
    <div class="article">
        <div class="bd">
            @if(isset($order))
            <div class="weui-article">
                <h1 class="page__tittle">{{$order->patient_name}}<span class="my_article_date">病情报告</span></h1>
                <section>
                    <h2 class="title">肿瘤名医<span class="my_article_date">{{$order->send_to_the_doctor_at->format('Y-m-d')}}</span></h2>
                    <section>
                        <p>
                            <img src="/storage/images/doctor/my_article_mask.png" alt="">
                        </p>
                        <p class="my_article_text">
                            {!! $order->condition_report !!}
                        </p>
                    </section>
                </section>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection