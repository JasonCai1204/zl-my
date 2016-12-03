@extends('web.layouts.user')

@section('title','资讯 - 肿瘤名医')

@section('content')

<div class="container" id="container_news">
    <div class="lists">
        @if(count('news') > 0)
            @foreach( $news as $new )
                <a href="/news/{{$new->id}}" class="my_advice_list">
                    <img src="/storage/{{$new->cover_image}}" alt="">
                    <span>{{$new->title}}</span>
                </a>
            @endforeach
        @endif
    </div>
</div>

@endsection

@section('script')
    <script src="../js/user/dropload.min.js"></script>

@endsection

