@extends('cms.layouts.app')

@section('title', '企业部门详情')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">企业部门详情</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/departments/' . $data->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                            <label for="id" class="col-md-4 control-label">编号*</label>

                            <div class="col-md-6">
                                <input type="number" id="id" class="form-control" name="id" placeholder="4 位数字" value="{{ old('id') ?: $data->id }}" required>

                                @if ($errors->has('id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">名称*</label>

                            <div class="col-md-6">
                                <input type="text" id="name" class="form-control" name="name" value="{{ old('name') ?: $data->name }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">保存</button>
                                <a class="btn btn-link" href="javascript:;" onclick="confirmDelete()">删除</a>
                            </div>
                        </div>
                    </form>

                    <form id="deleteForm" method="POST" action="{{ url('/departments/' . $data->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
