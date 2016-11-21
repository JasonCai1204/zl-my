@extends('cms.layouts.app')

@section('title', '内容管理系统')

@section('content')
<div class="container">
    <div class="row">
        @include('cms.partials.second-nav-bar')

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    请选择左侧菜单来查看或操作相应信息。
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
