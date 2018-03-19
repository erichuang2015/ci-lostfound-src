<div class="oms-page">
		<div style="padding-top:4px;" class="oms-tbar" >
		<form action="<?php echo site_url('admin/Home/orderList');?>" method="post">
			<div class="col-sm-2">
				<div class="input-group">
					<span class="input-group-addon">类型</span>
					<select name='order_type' class="form-control">
            			<option value=''>请选择</option>
            			<option <?php if($rule['order_type'] ==false ) echo 'selected="true"'; ?> value=''>所有</option>
            			<option <?php if($rule['order_type'] == 1) echo 'selected="true"'; ?> value='1'>失物</option>
            			<option <?php if($rule['order_type'] == 2) echo 'selected="true"'; ?> value='2'>拾取</option>
          			</select>
				</div>
			</div>

			<div class="col-sm-2">
				<div class="input-group data">
					<span class="input-group-addon">状态</span>
					<select name='status' id='status' class="form-control">
            			<option value=''>请选择</option>
            			<option <?php if($rule['status'] ==false ) echo 'selected="true"'; ?> value=''>所有</option>
            			<option <?php if($rule['status'] == 1) echo 'selected="true"'; ?> value='1'>创建待托管资金</option>
            			<option <?php if($rule['status'] == 2) echo 'selected="true"'; ?> value='2'>已托管资金待配送</option>
            			<option <?php if($rule['status'] == 3) echo 'selected="true"'; ?> value='3'>已配送等待收货</option>
            			<option <?php if($rule['status'] == 4) echo 'selected="true"'; ?> value='4'>丢失方申请退款等待同意</option>
            			<option <?php if($rule['status'] == 5) echo 'selected="true"'; ?> value='5'>拾取放不同意退款等待网站介入</option>
            			<option <?php if($rule['status'] == 6) echo 'selected="true"'; ?> value='6'>交易完成</option>
            			<option <?php if($rule['status'] == 7) echo 'selected="true"'; ?> value='7'>交易完成退款成功</option>
            			<option <?php if($rule['status'] == 8) echo 'selected="true"'; ?> value='8'>交易成功网站介入处理</option>
          			</select>
				</div>
			</div>

			<div class="col-sm-2">
				<div class="input-group">
					<span class="input-group-addon">丢失方</span>
					<input type="text" name="lost_username" value="<?php echo $rule['lost_username'];?>" class="form-control">
				</div>
			</div>

			<div class="col-sm-2">
				<div class="input-group">
					<span class="input-group-addon">拾取方</span>
					<input type="text" name="found_username" value="<?php echo $rule['found_username'];?>" class="form-control">
				</div>
			</div>

			<div class="col-xs-2">
				<div class="input-group">
					<span class="input-group-addon">信息标题</span>
					<input type="text" name="msg_title" value="<?php echo $rule['msg_title'];?>" class="form-control">
				</div>
			</div>
			<button type="submit" class="btn btn-primary glyphicon glyphicon-search btn-sm">查询</button>
		</form>
		</div>
		<br/>
		<div class="oms-body">
		<?php //var_dump($data);?>
		<div style="text-align: right; height: 25px">
			<a href="<?php echo site_url('admin/Home/orderAdd');?>" class="btn btn-success glyphicon-plus">新增</a>
		</div>
			<table style="padding-top: 10px;border: 1px solid #ddd;" class="table table-hover">
				<thead>
					<tr>
						<th width="50">&nbsp;序&nbsp;号&nbsp;&nbsp;</th>
						<th>标题</th>
						<th>内容</th>
						<th width="80">信息类别</th>
						<th width="80">物品种类</th>
						<th width="50">托管</th>
						<th width="50">报酬</th>
						<th width="70">发布人</th>
						<th width="70">丢失人</th>
						<th width="70">认领人</th>
						<th>创建时间</th>
					
						<th>状态</th>
						<th width="200">操作</th>
					</tr>
				</thead>
				<tbody id="list">
					<?php foreach ($data as $k=>$v) :?>
					<tr>
						<td><input value="<?php echo $v['order_id']?>" id="selector" type="checkbox" name="">&nbsp;<?php echo $k+1;?></td>
						<td><?php echo $v['msg_title']?></td>
						<td><?php echo $v['msg_content']?></td>

						<?php if ( $v['order_type'] == 1) {?>
							<td>失物</td>
						<?php }else {?>
							<td>拾物</td>
						<?php } ?>

						<td><?php echo $v['cat_name'];?></td>
						<td><?php echo $v['trusteeship_price'];?></td>
						<td><?php echo $v['price']?></td>
						<td><?php echo $v['username']?></td>
						<td><?php echo $v['lost_username']?></td>
						<td><?php echo $v['found_username']?></td>
						<td><?php echo $v['add_time']?></td>
						
						<?php if ($v['status']==1){?>
							<td><span class="glyphicon glyphicon-ok" style="color: rgb(28, 176, 0);">创建待托管</span></td>
						<?php }else if ($v['status']==2){?>
							<td><span style="color: rgb(28, 176, 0);">已托管资金待配送</span></td>
						<?php }else if ($v['status']==3){?>
							<td><span style="color: rgb(28, 176, 0);">已配送等待收货</span></td>
						<?php }else if ($v['status']==4){?>
							<td><span style="color: rgb(255, 72, 5);">丢失方退款待同意</span></td>
						<?php }else if ($v['status']==5) {?>
							<td><span style="color: rgb(255, 72, 5);">拾取不同意退款待介入</span></td>
						<?php }else if($v['status']==6) {?>
							<td><span style="color: rgb(28, 176, 0);">交易完成</span></td>
						<?php }else if($v['status']==7) {?>
							<td><span style="color: rgb(28, 176, 0);">交易完成退款成功</span></td>
						<?php }else if($v['status']==8) {?>
							<td><span style="color: rgb(28, 176, 0);">交易完成网站接入处理</span></td>
						<?php }else {?>
							<td><span style="color: rgb(255, 72, 5);">其他</span></td>
						<?php }?>
						<td>
							<!-- <a href="<?php echo site_url('admin/Home/msgEdit');?>?id=<?php echo $v['msg_id']?>" class="btn btn-primary btn-sm glyphicon glyphicon-pencil">修改</a> -->
							
							<?php if ($v['status']==1){?>
								<button class="btn btn-info btn-sm glyphicon glyphicon-usd"  onclick="javascript:trusteeship(<?php echo $v['order_id'];?>,<?php echo $k+1;?>,<?php echo $v['price'];?>,<?php echo $v['trusteeship_price'];?>)">托管</button>
							<?php }else if ($v['status']==2){?>
								<button class="btn btn-primary btn-sm"  onclick="javascript:send(<?php echo $v['msg_id'];?>,<?php echo $k+1;?>)">送</button>
							<?php }else if($v['status']==5){?>
								<button class="btn btn-primary btn-sm glyphicon glyphicon-info-sign"  onclick="javascript:manage(<?php echo $v['msg_id'];?>,<?php echo $k+1;?>)">处理</button>
							<?php }else {?>
								<button class="btn btn-success btn-sm" onclick="javascript:query(<?php echo $v['msg_id'];?>)">查</button>
							<?php }?>
							<button class="btn btn-warning btn-sm glyphicon glyphicon-trash" onclick="javascript:del(<?php echo $v['msg_id']?>,<?php echo $k+1;?>)" ></button>
						</td>
					</tr>
					<?php endforeach?>
					<tr>
					<td colspan="13">
						<input id="all" type="checkbox">&nbsp;&nbsp;<span >全选</span>
						选中项：
							<button class="btn btn-success glyphicon glyphicon-ok" id="btn-start-all">启用</button>
							<button class="btn btn-danger btn-sm glyphicon glyphicon-remove" style="width: 64px;" id="btn-off-all">停用</button>
							<button class="btn btn-warning btn-sm glyphicon glyphicon-trash" style="width: 64px;" id="btn-del-all" ></button>
						</td>
					</tr>
					<tr>
						<td colspan="13" align="center">
							<ul style="padding:0px;margin:0px;" class="pagination">
								<?php echo $page;?>
							</ul>
						</td>
					</tr>
				</tbody>
			</table>
			<br/>
			<br/>
		</div>
	</div>
