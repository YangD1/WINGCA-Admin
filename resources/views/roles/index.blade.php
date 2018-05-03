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
                <button type="button" onclick="_add()" class="btn btn-success">添加角色</button>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="users" class="table table-bordered table-hover " > 
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1">角色名</th>
                        <th rowspan="1" colspan="1">操作</th>
                        @foreach($key_data->get('datas') as $v)
                        <tr role="row" >
                            <td>{{ $v->id }}</td>
                            <td>{{ $v->name }}</td>
                            <td style="min-width: 88px">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-warning" onclick="_update( {{ $v->id }} )" >查看</button>
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
                </div>
                {!! $key_data->get('datas')->render() !!}
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
      <form method="POST" action="{{ route('roles.update') }}">
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
                    <label>可操作栏目:</label>
                    <br>
                    <div class="col-sm-12 menu-group" >
                        @foreach( $key_data->get('all_menus') as $v )
                            <div class="menu-group-checkbox">
                                <div class="menu-group-item">
                                    <input type="checkbox" class="flat-menu" data-lv="{{ $v->menu_lv }}" value="{{ $v->id }}" name="access_menus_id[]" >
                                    <label>{{ $v->name }}</label>
                                </div>
                                @if( !$v->child_menus->isEmpty() )
                                    @foreach( $v->child_menus as $k => $val )
                                    <div class="child-menu-box">
                                        <div class="menu-group-item menu-child-item">
                                            <i class="fa fa-arrow-up"></i>
                                            <input type="checkbox" value="{{ $val->id }}" data-lv="{{ $val->menu_lv }}" class="flat-menu" name="access_menus_id[]">
                                            <label>{{ $val->name }}</label>
                                        </div>
                                        @if( !$val->son_menus->isEmpty() )
                                            @foreach ( $val->son_menus as $key => $value )
                                            <div class="menu-group-item menu-son-item">
                                            <i class="fa fa-ellipsis-v" style="margin-right: 9px"></i>
                                            <i class="fa fa-arrow-up"></i>
                                                <input type="checkbox" value="{{ $value->id }}" data-lv="{{ $value->menu_lv }}" class="flat-menu" name="access_menus_id[]">
                                                <label>{{ $value->name }}</label>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
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

//  vue 对象
let appData = new Vue({
    el: "#main-modal",
    data: {
        object: {
            id: "", 
            name: "",
        }
    }
});


//公用modal
let mel = $('#main-modal');

// 查看菜单项目
let _update = function(id){
    $.ajax({
        url: "{{ route('roles.info') }}",
        data: {id: id},
        type: "POST",
        beforeSend: function(){
            $('.pop-background').css('display','flex');
        },
        success: function(data){
            // 设置vue对象
            Vue.set(appData,'object',data); 
            // 修改公用modal title
            mel.find('.modal-title').text(`管理 ${data.name}`);
            // 修改公用modal表单提交地址
            mel.find('form').attr('action',"{{ route('roles.update') }}");
            // 模拟 patch 请求方式
            mel.find('form').append(`{{ method_field('patch') }}`);
            // 默认选中checkbox的默认值
            option_value = "option[value='"+data.parent_id+"']";
            $('#main-modal .menu-group .menu-group-item').find('input').iCheck('uncheck');
            $('#main-modal .menu-group .menu-group-item').each(function(){
                var that = $(this).find('input');
                for(var i = 0 ; i < data.access_menus_id.length ; i++){
                    if(that.val() == data.access_menus_id[i]){
                        that.iCheck('check');
                    }
                }
            });
            mel.modal(); 
            $('.pop-background').css('display','none');
        }
    });
}

// 添加 modal
let _add = function(id){
    console.log('点击了modal');
    // 修改公用modal title
    mel.find('.modal-title').text('添加角色');
    // 修改公用modal表单提交地址
    mel.find('form').attr('action',"{{ route('roles.create') }}");
    // 去除提交方式input
    mel.find('form input[name="_method"]').remove();
    // 去除选中的checkbox
    mel.find('input').iCheck('uncheck');
    // 清空 vue 对象中的数据
    let data = {};
    Vue.set(appData,'object',data); 
    mel.modal(); 
}

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

$('input[type="checkbox"].flat-menu, input[type="radio"].flat-menu').iCheck({
    checkboxClass: 'icheckbox_flat-blue', 
    radioClass: 'iradio_flat-blue' 
});

$('input').on('ifChecked', function(event){
    switch ($(this).data('lv')) {
        case 3:
            $(this).parents('.menu-group-checkbox').find('input[data-lv="1"]').iCheck('check');
            $(this).parents('.child-menu-box').find('input[data-lv="2"]').iCheck('check');
            break;
        case 2:
            $(this).parents('.menu-group-checkbox').find('input[data-lv="1"]').iCheck('check');
            break;
        default:
            break;
    }
});

$('input').on('ifUnchecked', function(event){
    switch ($(this).data('lv')) {
        case 2:
            $(this).parents('.child-menu-box').find('input').iCheck('uncheck');
            break;
        case 1:
            $(this).parents('.menu-group-checkbox').find('input').iCheck('uncheck');
            break;
        default:
            break;
    }
});
</script>

@stop
