<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/fileUpload/webuploader.css');?>">
<script src="<?php echo base_url('public/fileUpload/webuploader.min.js');?>"></script>
<style type="text/css">

</style>
<div class="container-fluid">
	<div class="row">
	<form id="msgForm">
		<div class="col-md-12 text-center">
		<?php if ($lostOrFound == 1){?>
		<h1>丢失信息</h1>
		<?php }else{?>
		<h1>拾到信息</h1>
		<?php }?>
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
							<!--dom结构部分-->
<div id="uploader">
    <!--用来存放item-->
    <div id="fileList" class="uploader-list"></div>
    <div id="filePicker">选择图片</div>
</div>

								<input type="hidden" id="img_url">
								
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
									<option>请选择</option>
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
							<?php if ($lostOrFound == 1){?>
							<td class="col-md-2">丢失时间</td>
							<?php }else{?>
							<td class="col-md-2">拾到时间</td>
							<?php }?>
							<td class="col-md-4">
								<input type="text" id="time" name="">
							</td>
							
							
						</tr>
						<tr>
							<?php if ($lostOrFound == 1){?>
							<td class="col-md-2">丢失地点</td>
							<?php }else{?>
							<td class="col-md-2">拾到地点</td>
							<?php }?>
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
		$('#linkman').formValidator({tipCss:{width:100},defaultvalue:true,onShow:"联系人",onFocus:"联系人",onCorrect:"输入正确"}).inputValidator({min:1,onError:"不能为空"}).inputValidator({min:2,max:200,onError:"长度非法"});
		$('#mobile').formValidator({tipCss:{left:10,top:-4,height:20,width:100},defaultvalue:true,onShow:"手机号",onFocus:"手机号码",onCorrect:"输入正确"}).inputValidator({min:1,onError:"手机号码不能为空"}).inputValidator({min:6,max:100,onError:"手机号码长度非法"}).regexValidator({regExp:"^(\\d{3,4}-?\\d{7,8}|(13|15|18)\\d{9})$",onError:"手机格式不正确,请确认"});
		$('#cat').formValidator({tipCss:{left:10,top:-4,height:20,width:100},defaultvalue:true,onShow:"物品种类",onFocus:"物品种类",onCorrect:"输入正确"}).inputValidator({min:1,onError:"不能为空"});
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
			if ($(this).val()!=1){
				$("#price").attr({"disabled":"disabled"});
				$("#price").val('');
			}else{
				$("#price").removeAttr("disabled");
			}
		})
		// 初始化Web Uploader
var uploader = WebUploader.create({

    // 选完文件后，是否自动上传。
    auto: true,

    // swf文件路径
    swf: "<?php echo base_url('public/fileUpload/Uploader.swf');?>",

    // 文件接收服务端。
    server: "<?php echo site_url('Msg/UploadPic');?>",

    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: {id:'#filePicker',multiple:false},
    thumb:{width:110,height:110},
    threads:1,
    fileNumLimit:1,
    // 只允许选择图片文件。
    accept: {
        title: 'Images',
        extensions: 'gif,jpg,jpeg,bmp,png',
        mimeTypes: 'image/*'
    }
});
// 当有文件添加进来的时候
uploader.on( 'fileQueued', function( file ) {
    var $li = $(
            '<div id="' + file.id + '" class="file-item thumbnail">' +
                '<img>' +
                '<div class="info">' + file.name + '</div>' +
            '</div>'
            ),
    $btns = $('<div class="file-panel">' +
    	'<span id="del_img" class="btn btn-warning btn-xs glyphicon glyphicon-remove">删除</span></div>').appendTo( $li ),
        $img = $li.find('img');
    $list = $('#fileList');
    // $list为容器jQuery实例
    $list.append( $li );

    // 创建缩略图
    // 如果为非图片文件，可以不用调用此方法。
    // thumbnailWidth x thumbnailHeight 为 100 x 100
    //var thumbnailWidth = 100,thumbnailHeight=100;
    uploader.makeThumb( file, function( error, src ) {
        if ( error ) {
            $img.replaceWith('<span>不能预览</span>');
            return;
        }

        $img.attr( 'src', src );
    } );//thumbnailWidth, thumbnailHeight );
});
// 文件上传过程中创建进度条实时显示。
uploader.on( 'uploadProgress', function( file, percentage ) {
	//alert('ss');
    var $li = $( '#'+file.id ),
        $percent = $li.find('.progress span');

    // 避免重复创建
    if ( !$percent.length ) {
        $percent = $('<p class="progress"><span></span></p>')
                .appendTo( $li )
                .find('span');
    }

    $percent.css( 'width', percentage * 100 + '%' );
});

