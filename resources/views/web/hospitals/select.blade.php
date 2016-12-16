@extends('web.layouts.user-basic')

@section('title','选择医院 - 肿瘤名医')

@section('content')

    <div class="container" id="order_choice_hospital">

        <form action="/orders/create" method="GET">
            @if(isset($city_id))
                <input type="hidden" name="city_id" value="{{ $city_id }}"/>
            @endif
            @if (isset($doctor_id))
                <input type="hidden" name="doctor_id" value="{{ $doctor_id }}"/>
            @endif
            @if (isset($instance_id))
                <input type="hidden" name="instance_id" value="{{ $instance_id }}"/>
            @endif

            @if (count($hospitals) > 0 )

                <div class="weui-cells weui-cells_radio">
                    @foreach ( $hospitals as $hospital )
                        <label class="weui-cell weui-check__label">
                            <div class="weui-cell__bd">
                                <p>{{ $hospital->name }}</p>
                            </div>

                            <div class="weui-cell__ft">
                                <input type="radio" class="weui-check" name="hospital_id"
                                       value="{{ $hospital->id }}" {{ isset($hospital_id) && $hospital->is_recommended != 1 && $hospital->id == $hospital_id ? 'checked' : ''  }} />

                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                    @endforeach
                </div>
            @endif
            <div class="fixedbash">
                <div class="btnPosition">
                    <input type="submit" value="完成" class="btnfixed">
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="/js/user/my_choicebtn.js"></script>
@endsection
