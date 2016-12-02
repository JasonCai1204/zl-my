@extends('web.layouts.user-basic')

@section('title','选择所患疾病 - 肿瘤名医')

@section('content')

<!--主体部分-->
@if(isset($instances))
<div class="container" id="order_choice_cancer">
    <form action="/orders/create" method="get">
        <div class="weui-cells__title">所有肿瘤</div>
        <div class="weui-cells weui-cells_radio">
            @foreach($instances as $instance)
            <label class="weui-cell weui-check__label">
                <div class="weui-cell__bd">
                    <p>{{$instance->name}}</p>
                </div>
                <div class="weui-cell__ft">
                    <input type="radio" class="weui-check" name="instance_id" value="{{$instance->id}}">
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
    </form>
</div>
@endif

{{--Select instance from doctor--}}
@if(isset($doctorInstances))
    <div class="container" id="order_choice_cancer">
        @if(isset($doctorInstances) && isset($doctor_id))
            <form action="/orders/create" method="get">
                <input type="hidden" name="hospital_id" value="{{$hospital_id}}">
                <input type="hidden" name="doctor_id" value="{{$doctor_id}}">
                {{--<div class="weui-cells__title">所有肿瘤</div>--}}
                <div class="weui-cells weui-cells_radio">
                    @foreach($doctorInstances as $doctorInstance)
                        <label class="weui-cell weui-check__label">
                            <div class="weui-cell__bd">
                                <p>{{$doctorInstance->name}}</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input type="radio" class="weui-check" name="instance_id" value="{{$doctorInstance->id}}">
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
            </form>
        @endif
    </div>
@endif

@endsection

@section('script')

<script type="text/javascript" src="/js/user/my_choicebtn.js"></script>

@endsection
