@extends('www.layouts.app')

@section('title', '撰写评论 - ')

@section('content')
    <main>
        <div class="make-rating">
            <div class="ratings">
                <span class="star-light" data-ratings="1"></span>
                <span class="star-light" data-ratings="2"></span>
                <span class="star-light" data-ratings="3"></span>
                <span class="star-outline" data-ratings="4"></span>
                <span class="star-outline" data-ratings="5"></span>
            </div>
            <div class="tips">轻点星形来评分</div>
        </div>

        <div class="writing-review-content">
            <form action="/review" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="ratings" value="3">
                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                <textarea id="review-input" name="reviews" rows="7" placeholder="撰写评论" required></textarea>

                <button type="submit" class="weui-btn weui-btn_primary">发送</button>
            </form>
        </div>
    </main>
@endsection
