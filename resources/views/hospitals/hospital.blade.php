@extends('layouts.user-basic')

@section('title','找医院')

@section('content')

<!--主体部分-->
    @if(count($recommendHospitals) > 0 || count($hospitals) > 0 )
<div class="container">
    @if(count($recommendHospitals) > 0 )
    <div class="weui-cells__title">推荐医院</div>
    <div class="weui-cells">
        @foreach($recommendHospitals as $recommendHospital)
        <a href="hospital/{{$recommendHospital->id}}" class="weui-cell weui-cell_access">
            <div class="weui-cell__bd">
                <p>{{$recommendHospital->name}}</p>
            </div>
            <div class="weui-cell__ft">
                {{$recommendHospital->grading}}
            </div>
        </a>
        @endforeach
    </div>
    @endif

    @if(count($hospitals) > 0 )
    <div class="weui-cells__title">所有医院</div>
    <div class="weui-cells">
        @foreach($hospitals as $hospital)
        <a href="hospital/{{$hospital->id}}" class="weui-cell weui-cell_access">
            <div class="weui-cell__bd">
                <p>{{$hospital->name}}</p>
            </div>
            <div class="weui-cell__ft">
                {{$hospital->grading}}
            </div>
        </a>
        @endforeach
    </div>
    @endif
</div>
    @endif
@endsection