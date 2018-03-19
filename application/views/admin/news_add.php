<body>
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
								<input type="text" id="title" data-url="<?php echo site_url('admin/News/add')?>" placeholder="请输入公告标题" class="form-control">
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<th width="120">公告内容<font color="red">*</font>:</th>
					<td>
						<div class="row">
							<div class="col-xs-4">
								<textarea id="content" placeholder="请输入公告内容" class="form-control"></textarea>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td style="padding-left:130px;" colspan="2">
						<button type="submit" class="btn btn-primary">保存</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<script src="<?php echo base_url('public/js/lib/formValidator/formValidator-4.1.3.js');?>"></script>
    <script src="<?php echo base_url('public/js/lib/formValidator/formValidatorRegex.js')?>"</script>
