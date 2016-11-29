@extends('cms.layouts.app')

@section('title', '病例详情')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">病例详情</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('instances/' . $data->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">名称*</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') ?: $data->name }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type_id_and_sort') || $errors->has('type_id') || $errors->has('sort') ? ' has-error' : '' }}">
                            <label for="type_id_and_sort" class="col-md-4 control-label">所属病种和排序*</label>

                            <div class="col-md-6">
                                <select id="type_id_and_sort" class="form-control" name="type_id_and_sort">
                                    <option disabled selected>请选择</option>
                                    @foreach ($types as $type)
                                        <option disabled>{{ $type->name }}</option>
                                        @for ($i = 1; $i <= count($type->instances); $i++)
                                            <option value="{{ $type->id . ',' . $i }}"{{ $type->id . ',' . $i == old('type_id_and_sort') || (old('type_id_and_sort') == null && ($type->id . ',' . $i == $data->type_id . ',' . $data->sort)) ? ' selected' : '' }}>{{ $i }}</option>
                                        @endfor

                                        @if ($type->id != $data->type_id)
                                            <option value="{{ $type->id . ',' . (count($type->instances) + 1) }}"{{ $type->id . ',' . (count($type->instances) + 1) == old('type_id_and_sort') ? ' selected' : '' }}>{{ count($type->instances) + 1 }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('type_id_and_sort'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_id_and_sort') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('type_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_id') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('sort'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sort') }}</strong>
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

                    <form id="deleteForm" method="POST" action="{{ url('/instances/' . $data->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
