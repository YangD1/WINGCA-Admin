@extends('layouts.default')
@section('title','用户管理')
@section('pageHeader','系统设置')
@section('pageSmallHeader','用户管理')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="btn-group">
                    <button type="button" data-toggle="modal" data-target="#menu-add" class="btn btn-success">添加用户</button>
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
                                        <th rowspan="1" colspan="1">用户名</th>
                                        <th rowspan="1" colspan="1">e-mail</th>
                                        <th rowspan="1" colspan="1">当前权限</th>
                                        <th rowspan="1" colspan="1">操作</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($key_data->get('datas') as $v)
                                <tr role="row" >
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->name }}</td>
                                    <td>{{ $v->email }}</td>
                                    <td>{!! $v->role or "没有选择角色" !!}</td>
                                    <td>
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-sm btn-warning" onclick="menu_info( {{ $v->id }} )" >查看</button>
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
      <form method="post" action="{{ route('users.store') }}">
      {{ csrf_field() }}
      <div class="modal-body">

            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>姓名:</label>
                    <input type="text" name="name" class="form-control" placeholder="姓名">
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>email:</label>
                    <input type="text" name="email" class="form-control" placeholder="填写登录邮箱，不可修改请谨慎填写">
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>密码：</label>
                    <input type="password" name="password" class="form-control" placeholder="填写最少六位数的密码">
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>确认密码：</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="填写最少六位数的密码">
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>用户权限:</label>
                    <br>
                    <div class="col-sm-6" style="padding: 0">
                        <select class="js-example-basic-single" name="role_id">
                            <option value="0">没有选择角色</option>
                            @foreach($key_data->get('role_datas') as $v)
                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                            @endforeach
                        </select>
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
        <h4 class="modal-title">【菜单名称】</h4>
      </div>
      <form method="POST" action="{{ route('users.update') }}">
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
                    <label>email:</label>
                    <input type="text" name="email" class="form-control" disabled="true" placeholder="登录邮箱">
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>新密码: </label>
                    <input type="password" name="password" class="form-control" placeholder="新密码">
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>确认新密码：</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="确认新密码">
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>权限分配:</label>
                    <br>
                    <div class="col-sm-6" style="padding: 0">
                        <select class="js-example-basic-single" id='menu-update-select' name="role_id">
                            <option value="0">没有选择角色</option>
                            @foreach($key_data->get('role_datas') as $v)
                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                            @endforeach
                        </select>
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
      <form method="post" action="{{ route('users.destroy') }}">
          <input type="hidden" name="id" value="">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
        <p>确定删除此用户么？</p>
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



<script>

$('.del-btn').click(function(){
    $('#menu-del').find("input[name='id']").val($(this).data('id'));
});

// 查看菜单项目
let menu_info = function(id){
    $.ajax({
        url: "{{ route('users.info') }}",
        data: {id: id},
        type: "POST",
        beforeSend: function(){
            $('.pop-background').css('display','flex');
        },
        success: function(data){
            data = JSON.parse(data);
            option_value = "option[value='"+data.role_id+"']";
            $('#menu-info').find("input[name='id']").val(data.id);
            $('#menu-info').find("input[name='name']").val(data.name);
            $('#menu-info').find("input[name='email']").val(data.email);
            // 默认选中option和select2的默认值
            $('#menu-info').find(option_value).attr('selected',true);
            $('#menu-update-select').select2("val",[data.role_id]);
            $('#menu-info').modal();
            $('.pop-background').css('display','none');
        }
    });
}

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

@stop
