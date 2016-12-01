@extends('layouts.user-basic')

@section('title','资讯内容 - 肿瘤名医')

@section('content')

@if($news)
<div class="container" id="news_container" style="background-color: white;">
    <div class="article">
        <div class="bd">
            <div class="weui-article">
                <h1 class="page__tittle">{{$news->title}}</h1>
                <section>
                    <h2 class="title">肿瘤名医 <span class="my_article_date">{{$news->published_at->format('Y-m-d')}}</span></h2>
                    <section>
                        <p class="my_article_text">{!!$news->content!!}</p>
                    </section>
                </section>
            </div>
        </div>
    </div>
</div>
@endif

@endsection