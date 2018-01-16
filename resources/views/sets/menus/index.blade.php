@extends('layouts.default')
@section('title',$title)
@section('pageHeader','系统设置')
@section('pageSmallHeader','菜单管理')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="btn-group">
                    <button type="button" data-toggle="modal" data-target="#modal-add" class="btn btn-success">添加菜单</button>
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
                <small>&nbsp;&nbsp;&nbsp;&nbsp;Tip: 注意表单展示的时候根据宽度尺寸来隐藏一些显示内容</small>
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
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-sm btn-warning">查看</button>
                                          <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                          </button>
                                          <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" data-toggle="modal" data-target="#modal-default">删除</a></li>
                                          </ul>
                                        </div>
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
</div>

<!-- 删除弹窗 -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">警告信息！</h4>
      </div>
      <div class="modal-body">
        <p>确定删除这个菜单么，相关功能和模型可能无法使用。</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary">确认删除</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- 添加弹窗 -->
<div class="modal fade" id="modal-add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">添加菜单</h4>
      </div>
      <form action="">
      <div class="modal-body">

            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>名称:</label>
                    <input type="text" class="form-control" placeholder="菜单名称">
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>名称:</label>
                    <input type="text" class="form-control" placeholder="菜单名称">
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>名称:</label>
                    <input type="text" class="form-control" placeholder="菜单名称">
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>名称:</label>
                    <input type="text" class="form-control" placeholder="菜单名称">
                </div>
                <div class="col-sm-1"></div>
            </div>
            <!-- <div class="form-group">
                <label>url:</label>
                <input type="text" class="form-control" placeholder="菜单名称">
            </div>
            <div class="form-group">
                <label>菜单设置:</label>
                <input type="text" class="form-control" placeholder="菜单名称">
            </div>
            <div class="form-group">
                <label>icon:</label>
                <input type="text" class="form-control" placeholder="菜单名称">
            </div> -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary">添加</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
$(function(){
    $.ajax({
        url: "",
        data: {},
        success: function(data){

        }
    });
});
</script>


@stop
