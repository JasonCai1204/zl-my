@extends('web.layouts.user')

@section('title','推荐 - 肿瘤名医')

@section('content')

    @if (isset($hospitals) && count($hospitals) > 0)
        <div class="container" id="container_recommend">
            <div class="my_recommend_list">
                <div class="weui-cells__title">推荐医院</div>
                <div class="weui-cells">
                    @foreach ($hospitals as $hospital)

                        <a href="/hospital/{{ $hospital['city_id'] }}{{ isset($hospital) ? '&city_id='.$hospital['city_id'] : ''}}"
                           class="weui-cell weui-cell_access">
                            <div class="weui-cell__bd">
                                <p>{{ $hospital['name'] }}</p>
                            </div>
                            <div class="weui-cell__ft">
                                {{ $hospital['grading'] }}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if (isset($doctors) && count($doctors) >0)
        <div class="container" id="container_recommend">
            <div class="my_recommend_list">
                <div class="weui-cells__title">推荐医生</div>
                <div class="weui-cells">
                    @foreach ($doctors as $doctor)

                        <a href="/doctor/{{ $doctor['id'] }}"
                           class="weui-cell weui-cell_access my_doctor_cell">
                            <div class="weui-cell__bd">
                                <p>{{ $doctor['name'] }}</p>
                                <span class="my_cell_index">{{ $doctor['hospital_name'] }}</span>
                            </div>
                            <div class="weui-cell__ft">
                                {{ $doctor['grading'] }}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection