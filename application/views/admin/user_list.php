<div class="oms-page">
		<div id="test" class="oms-tbar" style="text-align: right; height: 25px">
			<a href="<?php echo site_url('admin/Home/userAdd');?>" class="btn btn-success glyphicon-plus">新增</a>
		</div>
		<br/>
		<div class="oms-body">
		
			<table style="padding-top: 10px;border: 1px solid #ddd;" class="table table-hover">
				<thead>
					<tr>
						<th width="50">&nbsp;序&nbsp;号&nbsp;&nbsp;</th>
						<th>用户名</th>
						<th>昵称</th>
						<th>邮箱</th>
						<th>手机</th>
						<th>地址</th>
						<th>注册时间</th>
						<th>常用城市</th>
						<!-- <th>地点</th> -->
						<th width="300">操作</th>
					</tr>
				</thead>
				<tbody id="list">
					<?php foreach ($user as $k=>$v) :?>
					<tr>
						<td><input value="<?php echo $v['userid']?>" id="selector" type="checkbox" name="">&nbsp;<?php echo $k+1;?></td>
						<td><?php echo $v['username']?></td>
						<td><?php echo $v['nickname']?></td>
						<td><?php echo $v['email']?></td>
						<td><?php echo $v['mobile']?></td>
						<td><?php echo $v['address']?></td>
						<td><?php echo $v['regdate']?></td>
						<td><?php echo $v['common_city']?></td>	
						<td>
							<a href="<?php echo site_url('admin/Home/userEdit');?>?id=<?php echo $v['userid']?>" class="btn btn-primary glyphicon glyphicon-pencil">修改</a>
							<button class="btn btn-warning glyphicon glyphicon-trash" onclick="javascript:del(<?php echo $v['userid']?>,<?php echo $k+1;?>)" style="width: 64px;" ></button>
						</td>
					</tr>
					<?php endforeach?>
					<tr>
					<td colspan="10">
						<input id="all" type="checkbox">&nbsp;&nbsp;<span >全选</span>
						选中项：
							<!-- <button class="btn btn-success btn-sm glyphicon glyphicon-ok" id="btn-start-all">启用</button> -->
							<button class="btn btn-warning btn-sm glyphicon glyphicon-trash" style="width: 64px;" id="btn-del-all" ></button>
						</td>
					</tr>
					<tr>
						<td colspan="10" align="center">
							<ul style="margin:0px;padding:0px;" class="pagination">
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
				$.post("<?php echo site_url('admin/News/on');?>",params,function(data){
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
				$.post("<?php echo site_url('admin/News/off');?>" ,params, function(data){
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
					$.post("<?php echo site_url('admin/User/del');?>",params,function(data){
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
			$.post("<?php echo site_url('admin/News/on');?>", params, function(data){
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
			$.post("<?php echo site_url('admin/News/off');?>", params, function(data){
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
				$.post("<?php echo site_url('admin/User/del')?>", params, function(data){
					var rs = JSON.parse(data);
					if (rs.status == 1){
						$.messager.model = {
							ok : { text: "是",classed: 'btn-primary'},
							cancel : {text:'返回', classed: 'btn-default'}
						};
						$.messager.confirm('删除公告提示',"删除操作成功！",function(){
							location.reload();
						});
					}else{
						$.messager.alert("删除公告提示","操作失败");
					}
				});
			});
		}

		//批删除
		
	</script>