@extends('cms.layouts.app')

@section('title', '添加文章')

@section('css')
    <link href="/css/cms/simditor.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">添加文章</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/news') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">标题*</label>

                            <div class="col-md-10">
                                <input type="text" id="title" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('news_class_id_and_sort') || $errors->has('news_class_id') || $errors->has('sort') ? ' has-error' : '' }}">
                            <label for="type_id_and_sort" class="col-md-2 control-label">所属文章类别和排序*</label>

                            <div class="col-md-6">
                                <select id="news_class_id_and_sort" class="form-control" name="news_class_id_and_sort">
                                    <option disabled selected>请选择</option>
                                    @foreach ($news_classes as $news_class)
                                        <option disabled>{{ $news_class->name }}</option>
                                        @for ($i = 1; $i <= count($news_class->news) + 1; $i++)
                                            <option value="{{ $news_class->id . ',' . $i }}"{{ $news_class->id . ',' . $i == old('news_class_id_and_sort') ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    @endforeach
                                </select>

                                @if ($errors->has('news_class_id_and_sort'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('news_class_id_and_sort') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('news_class->id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('news_class->id') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('sort'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sort') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cover_image') ? ' has-error' : '' }}">
                            <label for="cover_image" class="col-md-2 control-label">封面图片*</label>

                            <div class="col-md-10">
                                <input id="cover_image" type="file" name="cover_image" accept="image/*">
                                <span class="help-block">尺寸为 140x140px.</span>

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
                                <textarea id="editor" name="content" data-path="news/content">{{ old('content') }}</textarea>

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
                                        <input type="checkbox" onclick="recommendCheck()" id="is_recommended" name="is_recommended"> 推荐到首页
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <div class="col-md-10 col-md-offset-2">
                                    <label>
                                        <input type="checkbox" onclick="recommendCheck()" id="is_recommended_1" name="is_recommended_1"> 推荐到当前页面
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="recommendImage" class="form-group{{ $errors->has('banner_image') ? ' has-error' : '' }}">
                            <label for="banner_image" class="col-md-2 control-label">"推荐"的封面图片*</label>

                            <div class="col-md-10">
                                <input id="banner_image" type="file" name="banner_image" accept="image/*">
                                <span class="help-block">尺寸为 320x150px.</span>

                                @if ($errors->has('banner_image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('banner_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <div class="col-md-10 col-md-offset-2">
                                    <label>
                                        <input type="checkbox" id="published_at" name="published_at"> 发布
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
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

@section('js')
    <script src="/js/cms/module.min.js"></script>
    <script src="/js/cms/hotkeys.min.js"></script>
    <script src="/js/cms/uploader.min.js"></script>
    <script src="/js/cms/simditor.min.js"></script>
@endsection
