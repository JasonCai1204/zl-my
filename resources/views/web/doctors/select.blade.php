@extends('web.layouts.user-basic')

@section('title','选择医生 - 肿瘤名医')

@section('content')

        <!--主体部分-->
@if ( isset($recommendDoctors) || isset($doctors) )
    <div class="container" id="container_doctor">
        <form action="/orders/create" method="get">

            @if( isset($check_doctor_id) || isset($hospital_id) || isset($instance_id) )

                {{ $check_doctor_id }}
                <input type="hidden" name="check_doctor_id" value="{{ $check_doctor_id ? : '' }}"  />
                <input type="hidden" name="hospital_id" value="{{ isset($hospital_id) ? : '' }}"  />
                <input type="hidden" name="instance_id" value="{{ isset($instance_id) ? : '' }}"  />

            @endif

            @if ( count($recommendDoctors) > 0 )
                <div class="weui-cells__title">推荐医生</div>
                <div class="weui-cells weui-cells_radio">
                    @foreach( $recommendDoctors as $recommendDoctor )
                        <label class="weui-cell weui-check__label my_doctor_cell">
                            <div class="weui-cell__bd">
                                <p>{{ $recommendDoctor->name }}</p>
                                <span class="my_cell_index">{{ $recommendDoctor->hospital->name }}</span>
                            </div>
                            <div class="weui-cell__ft">
                                <input type="radio" class="weui-check" name="doctor_id"
                                       value="{{ $recommendDoctor->id }} " {{ $check_doctor_id == $recommendDoctor->id ? 'checked' : ''  }} />
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                    @endforeach
                </div>
            @endif

            @if ( count($doctors) > 0 )
                <div class="weui-cells__title">所有医生</div>
                <div class="weui-cells weui-cells_radio">
                    @foreach( $doctors as $doctor )
                        <label class="weui-cell weui-check__label my_doctor_cell">
                            <div class="weui-cell__bd">
                                <p>{{ $doctor->name }}</p>
                                <span class="my_cell_index">{{ $doctor->hospital->name }}</span>
                            </div>
                            <div class="weui-cell__ft">
                                <input type="radio" class="weui-check" name="doctor_id"
                                       value="{{ $doctor->id }} {{ $check_doctor_id == $doctor->id ? 'checked' : ''  }} /">
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
            @endif


            {{-- Select doctors from hospital--}}

            @if ( isset($hospitalDoctors) )
                <div class="container" id="container_doctor">
                    @if( count($hospitalDoctors) > 0 )
                        <form action="/orders/create" method="get">

                            @if( isset($check_doctor_id) || isset($hospital_id) || isset($instance_id) )

                                <input type="hidden" name="check_doctor_id" value="{{ $check_doctor_id ? : '' }}"  />
                                <input type="hidden" name="hospital_id" value="{{ $hospital_id ? : '' }}"  />
                                <input type="hidden" name="instance_id" value="{{ $instance_id ? : '' }}"  />

                            @endif

                            <input type="hidden" name="hospital_id" value="{{ $hospital_id }}">
                            <div class="weui-cells weui-cells_radio">
                                @foreach( $hospitalDoctors as $hospitalDoctor )
                                    <label class="weui-cell weui-check__label my_doctor_cell">
                                        <div class="weui-cell__bd">
                                            <p>{{ $hospitalDoctor->name }}</p>
                                            {{--<span class="my_cell_index">{{$hospitalDoctor->hospital->name}}</span>--}}
                                        </div>
                                        <div class="weui-cell__ft">
                                            <input type="radio" class="weui-check" name="doctor_id"
                                                   value="{{ $hospitalDoctor->id }}" {{ $check_doctor_id == $hospitalDoctor->id ? 'checked' : ''  }} />
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

            {{--Select doctors from instance--}}

            @if ( isset($instanceDoctors) )
                <div class="container" id="container_doctor">
                    @if ( count($instanceDoctors) > 0 )
                        <form action="/orders/create" method="get">

                            @if( isset($check_doctor_id) || isset($hospital_id) || isset($instance_id) )

                                <input type="hidden" name="check_doctor_id" value="{{ $check_doctor_id ? : '' }}"  />
                                <input type="hidden" name="hospital_id" value="{{ isset($hospital_id) ? : '' }}"  />
                                <input type="hidden" name="instance_id" value="{{ isset($instance_id) ? : '' }}"  />

                            @endif

                            <input type="hidden" name="instance_id" value="{{ $instance_id }}">
                            <div class="weui-cells weui-cells_radio">
                                @foreach ( $instanceDoctors as $instanceDoctor )
                                    <label class="weui-cell weui-check__label my_doctor_cell">
                                        <div class="weui-cell__bd">
                                            <p>{{ $instanceDoctor->name }}</p>
                                            {{--<span class="my_cell_index">{{$hospitalDoctor->hospital->name}}</span>--}}
                                        </div>
                                        <div class="weui-cell__ft">
                                            <input type="radio" class="weui-check" name="doctor_id"
                                                   value="{{ $instanceDoctor->id }}" {{ $check_doctor_id == $instanceDoctor->id ? 'checked' : ''  }} />
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