@extends('cms.layouts.app')

@section('title', '添加评论')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">添加评论</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/reviews') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('patient_id') ? ' has-error' : '' }}">
                            <label for="patient_id" class="col-md-4 control-label">评论者*</label>

                            <div class="col-md-6">
                                <select class="form-control" name="patient_id" required>
                                    <option value="" selected disabled>请选择</option>
                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}"{{ old('patient_id') == $patient->id ? ' selected' : '' }}>{{ $patient->name }}</option>
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
                                    <option value="" selected disabled>请选择</option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}"{{ old('doctor_id') == $doctor->id ? ' selected' : '' }}>{{ $doctor->name }}</option>
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
                                    <option value="1"{{ old('ratings') == '1' ? ' selected' : '' }}>1</option>
                                    <option value="2"{{ old('ratings') == '2' ? ' selected' : '' }}>2</option>
                                    <option value="3"{{ old('ratings') == '3' ? ' selected' : '' }}>3</option>
                                    <option value="4"{{ old('ratings') == '4' ? ' selected' : '' }}>4</option>
                                    <option value="5"{{ old('ratings') == '5' || count($errors) <= 0 ? ' selected' : '' }}>5</option>
                                </select>

                                @if ($errors->has('ratings'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ratings') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('reviews') ? ' has-error' : '' }}">
                            <label for="reviews" class="col-md-4 control-label">评论*</label>

                            <div class="col-md-6">
                                <textarea name="reviews" rows="3" class="form-control" required>{{ old('reviews') }}</textarea>

                                @if ($errors->has('reviews'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reviews') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="status" value="1"{{ old('status') == '1' || count($errors) == 0 ? ' checked' : '' }}> 通过审核
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    保存
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
