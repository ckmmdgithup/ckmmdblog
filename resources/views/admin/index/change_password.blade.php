@extends('admin.layouts.popboxpublic')

@section('title','管理员密码修改')
@section('keywords','ckmmdkeywords')
@section('description','ckmmddescription')
@section('main')
	<article class="page-container">
		<form action="" method="post" class="form form-horizontal" id="change_password">
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>原密码：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="password" class="input-text" value="" placeholder="" id="old_password" name="old_password">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>新密码：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="password" class="input-text" value="" placeholder="" id="new_password" name="new_password">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认新密码：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="password" class="input-text" value="" placeholder="" id="confim_password" name="confim_password">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">备注：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<textarea name="beizhu" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" onKeyUp="$.Huitextarealength(this,100)"></textarea>
					<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
				</div>
			</div>
			<div class="row cl">
				<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
					<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
				</div>
			</div>
		</form>
	</article>
@endsection
@section('script')

	<script type="text/javascript">
		$(function(){
			$('.skin-minimal input').iCheck({
				checkboxClass: 'icheckbox-blue',
				radioClass: 'iradio-blue',
				increaseArea: '20%'
			});

			$("#change_password").validate({
				rules:{
					old_password:{
						required:true,
						minlength:6,
						maxlength:18
					},
					new_password:{
						required:true,
						minlength:6,
						maxlength:18,

					},
					confim_password:{
						required:true,
						minlength:6,
						maxlength:18,
						equalTo:'#new_password'
					},

				},
				onkeyup:false,
				focusCleanup:true,
				success:"valid",
				submitHandler:function(form){
					//$(form).ajaxSubmit();
					var index = $(form).ajaxSubmit(
							{
								type:'post',
								url:'{{url('admin/change_password')}}',
								data:{
									'_token':'{{csrf_token()}}'
								},
								success: function (result) {
									if (result['status']==0){
											layer.msg(
													result['msg'],{icon:2},function () {
														window.location.reload();
													}
											);
									} else {
										layer.msg(
												result['msg'],{icon:1},function () {
													top.location.reload();
													  // var index =parent.layer.getFrameIndex(window.name);
													  // parent.layer.close(index);
													  //

												}
										);
									}
								}
							}
					)
					//parent.$('.btn-refresh').click();

				}
			});
		});
	</script>

@endsection