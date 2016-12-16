@extends('web.layouts.user-basic')

@section('title','选择医生 - 肿瘤名医')

@section('content')

    <div class="container" id="order_choice_hospital">

        <form action="/orders/create" method="GET">
            @if (isset($hospital_id))
                <input type="hidden" name="hospital_id" value="{{ $hospital_id }}"/>
            @endif
            @if (isset($instance_id))
                <input type="hidden" name="instance_id" value="{{ $instance_id }}"/>
            @endif


            @if (count($doctors) > 0 )

                <div class="weui-cells weui-cells_radio">
                    @foreach ($doctors as $doctor)
                        <label class="weui-cell weui-check__label">
                            <div class="weui-cell__bd">
                                <p>{{ $doctor->name }}</p>
                            </div>

                            <div class="weui-cell__ft">
                                <input type="radio" class="weui-check" name="doctor_id"
                                       value="{{ $doctor->id }}" {{ isset($doctor_id) && $doctor->is_recommended != 1 && $doctor->id == $doctor_id ? 'checked' : ''  }} />

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
