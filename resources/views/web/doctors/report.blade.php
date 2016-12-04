<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <title>患者报告详情 - 肿瘤名医</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="/css/doctor/weui.min.css">
    <link rel="stylesheet" href="/css/doctor/home.css">
</head>
<body style="background: white;">

<div class="logo_part">
    <div class="logo">
        <a href="/" style="background-image: url('/storage/images/app/M_32w.png');"></a>
        <a href="/account/profile" class="doctor_logo" style="background-image: url('/storage/images/app/silhouette_of_person.png')"></a>
    </div>
</div>

<!--主体部分-->
<div class="container" id="news_container" style="background-color: white;">
    <div class="article">
        <div class="bd">

            @if ( isset($order) )
            <div class="weui-article">
                <h1 class="page__tittle">{{ $order->patient_name }}<span class="my_article_date">病情报告</span></h1>
                <section>
                    <h2 class="title">肿瘤名医<span class="my_article_date">{{ isset($order->send_to_the_doctor_at) ? $order->send_to_the_doctor_at->format('Y-m-d') : '' }}</span></h2>
                    <section>

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

</body>
</html>