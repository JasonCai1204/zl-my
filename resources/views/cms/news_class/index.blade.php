@extends('cms.layouts.app')

@section('title', '添加文章类别')

@section('content')
    <div class="container">
        <div class="row">
            @include('cms.partials.second-nav-bar', ['hero' => 'news_class'])

            <div class="col-sm-10">
                <div id="tool-bar">
                    <a type="button" class="btn btn-default" href="/news_class/create">添加文章类别</a>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>名称</th>
                                    <th>所属类别</th>
                                    <th>排序</th>
                                    <th>更多</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>

                                        @if($item->type == 1)
                                            <td> 资讯 </td>
                                        @endif

                                        @if($item->type == 2)
                                            <td> 指南 </td>
                                        @endif

                                        <td>{{ $item->sort }}</td>
                                        <td><a href="/news_class/{{ $item->id }}">详情 &gt;</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
