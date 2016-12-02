@extends('cms.layouts.app')

@section('title', $data->patient_name . '的病例相关资料')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $data->patient_name }}的病例相关资料</div>

                <div class="panel-body">
                    @foreach ($data->photos ?: [] as $photo)
                        <a href="{{ Storage::url($photo) }}" target="_blank">
                            <img src="{{ Storage::url($photo) }}" alt="{{ $data->patient_name }} 的病例相关资料" style="max-width: 200px; max-height: 200px" >
                        </a>
                    @endforeach

                    <hr>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/orders/' . $data->id . '/photos') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('photos') || $errors->has('photos.0') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="photos">添加更多资料</label>

                            <div class="col-md-6">
                                <input id="photos" type="file" accept="image/*" name="photos[]" multiple>
                                <span class="help-block">支持多图上传；尺寸大于 50x50px。</span>

                                @if ($errors->has('photos'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photos') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('photos.0'))
                                    <span class="help-block">
                                        <strong>图片尺寸太小，请选择更大的图片。</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
