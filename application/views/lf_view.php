<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="col-md-12 lf-address">
				<div class="section">
					<span class="title">所属区域</span>
					<?php if ($lostOrFound == 1){?>
						<a href="<?php echo site_url('Home/lostView');?>" class="all">全部</a>
					<?php }else{?>
						<a href="<?php echo site_url('Home/findView');?>" class="all">全部</a>
					<?php }?>
					<ul id="area_list" class="list">
						<li><a href="">东城区</a></li>
						
					</ul>
				</div>
				<div class="section">
					<span class="title">信息标签</span>
					<?php if ($lostOrFound == 1){?>
						<a href="<?php echo site_url('Home/lostView');?>" class="all">全部</a>
					<?php }else{?>
						<a href="<?php echo site_url('Home/findView');?>" class="all">全部</a>
					<?php }?>
					<ul class="list">
						<li><a href="">公交</a></li>
						<li><a href="">道路</a></li>
						<li><a href="">饭店</a></li>
						<li><a href="">公园</a></li>
						<li><a href="">医院</a></li>
						<li><a href="">学校</a></li>
						<li><a href="">车站</a></li>
						<li><a href="">机场</a></li>
					</ul>
				</div>
				<div class="section">
					<span class="title">物品种类</span>
					<?php if ($lostOrFound == 1){?>
						<a href="<?php echo site_url('Home/lostView');?>" class="all">全部</a>
					<?php }else{?>
						<a href="<?php echo site_url('Home/findView');?>" class="all">全部</a>
					<?php }?>
					<ul class="list">
					<?php foreach ($cats as $k=>$v):?>
						<li><a href="<?php if ($lostOrFound==1){echo site_url('Home/lostView').'?cat_id='.$v['cat_id'];}else{echo site_url('Home/findView').'?cat_id='.$v['cat_id'];}?>"><?php echo $v['cat_name'];?></a></li>
					<?php endforeach?>
						
					</ul>
				</div>

			</div>

			<div class=" col-md-12 lf-main-body">
			<?php foreach ($obj['data'] as $k=>$v):?>
				<section class="col-md-12">
					<div class="show-img col-md-2">
						<img class="img-responsive" src="<?php echo $v['msg_imgs']; ?>">
					</div>
					<div class="col-md-10">
						<a href="<?php if ($lostOrFound==1){ echo site_url('Home/lostDetailView').'?id='.$v['msg_id'];}else{echo site_url('Home/findDetailView').'?id='.$v['msg_id'];} ?>" class="col-md-12 title"><?php echo $v['msg_title'];?>
						<?php if ($lostOrFound==1) { $str = "归还";} else { $str = "认领"; } ?>
						<?php if ($v['status'] == 1 ) {?>
							<span class="state">无人<?php echo $str?>未托管</span>
						<?php } else if ($v['status'] == 2 ) { ?>
							<span class="state">无人<?php echo $str?>已托管</span>
						<?php } else if ($v['status'] == 3 ) { ?>
							<span class="state">有人<?php echo $str?>交易中</span>
						<?php } else if ($v['status'] == 4 ) { ?>
							<span class="state">有人<?php echo $str?>交易完成</span>
						<?php } else if ($v['status'] == 5 ) { ?>
							<span class="state">无人<?php echo $str?>已托管</span>
						<?php } else { ?>
							<span class="state">无人<?php echo $str?>已托管</span>
						<?php }  ?>
						</a>
						<div class="col-md-12 desc"><?php echo $v['msg_content'];?></div>
						<div class="col-md-12 info">
							<div class="type"><span>物品种类:</span><?php echo $v['cat_name'];?></div>
							<div class="update"><?php echo $v['add_time'];?>更新</div>
						</div>

					</div>
				</section>
			<?php endforeach?>
				
			</div>

			<div class="col-md-12">
				<nav>
				  <ul class="pagination pagination-lg">
				  
				  <?php echo $obj['page'];?>
				    <!--
				    <li>
				      <a href="#" aria-label="Previous">
				        <span aria-hidden="true">&laquo;</span>
				      </a>
				    </li>
				    <li><a href="#">1</a></li>
				    <li><a href="#">2</a></li>
				    <li><a href="#">3</a></li>
				    <li><a href="#">4</a></li>
				    <li><a href="#">5</a></li>
				    <li>
				      <a href="#" aria-label="Next">
				        <span aria-hidden="true">&raquo;</span>
				      </a>
				    </li>
				     -->
				  </ul>
				</nav>
			</div>

			
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		area_url = "<?php $area = $_SESSION['city']; echo site_url('Area/get_next').'?id='.$area['area_id'];?>";
		$.get(area_url,function(data){
			//console.log(data);
			var a_rs = JSON.parse(data);
			var html = '';
			var page_url = "<?php if($lostOrFound==1){echo site_url('Home/lostView');}else{echo site_url('Home/findView');}?>";
			for (var i in a_rs) {
				html += '<li data-id="'+a_rs[i]['area_id']+'"><a href="'+page_url+'?qu_id='+a_rs[i]['area_id']+'">'+a_rs[i]['area_name']+'</a></li>';
			}
			//console.log(html);
			$('#area_list').html(html);
		});
		$('#area_list').on('click', 'li a',function(){
			var id = $(this).closest('li').data('id');
			//调用加载信息函数
		})
	});
	//
	
</script>