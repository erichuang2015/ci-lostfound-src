<nav class="nav-collapse menu-nav hidden-md hidden-lg">
    <ul>
        <li><a href="<?php echo site_url('Home/home') ?>">首页</a></li>
		<li><a class="active" href="<?php echo site_url('Home/lostView') ?>">丢失东西</a></li>
		<li><a href="<?php echo site_url('Home/findView') ?>">找到东西</a></li>
		<li><a href="<?php echo site_url('Home/news') ?>">新闻资讯</a></li>
		<li><a href="<?php echo site_url('Home/aboutus') ?>">关于我们</a></li>
		<li><a href="<?php echo site_url('Home/publishLost') ?>">发布丢失</a></li>
		<li><a href="<?php echo site_url('Home/publishFound') ?>">发布拾取</a></li>
    </ul>
</nav>

<div class="container-fluid">
	<div class="row" style="background-color: #eee;">
		<div class="col-md-10 col-md-offset-1 lf-top-nav">
			<div class="col-xs-8 col-md-3">
				<span id="address"><?php echo $city['province_name'].'-'.$city['area_name'];?></span> <a href="<?php echo site_url('Home/chooseCity') ?>">[选择城市]</a>
			</div>

			<div class="col-md-3 visible-md visible-lg pull-right text-right">
				<a href="">设为首页</a> |
				<a href="">加入收藏</a>
			</div>
			<div class="visible-xs visible-sm col-xs-4 text-right login-area">
				<?php if (!isset($_SESSION['USER'])) {?>
				
					<a class="" href="<?php echo site_url('Home/loginView') ?>">登录</a>
					<a class="" href="<?php echo site_url('Home/registerView') ?>">注册</a>	
				
				<?php }else{ $user = $_SESSION['USER'];?>
				
					<h3>欢迎你~<a href="<?php echo site_url('Home/personCenter');?>"><?php echo $user['nickname'];?></a></h3>
					<a href="<?php echo site_url('Login/logout');?>">安全退出</a>
				
				<?php }?>
				<span id="menu-btn" class="glyphicon glyphicon-menu-hamburger"></span>
			</div>

		</div>
	</div>

	<div class="row" style="border-bottom: 1px solid lightgray;">
		<div class="hidden-xs hidden-sm col-md-10 col-md-offset-1">
			<div class="col-md-3 col-sm-3 hidden-xs lf-logo">
				<img class="img-responsive" src="<?php echo base_url('public/img/logo1.png'); ?>">
			</div>
			<div class="col-md-7 col-sm-7 lf-nav">
				<a href="<?php echo site_url('Home/home') ?>">首页</a>
				<a class="active" href="<?php echo site_url('Home/lostView') ?>">丢失东西</a>
				<a href="<?php echo site_url('Home/findView') ?>">找到东西</a>
				<a href="<?php echo site_url('Home/news') ?>">新闻资讯</a>
				<a href="<?php echo site_url('Home/aboutus') ?>">关于我们</a>
				<a href="<?php echo site_url('Home/publishLost') ?>">发布丢失</a>
				<a href="<?php echo site_url('Home/publishFound') ?>">发布拾取</a>
			</div>
			<div class="col-md-2 lf-lore">
				<?php if (!isset($_SESSION['USER'])) {?>
				<div class="btn-group">
					<a class="btn btn-primary" href="<?php echo site_url('Home/loginView') ?>">登录</a>
					<a class="btn btn-primary" href="<?php echo site_url('Home/registerView') ?>">注册</a>	
				</div>
				<?php }else{ $user = $_SESSION['USER'];?>
				<div>
					<h3>欢迎你~<a href="<?php echo site_url('Home/personCenter');?>"><?php echo $user['nickname'];?></a></h3>
					<a href="<?php echo site_url('Login/logout');?>">安全退出</a>
				</div>
				<?php }?>
			</div>
		</div>
	</div>
</div>