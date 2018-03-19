
<div class="container-fluid">
	<div class="row">
	
		<div class="hidden-xs hidden-sm col-md-12 lf-banner">
		 		<div class="item" style="background-image: url(<?php echo base_url('public/img/banners/banner1.jpg') ?>)"></div>
		 		<div class="item" style="background-image: url(<?php echo base_url('public/img/banners/banner2.png') ?>)"></div>
		</div>

		<div class="col-md-10 col-md-offset-1 lf-mainbody">
			<div class="col-md-4">
				<div class="lf-border lf-lfbox">
					<h4><span class="lf-new-tag">最新<span class="lf-lin-tag"></span></span>丢失东西<a class="lf-more" href="<?php echo site_url('Home/lostView'); ?>">more+</a></h4>
					<ul>
					<?php foreach ($lostMsg as $i=>$v):?>
						<li><span class="lf-badge"><?php echo $v['area_name'];?></span><a href="<?php echo site_url('Home/lostDetailView').'?id='.$v['msg_id'];?>"><?php echo $v['msg_title'];?></a></li>
						<?php if ($i==9) break;?>
					<?php endforeach?>
						<!-- <li><span class="lf-badge">重庆市</span><a href="">绿色行李箱</a></li> -->
					</ul>
				</div>
			</div>

			<div class="col-md-4">
				<div class="lf-border lf-lfbox">
					<h4><span class="lf-new-tag">最新<span class="lf-lin-tag"></span></span>找到东西<a class="lf-more" href="<?php echo site_url('Home/findView'); ?>">more+</a></h4>
					<ul>
					<?php foreach ($foundMsg as $i=>$v):?>
						<li><span class="lf-badge"><?php echo $v['area_name'];?></span><a href="<?php echo site_url('Home/findDetailView').'?id='.$v['msg_id'];?>"><?php echo $v['msg_title'];?></a></li>
						<?php if ($i==9) break;?>
					<?php endforeach?>
						<!-- <li><span class="lf-badge">重庆市</span><a href="">绿色行李箱</a></li> -->
						
					</ul>
				</div>
			</div>

			<div class="col-md-4">
				<div class="lf-notice-panel">
					<h4>本站公告</h4>
					<ul>
						<li><a href="">休假通知</a></li>
						<li><a href="">休假通知</a></li>
						<li><a href="">休假通知</a></li> 
						<li><a href="">休假通知</a>
						<li><a href="">休假通知</a></li> 
						
					</ul>
				</div>
			</div>
			
		</div>

		<div class="col-md-12 lf-friend-link visible-md visible-lg">
			<div class="col-md-10 col-md-offset-1">
				<div class="col-sm-12 col-md-3"><a href=""><img class="img-responsive" src="<?php echo base_url('public/img/friendlink/friend1.jpg') ?>"></a></div>
				<div class="col-sm-12 col-md-3"><a href=""><img class="img-responsive" src="<?php echo base_url('public/img/friendlink/friend1.jpg') ?>"></a></div>
				<div class="col-sm-12 col-md-3"><a href=""><img class="img-responsive" src="<?php echo base_url('public/img/friendlink/friend1.jpg') ?>"></a></div>
				<div class="col-sm-12 col-md-3"><a href=""><img class="img-responsive" src="<?php echo base_url('public/img/friendlink/friend1.jpg') ?>"></a></div>
			</div>
		</div>

	</div>
</div>

