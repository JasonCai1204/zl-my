@extends('cms.layouts.app')

@section('title', '医院详情')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">医院详情</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/hospitals/' . $data->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">名称*</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ?: $data->name }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('grading') ? ' has-error' : '' }}">
                            <label for="grading" class="col-md-4 control-label">等级*</label>

                            <div class="col-md-6">
                                <input id="grading" type="text" class="form-control" name="grading" value="{{ old('grading') ?: $data->grading }}" required>

                                @if ($errors->has('grading'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('grading') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
                            <label for="city_id" class="col-md-4 control-label">所在城市*</label>

                            <div class="col-md-6">
                                <select class="form-control" name="city_id">
                                    <option disabled selected>请选择</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" {{ old('city_id') == $city->id || $data->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('city_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('introduction') ? ' has-error' : '' }}">
                            <label for="introduction" class="col-md-4 control-label">介绍*</label>

                            <div class="col-md-6">
                                <textarea id="introduction" class="form-control" rows="7" cols="40" name="introduction" required>{{ old('introduction') ?: $data->introduction }}</textarea>

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
                                            <input type="checkbox" name="is_recommended"{{ old('is_recommended') || $data->is_recommended ? ' checked' : '' }}> 推荐
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
                                <button type="submit" class="btn btn-primary">
                                    保存
                                </button>
                                <a class="btn btn-link" href="javascript:;" onclick="confirmDelete()">
                                    删除
                                </a>
                            </div>
                        </div>

                    </form>

                    <form id="deleteForm" method="POST" action="{{ url('/hospitals/' . $data->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