<div hidden="hidden">
	<div id="trusteeship">
		<div style="padding-left:20px;" class="">
			<div class="col-xs-4 input-group">
				<span class="input-group-addon">已经托管</span>
				<input type="text" id="trusteeshiped" readonly="ture" value="10" class="form-control">
			</div>
			<div class="col-xs-4 input-group">
				<span class="input-group-addon">还需托管</span>
				<input type="text" id="trusteeship_need" readonly="ture" value="10" class="form-control">
			</div>
			<div class="col-xs-4 input-group">
				<span class="input-group-addon">托管多少</span>
				<input type="text" id="trusteeship_price" class="form-control">
			</div>
		</div>
	</div>
</div>


	<script type="text/javascript">
		$(function(){
			$('#all').on('click',function(){
				if (this.checked){
					$("#list").find('input#selector').attr("checked", true);
				}else{
					$("#list").find('input#selector').attr("checked", false);
				}
			});
			//启用所有选中
			$('#btn-start-all').on('click',function(){
				//alert($('#list').find('input').data('id'));
				var selectors = $("#list").find('input#selector');
				var params = {}, id = [];
				for(var i in selectors){
					if (selectors[i].checked){
						id[i] = selectors[i].value;
					}
				}
				params.id = id;
				$.post("<?php echo site_url('admin/Order/on');?>",params,function(data){
					//console.log(data);
					var rs = JSON.parse(data);
					if (rs.status == 1){
						$.messager.alert('启用公告提示','操作成功');
					}else if(rs.status==-1){
						for (var i in rs.error){
							if (i==0){
								var error = rs.error[i];
							}else{
								error += ',\n'+rs.error[i];
							}
						}
						$.messager,model = {
							ok : { text: "是",classed: 'btn-primary'}
						};
						$.messager.alert('启用公告提示','第'+error+'项操作失败!共操作失败'+rs.count+'项');
					}
				});
			});
			//停用所有选中
			$('#btn-off-all').on("click",function(){
				var selectors = $("#list").find('input#selector');
				var params = {}, id = [];
				for(var i in selectors){
					if (selectors[i].checked){
						id[i] = selectors[i].value;
					}
				}
				params.id = id;
				//console.log(params);
				$.post("<?php echo site_url('admin/Order/off');?>" ,params, function(data){
					//console.log(data);
					var rs = JSON.parse(data);
					if (rs.status == 1){
						$.messager.alert('关闭公告提示','注销操作成功');
					}else if(rs.status==-1){
						for (var i in rs.error){
							if (i==0){
								var error = rs.error[i];
							}else{
								error += ',\n'+rs.error[i];
							}
						}
						$.messager.model = {
							ok : { text: "是",classed: 'btn-primary'}
						};
						$.messager.alert('关闭公告提示','第'+error+'项操作失败!共操作失败'+rs.count+'项');
					}
				});
			});

			//批删除
			$('#btn-del-all').on("click",function(){
				var selectors = $("#list").find('input#selector');
				var params = {}, id = {}, str = '';
				for(var i in selectors){
					if (selectors[i].checked){
						id[i] = selectors[i].value;
						str += i+',';
					}
				}
				$.messager.confirm("删除公告提示","确定删除选中项吗",function () {
					params.id = id;
					$.post("<?php echo site_url('admin/Order/del');?>",params,function(data){
						var rs = JSON.parse(data);
						if (rs.status == 1){
							$.messager.alert('删除公告提示','删除操作成功');
						}else if(rs.status==-1){
							for (var i in rs.error){
								if (i==0){
									var error = rs.error[i];
								}else{
									error += ',\n'+rs.error[i];
								}
							}
							$.messager.model = {
								ok : { text: "是",classed: 'btn-primary'}
							};
							$.messager.alert('删除公告提示','第'+error+'项操作失败!共操作失败'+rs.count+'项');
						}
					});
				});
				
			});
			//$("#selector").click(function(){alert('cnmm');})
		});
		//启用
		function start(id){
			var params = {};
			params.id = id;
			$.post("<?php echo site_url('admin/Order/on');?>", params, function(data){
				var rs = JSON.parse(data);
				if (rs.status == 1){
					$.messager.model = {
							ok : { text: "是",classed: 'btn-primary'},
							cancel : {text:'返回', classed: 'btn-default'}
						};
					$.messager.confirm('启用公告提示',"操作成功！",function(){
						location.reload();
					});
				}else{
					$.messager.alert("启用公告提示","操作失败");
				}
			});
		}
		//停用
		function off(id) {
			var params = {};
			params.id = id;
			$.post("<?php echo site_url('admin/Order/off');?>", params, function(data){
				var rs = JSON.parse(data);
				if (rs.status == 1){
					$.messager.model = {
							ok : { text: "是",classed: 'btn-primary'},
							cancel : {text:'返回', classed: 'btn-default'}
						};
					$.messager.confirm('停用公告提示',"操作成功！",function(){
						location.reload();
					});
				}else{
					$.messager.alert("停用公告提示","操作失败");
				}
			});
		}
		//单个删除
		function del(id,k){
			$.messager.confirm("请确认!","删除第"+k+"项??",function(){
				var params = {};
				params.id = id;
				$.post("<?php echo site_url('admin/Order/del')?>", params, function(data){
					var rs = JSON.parse(data);
					if (rs.status == 1){
						$.messager.model = {
							ok : { text: "是",classed: 'btn-primary'},
							cancel : {text:'返回', classed: 'btn-default'}
						};
						$.messager.confirm('删除提示',"删除操作成功！",function(){
							location.reload();
						});
					}else{
						$.messager.alert("删除提示","操作失败");
					}
				});
			});
		}

		//定价
		function trusteeship (id,k,price, trusteeship) {
			$("#trusteeshiped").val(trusteeship);
			$("#trusteeship_need").val(price-trusteeship);
			$("#trusteeship").dialog({
				title:"为第"+k+"托管！@",
				backdrop: "static",
				onClose:function(){$(this).dialog('close')},
				buttons:[
					{
						text:"确认",
						'class':"btn-success",
						click:function(){
							var params = {};
							params.trusteeship_price = $.trim($("#trusteeship_price").val());
							params.id = id;
							$.messager.model={
								ok:{text:"确认",classed:"btn-info"},
								cancel:{text:"取消",classed:"btn-default"}
							};
							$.messager.confirm("定价确认","确认为第"+k+"项托管￥"+params.trusteeship_price+"吗?",function(){
								$.post("<?php echo site_url('admin/Order/trusteeship');?>", params, function(data){
									var rs = JSON.parse(data);
									if (rs.status==1){
										$.messager.model={
											ok:{text:"确认",classed:"btn-success"},
											cancel:{text:"取消",classed:"btn-default"}
										}
										$.messager.confirm("托管成功提示","恭喜你第"+k+"项托管"+params.trusteeship_price+"成功！",function(){
											location.reload();
										});
									}else{
										$.messager.alert('托管失败提示',"第"+k+"项定价为"+params.trusteeship_price+"失败");
									}
								});
							});
						}
					},
					{
						text:"返回",
						'class':"btn-default",
						click:function(){$(this).dialog('close');}
					}
				]
			});
		}
		
	</script>