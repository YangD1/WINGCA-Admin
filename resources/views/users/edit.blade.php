@extends('layouts.default')
@section('title','个人信息')
@section('pageHeader','')
@section('pageSmallHeader','')
@section('content')
<link rel="stylesheet" href="/statics/plugin/dropzone/dropzone.min.css">
<style>
    .dropzone{ padding: 0; border: 1px solid #d2d6de}
    .dz-image img{ width: 100% }
</style>
   <div class="row">
    <div class="col-sm-3"></div>
        <div class="col-sm-6">
        <div class="box">
        <div class="box-header with-border" style="cursor: move;">
            <i class="fa fa-black-tie"></i>
                <h3 class="box-title">个人信息</h3>
            </div>
            <div id="avatar_path" style="display: none;">
                <div id="preview-template">
                    <img data-dz-thumbnail src="{{ $key_data->get('data')->avatar_path }}" alt="">
                </div>
            </div>
            <form method="post" action="{{ route('user.update',$key_data->get('data')->id) }}" class="psersonal-form">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
            <div class="box-body">
                    <div class="form-group">
                       <label class="col-sm-3 control-label">头像：</label> 
                       <div class="col-sm-4">
                        <p id="material_path" class="dropzone needsclick dz-clickable"></p>
                       </div>
                    </div>
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

<script src="/statics/plugin/dropzone/dropzone.min.js"></script>
<script>
    var _method = $('meta[name="csrf-token"]').attr('content')
    Dropzone.autoDiscover = false;
    $("#material_path").dropzone({
        url: "{{ route('file_upload') }}",
        headers: {
        'X-CSRF-TOKEN': _method
        },
        acceptedFiles: 'image/*,.zip,.rar,.doc,.docx',
        maxFile: 1,
        clickable: true,
        init: function() {
            $('#material_path .dz-default').html(`<img data-dz-thumbnail src="{{ $key_data->get('data')->avatar_path }}">`);
        },
        drop: function() {
            $("input[type='submit']").attr("disabled",true);
        },
        success: function (i, data) {
            toastr.success('上传成功');
            $('#material_path').append(`
                <input type='hidden' name='avatar_path' value='${data}'>
            `);
            $("input[type='submit']").attr("disabled",false);
        },
        error: function () {
            toastr.warning('上传失败');
        }
    });
</script>
@stop
