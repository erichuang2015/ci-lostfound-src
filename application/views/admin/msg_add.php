<div class="container-fluid">
	<div class="row">
	<form id="msgForm">
		<div class="col-md-12 text-center">
		<h2>发布信息</h2>
		</div>
		<div class="col-md-8 col-md-offset-2 info-container">
			<div class="col-md-12 info-header">
				<div class="info-title">
					<div class="form-group">
						<label class="control-label col-md-1">标题:</label>
						<div class="col-md-7">
							<input id="title" type="text" class="form-control" placeholder="标题">
						</div>
					</div>
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
							<td class="col-md-2">信息类别</td>
							<td class="col-md-6">
								<div class="form-group">
									<select id="type" name="" >
										<option>请选择</option>
										<option value="1">失物</option>
										<option value="2">拾物</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td class="col-md-2">物品种类</td>
							<td class="col-md-8">
								<div class="form-group">
									<select id="cat" name="" >
										<option>请选择</option>
										<?php foreach ($cats as $c):?>
											<option value="<?php echo $c['cat_id'];?>"><?php echo $c['cat_name'];?></option>
										<?php endforeach?>
									</select>
								</div>
							</td>
							<td class="col-md-2" rowspan="4">
								<img class="img-responsive" src="<?php echo base_url('public/img/ims.jpg') ?>">
							</td>
							
						</tr>
						<tr>
							<td>详细描述</td>
							<td>
								<input type="text" id="describ" name="">
							</td>
							
						</tr>
						<tr>
							<td>酬谢方式</td>
							<td>
								<select name="" id="price_type">
									<option value="">请选择</option>
									<option value="1">自己定价</option>
									<option value="2">网站公平定价</option>
									<option value="3">爱心免费</option>
								</select>
							</td>
							
						</tr>
						<tr>
							<td>酬谢价钱</td>
							<td>
								<input type="text" id="price" placeholder="爱心类跟网站定价请勿填写" name="">
							</td>
							
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
							<td class="col-md-4">
								<select id="province">
									<option>选择省</option>
									<option>2</option>
								</select>
								<select id="city">
									<option>选择市</option>
									<option>2</option>
								</select>
								<select id="qu">
									<option>地区</option>
									<option>2</option>
								</select>
							</td>
							
							<td class="col-md-2">时间</td>
							
							<td class="col-md-4">
								<input type="text" id="time" name="">
							</td>
							
							
						</tr>
						<tr>
							
							<td class="col-md-2">拾到地点</td>
							<td class="col-md-10" colspan="3">
								<input type="text" id="place" name="">
							</td>
							
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
							<td class="col-md-10" colspan="3">
								<input type="text" id="address" name="">
							</td>
							
						</tr>
						<tr>
							<td class="col-md-2">联系人</td>
							<td class="col-md-4"><input type="text" id="linkman" name=""></td>
							<td class="col-md-2">手机</td>
							<td class="col-md-4"><input type="text" id="mobile" name=""></td>
						</tr>
						<tr>
							<td class="col-md-2">邮箱</td>
							<td class="col-md-4"><input type="text" id="email" name=""></td>
							<td class="col-md-2">电话</td>
							<td class="col-md-4"><input type="text" name=""></td>
						</tr>
						<tr>
							<td class="col-md-2">QQ</td>
							<td class="col-md-4"><input type="text" id="qq" name=""></td>
							<td class="col-md-2">微信</td>
							<td class="col-md-4"><input type="text" id="wechat" name=""></td>
						</tr>
						
						<tr>
							<td colspan="4"><button type="submit" id="sub-btn" class="btn btn-primary btn-block" >提交</button></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$.formValidator.initConfig({
		   theme:'Default',mode:'AutoTip',formID:"msgForm",debug:true,submitOnce:true,onSuccess:function(){
				   publish();
			       return false;
			},onError:function(msg){
		}});
		$('#title').formValidator({defaultvalue:true,onShow:"好的标题一目了然",onFocus:"好的标题一目了然",onCorrect:"输入正确"}).inputValidator({min:1,onError:"不能为空"}).inputValidator({min:1,max:100,onError:"长度非法"});
		$('#describ').formValidator({defaultvalue:true,onShow:"详细的描述",onFocus:"详细的描述一目了然",onCorrect:"输入正确"}).inputValidator({min:1,onError:"不能为空"}).inputValidator({min:4,max:200,onError:"长度非法"});
		$('#thank_method').formValidator({defaultvalue:true,onShow:"酬谢方式",onFocus:"你想要的报酬已经报酬方式",onCorrect:"输入正确"}).inputValidator({min:1,onError:"不能为空"}).inputValidator({min:4,max:200,onError:"长度非法"});
		$('#time').formValidator({defaultvalue:true,onShow:"拾取或者丢失的时间",onFocus:"拾取或者丢失的时间列2019-06-15",onCorrect:"输入正确"}).inputValidator({min:1,onError:"不能为空"}).inputValidator({min:6,max:200,onError:"长度非法"});
		$('#place').formValidator({defaultvalue:true,onShow:"地点",onFocus:"详细的地点",onCorrect:"输入正确"}).inputValidator({min:1,onError:"不能为空"}).inputValidator({min:6,max:200,onError:"长度非法"});
		$('#linkman').formValidator({defaultvalue:true,onShow:"联系人",onFocus:"联系人",onCorrect:"输入正确"}).inputValidator({min:1,onError:"不能为空"}).inputValidator({min:2,max:200,onError:"长度非法"});
		$('#link_mobile').formValidator({defaultvalue:true,onFocus:"请输入你的手机号码",onCorrect:"输入正确"}).inputValidator({min:1,onError:"手机号码不能为空"}).inputValidator({min:6,max:100,onError:"手机号码长度非法"}).regexValidator({regExp:"^(\\d{3,4}-?\\d{7,8}|(13|15|18)\\d{9})$",onError:"手机格式不正确,请确认"});
		//加载数据
		//加载地区信息
		var p_url = "<?php echo site_url('Area/provinceList');?>";
		$.get(p_url,function(data){
			var p_rs = JSON.parse(data);
			var p_html = '<option>选择省</option>';
			for (var i in p_rs){
				p_html += 	'<option value="'+p_rs[i]['area_id']+'">'+
								p_rs[i]['area_name']+
							'</option>';
			}
			$('#province').html(p_html);
		});

		$("#price_type").on("change",function () {
			if ($(this).val()!=1 ||$(this).val()==''){
				$("#price").attr({"disabled":"disabled"});
			}else{
				$("#price").removeAttr("disabled");
			}
		})
	});
	function publish(){
		var params = {};
		params.type = $.trim($("#type"),val());
		if ($("#price_type").val()==2){
			params.status = 2;
		}else{
			params.status = 1;
		}
		params.price_type = $("#price_type"),val();
		params.msg_title = $.trim($('#title').val());
		params.cat_id = $.trim($('#cat').val());
		params.thank_method = $.trim($('#thank_method').val());
		params.province_id = $.trim($('#province').val());
		params.city_id = $.trim($('#city').val());
		params.qu_id = $.trim($('#qu').val());
		params.msg_content = $.trim($('#describ').val());
		params.price = $.trim($('#price').val());
		params.time = $.trim($('#time').val());
		params.place = $.trim($('#place').val());
		//联系方式
		params.linkman = $.trim($('#linkman').val());
		params.address = $.trim($('#address').val());
		params.qq = $.trim($('#qq').val());
		params.mobile = $.trim($('#mobile').val());
		params.wechat = $.trim($('#wechat').val());
		params.email = $.trim($('#email').val());
		var url = "<?php echo site_url('admin/Msg/add');?>";
		//console.log(params);
		$.post(url,params,function(data,textStatus){
			//alert(data);
			//console.log(data);
			var rs = JSON.parse(data);
			if (rs.status==1){
				$.messager.model = {
					ok : {text: "现在去",classed:"btn-primary"},
					cancel : {text: "返回", classed :"btn-default"}
				}
				$.messager.confirm("发布成功提示！","恭喜你，失物信息发布成功！请前往个人中心托管资金",function() {
					location.href="<?php echo site_url('Home/personCenter').'#myPublish';?>";
				});
			}else if(rs.status==-1){
				$.messager.popup('请填写'+rs.key+'字段');
			}
		});
	}
	//
	$('#province').change(function(){
		c_url = "<?php echo site_url('Area/get_next');?>?id="+$(this).val();
		$.get(c_url,function(data){
			var c_rs = JSON.parse(data);
			var c_html = '<option>选择城市</option>';
			for (var i in c_rs){
				c_html += 	'<option value="'+c_rs[i]['area_id']+'">'+
								c_rs[i]['area_name']+
							'</option>';
			}
			$('#city').html(c_html);
		})
	});
	$('#city').change(function(){
		q_url = "<?php echo site_url('Area/get_next');?>?id="+$(this).val();
		$.get(q_url,function(data){
			var q_rs = JSON.parse(data);
			var q_html = '<option>选择地区</option>';
			for (var i in q_rs){
				q_html += 	'<option value="'+q_rs[i]['area_id']+'">'+
								q_rs[i]['area_name']+
							'</option>';
			}
			$('#qu').html(q_html);
		})
	});
</script>

<script src="<?php echo base_url('public/js/lib/formValidator/formValidator-4.1.3.js');?>"></script>
<script src="<?php echo base_url('public/js/lib/formValidator/formValidatorRegex.js')?>"</script>