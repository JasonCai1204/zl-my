@extends('cms.layouts.app')

@section('title', $data->patient_name . '的病情报告')

@section('css')
    <link href="/css/cms/simditor.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $data->patient_name }}的病情报告</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/orders/' . $data->id . '/condition-report') }}">
                        {{ csrf_field() }}

                        <textarea id="editor" name="condition_report" data-path="order/condition-report" autofocus>{{ $data->condition_report }}</textarea>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="send_to_the_doctor_at" name="send_to_the_doctor_at"{{ $data->send_to_the_doctor_at ? ' checked' : '' }}> 发送给医生
                            </label>
                        </div>

                        <div style="margin-top: 5px">
                            <button type="submit" class="btn btn-primary">保存</button>
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
