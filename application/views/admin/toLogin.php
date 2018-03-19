
	<div style="height:94%;background: #1D8FED">
	<div style="padding:20px;float:right"><a href="<?php echo site_url('Home/index');?>" class="glyphicon glyphicon-home" style="color:#ffffff;font-size:20px;">去首页</a></div>
	<div style=" ;" class="container">
		<br/>
		<br/>
		<div class="col-md-offset-4">
			<div class="">
				<h1 style="color: #ffffff">失物招领——管理员登录</h1>
			</div>
		</div>
		
		<div class="cotent">
			<div class="loginBox">
				<br/>
				<form class="form-horizontal" role="form">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="username"><i class="glyphicon glyphicon-user"></i></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="username" id="username" placeholder="请输入用户名">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="password"><i class="glyphicon glyphicon-lock"></i></label>
					<div class="col-sm-8">
						<input type="password" class="form-control" name="password" id="password" placeholder="请输入密码">
					</div>
				</div>
				<!--<div class="form-group">
					<label for="verfyCode" class="col-sm-2 control-label"><i class="glyphicon glyphicon-sound-dolby"></i></label>
					<div class="col-sm-3">
						<input type="text" id="verfyCode" class="form-control" placeholder="验证码">
					</div>
					<div class="col-sm-6">
						<img style="width: 165px;height: 38px;" class="verifyImg" onclick="this.src='{:U(\'Index/getVerify\')}?id='+Math.random()" src="{:U('Index/getVerify')}" alt="验证码">
					</div>
				</div>
				-->
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="checkbox">
							<label for="">
								<input type="checkbox">请记住我
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div style="width: 100px" id="loginBtn" class="btn btn-default">登录</div>
					</div>
				</div>
			</form>
			</div>
			
		</div>
		<div class="footer"></div>
	</div>
	</div>
<script type="text/javascript">
	$(function(){
		$('#loginBtn').click(function(){login()});
		$(document).keypress(function(e){
			if (e.which == 13){
				login();
			}
		})
	})
	function login(){
		var params = {};
		params.username = $.trim($('#username').val());
		params.password = $.trim($('#password').val());
		//params.verify = $.trim($('#verfyCode').val());
		// params.id = $.trim($('#id'))
		if (params.username==''){
			 $.messager.popup("请输入用户名!");
		   $('#username').focus();
		   return;
		}
		if (params.password==''){
			$.messager.popup("请输入密码!");
			$('#password').focus();
			return;
		}
		/*if (params.verify==''){
			$.messager.popup("请输入验证码!");
			$('#verifyCode').focus();
			return;
		}*/
		var url = "<?php echo site_url('admin/Login/login');?>";
		$.post(url,params,function(data,textStatus){
			var json = JSON.parse(data);
			if (json.status=='1'){
				$.messager.popup("登录成功!");
				location.href="<?php echo site_url('admin/Home/index');?>";
			}else if(json.status=='-2'){
				$.messager.popup("验证码错误!");
				//getVerify();
			}else{
				$.messager.popup("账号或密码错误!");
				//getVerify();
			}
		});
	}
	function getVerify(){
		//var vurl="{:U('Index/getVerify')}"+'?rmd='+Math.random();
		//alert(vurl);
		//$('.verifyImg').attr('src',vurl);
	}
</script>