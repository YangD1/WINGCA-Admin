@extends('layouts.default')
@section('title','角色管理')
@section('pageHeader','系统设置')
@section('pageSmallHeader','角色管理')
@section('content')
<link rel="stylesheet" href="/statics/plugin/AdminLTE/plugins/iCheck/all.css">
<style>
 .icheckbox_flat-blue{
    margin-top: -4px;
 }
</style>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="btn-group">
                    <button type="button" data-toggle="modal" data-target="#menu-add" class="btn btn-success">添加角色</button>
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                </div>
                <small>&nbsp;&nbsp;&nbsp;&nbsp;Tip: 注意表单展示的时候根据宽度尺寸来隐藏一些显示内容</small>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-sm-12">
                        <table id="users" class="table table-bordered table-hover " >
                            <thead>
                                <tr role="row">
                                    <tr>
                                        <th rowspan="1" colspan="1">#</th>
                                        <th rowspan="1" colspan="1">角色名</th>
                                        <th rowspan="1" colspan="1">操作</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($key_data->get('datas') as $v)
                                <tr role="row" >
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->name }}</td>
                                    <td>
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-sm btn-warning" onclick="menu_info( {{ $v->id }} )" data-toggle="modal" data-target="#menu-info">查看</button>
                                          <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                          </button>
                                          <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" class="del-btn" data-id="{{ $v->id }}" data-toggle="modal" data-target="#menu-del">删除</a></li>
                                          </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $key_data->get('datas')->render() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- 添加弹窗 -->
<div class="modal fade" id="menu-add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">添加用户</h4>
      </div>
      <form method="post" action="{{ route('roles.store') }}">
      {{ csrf_field() }}
      <div class="modal-body">

            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>角色名:</label>
                    <input type="text" name="name" class="form-control" placeholder="角色权限组名称">
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>可操作栏目:</label>
                    <br>
                    <div class="col-sm-12 menu-group" >
                        @foreach( $key_data->get('all_menus') as $v )
                            <div class="menu-group-checkbox">
                                <div class="menu-group-item">
                                    <input type="checkbox" class="flat-menu" value="{{ $v->id }}" name="access_menus_id[]">
                                    <label>{{ $v->name }}</label>
                                </div>
                                @if(!$v->child_menus->isEmpty())
                                    @for ($i = 0; $i < $v->child_menus->count(); $i++)
                                    <div class="menu-group-item menu-child-item">
                                        <input type="checkbox" value="{{ $v->child_menus[$i]->id }}" class="flat-menu" name="access_menus_id[]">
                                        <label>{{ $v->child_menus[$i]->name }}</label>
                                    </div>
                                    @endfor
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-primary">添加</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- 查看/修改 弹窗 -->
<div class="modal fade" id="menu-info">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">【菜单信息】</h4>
      </div>
      <form method="POST" action="{{ route('roles.update') }}">
      {{ method_field('PATCH') }}
      {{ csrf_field() }}
      <div class="modal-body">
            <div class="form-group">
                <input type="hidden" name="id" value="">
            </div>

            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>名称:</label>
                    <input type="text" name="name" class="form-control" placeholder="菜单名称">
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>可操作栏目:</label>
                    <br>
                    <div class="col-sm-12 menu-group" >
                        @foreach( $key_data->get('all_menus') as $v )
                            <div class="menu-group-checkbox">
                                <div class="menu-group-item">
                                    <input type="checkbox" class="flat-menu" value="{{ $v->id }}" name="access_menus_id[]" >
                                    <label>{{ $v->name }}</label>
                                </div>
                                @if( !$v->child_menus->isEmpty() )
                                
                                    @foreach( $v->child_menus as $k => $val )
                                        <div class="menu-group-item menu-child-item">
                                            <i class="fa fa-arrow-up"></i>
                                            <input type="checkbox" value="{{ $val->id }}" class="flat-menu" name="access_menus_id[]">
                                            <label>{{ $val->name }}</label>
                                        </div>
                                        @if( !$val->son_menus->isEmpty() )
                                            @foreach ( $val->son_menus as $key => $value )
                                            <div class="menu-group-item menu-son-item">
                                            <i class="fa fa-ellipsis-v" style="margin-right: 9px"></i>
                                            <i class="fa fa-arrow-up"></i>
                                                <input type="checkbox" value="{{ $value->id }}" class="flat-menu" name="access_menus_id[]">
                                                <label>{{ $value->name }}</label>
                                            </div>
                                            @endforeach
                                        @endif
                                    @endforeach
                                    
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-success">更新</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- 删除弹窗 -->
<div class="modal fade" id="menu-del">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">警告信息！</h4>
      </div>
      <div class="modal-body">
      <form method="post" action="{{ route('roles.destroy') }}">
          <input type="hidden" name="id" value="">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
        <p>确定删除该角色么，相关功能和模型可能无法使用。</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-danger" >确认删除</button>
      </div>
     </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="/statics/plugin/AdminLTE/plugins/iCheck/icheck.min.js"></script>

<script>

$('.del-btn').click(function(){
    $('#menu-del').find("input[name='id']").val($(this).data('id'));
});

// 查看菜单项目
let menu_info = function(id){
    $.ajax({
        url: "{{ route('roles.info') }}",
        data: {id: id},
        type: "POST",
        beforeSend: function(){
            $('.pop-background').css('display','flex');
        },
        success: function(data){
            data = JSON.parse(data);
            console.log(data);
            option_value = "option[value='"+data.parent_id+"']";
            $('#menu-info').find("input[name='id']").val(data.id);
            $('#menu-info').find("input[name='name']").val(data.name);
            // 默认选中checkbox的默认值
            $('#menu-info .menu-group .menu-group-item').find('input').iCheck('uncheck');
            $('#menu-info .menu-group .menu-group-item').each(function(){
                var that = $(this).find('input');
                for(var i = 0 ; i < data.access_menus_id.length ; i++){
                    if(that.val() == data.access_menus_id[i]){
                        that.iCheck('check');
                    }
                }
            });
            
            $('.pop-background').css('display','none');
        }
    });
}

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

$('input[type="checkbox"].flat-menu, input[type="radio"].flat-menu').iCheck({
    checkboxClass: 'icheckbox_flat-blue', 
    radioClass: 'iradio_flat-blue' 
});
</script>

@stop
