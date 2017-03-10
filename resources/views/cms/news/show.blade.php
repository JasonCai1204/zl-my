@extends('cms.layouts.app')

@section('title', '文章详情')

@section('css')
    <link href="/css/cms/simditor.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">文章详情</div>

                <div class="panel-body">
                    <form id="news-show" class="form-horizontal" role="form" method="POST" action="{{ url('/news/' . $data->id) }}" enctype="multipart/form-data">
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

                        <div class="form-group{{ $errors->has('news_class_id_and_sort') || $errors->has('news_class_id') || $errors->has('sort') ? ' has-error' : '' }}">
                            <label for="news_class_id_and_sort" class="col-md-2 control-label">所属文章类别和排序*</label>

                            <div class="col-md-6">
                                <select id="news_class_id_and_sort" class="form-control" name="news_class_id_and_sort">
                                    <option disabled selected>请选择</option>
                                    @foreach ($news_classes as $news_class)
                                        <option disabled>{{ $news_class->name }}</option>
                                        @for ($i = 1; $i <= count($news_class->news); $i++)
                                            <option value="{{ $news_class->id . ',' . $i }}"{{ $news_class->id . ',' . $i == old('news_class_id_and_sort') || (old('news_class_id_and_sort') == null && ($news_class->id . ',' . $i == $data->news_class_id . ',' . $data->sort)) ? ' selected' : '' }}>{{ $i }}</option>
                                        @endfor

                                        @if ($news_class->id != $data->news_class_id)
                                            <option value="{{ $news_class->id . ',' . (count($news_class->news) + 1) }}"{{ $news_class->id . ',' . (count($news_class->news) + 1) == old('news_class_id_and_sort') ? ' selected' : '' }}>{{ count($news_class->news) + 1 }}</option>
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


                        <div class="form-group{{ $errors->has('cover_image') ? ' has-error' : '' }}">
                            <label for="cover_image" class="col-md-2 control-label">封面图片</label>

                            <div class="col-md-10">
                                <input id="cover_image" type="file" name="cover_image" accept="image/*">
                                <span class="help-block">尺寸为 140x140px.</span>
                                @if(isset($data->cover_image))
                                <img src="/storage/{{$data->cover_image}}" alt="{{ $data->title }}的封面图片" style="max-width: 100%">
                                @endif
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
                                        <input type="checkbox" onclick="recommendCheck()" id="is_recommended" name="is_recommended"{{ old('is_recommended') || (old('title') == null && $data->is_recommended) ? ' checked' : '' }}> 推荐到首页
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <div class="col-md-10 col-md-offset-2">
                                    <label>
                                        <input type="checkbox" onclick="recommendCheck()" id="is_recommended_1" name="is_recommended_1"{{ old('is_recommended_1') || (old('title') == null && $data->is_recommended_1) ? ' checked' : '' }}> 推荐到当前页面
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="recommendImage" class="form-group{{ $errors->has('banner_image') ? ' has-error' : '' }}">
                            <label for="banner_image" class="col-md-2 control-label">"推荐"的封面图片*</label>

                            <div class="col-md-10">
                                <input id="banner_image" type="file" name="banner_image" accept="image/*">
                                <span class="help-block">尺寸为 320x150px.</span>
                                @if(isset($data->banner_image))
                                <img src="{{ Storage::url($data->banner_image) }}" alt="{{ $data->title }}的推荐到首页图片" style="max-width: 100%">
                                @endif

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
