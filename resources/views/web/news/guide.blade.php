@extends('web.layouts.user')

@section('title','文章 - 肿瘤名医')

@section('backgroundColor','white')

@section('content')

        <!--轮播图-->
        @if(count($is_recommended)>0)
        <div class="my_swiper my_has_after">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @if(isset($is_recommended))
                        @foreach($is_recommended as $item)
                            <div class="swiper-slide">
                                <a href="news/{{ $item->id }}"
                                   style="background-image:url('/storage/{{$item->banner_image}}')"></a>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        @endif


        <input type="hidden" name = 'news_class_id' value = {{ isset($count[0]) && count($count[0]) > 10 ? $count[0][0]->news_class->id : 'false' }}>

        <input type="hidden" name = 'news_class_id' value = {{ isset($count[1]) && count($count[1]) > 10 ? $count[1][0]->news_class->id : 'false' }}>

        <input type="hidden" name = 'news_class_id' value = {{ isset($count[2]) && count($count[2]) > 10 ? $count[2][0]->news_class->id : 'false' }}>


    <div class="classifyInformation my_has_after">

        @if(isset($news[0][0]) && count($news[0][0]) > 0)
        <a name="news_class_id" href="javascript:;" class="classifyItem itemclick">{{ isset($news[0][0]) ? $news[0][0]->News_class->name : '' }}</a>
        @endif

        @if(isset($news[1][0]) && count($news[1][0]) >0)
        <a name="news_class_id" href="javascript:;" class="classifyItem">{{ isset($news[1][0]) ? $news[1][0]->News_class->name : '' }}</a>
        @endif

        @if(isset($news[2][0]) && count($news[2][0])>0)
        <a name="news_class_id" href="javascript:;" class="classifyItem">{{ isset($news[2][0]) ? $news[2][0]->News_class->name : '' }}</a>
        @endif

    </div>

    <div id="container_guide" class="container my_has_before my_has_after">

        @if(isset($news[0]))
            <div class="infomation-cells">

                @foreach($news[0] as $item)
                <a href="/news/{{ $item->id }}" class="information-cell">
                    <img src="{{Storage::url($item->cover_image)}}" alt="" class="information-cell__hd">
                    <div class="information-cell__bd">
                        <p>{{ $item->title }}</p>
                    </div>
                </a>
                @endforeach

            </div>
        @endif

        @if(isset($news[1]))
            <div class="infomation-cells" style="display: none;">


                @foreach($news[1] as $item)
                <a href="/news/{{ $item->id }}" class="information-cell">
                    <img src="{{Storage::url($item->cover_image)}}" alt="" class="information-cell__hd">
                    <div class="information-cell__bd">
                        <p>{{ $item->title }}</p>
                    </div>
                </a>
                @endforeach

            </div>
        @endif

        @if(isset($news[2]))
            <div class="infomation-cells" style="display: none;">

                @foreach($news[2] as $item)
                <a href="/news/{{ $item->id }}" class="information-cell">
                    <img src="{{Storage::url($item->cover_image)}}" alt="" class="information-cell__hd">
                    <div class="information-cell__bd">
                        <p>{{ $item->title }}</p>
                    </div>
                </a>
                @endforeach

            </div>
        @endif

    </div>
    <p class="loadBtnOuter">
        <a href="javascript:;" id="loadInformation">查看更多</a>
    </p>

@endsection

@section('scripts')
    <script>
        showDate = false;
    </script>
    <script src="/js/user/loadInformation.js"></script>
    <script>
        $(function(){
            var mySwiper = new Swiper('.swiper-container', {
                    direction: 'horizontal',
                    autoplay: 3000,
                    pagination: '.swiper-pagination',
                    paginationClickable: true,
                    speed: 500
                });
        })
    </script>
@endsection
