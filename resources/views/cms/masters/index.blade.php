@extends('cms.layouts.app')

@section('title', '德之天才')

@section('content')
    <div class="container">
        <div class="row">
            @include('cms.partials.second-nav-bar', ['hero' => 'master'])

            <div class="col-sm-10">
                <div id="tool-bar">
                    <a type="button" class="btn btn-default" href="/masters/create">添加德之天才</a>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>姓名</th>
                                    <th>手机号码</th>
                                    <th>所在部门</th>
                                    <th>更多</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->m_id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->users->first()->phone_number or ''}}</td>
                                        <td>{{ $item->department->name }}</td>
                                        <td><a href="/masters/{{ $item->id }}">详情 &gt;</a></td>
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
