$( function () {
	$("#alter-all").on("click", function () {
		var params = {}, data = {};
		data.mobile = $.trim($('#mobile').val());
		data.qq = $.trim($('#qq').val());
		data.email = $.trim($('#email').val());
		data.address = $.trim($('#address').val());
		data.nickname = $.trim($('#nickname').val());
		params.id = $.trim($("#list").data('id'));
		params.obj = data;
		$.post( $("#list").data('editurl'), params, function (data) {
			//console.log(data);
			var rs = JSON.parse(data);
			if (rs.status = 1 ) {
				$.messager.model = {
					ok:{ text: "确认", classed: 'btn-primary' },
					cancel: { text : "返回", classed:"btn-default"}
				};
				$.messager.confirm("修改成功提示","修改成功！", function () {
					location.reload();
				});
			} else {
				$.messager.alert("修改会员基本信息提示","修改失败");
			}
		});
	});
	//
	$("#reset-all").on("click", function () {
		var old_value = $("#list input[readonly=true]");
		$("#list").find("input[id]").each(function(index, element){
			element.value = old_value[index].value;
		});		
	});
});
//单个修改
function info_alter (id) {
	var params = {}, data = {};
	data[id] = $.trim($('#'+id).val());
	params.obj = data;
	params.id = $("#list").data('id');
	$.post( $("#list").data('editurl'), params, function (data) {
		var rs = JSON.parse(data);
		if (rs.status = 1 ) {
			$.messager.model = {
				ok:{ text: "确认", classed: 'btn-primary' },
				cancel: {text :"返回", classed: "btn-default"}
			};
			$.messager.confirm("修改成功提示","修改成功！", function () {
				location.reload();
			});
		} else {
			$.messager.alert("修改会员基本信息提示","修改失败");
		}
	});
}

//单个重置
function reset ( id , val) {
	$('#'+id).val(val);
}
