@extends('cms.layouts.app')

@section('title', '评论')

@section('content')
    <div class="container">
        <div class="row">
            @include('cms.partials.second-nav-bar', ['hero' => 'review'])

            <div class="col-sm-10">
                <div id="tool-bar">
                    <form class="form-inline" action="{{ url('reviews/search') }}" method="get">
                        <div class="form-group">
                            <label for="q" class="sr-only">搜索</label>
                            <input class="form-control" type="search" name="q" placeholder="搜索">
                        </div>

                        <button type="submit" class="btn btn-default">搜索</button>
                    </form>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>患者</th>
                                    <th>医生</th>
                                    <th>评级</th>
                                    <th>评论</th>
                                    <th>评论时间</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->patient->name }}</td>
                                        <td>{{ $item->doctor->name }}</td>
                                        <td>{{ $item->ratings }}</td>
                                        <td>{{ str_limit($item->reviews, 40) }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td><a href="/reviews/{{ $item->id }}">详情 &gt;</a></td>
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
