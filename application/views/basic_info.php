<div class="row">
	<div class="col-md-12">
		<h1>会员基本信息</h1>
		<table class="table table-hover">

			<tbody>
				<tr>
					<td>昵称：</td>
					<td><?php echo $user['nickname'];?></td>
					<td>用户名</td>
					<td><?php echo $user['nickname'];?></td>
				</tr>
				<tr>
					<td>e-mail</td>
					<td><?php echo $user['email'];?></td>
					<td>手机</td>
					<td><?php echo $user['mobile'];?></td>
				</tr>
				<tr>
					<td>性别</td>
					<td><?php if ($user['sex']==1){echo '男';}else{ echo '女';}?></td>
					<td>注册时间</td>
					<td><?php echo $user['regdate'];?></td>
				</tr>
				
			</tbody>
		</table>

	</div>
</div>