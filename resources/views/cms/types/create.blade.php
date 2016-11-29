@extends('cms.layouts.app')

@section('title', '添加病种')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    添加病种
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="{{ url('/types') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">名称*</label>

                            <div class="col-md-6">
                                <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('icon') ? ' has-error' : '' }}">
                            <label for="icon" class="col-md-4 control-label">图标</label>

                            <div class="col-md-6">
                                <input id="icon" type="file" name="icon" accept="image/*">

                                <span class="help-block">尺寸大于 100x100px</span>

                                @if ($errors->has('icon'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('icon') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sort') ? ' has-error' : '' }}">
                            <label for="sort" class="col-md-4 control-label">排序</label>

                            <div class="col-md-6">
                                <select class="form-control" name="sort">
                                    @for ($i = 1; $i <= $sort; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>

                                @if ($errors->has('sort'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sort') }}</strong>
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
