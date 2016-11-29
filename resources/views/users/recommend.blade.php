@extends('layouts.user')

@section('title','推荐 - 肿瘤名医')

@section('content')
<!--推荐部分-->

@if($hospitals || $doctors)

    <div class="container" id="container_recommend">
        <div class="my_recommend_list">
            @if(count($hospitals) >0 )
            <div class="weui-cells__title">推荐医院</div>
            <div class="weui-cells">
                @foreach($hospitals as $hospital)
                <a href="/hospital/{{$hospital->id}}" class="weui-cell weui-cell_access">
                    <div class="weui-cell__bd">
                        <p>{{$hospital->name}}</p>
                    </div>
                    <div class="weui-cell__ft">
                        {{$hospital->grading}}
                    </div>
                </a>
                @endforeach
            @endif
            </div>

             @if(count($doctors) >0 )
                <div class="weui-cells__title">推荐医生</div>
                <div class="weui-cells">
                    @foreach($doctors as $doctor)
                    <a href="/doctor/{{$doctor->id}}" class="weui-cell weui-cell_access my_doctor_cell">
                        <div class="weui-cell__bd">
                            <p>{{$doctor->name}}</p>
                            <span class="my_cell_index">{{$doctor->hospital->name}}</span>
                        </div>
                        <div class="weui-cell__ft">
                            {{$doctor->grading}}
                        </div>
                    </a>
                    @endforeach
            @endif
            </div>
        </div>
    </div>

@endif

@endsection