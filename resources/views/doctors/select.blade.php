@extends('layouts.user-basic')

@section('title','选择医生 - 肿瘤名医')

@section('content')

<!--主体部分-->
@if($recommendDoctors || $doctors)
<div class="container" id="container_doctor">
    <form action="/doctor/select" method="post">
        {{ csrf_field() }}
        @if(count($recommendDoctors) > 0 )
        <div class="weui-cells__title">推荐医生</div>
        <div class="weui-cells weui-cells_radio">
            @foreach( $recommendDoctors as $recommendDoctor)
            <label class="weui-cell weui-check__label my_doctor_cell">
                <div class="weui-cell__bd">
                    <p>{{$recommendDoctor->name}}</p>
                    <span class="my_cell_index">{{$recommendDoctor->hospital->name}}</span>
                </div>
                <div class="weui-cell__ft">
                    <input type="radio" class="weui-check" name="id" value="{{$recommendDoctor->id}}">
                    <span class="weui-icon-checked"></span>
                </div>
            </label>
            @endforeach
        </div>
        @endif

        @if( count($doctors) > 0 )
        <div class="weui-cells__title">所有医生</div>
        <div class="weui-cells weui-cells_radio">
            @foreach( $doctors as $doctor )
            <label class="weui-cell weui-check__label my_doctor_cell">
                <div class="weui-cell__bd">
                    <p>{{$doctor->name}}</p>
                    <span class="my_cell_index">{{$doctor->hospital->name}}</span>
                </div>
                <div class="weui-cell__ft">
                    <input type="radio" class="weui-check" name="id" value="{{$doctor->id}}>
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

@else($hospitalDoctors)
        @if( count($hospitalDoctors) > 0 )
         <form action="/doctor/hospital/select" method="post">
             {{ csrf_field() }}
            <div class="weui-cells weui-cells_radio">
                @foreach( $hospitalDoctors as $hospitalDoctor )
                    <label class="weui-cell weui-check__label my_doctor_cell">
                        <div class="weui-cell__bd">
                            <p>{{$hospitalDoctor->name}}</p>
                            {{--<span class="my_cell_index">{{$hospitalDoctor->hospital->name}}</span>--}}
                        </div>
                        <div class="weui-cell__ft">
                            <input type="radio" class="weui-check" name="id" value="{{$hospitalDoctor->id}}">
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

@endsection