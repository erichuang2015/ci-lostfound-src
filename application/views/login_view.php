<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 login-container">
			<div class="col-md-12 form-horizontal">
				
				<form id="login-form">
				<div class="form-group">
					<label class="control-label col-md-3">用户名:</label>
					<div class="col-md-6">
						<input type="text" id="username" class="form-control" placeholder="登录的时候的用户名">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">密码:</label>
					<div class="col-md-6">
						<input type="password" id="password" class="form-control" placeholder="用户密码">
					</div>
				</div>
				

				<div class="form-group">
					<div class="col-md-6 col-md-offset-3">
						<button type="button" id="login-btn" class="btn btn-primary btn-block">登录</button>
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
		   theme:'Default',mode:'AutoTip',formID:"login-form",debug:true,submitOnce:true,onSuccess:function(){
				   login();
				   //console.log('sss');
			       return false;
			},onError:function(msg){
		}});
		$("#username").formValidator({onFocus:"用户名必须为6位数字或者英文字母下划线",onCorrect:"输入正确"}).inputValidator({min:6,max:30,onError:"你输入的长度不正确,请确认"});
	});
	$('#login-btn').click(function(){login()});
	$(document).keypress(function(e){
			if (e.which == 13){
				login();
			}
		});
	function login(){
		var parms = {};
		parms.password = $.trim($('#password').val());
		parms.username = $.trim($('#username').val());
		var url = "<?php echo site_url('Login/login');?>";
		//console.log(parms);
		$.post(url,parms,function(data){
			//console.log(data);
			var rs = JSON.parse(data);
			if (rs.status==1){
				//alert('注册成功!');
				$.messager.popup('登录成功!');
				location.href="<?php echo site_url('Home/index');?>";
			}else if(rs.status==-2){
				//alert('注册失败!');
				$.messager.popup('用户名不存在');
			}else{
				$.messager.popup('密码错误!');
			}
		});
	}
</script>