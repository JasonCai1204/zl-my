@extends('cms.layouts.app')

@section('title', '医生')

@section('content')
    <div class="container">
        <div class="row">
            @include('cms.partials.second-nav-bar', ['hero' => 'doctor'])

            <div class="col-sm-10">
                <div id="tool-bar">
                    <a type="button" class="btn btn-default" href="/doctors/create">添加医生</a>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>姓名</th>
                                    <th>职称</th>
                                    <th>手机号码</th>
                                    <th>所在医院</th>
                                    <th>签约</th>
                                    <th>推荐</th>
                                    <th>更多</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->grading }}</td>
                                        {{--<td>{{$item->users}}</td>--}}
                                        <td>{{$item->users->first()->phone_number or ''}}</td>
                                        <td>{{ $item->hospital->name }}</td>
                                        <td>{{ $item->is_certified ? '✓' : '' }}</td>
                                        <td>{{ $item->is_recommended ? '👍' : '' }}</td>
                                        <td><a href="/doctors/{{ $item->id }}">详情 &gt;</a></td>
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
