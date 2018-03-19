<div class="container">
	<div class="row">
	<br/>

		<div class="col-md-6 col-md-offset-1">
			<div class="col-md-12 form-horizontal">
				<h1 align="center">密码修改</h1>
				<span></span>
				<form id="changePass-form">
				<div class="form-group">
					<label class="control-label col-md-3">原密码:</label>
					<div class="col-md-6">
						<input type="password" id="password" class="form-control" placeholder="原密码">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">新密码:</label>
					<div class="col-md-6">
						<input type="password" id="old_password" class="form-control" placeholder="新密码">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">重复密码:</label>
					<div class="col-md-6">
						<input type="password" id="repassword" class="form-control" placeholder="再次输入新密码">
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-3">
						<button type="button" id="changePass-btn" class="btn btn-primary btn-block">确认修改</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$.formValidator.initConfig({
		   theme:'Default',mode:'AutoTip',formID:"changePass-form",debug:true,submitOnce:true,onSuccess:function(){
				   changePass();
				   //console.log('sss');
			       return false;
			},onError:function(msg){
		}});
		//$("#password").formValidator({onFocus:"密码必须为6位或以上数字或者英文字母下划线字符",onCorrect:"输入正确"}).inputValidator({min:6,max:30,onError:"你输入的长度不正确,请确认"});
		//$("#repassword").formValidator({onFocus:"密码必须为6位或以上数字或者英文字母下划线字符",onCorrect:"输入正确"}).inputValidator({min:6,max:30,onError:"你输入的长度不正确,请确认"});
		//$("#old_password").formValidator({onFocus:"密码必须为6位或以上数字或者英文字母下划线字符",onCorrect:"输入正确"}).inputValidator({min:6,max:30,onError:"你输入的长度不正确,请确认"});
	});
	
	function changePass(){
		var parms = {};
		parms.old_password = $.trim($('#old_password').val());
		parms.password = $.trim($('#password').val());
		parms.repassword = $.trim($('#repassword').val());
		if (parms.repassword != parms.password){
			$.messager.popup('两次密码不一样');
			$('#repassword').focus();
		}
		var url = "<?php echo site_url('User/change_pass');?>";
		//console.log(parms);
		$.post(url,parms,function(data){
			//console.log(data);
			var rs = JSON.parse(data);
			if (rs.status==1){
				$.messager.popup('修改成功!');
				location.href="<?php echo site_url('Home/personCenter').'basicInfo';?>";
			}else if(rs.status==-2){
				//alert('注册失败!');
				$.messager.popup('两次密码不一样');
				$('#repassword').focus();
			}else if(rs.status==-3){
				$.messager.popup('原密码错误!');
				$('#old_password').focus();
			}else{
				$.messager.popup('操作失败');
			}
		});
	}
</script>