@extends('layouts.default')
@section('title','用户管理')
@section('pageHeader','系统设置')
@section('pageSmallHeader','用户管理')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <button type="button" onclick="_add()" class="btn btn-success">添加用户</button>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="users" class="table table-bordered table-hover " >
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1">用户名</th>
                        <th rowspan="1" colspan="1">e-mail</th>
                        <th rowspan="1" colspan="1">当前权限</th>
                        <th rowspan="1" colspan="1">操作</th>
                        @foreach($key_data->get('datas') as $v)
                        <tr role="row" >
                            <td>{{ $v->id }}</td>
                            <td>{{ $v->name }}</td>
                            <td>{{ $v->email }}</td>
                            <td>{!! $v->role or "没有选择角色" !!}</td>
                            <td style="min-width: 88px">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-warning" onclick="_info( {{ $v->id }} )" >查看</button>
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
                    </table>
                    {!! $key_data->get('datas')->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>


<!-- 查看/修改 弹窗 -->
<div class="modal fade" id="main-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <form method="POST" action="{{ route('users.update') }}">
      {{ method_field('PATCH') }}
      {{ csrf_field() }}
      <div class="modal-body">
            <div class="form-group">
                <input type="hidden" name="id" v-bind:value="object.id">
            </div>

            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>名称:</label>
                    <input type="text" name="name" v-bind:value="object.name" class="form-control" placeholder="菜单名称">
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <label>email:</label>
                    <input type="text" name="email" v-bind:value="object.email" class="form-control" disabled="true" placeholder="登录邮箱">
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
        <button type="submit" class="btn btn-success">提交</button>
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

// vue 对象 
let appData = new Vue({
    el: "#main-modal",
    data: {
        object: {
            id: "", 
            name: "",
            email: "" 
        }
    }
});

// 公用 modal
let mel = $('#main-modal');

// 查看菜单项目
let _info = function(id){
    $.ajax({
        url: "{{ route('users.info') }}",
        data: {id: id},
        type: "POST",
        beforeSend: function(){
            $('.pop-background').css('display','flex');
        },
        success: function(data){
            // 修改公用modal title
            mel.find('.modal-title').text(`管理 ${data.name}`);
            // 修改公用modal表单提交地址
            mel.find('form').attr('action',"{{ route('users.update') }}");
            // 查看/更新用户禁用 email  input 
            mel.find('input[name="email"]').attr('disabled',true);
            // 模拟 patch 请求方式
            mel.find('form').append(`{{ method_field('patch') }}`);
            // 设置 vue 对象
            Vue.set(appData,'object',data); 
            // 默认选中option和select2的默认值
            let option_value = "option[value='"+data.role_id+"']";
            mel.find(option_value).attr('selected',true);
            $('#menu-update-select').select2("val",[data.role_id]);
            mel.modal();
            $('.pop-background').css('display','none');
        }
    });
}

// 添加项目
let _add = function()
{
    // 修改公用modal title
    mel.find('.modal-title').text('添加用户');
    // 修改公用modal表单提交地址
    mel.find('form').attr('action',"{{ route('users.create') }}");
    // 添加用户去除邮箱的 hidden
    mel.find('input[name="email"]').attr('disabled',false);
    // 去除提交方式input
    mel.find('form input[name="_method"]').remove();
    // 重置 select 的选择
    mel.find('option').eq(0).attr('seleted',true);
    $('#menu-update-select').select2("val",[0]);
    // 清空 vue 对象中的数据
    let data = {};
    Vue.set(appData,'object',data); 

    mel.modal();
}

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

@stop
