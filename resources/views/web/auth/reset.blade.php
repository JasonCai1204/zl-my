@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">修改密码</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('account/password/reset') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ isset($myErrors['current_password']) ? ' has-error' : '' }}">
                            <label for="current_password" class="col-md-4 control-label">当前密码</label>

                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control" name="current_password"  autofocus>

                                @if (isset($myErrors['current_password']))
                                    <span class="help-block">
                                        <strong>{{ $myErrors['current_password'][0] }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ isset($myErrors['password']) ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">新密码</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >

                                @if (isset($myErrors['password']))
                                    <span class="help-block">
                                        <strong>{{ $myErrors['password'][0] }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">确认密码</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    保存
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
