<?php $user = $_SESSION['USER']?>
<div class="row">
	<div class="col-md-12">
		<h1>交易单</h1>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>交易标题</th>
					<th>报酬</th>
					<th>交易状态</th>
					<th>托管状态</th>
					<th>丢失方</th>
					<th>拾取方</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($obj as $k=>$v):?>
				<tr>
					<td><a href="<?php if ($v['order_type'] ==1) { echo site_url('Home/findDetailView').'?id='.$v['msg_id']; }else { echo site_url('Home/lostDetailView').'?id='.$v['msg_id']; }?>"><?php echo $v['msg_title'];?></a></td>
					<td><?php echo $v['price'];?></td>
					<td>
						<?php if($v['status'] == 1) 
						{ echo "等待托管";}else if ($v['status'] ==2 )
						{ echo "已托管等待配送";}else if($v['status']==3)
						{echo "等待确认收货";}else if($v['status']==4){echo "丢失方申请退款";}else if($v['status']==5){
							echo "不同意退款等待网站介入";
						}else if($v['status']==6){
							echo "交易完成";
						}else if($v['status']==7){
							echo "交易完成退款成功";
						}else if($v['status']==8){
							echo "交易成功网站介入处理";
						}else {
							echo "其他";
						}
						?>
						
					</td>
					<td><?php echo $v['trusteeship_price'];?></td>
					<?php if ($v['lost_userid'] == $user['userid']) {?>
						<td style="color:#30D919"><b>我</b></td>
					<?php } else { ?>
						<td><?php echo $v['lost_username'];?></td>
					<?php }?>

					<?php if ($v['found_userid']==$user['userid']) { ?>
						<td style="color:#30D919;"><b>我</b></td>
					<?php } else { ?>
						<td><?php echo $v['found_username'];?></td>
					<?php } ?>
					<td>
						<?php if ( $v['status']==1 && $v['trusteeship_price'] < $v['price'] && $v['lost_userid']==$user['userid'] ) {?>
							<button data-toggle="modal" onclick="javascript:trusteeship_info(<?php echo $v['price']-$v['trusteeship_price'];?>)" data-target="#trusteeship" class="btn btn-sm btn-primary">托</button>
						<?php }else if ($v['status'] ==2 && $v['trusteeship_price']==$v['price'] ) { ?>
							<?php if($v['lost_userid'] == $user['userid']) {?>
								<button onclick="javascropt:received(<?php echo $v['order_id']; ?>)" class="btn btn-sm btn-success">收</button>
								<button class="btn btn-sm btn-info" onclick="javascript:query(<?php echo $v['order_id'];?>)" >查</button>
							<?php }else { ?>
								<button class="btn btn-sm btn-danger" onclick="javascript:send(<?php echo $v['order_id']; ?>);">送</button>
							<?php }	?>
						<?php }else if ($v['status'] ==3 && $v['lost_userid']==$user['userid']) { ?>
							<button class="btn btn-sm btn-warning" onclick="javascript:refund(<?php echo $v['order_id']; ?>);">退</button>
							<button onclick="javascropt:received(<?php echo $v['order_id']; ?>)" class="btn btn-sm btn-success">收</button>
							<button class="btn btn-sm btn-info" onclick="javascript:query(<?php echo $v['order_id'];?>)" >查</button>
						<?php }else if ($v['status']==4 && $v['found_userid']==$user['userid']) { ?>
							<button class="btn btn-sm btn-primary" onclick="javascript:agree(<?php echo $v['order_id']; ?>);">同</button>
							<button class="btn btn-sm btn-danger" onclick="javascript:reject(<?php echo $v['order_id']; ?>);">拒</button>
							<button class="btn btn-sm btn-info" onclick="javascript:query(<?php echo $v['order_id'];?>)">查</button>
						<?php }else{?>
							<button class="btn btn-sm btn-info" onclick="javascript:query(<?php echo $v['order_id'];?>)">查</button>
						<?php } ?>
					</td>
				</tr>
			<?php endforeach ?>
				
			</tbody>
		</table>

	</div>
</div>
<div hidden="true">
	<!-- 退de原因 -->
	<div id="refund">
		<div class="form-group">
			<label for="reason" class="col-sm-2">原因</label>
			<div class="col-sx-4">
				<textarea id="reason" class="form-control" placeholder="请填写你的原因"></textarea>
			</div>
		</div>
	</div>
</div>
<!-- 摸态框 -->
	<!--<div class="model fade" style="margin-top:100px;" data-backdrop="true" id="trusteeship" role="dialog" aria-labelledby="trusteeship" aria-hidden="true">
		<div class="modal-dialog">
			<div style="" class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">托管相关</h4>
				</div>
				<div class="modal-body">
					托管办法!
					银行卡：
					支付宝：
					微信：
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" data-dismiss="modal">确认</button>
					<button class="btn btn-default" data-dismiss="modal">关闭</button>
				</div>
			</div><!--modal-content-->
		<!--</div><!--modal-dialog-->
	<!--</div><!--modal-->
