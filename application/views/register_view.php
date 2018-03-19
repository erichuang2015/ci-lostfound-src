<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="col-md-12 lf-register-panel form-horizontal">
				<div class="form-group">
					<div class="col-md-12 text-center">
						<h1>欢迎注册找回网</h1>
						<hr>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">昵称:</label>
					<div class="col-md-6">
						<input id="nickname" type="text" class="form-control" placeholder="最好是您的实际姓名">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">用户名:</label>
					<div class="col-md-6">
						<input id="username" type="text" class="form-control" placeholder="登录的时候的用户名">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">密码:</label>
					<div class="col-md-6">
						<input type="password" id="password" class="form-control" placeholder="用户密码">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">重复密码:</label>
					<div class="col-md-6">
						<input type="password" id="confirmpassword" class="form-control" placeholder="重新输入一遍密码">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3">联系电话:</label>
					<div class="col-md-6">
						<input type="text" id="mobile" class="form-control" placeholder="请提供有效的联系电话">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">邮箱:</label>
					<div class="col-md-6">
						<input type="text" id="email" class="form-control" placeholder="常用邮箱">
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-3">
						<button type="button" id="register-btn" class="btn btn-primary btn-block">注册</button>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#register-btn').click(function(){register()});
	$(document).keypress(function(e){
			if (e.which == 13){
				register();
			}
		});
	function register(){
		var parms = {};
		parms.nickname = $.trim($('#nickname').val());
		parms.username = $.trim($('#username').val());
		parms.password = $.trim($('#password').val());
		parms.confirmpassword = $.trim($('#confirmpassword').val());
		parms.mobile = $.trim($('#mobile').val());
		parms.email = $.trim($('#email').val());
		var url = "<?php echo site_url('Login/register');?>";
		//console.log(parms);
		$.post(url,parms,function(data){
			//console.log(data);
			var rs = JSON.parse(data);
			if (rs.status==1){
				//alert('注册成功!');
				$.messager.popup('注册成功');
				location.href="<?php echo site_url('Home/index');?>";
			}else if(rs.status==2){
				//alert('该用户名已经存在');
				$.messager.popup('该用户名已经存在');
			}else{
				//alert('注册失败!');
				$.messager.popup('注册失败');
			}
		});
	}
</script>