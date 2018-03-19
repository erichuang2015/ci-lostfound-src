<style type="text/css">
	th{
		text-align: right;
	}
</style>
	<div class="oms-page">
		<form id="myform" role="form">
			<table style="padding-top: 10px;border: 1px solid #ddd;" class="table table-hover">

				<tr>
					<th width="120">公告标题<font color="red">*</font>:</th>
					<td>
						<div class="row">
							<div class="col-xs-4">
								<input type="text" id="title" data-id="<?php echo $news['news_id']?>" value="<?php echo $news['title']?>" class="form-control">
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<th width="120">公告内容<font color="red">*</font>:</th>
					<td>
						<div class="row">
							<div class="col-xs-4">
								<textarea id="content" class="form-control"><?php echo $news['content']?></textarea>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td style="padding-left:130px;" colspan="2">
						<button type="button" id="alter_news" class="btn btn-primary">保存</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<script type="text/javascript">
		$("#alter_news").on("click", function () {
			var params = {}, data = {};
			data.title = $.trim($("#title").val());
			data.content = $.trim($("#content").val());
			params.obj = data;
			params.id = $.trim($("#title").data('id'));
			//console.log(params);
			$.post("<?php echo site_url('admin/News/edit') ?>", params, function (data) {
				//console.log(data);
				var rs = JSON.parse(data);
				if (rs.status == 1 ) {
					$.messager.alert("编辑公告提醒","恭喜你修改公告成功！");
				}else{
					$.messager.alert("编辑公告提醒","操作失败");
				}
			});
		})
	</script>
