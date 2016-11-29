@extends('cms.layouts.app')

@section('title', '德之天才详情')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">德之天才详情</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/masters/' . $data->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                            <label for="id" class="col-md-4 control-label">编号*</label>

                            <div class="col-md-6">
                                <input type="number" id="id" class="form-control" name="id" placeholder="6 位数字" value="{{ old('id') ?: $data->id }}" required>

                                @if ($errors->has('id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">姓名*</label>

                            <div class="col-md-6">
                                <input type="text" id="name" class="form-control" name="name" value="{{ old('name') ?: $data->name }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="id" class="col-md-4 control-label">手机号码*</label>

                            <div class="col-md-6">
                                <input type="number" id="phone_number" class="form-control" name="phone_number" value="{{ old('phone_number') ?: $data->phone_number }}" required>

                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">所在部门*</label>

                            <div class="col-md-6">
                                <select class="form-control" name="department_id">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"{{ old('department_id') == $department->id || $data->department_id == $department->id ? ' selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('department_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">保存</button>
                                <a class="btn btn-default" href="{{ url('masters/' . $data->id . '/password') }}">修改密码</a>
                                <a class="btn btn-link" href="javascript:;" onclick="confirmDelete()">删除</a>
                            </div>
                        </div>
                    </form>

                    <form id="deleteForm" method="POST" action="{{ url('/masters/' . $data->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
