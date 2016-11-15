@extends('layouts.user')

@section('title','咨讯-肿瘤名医')

@section('content')

<!--主体部分-->
<div class="content" id="container_advice">
    <div class="lists">
        @if(count('news') > 0)
            @foreach( $news as $new )
                <a href="/news/{{$new->id}}" class="my_advice_list">
                    <img src="{{$new->cover_image}}" alt="">
                    <span>{{$new->title}}</span>
                </a>
            @endforeach
        @endif
    </div>
</div>

@endsection
