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

                        <div class="form-group">
                            <label for="patient_id" class="col-md-4 control-label">评论者*</label>

                            <div class="col-md-6">
                                <input class="form-control" name="patient_id" value="{{ $data->patient->name }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="doctor_id" class="col-md-4 control-label">医生*</label>

                            <div class="col-md-6">
                                <input class="form-control" name="doctor_id" value="{{ $data->doctor->name }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ratings" class="col-md-4 control-label">评级*</label>

                            <div class="col-md-6">
                                <input class="form-control" name="ratings" value="{{ $data->ratings }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reviews" class="col-md-4 control-label">评论*</label>

                            <div class="col-md-6">
                                <textarea name="reviews" rows="12" class="form-control" readonly>{{ $data->reviews }}</textarea>
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
                            </div>
                        </div>
                    </form>

                    <form id="deleteForm" method="POST" action="{{ url('/cities/' . $data->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
