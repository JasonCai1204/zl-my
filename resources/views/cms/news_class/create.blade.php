@extends('cms.layouts.app')

@section('title', '添加文章类别')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    添加文章类别
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="{{ url('/news_class') }}" method="post" enctype="multipart/form-data">
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

                        <div class="form-group{{ $errors->has('type_id_and_sort') || $errors->has('type_id') || $errors->has('sort') ? ' has-error' : '' }}">
                            <label for="type_and_sort" class="col-md-4 control-label">所属文章分类和排序*</label>

                            <div class="col-md-6">
                                <select id="type_and_sort" class="form-control" name="type_and_sort">
                                    <option disabled selected>请选择</option>
                                    @foreach ($classes as $class)
                                        <option disabled>{{ $class }}</option>
                                        @if($class == '资讯')
                                            @for ($i = 1; $i <= count($news_classes->where('type',1)) + 1; $i++)
                                                <option value="{{ 1 . ',' . $i }}"{{ $class . ',' . $i == old('type_and_sort') ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        @endif

                                        @if($class == '科普')
                                            @for ($i = 1; $i <= count($news_classes->where('type',2)) + 1; $i++)
                                                <option value="{{ 2 . ',' . $i }}"{{ $class . ',' . $i == old('type_and_sort') ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        @endif

                                    @endforeach
                                </select>

                                @if ($errors->has('type_and_sort'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_and_sort') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('sort'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sort') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">--}}
                            {{--<label for="type" class="col-md-4 control-label">所属类别</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<select class="form-control" name="type">--}}
                                    {{--@for ($i = 1; $i <= $count; $i++)--}}
                                        {{--<option value="{{ $i }}">{{ $i }}</option>--}}
                                    {{--@endfor--}}
                                {{--</select>--}}

                                {{--@if ($errors->has('type'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('type') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('sort') ? ' has-error' : '' }}">--}}
                            {{--<label for="sort" class="col-md-4 control-label">排序</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<select class="form-control" name="sort">--}}
                                    {{--@for ($i = 1; $i <= $sort; $i++)--}}
                                        {{--<option value="{{ $i }}">{{ $i }}</option>--}}
                                    {{--@endfor--}}
                                {{--</select>--}}

                                {{--@if ($errors->has('sort'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('sort') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

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