<script type="text/javascript">
	function trusteeship_info (m) {
		$.messager.alert("<h2>托管相关</h2>","<h3>请转<span style=\"color:red\";>"+m+"</span>到</br>银行卡：1233322或</br>支付宝：122455或</br>微信:5511544</h3>");
	}
	//确认已经送出
	function send (id) {
		var params = {};
		params.id = id;
		$.messager.model = {
			ok : { text : "确认", classed : "btn-info"},
			cancel : { text : "取消", classed : "btn-default"}
		}
		$.messager.confirm("确认送出提示","请确认你已经将东西送出",function () {
			$.post("<?php echo site_url('Trade/sended'); ?>", params, function (data) {
				var rs = JSON.parse(data);
				if (rs.status==1){
					$.messager.confirm("确认送出提示","操作成功！等待对方确认后即可打款给你哦",function (){
						location.reload();
					});
				} else if (rs.status==-2){
					$.messager.alert("警告！","无权操作");
				}else if (rs.status ==-3) {
					$.messager.alert("警告！","此订单还没有托管资金");
				}else{
					$.messager.alert("警告！","操作失败");
				}
			});
		})
	}

	//收到东西
	function received (id) {
		var params = {};
		params.id = id;
		$.messager.model = {
			ok : { text : "确认", classed : "btn-info"},
			cancel : { text : "取消", classed : "btn-default"}
		}
		$.messager.confirm("确认收到提示","请确认你丢失的物品已经收到，同意之后托管资金将会打给对方",function () {
			$.post("<?php echo site_url('Trade/received'); ?>", params, function (data) {
				//console.log(data);
				var rs = JSON.parse(data);
				if (rs.status==1){
					$.messager.popup("操作成功！");
					location.reload();
				} else if (rs.status==-2){
					$.messager.alert("警告！","无权操作");
				}else if (rs.status ==-3) {
					$.messager.alert("警告！","此订单状态不对还不能确认收货");
				}else{
					$.messager.alert("警告！","操作失败");
				}
			});
		})
	}

	//退
	function refund (id) {
		var params = {};
		params.id = id;
		$.messager.model = {
			ok : { text : "确认", classed : "btn-info"},
			cancel : { text : "取消", classed : "btn-default"}
		}
		$.messager.confirm("警告！","你确认要退吗？",function () {
			//填写退款原因
			$("#refund").dialog({
				title:"原因填写",
				backdrop: "static",
				onClose:function () {$(this).dialog("close");},
				buttons:[
				{
					text:"提交",
					'class':"btn-success",
					click : function (){
						params.reason = $.trim($("#reason").val());
						$.post("<?php echo site_url('Trade/refund'); ?>", params, function (data) {
							console.log(data);
							var rs = JSON.parse(data);
							if (rs.status==1){
								$.messager.confirm("申请退回提示","操作成功！等待对方同意哦",function (){
									location.reload();
								});
							} else if (rs.status==-2){
								$.messager.alert("警告！","无权操作");
							}else if (rs.status ==-3) {
								$.messager.alert("警告！","此订单状态不对");
							}else{
								$.messager.alert("警告！","请填写字段"+rs.key);
							}
						});
					}
				},
				{
					text:"关闭",
					'class':"btn-default",
					click:function(){$(this).dialog("close");},
				}
				]
			});
			
		});
	}

	//同意退
	function agree (id) {
		var params = {};
		params.id = id;
		$.messager.model = {
			ok : { text : "确认", classed : "btn-info"},
			cancel : { text : "取消", classed : "btn-default"}
		}
		$.messager.confirm("提示！","同意之后托管资金将退回对方，请确认",function () {
			$.get("<?php echo site_url('Trade/agree');?>", params, function (data){
				var rs = JSON.parse(data);
				if (rs.status==1){
					$.messager.confirm("同意退回提示","操作成功！托管资金将打回到对方账户",function (){
						location.reload();
					});
				} else if (rs.status==-2){
					$.messager.alert("警告！","无权操作");
				}else if (rs.status ==-3) {
					$.messager.alert("警告！","此订单状态不对");
				}else{
					$.messager.alert("警告！","操作失败");
				}
			});
		});
	}

	//不同意退
	function reject (id){
		var params = {};
		params.id = id;
		$.messager.model = {
			ok : { text : "确认", classed : "btn-info"},
			cancel : { text : "取消", classed : "btn-default"}
		}
		$.messager.confirm("警告！","请确认！",function () {
			//填写退款原因
			$("#refund").dialog({
				title:"原因填写",
				backdrop: "static",
				onClose:function () {$(this).dialog("close");},
				buttons:[
				{
					text:"提交",
					'class':"btn-success",
					click : function (){
						params.reason = $.trim($("#reason").val());
						$.post("<?php echo site_url('Trade/reject'); ?>", params, function (data) {
							//console.log(data);
							var rs = JSON.parse(data);
							if (rs.status==1){
								$.messager.confirm("提示","操作成功！",function (){
									location.reload();
								});
							} else if (rs.status==-2){
								$.messager.alert("警告！","无权操作");
							}else if (rs.status ==-3) {
								$.messager.alert("警告！","此订单状态不对");
							}else{
								$.messager.alert("警告！","请填写字段"+rs.key);
							}
						});
					}
				},
				{
					text:"关闭",
					'class':"btn-default",
					click:function(){$(this).dialog("close");},
				}
				]
			});
			
		});
	}

	//查
	function query (id) {
		var params = {};
		params.id = id;
		$.get("<?php echo site_url('Trade/getLink');?>", params, function (data) {
			var rs = JSON.parse(data);
			var str = '';
			str = '<span style="font-size:2.1em;padding:40px;">姓名：'+rs.linkman+'</span></br>'+
					'<span style="font-size:2.1em;padding:40px;">手机：'+rs.mobile+'</span></br>'+
					'<span style="font-size:2.1em;padding:40px;">QQ：'+rs.qq+'</span>'+
					'<span style="font-size:2.1em;padding:40px;">QQ：'+rs.address+'</span>';
			$.messager.alert("联系人信息",''+str);
		});
	}
</script>

<style>
      .modal-open {
        overflow: auto;
        padding: 0 !important;
      }

      .modal.msg-alert {
        top: auto;
      }

      .modal.msg-alert .modal-dialog {
        width: 300px !important;
        margin: 30px auto 60px;
      }

      .modal.msg-alert .modal-body {
        background-color: #000;
        color: #fff;
      }

      .modal.msg-alert .modal-content {
        border: none;
      }
      </style>