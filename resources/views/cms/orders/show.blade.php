@extends('cms.layouts.app')

@section('title', '预约单详情')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">预约单详情</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/orders/' . $data->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                            <label for="id" class="col-md-4 control-label">编号</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control" name="id" value="{{ $data->id }}" readonly required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('patient_name') ? ' has-error' : '' }}">
                            <label for="patient_name" class="col-md-4 control-label">患者姓名*</label>

                            <div class="col-md-6">
                                <input id="patient_name" type="text" class="form-control" name="patient_name" value="{{ old('patient_name') ?: $data->patient_name }}" required>
                            </div>

                            @if ($errors->has('patient_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('patient_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number" class="col-md-4 control-label">手机号码*</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="number" class="form-control" name="phone_number" value="{{ old('phone_number') ?: $data->phone_number }}" required>
                            </div>

                            @if ($errors->has('phone_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('instance_id') ? ' has-error' : '' }}">
                            <label for="instance_id" class="col-md-4 control-label">所患疾病</label>

                            <div class="col-md-6">
                                <select id="instance_id" name="instance_id" class="form-control">
                                    <option value="">请选择</option>
                                    @foreach ($types as $type)
                                        <option disabled>{{ $type->name }}</option>
                                        @foreach ($type->instances as $instance)
                                            <option value="{{ $instance->id }}"{{ old('instance_id') == $instance->id || (old('instance_id') == null && $instance->id == $data->instance_id) ? ' selected' : '' }}>{{ $instance->name }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>

                            @if ($errors->has('instance_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('instance_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('hospital_id_or_doctor_id') ? ' has-error' : '' }}">
                            <label for="hospital_id_or_doctor_id" class="col-md-4 control-label">预约医院和医生</label>

                            <div class="col-md-6">
                                <select id="hospital_id_or_doctor_id" name="hospital_id_or_doctor_id" class="form-control">
                                    <option value="">请选择</option>
                                    @foreach ($hospitals as $hospital)
                                        <option value="{{ $hospital->id }}"{{ (old('hospital_id_or_doctor_id') == $hospital->id) || (old('hospital_id_or_doctor_id') == null && $data->doctor_id == null && $hospital->id == $data->hospital_id) ? ' selected' : '' }}>{{ $hospital->name }}</option>
                                        @foreach ($hospital->doctors as $doctor)
                                            <option value="{{ $hospital->id . ',' . $doctor->id }}"{{ old('hospital_id_or_doctor_id') == $hospital->id . ',' . $doctor->id || (old('hospital_id_or_doctor_id') == null && $doctor->id == $data->doctor_id) ? ' selected' : '' }}>👤 {{ $doctor->name }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>

                            @if ($errors->has('hospital_id_or_doctor_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('hospital_id_or_doctor_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">性别</label>

                            <div class="col-md-6">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" id="gender" value="1"{{ $data->gender == '1' ? ' checked' : '' }}> 👱男
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" id="gender" value="0"{{ $data->gender == '0' ? ' checked' : '' }}> 👩女
                                </label>
                            </div>

                            @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            <label for="birthday" class="col-md-4 control-label">出生年月</label>

                            <div class="col-md-6">
                                <input id="birthday" type="month" class="form-control" name="birthday" placeholder="yyyy-mm-dd" value="{{ (new DateTime(old('birthday') ?: $data->birthday))->format('Y-m') }}">

                                @if ($errors->has('birthday'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                            <label for="weight" class="col-md-4 control-label">体重</label>

                            <div class="col-md-6">
                                <select id="weight" name="weight" class="form-control">
                                    <option value="">请选择</option>
                                    @for ($i = 30; $i < 95; $i = $i + 5)
                                        <option value="{{ ($i + 1) . '-' . ($i + 5) }}"{{ $data->weight == (($i + 1) . '-' . ($i + 5)) ? ' selected' : '' }}>{{ ($i + 1) . '-' . ($i + 5) }} kg</option>
                                    @endfor
                                </select>
                            </div>

                            @if ($errors->has('weight'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('weight') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('smoking') ? ' has-error' : '' }}">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input id="smoking" type="checkbox" name="smoking"{{ old('smoking') || $data->smoking ? ' checked' : '' }}> 🚬吸烟
                                    </label>
                                </div>

                                @if ($errors->has('smoking'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('smoking') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('wechat_id') ? ' has-error' : '' }}">
                            <label for="wechat_id" class="col-md-4 control-label">微信号</label>

                            <div class="col-md-6">
                                <input id="wechat_id" type="text" class="form-control" name="wechat_id" value="{{ old('wechat_id') ?: $data->wechat_id }}">
                            </div>

                            @if ($errors->has('wechat_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('wechat_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                            <label for="detail" class="col-md-4 control-label">病情描述</label>

                            <div class="col-md-6">
                                <textarea id="detail" class="form-control" name="detail" rows="7" cols="40">{{ old('detail') ?: $data->detail }}</textarea>
                            </div>

                            @if ($errors->has('detail'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('detail') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="photos" class="col-md-4 control-label">病例相关资料</label>

                            <div class="col-md-6">
                                @if (count($data->photos) > 0)
                                    <div style="margin-bottom: 5px">
                                        @foreach ($data->photos as $photo)
                                            <a href="{{ Storage::url($photo) }}" target="_blank">
                                                <img src="{{ Storage::url($photo) }}" alt="{{ $data->patient_name }} 的病例相关资料" style="max-width: 50px; max-height: 50px">
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                                <a href="{{ url('orders/' . $data->id . '/photos') }}" class="btn btn-default">查看／编辑病例相关资料</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="created_at" class="col-md-4 control-label">日期</label>

                            <div class="col-md-6">
                                <input id="created_at" type="day" class="form-control" name="created_at" value="{{ $data->created_at }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="condition_report" class="col-md-4 control-label">病情报告</label>

                            <div class="col-md-6">
                                <a href="{{ url('orders/' . $data->id . '/condition-report') }}" class="btn btn-default">查看／编辑病情报告</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="user_id" class="col-md-4 control-label">预约单所属用户</label>

                            <div class="col-md-6">
                                <a href="{{ url('users/' . $data->user_id) }}" class="btn btn-link">{{ $data->user->name }}</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
