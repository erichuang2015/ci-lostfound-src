<div class="row">
	<div class="col-md-12">
		<h1>我的发布</h1>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>信息标题</th>
					<th>类别</th>
					<th>地点</th>
					<th>时间</th>
					<th>报酬</th>
					<th>托管</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($obj as $k=>$v):?>
				<?php if ($v['type']==1){ ?>
					<tr>
						<td><a href="<?php  echo site_url('Home/lostDetailView').'?id='.$v['msg_id'];?>"><?php echo $v['msg_title'];?></a></td>
						<td><?php echo $v['cat_name'];?></td>
						<td><?php echo $v['place'];?></td>
						<td><?php echo $v['time'];?></td>
						<td><?php echo $v['price'];?></td>
						<td><?php echo $v['trusteeship_price'];?></td>
						<td><?php if ($v['status'] == 1){echo "发布";}else if($v['status']==2){echo "待审核";}else if($v['status']==3){echo "交易中";}else if($v['status']==4){echo "交易完成";}else if($v['status']==5){echo "关闭";}else{echo "其他";}  ?></td>
						<td>
							<button onclick="javascript:trusteeship_info(<?php echo $v['price']-$v['trusteeship_price'];?>)" class="btn btn-sm btn-primary">托</button>
							<button onclick="javascript:close_msg(<?php echo $v['msg_id'];?>)" class="btn btn-sm btn-warning glyphicon glyphicon-trash"></button>
						</td>
					</tr>
				<?php }else{ ?>
					<tr>
						<td><a href="<?php  echo site_url('Home/foundDetailView').'?id='.$v['msg_id'];?>"><?php echo $v['msg_title'];?></a></td>
						<td><?php echo $v['cat_name'];?></td>
						<td><?php echo $v['place'];?></td>
						<td><?php echo $v['time'];?></td>
						<td><?php echo $v['price'];?></td>
						<td><?php echo $v['trusteeship_price'];?></td>
						<td><?php if ($v['status'] == 1){echo "发布";}else if($v['status']==2){echo "待审核";}else if($v['status']==3){echo "交易中";}else if($v['status']==4){echo "交易完成";}else if($v['status']==5){echo "关闭";}else{echo "其他";}  ?></td>
						<td>
							<button class="btn btn-sm btn-info">查</button>
							<button onclick="javascript:close_msg(<?php echo $v['msg_id'];?>)" class="btn btn-sm btn-warning glyphicon glyphicon-trash"></button>
						</td>
					</tr>
				<?php } ?>
			<?php endforeach ?>
				
			</tbody>
		</table>

	</div>
</div>

<script type="text/javascript">
	$(function(){
		//
	});
	function trusteeship_info (m) {
		$.messager.alert("<h2>托管相关</h2>","<h3>请转<span style=\"color:red\";>"+m+"</span>到</br>银行卡：1233322或</br>支付宝：122455或</br>微信:5511544</h3>");
	}

	//关闭信息
	function close_msg ( id ) {
		var params = {};
		params.msgid = id;
		$.messager.model = {
			ok : { text : "确认",classed:"btn-primary"},
			cancel : { text : "取消", classed:"btn-default"}
		}
		$.messager.confirm("删除消息提示","删除后将不能恢复，请确认",function () {
			$.get("<?php echo site_url('Msg/delMsg');?>", params, function(data){
				var rs = JSON.parse(data);
				if (rs.status==1){
					$.messager.confirm("删除结果提示","删除成功",function () {
						location.reload();
					});
				} else if( rs.status == -2) {
					$.messager.alert("警告","你没有权限操作！");
				} else if ( rs.status == -3 ) {
					$.messager.alert("警告","该信息正在交易中，不允许删除！");
				} else {
					$.messager.alert("警告","删除失败");
				}
				
			});
		});
	} 
</script>