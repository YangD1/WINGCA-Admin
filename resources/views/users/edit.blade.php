@extends('layouts.default')
@section('title','个人信息')
@section('pageHeader','')
@section('pageSmallHeader','')
@section('content')
   <div class="row">
    <div class="col-sm-3"></div>
        <div class="col-sm-6">
        <div class="box">
        <div class="box-header with-border" style="cursor: move;">
            <i class="fa fa-black-tie"></i>
                <h3 class="box-title">个人信息</h3>
            </div>
            <form method="post" action="{{ route('user.update',$key_data->get('data')->id) }}" class="psersonal-form">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
            <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">姓名：</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="name" type="text" value="{{ $key_data->get('data')->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">邮箱：</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" value="{{ $key_data->get('data')->email }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">新密码：</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="password" placeholder="输入新密码" type="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">确认新密码：</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="password_confirmation" placeholder="确认新密码" type="password">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 0">
                        <label class="col-sm-3 control-label">我的当前身份：</label>
                        <div class="col-sm-6">
                           &nbsp;&nbsp;&nbsp;&nbsp;{{ Auth::user()->role_name() }}
                        </div>
                    </div>
                    
            </div>
                <div class="box-footer">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6" style="text-align: right">
                        <input type="submit" class="btn btn-primary" value="提交更新">
                    </div>
                </div>
            </form>
        </div>  
        </div>
    <div class="col-xs-3"></div>
   </div> 
@stop
