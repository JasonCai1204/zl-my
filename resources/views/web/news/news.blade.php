@extends('web.layouts.user')

@section('title','资讯 - 肿瘤名医')

@section('content')

    <div class="container" id="container_news">
        <div class="lists">
            @if (count('news') > 0)
                @foreach ($news as $item)
                    <a href="/news/{{ $item->id }}" class="my_advice_list">
                        <img src="/storage/{{ $item->cover_image }}">
                    </a>
                @endforeach
            @endif
        </div>
    </div>

@endsection

@section('script')
    <script src="../js/user/dropload.min.js"></script>
@endsection
