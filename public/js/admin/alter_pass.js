function alterPass (url) {
	var params = {};
		params.password = $.trim($('#password').val());
		params.repassword = $.trim($('#repassword').val());
		params.newpassword = $.trim($('#newpassword').val());
		if (params.newpassword != params.repassword) {
			$.messager.popup("两次密码不一样！");
			return false;
		}
		//console.log(params);
		$.post(url, params, function (data) {
			//console.log(data);
			var rs = JSON.parse(data);
			if (rs.status==1) {
				$.messager.alert("修改密码成功提示","恭喜你修改密码成功！请记住你的新密码");
			}else if( rs.status == -2 ) {
				$.messager.alert("原密码错误提示","对不起你输入的原密码不正确！请检查");
			}else{
				$.messager.alert("修改密码失败提示","对不起！操作失败");
			}
		});
}