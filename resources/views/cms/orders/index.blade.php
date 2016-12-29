@extends('cms.layouts.app')

@section('title', '预约单')

@section('content')
    <div class="container">
        <div class="row">
            @include('cms.partials.second-nav-bar', ['hero' => 'order'])

            <div class="col-sm-10">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>患者姓名</th>
                                    <th>手机号码</th>
                                    <th>所患疾病</th>
                                    <th>预约医院</th>
                                    <th>预约医生</th>
                                    <th>时间</th>
                                    <th>更多</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->patient_name }}</td>
                                        <td>{{ $item->phone_number }}</td>
                                        <td>{{ $item->instance ? $item->instance->name : '' }}</td>
                                        <td>{{ $item->hospital ? $item->hospital->name : ($item->doctor ? $item->doctor->hospital->name : '') }}</td>
                                        <td>{{ $item->doctor ? $item->doctor->name : '' }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td><a href="/orders/{{ $item->id }}">详情 &gt;</a></td>
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
