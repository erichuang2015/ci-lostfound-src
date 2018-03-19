$(function(){
	$('#alter-all').on('click',function(){
		var inputs = $("#list input[id]");
		var id = [], value = [], params = {};
		console.log(inputs);
		for (var i=0;i<6;i++) {
			id[i] = inputs[i].dataset.id;
			value[i] = inputs[i].value;
		}
		params.id = id;
		params.value = value;
		console.log(params);
		$.post($("#data").data("url"), params, function(data){
			var rs = JSON.parse(data);
			if (rs.status==1){
				$.messager.model = {
					ok : { text: "是",classed: 'btn-primary'},
					cancel : false
				};
				$.messager.confirm('修改提示','修改成功',function(){
					location.reload();
				});
			}else {
				for (var i in rs.error){
					if (i==0) var error = error[i];
					error += '.'+error[i];
				}
				$.messager.alert('修改提示','第'+error+'项，修改失败！共计'+rs.count+'项');
			//location.reload();
		}
		});
	});
});
function config_alter(id,code){
	var params = {};
	params.id = id;
	//params.field = [1,2,3,4];
	params.value = $.trim($('#'+code+id).val());
	$.post($('#data').data('url'),params,function(data){
		var rs = JSON.parse(data);
		if (rs.status==1){
			$.messager.model = {
				ok : { text: "是",classed: 'btn-primary'},
				cancel : false
			};
			$.messager.confirm('修改提示','修改成功',function(){
				location.reload();
			});
		}else {
			$.messager.alert('修改提示','修改失败');
			//location.reload();
		}
	});
}