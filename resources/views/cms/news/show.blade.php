@extends('cms.layouts.app')

@section('title', '咨讯详情')

@section('css')
    <link href="/css/cms/simditor.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">咨讯详情</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/news/' . $data->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">标题*</label>

                            <div class="col-md-10">
                                <input type="text" id="title" class="form-control" name="title" value="{{ old('title') ?: $data->title }}" required>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cover_image') ? ' has-error' : '' }}">
                            <label for="cover_image" class="col-md-2 control-label">封面图片</label>

                            <div class="col-md-10">
                                <input id="cover_image" type="file" name="cover_image" accept="image/*">
                                <span class="help-block">尺寸为 400x200px.</span>
                                <img src="{{ Storage::url($data->cover_image) }}" alt="{{ $data->title }}的封面图片" style="max-width: 100%">

                                @if ($errors->has('cover_image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cover_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-2 control-label">内容*</label>

                            <div class="col-md-10">
                                <textarea id="editor" name="content" data-path="news/content">{{ old('content') ?: $data->content }}</textarea>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <div class="col-md-10 col-md-offset-2">
                                    <label>
                                        <input type="checkbox" id="published_at" name="published_at"{{ old('published_at') || (old('title') == null && $data->published_at) ? ' checked' : '' }}> 发布
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

                    <form id="deleteForm" method="POST" action="{{ url('/news/' . $data->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/js/cms/module.min.js"></script>
    <script src="/js/cms/hotkeys.min.js"></script>
    <script src="/js/cms/uploader.min.js"></script>
    <script src="/js/cms/simditor.min.js"></script>
@endsection
