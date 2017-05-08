@extends('cms.layouts.app')

@section('title', '评论详情')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">评论详情</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('reviews/' . $data->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('patient_id') ? ' has-error' : '' }}">
                            <label for="patient_id" class="col-md-4 control-label">评论者*</label>

                            <div class="col-md-6">
                                <select class="form-control" name="patient_id" required>
                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}"{{ old('patient_id') == $patient->id || (count($errors) == 0 && $data->patient_id == $patient->id) ? ' selected' : '' }}>{{ $patient->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('patient_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('patient_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('doctor_id') ? ' has-error' : '' }}">
                            <label for="doctor_id" class="col-md-4 control-label">医生*</label>

                            <div class="col-md-6">
                                <select class="form-control" name="doctor_id" required>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}"{{ old('doctor_id') == $doctor->id || (count($errors) == 0 && $data->doctor_id == $doctor->id) ? ' selected' : '' }}>{{ $doctor->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('doctor_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('doctor_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ratings') ? ' has-error' : '' }}">
                            <label for="ratings" class="col-md-4 control-label">评级*</label>

                            <div class="col-md-6">
                                <select class="form-control" name="ratings" required>
                                    <option value="1"{{ old('ratings') == '1' || (count($errors) == 0 && $data->rating == '1') ? ' selected' : '' }}>1</option>
                                    <option value="2"{{ old('ratings') == '2' || (count($errors) == 0 && $data->rating == '2') ? ' selected' : '' }}>2</option>
                                    <option value="3"{{ old('ratings') == '3' || (count($errors) == 0 && $data->rating == '3') ? ' selected' : '' }}>3</option>
                                    <option value="4"{{ old('ratings') == '4' || (count($errors) == 0 && $data->rating == '4') ? ' selected' : '' }}>4</option>
                                    <option value="5"{{ old('ratings') == '5' || (count($errors) == 0 && $data->rating == '5') ? ' selected' : '' }}>5</option>
                                </select>

                                @if ($errors->has('ratings'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ratings') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reviews" class="col-md-4 control-label">评论*</label>

                            <div class="col-md-6">
                                <textarea name="reviews" rows="12" class="form-control">{{ $data->reviews }}</textarea>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('created_at') ? ' has-error' : '' }}">
                            <label for="reviews" class="col-md-4 control-label">时间*</label>

                            <div class="col-md-6">
                                <input class="form-control" type="datetime" name="created_at" value="{{ old('created_at', $data->created_at) }}" required>

                                @if ($errors->has('created_at'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('created_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="status" value="1"{{ $data->status === 1 ? ' checked' : '' }}> 通过审核
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">保存</button>
                                <a class="btn btn-link" href="javascript:;" onclick="confirmDelete()">删除</a>
                            </div>
                        </div>
                    </form>

                    <form id="deleteForm" method="POST" action="{{ url('/reviews/' . $data->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
