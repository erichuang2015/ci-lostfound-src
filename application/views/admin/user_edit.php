	<div class="oms-page">
		<div class="oms-tbar" style="padding-left:100px;margin-bottom:20px;height:25px;">
			<h2>修改<?php echo $user['username'];?>的信息</h2>
		</div>
		<div class="oms-body">
			<table style="/*align:center;*/width:780px;" class="table table-hover">
				<thead>
					<tr>
						<th width="100">属性</th>
						<th width="180">值&nbsp;&nbsp;</th>
						<th width="180">修改</th>
						<th width="">操作</th>
					</tr>
				</thead>
				<tbody id="list" data-editurl="<?php echo site_url('admin/User/edit');?>" data-id="<?php echo $user['userid'];?>">
					<tr>
						<td>昵称</td>
						<td>
							<input type="text" readonly="true" class="form-control" value="<?php echo $user['nickname']?>">
						</td>
						<td>
							<input type="text" id="nickname"  class="form-control" value="<?php echo $user['nickname']?>">
						</td>
						<td>
							<button class="btn btn-primary glyphicon glyphicon glyphicon-pencil" style="width: 64px;" onclick="javascript:info_alter('nickname')">确认</button>
							<button class="btn btn-success" onclick="javascript:reset('nickname','<?php echo $user['nickname'];?>')" style="width: 64px;">重置</button>
						</td>
					</tr>

					<tr>
						<td>手机</td>
						<td>
							<input type="text" readonly="true" class="form-control" value="<?php echo $user['mobile']?>">
						</td>
						<td>
							<input type="text" id="mobile"  class="form-control" value="<?php echo $user['mobile']?>">
						</td>
						<td>
							<button class="btn btn-primary glyphicon glyphicon glyphicon-pencil" style="width: 64px;" onclick="javascript:info_alter('mobile')">确认</button>
							<button class="btn btn-success" onclick="javascript:reset('mobile',<?php echo $user['mobile'];?>)" style="width: 64px;">重置</button>
						</td>
					</tr>

					<tr>
						<td>QQ</td>
						<td>
							<input type="text" readonly="true" class="form-control" value="<?php echo $user['qq'];?>">
						</td>
						<td>
							<input type="text" id="qq"  class="form-control" value="<?php echo $user['qq'];?>">
						</td>
						<td>
							<button class="btn btn-primary glyphicon glyphicon glyphicon-pencil" style="width: 64px;" onclick="javascript:info_alter('qq')">确认</button>
							<button class="btn btn-success" onclick="javascript:reset('qq',<?php echo $user['qq']?>)" style="width: 64px;">重置</button>
						</td>
					</tr>

					<tr>
						<td>邮箱</td>
						<td>
							<input type="text" readonly="true" class="form-control" value="<?php echo $user['email'];?>">
						</td>
						<td>
							<input type="text" id="email"  class="form-control" value="<?php echo $user['email'];?>">
						</td>
						<td>
							<button class="btn btn-primary glyphicon glyphicon glyphicon-pencil" style="width: 64px;" onclick="javascript:info_alter('email')">确认</button>
							<button class="btn btn-success" onclick="javascript:reset('email','<?php echo $user['email'];?>')" style="width: 64px;">重置</button>
						</td>
					</tr>

					<tr>
						<td>地址</td>
						<td>
							<input type="text" readonly="true" class="form-control" value="<?php echo $user['address'];?>">
						</td>
						<td>
							<input type="text" id="address"  class="form-control" value="<?php echo $user['address'];?>">
						</td>
						<td>
							<button class="btn btn-primary glyphicon glyphicon glyphicon-pencil" style="width: 64px;" onclick="javascript:info_alter('address')">确认</button>
							<button class="btn btn-success" onclick="javascript:reset('address','<?php echo $user['address'];?>')" style="width: 64px;">重置</button>
						</td>
					</tr>
					
					<tr>
						<td align="" colspan="4">
							<button class="btn btn-primary glyphicon glyphicon-pencil" id="alter-all">确认修改</button>
							<button class="btn btn-success" id="reset-all">重置</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>