@extends('web.layouts.user-basic')

@section('title','选择医院 - 肿瘤名医')
        <!--固定在屏幕上部的logo-->

@section('content')

@if ( count($recommendHospitals) > 0 || count($hospitals) > 0 )
        <!--主体部分-->
<div class="container" id="order_choice_hospital">
    <form action="/orders/create" method="get">

        @if( isset($check_hospital_id) || isset($doctor_id) || isset($instance_id) )
            <input type="hidden" name="check_hospital_id" value="{{ $check_hospital_id ? : '' }}"  />
            <input type="hidden" name="doctor_id" value="{{ $doctor_id ? : '' }}"  />
            <input type="hidden" name="instance_id" value="{{ $instance_id ? : '' }}"  />

        @endif

        @if ( count($recommendHospitals) > 0 )
            <div class="weui-cells__title">推荐医院</div>
            <div class="weui-cells weui-cells_radio">
                @foreach ( $recommendHospitals as $recommendHospital )
                    <label class="weui-cell weui-check__label">
                        <div class="weui-cell__bd">
                            <p>{{ $recommendHospital->name }}</p>
                        </div>
                        <div class="weui-cell__ft">
                            <input type="radio" class="weui-check" name="hospital_id"
                                   value="{{ $recommendHospital->id }}" {{ $check_hospital_id == $recommendHospital->id ? 'checked' : ''  }} />
                            <span class="weui-icon-checked"></span>
                        </div>
                    </label>
                @endforeach
            </div>
        @endif

        @if (count( $hospitals) > 0 )
            <div class="weui-cells__title">所有医院</div>
            <div class="weui-cells weui-cells_radio">
                @foreach ( $hospitals as $hospital )
                    <label class="weui-cell weui-check__label">
                        <div class="weui-cell__bd">
                            <p>{{ $hospital->name }}</p>
                        </div>
                        <div class="weui-cell__ft">
                            <input type="radio" class="weui-check" name="hospital_id"
                                   value="{{ $hospital->id }}" {{ $check_hospital_id == $hospital->id && $hospital->is_recommended != 1 ? 'checked' : ''  }} />
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
@endif
@endsection

@section('script')
    <script type="text/javascript" src="/js/user/my_choicebtn.js"></script>
    <script type="text/javascript">
        $(function () {
            if($('[checked]').length > 0){
                console.log($('[checked]'));
            }

        })
    </script>
@endsection