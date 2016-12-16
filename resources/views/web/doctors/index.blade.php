@extends('web.layouts.user-basic')

@section('title','找医生 - 肿瘤名医')

@section('content')

    <div class="container" id="container_doctor">

        @if (count($doctors) > 0)
            <div class="weui-cells">
                @foreach ($doctors as $doctor)

                    <a href="doctor/{{ $doctor->id }}" class="weui-cell weui-cell_access my_doctor_cell">
                        <div class="weui-cell__bd">

                            <p>{{ $doctor->name }}</p>
                            <span class="my_cell_index">{{ $doctor->hospital->name }}</span>
                        </div>
                        <div class="weui-cell__ft">
                            {{ $doctor->grading }}
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection