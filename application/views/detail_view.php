<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 info-container">
			<div class="col-md-12 info-header">
				<div class="info-title">
					<h3><?php echo $data['msg_title'];?>
					<?php if ($lostOrFound == 2){?>
						<small><?php if ($data['status']==1){ if ($data['price']==$data['trusteeship_price']){echo "无人认领已托管";}else if ($data['trusteeship_price']==0){ echo '无人认领未托管';}else{echo "无人认领已托管{$data['trusteeship_price']}";} }else if($data['status']==2){ echo '等待网站定价';}else if($data['status']==3){ echo '已经认领交易中';}else{}?></small>
					<?php }else{ ?>
						<small><?php if ($data['status']==1){ echo '无人归还未托管';}else if($data['status']==2){ echo '无人归还已托管';}else if($data['status']==3){ echo '已经归还交易中';}else{}?></small>
					<?php }?>
					<?php if ($data['status']==1){?>
						<?php if ($lostOrFound==1){?>
							<button id="back-btn" class="btn btn-primary pull-right">我要归还</button></h3>
						<?php }else{ ?>
							<button id="claim-btn" class="btn btn-primary pull-right">我要认领</button></h3>
						<?php }?>
					<?php }?>
				</div>
			</div>

			<div class="col-md-12 info-basic table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th colspan="3">基本信息</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="col-md-2">物品种类</td>
							<td class="col-md-8"><?php echo $data['cat_name'];?></td>
							<td class="col-md-2" rowspan="3">
								<img class="img-responsive" src="<?php echo $data['msg_imgs']; ?>">
							</td>
							
						</tr>
						<tr>
							<td>详细描述</td>
							<td><?php echo $data['msg_content'];?></td>
							
						</tr>
						<tr>
							<td>酬谢方式</td>
							<td><?php echo $data['thank_method'];?></td>
							
						</tr>
					</tbody>
				</table>
			</div>

			<div class="col-md-12 info-place table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th colspan="4">拾到地点</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="col-md-2">拾到区域</td>
							<td class="col-md-4"><?php echo $data['province_name'].'-'.$data['area_name'];?></td>
							<td class="col-md-2">拾到时间</td>
							<td class="col-md-4"><?php echo $data['time'];?></td>
							
							
						</tr>
						<tr>
							<td class="col-md-2">拾到地点</td>
							<td class="col-md-10" colspan="3"><?php echo $data['place'];?></td>
							
						</tr>
						
					</tbody>
				</table>
			</div>

			<div class="col-md-12 info-contact table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th colspan="4">联系方式</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="col-md-2">联系地址</td>
							<td class="col-md-10" colspan="3">草房</td>
							
						</tr>
						<tr>
							<td class="col-md-2">联系人</td>
							<td class="col-md-4"><?php echo $data['link']['linkman'];?></td>
							<td class="col-md-2">手机</td>
							<td class="col-md-4"><?php echo $data['link']['mobile'];?></td>
						</tr>
						<tr>
							<td class="col-md-2">邮箱</td>
							<td class="col-md-4"><?php echo $data['link']['email'];?></td>
							<td class="col-md-2">电话</td>
							<td class="col-md-4"></td>
						</tr>
						<tr>
							<td class="col-md-2">QQ</td>
							<td class="col-md-4"><?php echo $data['link']['qq'];?></td>
							<td class="col-md-2">微信</td>
							<td class="col-md-4"><?php echo $data['link']['wechat'];?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div hidden="hidden">
	<!-- 认领 -->
	<div id="claimwrap">
		<form id="login-form">
			<div class="form-group">
			<label for="description_claim">填写你的认领描述:</label>
			
				<textarea id="description_claim" class="form-control" placeholder="对要认领物品的描述或者你的联系方式等等"></textarea>
		
			</div>
		
		</form>
	</div>
	<!-- 归还 -->

	<div id="backwrap">
		<form id="back-form">
			<div class="form-group">
			<label for="description_back">填写你的归还描述:</label>
				<textarea id="description_back" class="form-control" placeholder="对要归还物品的描述或者你的联系方式等等"></textarea>
		
			</div>
		
		</form>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		//
	});
	$('#claim-btn').click(function(){
		$.messager.model = {
			ok: {text:"我同意",classed:"btn-primary"},
			cancel : {text:"我不同意",classed:"btn-danger"}
		}
		$.messager.confirm("条款协议","条款内容",function() {
			$("#claimwrap").dialog({
				title:    "填写认领信息描述"
				, 'class':  "mydialog"  /*add custom class for this dialog*/
				,dialogClass : "modal-lg"
				, onClose: function() { $(this).dialog("close"); }
				, buttons: [
				{
					text: "关闭"
					, 'class': "btn-primary"
					, click: function() {
						$(this).dialog("close");
					}
				},
				{
					text: "提交"
					, 'class': "btn-success"
					, click: function() {
						/*your login handler*/
						var params = {};
						params.id = "<?php echo $data['msg_id'];?>";
						params.description = $.trim($('#description_claim').val());
						var claim_url = "<?php echo site_url('Trade/found');?>";
					//console.log(claim_url);
					$.post(claim_url,params,function(data){
						//console.log(data);
						var claim_rs = JSON.parse(data);
						if (claim_rs.status==1){
							$.messager.model = {
								ok: {text:"确定",classed:"btn-primary"},
								cancel : {text:"返回",classed:"btn-default"}
							}
							$.messager.confirm('操作成功提示!',"恭喜你认领成功！请前往个人中心进行托管",function() {
								location.href="<?php echo site_url('Home/personCenter').'#tradeOrder';?>";
							});
						}else if(claim_rs.status==-2){
							$.messager.model = {
								ok: {text:"确定",classed:"btn-primary"},
								cancel : {text:"返回",classed:"btn-default"}
							}
							$.messager.alert('认领出错提醒','信息状态不符合或已经有人认领在交易中!');
						}else if(claim_rs.status==-3){
							$.messager.popup('error');
						}else if(claim_rs.status==-999){
							$.messager.popup('请登录！');
						}else{
							$.messager.popup('操作失败!');
						}
					});
					$(this).dialog("close");
				}
			},
			{
				text: "取消"
				, classed: "btn-error"  /*classed equal to 'class'*/
				, click: function() {
					/*your login handler*/

					$(this).dialog("destroy");
				}
			}
			]
		});
		})
		
	});
	//归还
	$('#back-btn').click(function(){
		$.messager.model = {
			ok: {text:"我同意",classed:"btn-primary"},
			cancel : {text:"我不同意",classed:"btn-danger"}
		}
		$.messager.confirm("归还条款协议","协议内容",function () {
			$("#backwrap").dialog({
				title:    "填写归还信息描述"
				, 'class':  "mydialog"  /*add custom class for this dialog*/
				,dialogClass : "modal-lg"
				, onClose: function() { $(this).dialog("close"); }
				, buttons: [
				{
					text: "关闭"
					, 'class': "btn-primary"
					, click: function() {
						$(this).dialog("close");
					}
				},
				{
					text: "提交"
					, 'class': "btn-success"
					, click: function() {
						/*your login handler*/
						var params = {};
						params.id = "<?php echo $data['msg_id'];?>";
						params.description = $.trim($('#description_back').val());
						var claim_url = "<?php echo site_url('Trade/back');?>";
						//console.log(claim_url);
						$.post(claim_url,params,function(data){
							var claim_rs = JSON.parse(data);
							if (claim_rs.status==1){
								$.messager.model = {
									ok: {text:"确定",classed:"btn-primary"},
									cancel : {text:"返回",classed:"btn-default"}
								}
								$.messager.confirm('操作成功提示!',"恭喜你操作成功！请前往个人中心进行联系交流查看",function() {
								location.href="<?php echo site_url('Home/personCenter').'#tradeOrder';?>";
							});
							}else if(claim_rs.status==-2){
								$.messager.model = {
									ok: {text:"确定",classed:"btn-primary"},
									cancel : {text:"返回",classed:"btn-default"}
								}
								$.messager.alert('归还出错提醒','信息状态不符合或已经有人归还在交易中!');
							}else if(claim_rs.status==-4){
								$.messager.popup('该信息是拾物信息只能认领不能归还');
							}else{
								$.messager.popup('操作失败!');
							}
						});
						$(this).dialog("close");
					}
				},
				{
					text: "取消"
					, classed: "btn-error"  /*classed equal to 'class'*/
					, click: function() {
						/*your login handler*/

						$(this).dialog("destroy");
					}
				}
				]
			});
		})
		
	});
</script>