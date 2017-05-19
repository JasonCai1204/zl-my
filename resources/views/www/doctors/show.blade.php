@extends('www.layouts.app')

@section('title', '医生 - ')

@section('content')
    <span id="id" style="display:none">{{ $doctor->id }}</span>
    <main class="container doctor-show">
        <div class="top">
            <figure style="background-image: url('{{ url('storage/' . $doctor->avatar) }}')"></figure>
            <h1>{{ $doctor->name }}<span> {{ $doctor->grading }}</span></h1>
        </div>

        <div class="tab-bar">
            <div class="left active">
                简介
            </div>
            <div class="right">
                评论
            </div>
        </div>

        <div class="left-content">
            {{ $doctor->introduction }}
        </div>

        <div class="right-content" style="display: none">
            <div class="ratings sum-ratings">
                @for ($i = 0; $i < $avg; $i++)
                    <span class="star-light"></span>
                @endfor
                @for ($i = 0; $i < 5-$avg; $i++)
                    <span class="star-outline"></span>
                @endfor
                <span class="desc">{{ $counts }}份评论</span>
            </div>

            <a class="writing-review" href="{{ url('review/'. $doctor->id . '/create') }}">撰写评论</a>

            <div class="reviews">
                @foreach ($reviews as $review)
                    <div class="review">
                        <div class="ratings sum-ratings">
                            @for ($i = 0; $i < $review->ratings; $i++)
                                <span class="star-light"></span>
                            @endfor
                            @for ($i = 1; $i < 5-$review->ratings; $i++)
                                <span class="star-outline"></span>
                            @endfor
                            <span class="desc">评论人：{{ $review->user->name }}</span>
                        </div>
                        <p>{{ $review->reviews }}</p>
                    </div>
                @endforeach

                @if (count($reviews) > 15)
                    <div class="more-reviews">
                        更多评论
                    </div>
                @endif
            </div>
        </div>

        <div class="operating-bar">
            @if ($doctor->is_certified != 0)
                <a href="/orders/create?{{ isset($doctor) ? 'doctor_id=' . $doctor_id . '&' : '' }}{{ isset($hospital) ? 'hospital_id=' . $hospital_id . '&' : ''}}{{ isset($instance) ? 'instance_id=' . $instance_id : '' }}{{isset($city) ? 'city_id=' . $city_id : '' }}"
                   class="weui-btn weui-btn_primary">预约</a>
            @else
                <a href="javascript:;" class="weui-btn weui-btn_primary" id="showIOSDialog1">预约</a>
            @endif
        </div>
    </div>
    </main>

    <div id="dialogs">
        <div class="js_dialog" id="iosDialog1" style="display: none;">
            <div class="weui-mask"></div>
            <div class="weui-dialog">
                <div class="weui-dialog__bd">此医生未签约，预约时间可能稍长。</div>
                <div class="weui-dialog__ft">
                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_default">取消</a>
                    <a href="/orders/create?{{ isset($doctor) ? 'doctor_id=' . $doctor_id . '&' : '' }}{{ isset($hospital) ? 'hospital_id=' . $hospital_id . '&' : ''}}{{ isset($instance) ? 'instance_id=' . $instance_id : '' }}{{isset($city) ? 'city_id=' . $city_id : '' }}" class="weui-dialog__btn weui-dialog__btn_primary">预约</a>
                </div>
            </div>
        </div>
    </div>
@endsection
