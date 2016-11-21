@extends('cms.layouts.app')

@section('title', '添加医生')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">添加医生</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" action="{{ url('/doctors') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
                            <label class="col-md-4 control-label" for="name">名称*</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>

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
                                <input id="grading" class="form-control" type="text" name="grading" value="{{ old('grading') }}">

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
                                <input type="number" pattern="[0-9]11" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">

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
                                    @foreach ($hospitals as $hospital)
                                        <option value="{{ $hospital->id }}" {{ old('hospital_id') == $hospital->id ? 'selected' : '' }}>{{ $hospital->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('hospital_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hospital_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('instance_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="instance_id[]">专长*</label>

                            <div class="col-md-6">
                                <div class="row">
                                    @foreach ($instances as $instance)
                                        <div class="col-md-6">
                                            <div class="checkbox-inline">
                                                <input type="checkbox" name="instance_id[]" value="{{ $instance->id }}"{{ (old('instance_id') !== null && in_array($instance->id, old('instance_id'))) ? ' checked' : '' }}> {{ $instance->name }}
                                            </div>
                                        </div>
                                    @endforeach

                                    @if ($errors->has('instance_id'))
                                        <div class="col-md-12">
                                            <span class="help-block">
                                                <strong>
                                                    @foreach ($errors->get('instance_id') as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('is_certified') ? ' has-error' : '' }}">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input id="is_certified" type="checkbox" name="is_certified"{{ old('is_certified') ? ' checked' : '' }}> 签约
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
                                <textarea id="introduction" class="form-control" name="introduction" rows="7" cols="40">{{ old('introduction') }}</textarea>

                                @if ($errors->has('introduction'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('introduction') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="password">密码</label>

                            <div class="col-md-6">
                                <input id="password" class="form-control" type="password" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('is_recommended') ? ' has-error' : '' }}">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input id="is_recommended" type="checkbox" name="is_recommended"{{ old('is_recommended') ? ' checked' : '' }}> 推荐
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
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">保存</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
