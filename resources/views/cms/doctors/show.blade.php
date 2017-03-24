@extends('cms.layouts.app')

@section('title', '医生详情')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">医生详情</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/doctors/' . $data->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
                            <label class="col-md-4 control-label" for="name">名称*</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?: $data->name }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('avatar') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label" for="avatar">照片</label>

                            <div class="col-md-6">
                                <input id="avatar" type="file" accept="image/*" name="avatar">
                                <span class="help-block">尺寸大于 100x100px</span>

                                <img src="{{ Storage::url($data->avatar ?: 'images/doctor/avatar/default.png') }}" alt="{{ $data->name }}的照片" style="max-width: 50px; max-height: 50px" />

                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('grading') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="grading">职称*</label>

                            <div class="col-md-6">
                                <input id="grading" class="form-control" type="text" name="grading" value="{{ old('grading') ?: $data->grading }}">

                                @if ($errors->has('grading'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('grading') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="phone_number">手机号码</label>

                            <div class="col-md-6">
                                <input type="number" pattern="[0-9]11" class="form-control" id="phone_number" name="phone_number" value="{{ $data->users->first()->phone_number or '' }}">

                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('hospital_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="hospital_id">所在医院*</label>

                            <div class="col-md-6">
                                <select id="hospital_id" class="form-control" name="hospital_id">
                                    <option selected disabled>请选择</option>
                                    @foreach ($hospitals as $hospital)
                                        <option value="{{ $hospital->id }}" {{ old('hospital_id') == $hospital->id || $data->hospital_id == $hospital->id ? 'selected' : '' }}>{{ $hospital->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('hospital_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hospital_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- TODO: show old content. --}}
                        <div class="form-group{{ $errors->has('instance_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="instance_id[]">专长*</label>

                            <div class="col-md-6">
                                <select id="instance_id" class="form-control" name="instance_id[]" multiple>
                                    @foreach ($types as $type)
                                        <option disabled>{{ $type->name }}</option>

                                        @foreach ($type->instances()->orderBy('sort')->get() as $instance)
                                            <option value="{{ $instance->id }}"{{ $data->instances()->find($instance->id) != null ? ' selected' : '' }}>&nbsp;&nbsp;&nbsp; {{ $instance->name }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                                <span class="help-block">按住 Ctrl (Windows) / Command (Mac) 键来多选。</span>

                                @if ($errors->has('instance_id'))
                                    <span class="help-block">
                                        <strong>
                                            @foreach ($errors->get('instance_id') as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('is_certified') ? ' has-error' : '' }}">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input id="is_certified" type="checkbox" name="is_certified"{{ old('is_certified') || $data->is_certified ? ' checked' : '' }}> 签约
                                    </label>
                                </div>

                                @if ($errors->has('is_certified'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_certified') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('introduction') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="introduction">介绍*</label>

                            <div class="col-md-6">
                                <textarea id="introduction" class="form-control" name="introduction" rows="7" cols="40">{{ old('introduction') ?: $data->introduction }}</textarea>

                                @if ($errors->has('introduction'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('introduction') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('is_recommended') ? ' has-error' : '' }}">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input id="is_recommended" type="checkbox" name="is_recommended"{{ old('is_recommended') || $data->is_recommended ? ' checked' : '' }}> 推荐
                                    </label>
                                </div>

                                @if ($errors->has('is_recommended'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_recommended') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">保存</button>
                                <a class="btn btn-default" href="{{ url('doctors/' . $data->id . '/password') }}">修改密码</a>
                                <a class="btn btn-link" href="javascript:;" onclick="confirmDelete()">删除</a>
                            </div>
                        </div>
                    </form>

                    <form id="deleteForm" method="POST" action="{{ url('doctors/' . $data->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
