@extends('cms.layouts.app')

@section('title', '城市')

@section('content')
    <div class="container">
        <div class="row">
            @include('cms.partials.second-nav-bar', ['hero' => 'city'])

            <div class="col-sm-10">
                <div id="tool-bar">
                    <a type="button" class="btn btn-default" href="/cities/create">添加城市</a>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>名称</th>
                                    <th>更多</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td><a href="/cities/{{ $item->id }}">详情 &gt;</a></td>
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
