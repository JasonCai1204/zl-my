<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <title>资讯内容 - 肿瘤名医</title>
    <!--XX 为用户输入的搜索关键词 未输入关键词时未空-->

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="/css/user/weui.min.css">
    <link rel="stylesheet" href="/css/user/home.css">
</head>
<body>
@if($news)
<div class="container" id="news_container" style="background-color: white;">
    <div class="article">
        <div class="bd">
            <div class="weui-article">
                <h1 class="page__tittle">{{$news->title}}</h1>
                <section>
                    <h2 class="title">肿瘤名医 <span class="my_article_date">{{$news->published_at->format('Y-m-d')}}</span></h2>
                    <section>
                        <p class="my_article_text">{{$news->content}}  </p>
                    </section>
                </section>
            </div>
        </div>
    </div>
</div>
@endif

</body>
</html>