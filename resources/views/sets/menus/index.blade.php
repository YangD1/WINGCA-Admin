@extends('layouts.default')
@section('title',$title)
@section('pageHeader','设置')
@section('pageSmallHeader','菜单管理')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="btn-group">
                    <button type="button" class="btn btn-success">添加菜单</button>
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-sm-12">
                        <table id="menus" class="table table-bordered table-hover " >
                            <thead>
                                <tr role="row">
                                    <tr>
                                        <th rowspan="1" colspan="1">#</th>
                                        <th rowspan="1" colspan="1">菜单名称</th>
                                        <th rowspan="1" colspan="1">url</th>
                                        <th rowspan="1" colspan="1">父级栏目</th>
                                        <th rowspan="1" colspan="1">icon</th>
                                        <th rowspan="1" colspan="1">操作</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $v)
                                <tr role="row" >
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->name }}</td>
                                    <td>{{ $v->url }}</td>
                                    <td>{{ $v->parent_id }}</td>
                                    <td><i class="fa fa-{{ $v->icon }}"></i> {{ $v->icon }}</td>
                                    <td style="text-align: center">
                                        <button class="btn btn-sm btn-warning">查看/修改</button>
                                        <button class="btn btn-sm btn-danger">删除</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $datas->render() !!}
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>@stop
