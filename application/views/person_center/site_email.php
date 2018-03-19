<div class="row">
	<div class="col-md-12">
		<h1>我的站内信</h1>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>标题</th>
					<th>内容</th>
					<th>时间</th>
					<th>发送人</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($obj as $k=>$v):?>
				<tr>
					<td><a href="<?php if ($v['type']==1){ echo site_url('Home/lostDetailView').'?id='.$v['msg_id'];}else{echo site_url('Home/foundDetailView').'?id='.$v['msg_id'];}?>"><?php echo $v['sms_title'];?></a></td>
					<td><?php echo $v['sms_content'];?></td>
					<td><?php echo $v['add_time'];?></td>
					<td><?php echo $v['send_username'];?></td>
				</tr>
			<?php endforeach ?>
				
			</tbody>
		</table>

	</div>
</div>