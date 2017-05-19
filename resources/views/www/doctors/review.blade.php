@extends('www.layouts.app')

@section('title', '撰写评论 - ')

@section('content')
    <main>
        <div class="make-rating">
            <div class="ratings">
                <span class="star-light" data-rating="1"></span>
                <span class="star-light"data-rating="2"></span>
                <span class="star-light"data-rating="3"></span>
                <span class="star-outline"data-rating="4"></span>
                <span class="star-outline"data-rating="5"></span>
            </div>
            <div class="tips">轻点星形来评分</div>
        </div>

        <div class="writing-review-content">
            <form class="" action="#" method="post">
                <input type="hidden" name="ratings" value="3">
                <textarea id="review-input" name="content" rows="7" placeholder="撰写评论"></textarea>

                <button type="submit" class="weui-btn weui-btn_primary">发送</button>
            </form>
        </div>
    </main>
@endsection
