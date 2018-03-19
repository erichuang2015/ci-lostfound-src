$(function(){
	$.formValidator.initConfig({theme:'Default',mode:'AutoTip',formID:'myform',submitOnce:true,onSuccess:
		function(){
			add();
			return false;
		},onError:function(msg){
			console.log(msg);
		}
	});
	$('#title').formValidator({onShow:"公告标题",onFocus:"输入公告标题",onCorrect:"输入正确"}).inputValidator({min:1,onError:"标题不能为空"});
	$('#content').formValidator({onShow:"公告内容",onFocus:"输入公告内容",onCorrect:"输入正确"}).inputValidator({min:1,onError:"公告内容不能为空"});
	//
});
function add() {
	var params = {};
	params.content = $.trim($('#content').val());
	$.post($('#title').data('url'), params, function(data){
		var rs = JSON.parse(data);
		if (rs.status==1){
			$.messager.alert("添加公告提示","添加成功！");
		}else{
			$.messager.alert("添加公告提示","添加失败！");
		}
	});
}