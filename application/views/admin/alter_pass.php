<div class="oms-page">
		
		<div style="padding-left:100px;" class="oms-body">
		<h2 style="padding-left:50px;">修改管理员密码</h2>
		<form name="myform" role="form" id="myform">
			<table style="/*align:center;*/width:330px;" class="table table-condensed">
				<tbody id="list">
					
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">原始密码</span>
								<input type="password" id="password" class="form-control">
							</div>							
						</td>
						
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">新的密码</span>
								<input type="password" id="newpassword" class="form-control">
							</div>
						</td>	
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">重复密码</span>
								<input type="password" id="repassword" class="form-control">
							</div>
						</td>	
					</tr>
					<tr>
						<td align="" >
							<button type="button" onclick="javascript:alterPass(<?php echo site_url('admin/Home/exeAlterPass'); ?>)" class="btn btn-primary glyphicon glyphicon-pencil">修改</button>
							<button type="button" class="btn btn-warning" id="reset">重置</button>
						</td>
					</tr>
				</tbody>
			</table>
			</form>
		</div>
		
	</div>
	<script type="text/javascript">
		
	</script>