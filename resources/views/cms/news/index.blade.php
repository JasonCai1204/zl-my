@extends('cms.layouts.app')

@section('title', '文章')

@section('content')
    <div class="container">
        <div class="row">
            @include('cms.partials.second-nav-bar', ['hero' => 'news'])

            <div class="col-sm-10">
                <div id="tool-bar">
                    <a type="button" class="btn btn-default" href="/news/create">添加文章</a>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>标题</th>
                                    <th>文章类别</th>
                                    <th>时间</th>
                                    <th>发布</th>
                                    <th>更多</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ str_limit($item->title, 40) }}</td>
                                        <td>{{ $item->news_class->name or '' }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        {{--<td>{{ $item->is_recommended ? '✓' : '' }}</td>--}}
                                        {{--<td>{{ $item->is_recommended_1 ? '✓' : '' }}</td>--}}
                                        <td>{{ $item->published_at ? '✓' : '' }}</td>
                                        <td><a href="/news/{{ $item->id }}">详情 &gt;</a></td>
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