// 文件上传成功，给item添加成功class, 用样式标记上传成功。
uploader.on( 'uploadSuccess', function( file ,response ) {
	//console.log(response);
	var rs = response;
	if (rs.status==1){
		$('#img_url').val(rs.data.file_url);
		$.messager.popup('上传成功！');
	}else{
		$.messager.confirm('上传失败提示',"文件上传失败,失败原因："+rs.errmsg,function(){
			//location.reload();
			uploader.removeFile(file);
			$('#'+file.id).off().remove();
		});
	}
    $( '#'+file.id ).addClass('upload-state-done');
});

// 文件上传失败，显示上传出错。
uploader.on( 'uploadError', function( file ) {
    var $li = $( '#'+file.id ),
        $error = $li.find('div.error');

    // 避免重复创建
    if ( !$error.length ) {
        $error = $('<div class="error"></div>').appendTo( $li );
    }

    $error.text('上传失败');
    $.messager.popup("上传失败！");
});
var del_file = '';
// 完成上传完了，成功或者失败，先删除进度条。
uploader.on( 'uploadComplete', function( file ) {
    $( '#'+file.id ).find('.progress').remove();
    //绑定图片删除事件
del_file = file;
});
$('#uploader').on('click','#del_img',function(){
	//alert(del_file);
	uploader.removeFile(del_file);
	$('#'+del_file.id).off().remove();
})

	});
	function publish(){
		var params = {};
		params.type = <?php echo $lostOrFound;?>;
		if ($("#price_type").val()==2){
			params.status = 2;
		}else{
			params.status = 1;
		}
		params.price_type = $("#price_type").val();
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
		params.msg_imgs = $.trim($('#img_url').val());
		var url = "<?php echo site_url('Msg/add');?>";
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
				<?php if ($lostOrFound == 1) {?>
					$.messager.confirm("发布成功提示！","恭喜你，失物信息发布成功！请前往个人中心托管资金",function() {
						location.href="<?php echo site_url('Home/personCenter').'#myPublish';?>";
					});
				<?php }else { ?>
					$.messager.confirm("发布成功提示！","恭喜你，拾物信息发布成功！你可以前往个人中心查看",function() {
						location.href="<?php echo site_url('Home/personCenter').'#myPublish';?>";
					});
				<?php } ?>
			}else if(rs.status==-1){
				$.messager.popup('请填写'+rs.key+'字段');
			}
		});
	}
	//图片上传

	function uploadImg (file) {
		//alert(file);
		console.log(file);
		//判断是否有选择上传文件
            var imgPath = $("#imgUpload").val();
            if (imgPath == "") {
                alert("请选择上传图片！");
                return;
            }
            //判断上传文件的后缀名
            var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
            if (strExtension != 'jpg' && strExtension != 'gif' && strExtension != 'png' && strExtension != 'bmp') {
                alert("请选择图片文件");
                return;
            }
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Msg/UploadPic'); ?>",
                data: { file: $("#imgUpload").val() },
                cache: false,
                success: function(data) {
                	console.log(data);
                    alert("上传成功");
                    //var rs = JSON.parse()
                    img_html = '<img hidden="true" id="pre_img" class="img-responsive" src="'+imgPath+'">';
                    $("#imgDiv").empty();
                    $("#imgDiv").html(img_html);
                    $("#imgDiv").show();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("上传失败，请检查网络后重试");
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