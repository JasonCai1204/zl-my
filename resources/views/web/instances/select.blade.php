@extends('web.layouts.user-basic')

@section('title','选择所患疾病 - 肿瘤名医')

@section('content')
    <div class="container" id="order_choice_hospital">

        <form action="/orders/create" method="GET">
            @if (isset($hospital_id))
                <input type="hidden" name="hospital_id" value="{{ $hospital_id }}" />
            @endif
            @if (isset($doctor_id))
                <input type="hidden" name="doctor_id" value="{{ $doctor_id }}" />
            @endif

            @if (count($all) > 0 )
                <div class="weui-cells__title">选择所患疾病</div>

                <div class="weui-cells weui-cells_radio">
                    @foreach ( $all as $item )
                        <label class="weui-cell weui-check__label">
                            <div class="weui-cell__bd">
                                <p>{{ $item->name }}</p>
                            </div>

                            <div class="weui-cell__ft">
                                <input type="radio" class="weui-check" name="instance_id" value="{{ $item->id }}" {{ isset($instance_id) && $item->id == $instance_id ? 'checked' : ''  }} />

                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                    @endforeach
                </div>

                <div class="fixedbash">
                    <div class="btnPosition">
                        <input type="submit" value="完成" class="btnfixed">
                    </div>
                </div>
            @endif
        </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="/js/user/my_choicebtn.js"></script>
@endsection
