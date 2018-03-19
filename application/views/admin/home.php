<?php //$user = $_SESSION['ADMIN'];?>
	<div class="navbar navbar-duomi navbar-static-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
               <div class="navbar-brand">
                    <h3>失物招领网——管理员后台</h3>
                </div>
            </div>
            <div class="navbar-body">
                <div class="info">
                        <span>欢迎你<?php echo $user['username']?></span>
                        <span>交易单总计：<?php echo $_info['orderNum'] ?></span>
                        <span class="credit">信息总数：<?php echo $_info['msgNum'] ?></span>
                        <span>总会员数：<?php echo $_info['userNum']?></span>
                    <a href="{:U('Index/logout')}"><i class="glyphicon glyphicon-off"></i>退出</a>
                </div>
                
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <ul id="main-nav" class="main-nav nav nav-tabs nav-stacked" style="">
                    <li>
                         <a href="#systemSetting" class="nav-header collapsed" data-toggle="collapse">
                            <i class="glyphicon glyphicon-cog"></i>
                            系统管理
                            
                            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
                        </a>
                        <ul id="systemSetting" class="nav nav-list secondmenu collapse in">
                            <li><a href="{:U('Index/config')}" target="iframe_a"><i class="glyphicon glyphicon-user"></i>&nbsp;基本设置</a></li>
                            <li><a href="<?php echo site_url('admin/Home/newsList');?>" target="iframe_a"><i class="glyphicon glyphicon-asterisk"></i>&nbsp;公告列表</a></li>
                            <li><a href="<?php echo site_url('admin/Home/alterPass');?>" target="iframe_a""><i class="glyphicon glyphicon-edit"></i>&nbsp;修改密码</a></li>
                            <!-- <li><a href="{:U('Index/logLogins')}" target="iframe_a"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;日志查看</a></li> -->
                        </ul>
                    </li>
                    <li>
                        <a href="#userSetting" class="nav-header collapsed" data-toggle="collapse">
                            <i class="glyphicon glyphicon-th-large"></i>
                            消息管理
                            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span> 
                        </a>
                        <ul class="nav nav-list secondmenu collapse" id="userSetting" style="height: 0px;">
                            <li>
                                <a href="<?php echo site_url('admin/Home/msgList');?>" target="iframe_a"><i class="glyphicon glyphicon-list"></i>查看消息</a>
                            </li>
                             <li>
                                <!-- <a href="<?php echo site_url('admin/Home/foundList');?>" target="iframe_a"><i class="glyphicon glyphicon-list"></i>查看拾物</a> -->
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#configSetting" class="nav-header collapsed" data-toggle="collapse">
                            <i class="glyphicon glyphicon-user"></i>
                            会员管理	
                                   <span class="pull-right glyphicon  glyphicon-chevron-toggle"></span>
                        </a>
                        <ul id="configSetting" class="nav nav-list secondmenu collapse in">
                            <li class="">
                                <a href="<?php echo site_url('admin/Home/userList');?>" target="iframe_a"><i class="glyphicon glyphicon-list"></i>&nbsp;会员列表</a>
                            </li>
                            <!-- <li><a href="{:U('User/add')}" target="iframe_a"><i class="glyphicon glyphicon-star-empty"></i>系统注册</a></li> -->
                            <!-- <li><a href="{:U('Index/stat')}" target="iframe_a"><i class="glyphicon glyphicon-star"></i>&nbsp;other item1</a></li> -->
                            <!-- <li><a href="#"><i class="glyphicon glyphicon-text-width"></i>&nbsp;other item2</a></li> -->
                            <!-- <li><a href="#"><i class="glyphicon glyphicon-ok-circle"></i>&nbsp;other item3</a></li> -->
                        </ul>
                    </li>

                    <li>
                        <a href="#disSetting" class="nav-header collapsed" data-toggle="collapse">
                            <i class="glyphicon glyphicon-list-alt"></i>
                            订单管理
							 <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
                        </a>
                        <ul id="disSetting" class="nav nav-list secondmenu collapse">
                            <li><a href="<?php echo site_url('admin/Home/orderList');?>" target="iframe_a"><i class="glyphicon glyphicon-list"></i>查看交易</a></li>
                            <!-- <li><a href="#"><i class="glyphicon glyphicon-plus"></i>&nbsp;新增报单</a></li> -->
                        </ul>
                    </li>

                    <li>
                        <a href="#dicSetting" class="nav-header collapsed" data-toggle="collapse">
                            <i class="glyphicon glyphicon-bold"></i>
                            常用配置
                            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
                        </a>
                        <ul id="dicSetting" class="nav nav-list secondmenu collapse">
                            <li><a href="#"><i class="glyphicon glyphicon-text-width"></i>&nbsp;关键字配置</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-fire"></i>
                            关于系统
                            <span class="badge pull-right">1</span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="col-md-10">
                <div class="col-sm-12 panel panel-default">
                    <section class="content-header">
                     <div class="notice">
                         <span class="menu1">
                            <i class="glyphicon glyphicon-cog"></i>
                            系统管理
                        </span><span><i class="glyphicon glyphicon-chevron-right" style="padding-right:5px;"></i></span><span class="menu2"><i class="glyphicon glyphicon-asterisk"></i>&nbsp;公告列表</span>
                    </div>
                    </section>
                </div>
            	<iframe name="iframe_a" src="{:U('News/all')}" frameborder="0" marginheight="0" marginwidth="0" width="100%" scrolling="no" id="test" onload="this.height=100"></iframe>
            </div>
        </div>

    </div>
<script type="text/javascript">
	function reinitIframe(){
		var iframe = document.getElementById("test");
		try{
			var bHeight = iframe.contentWindow.document.body.scrollHeight;
			var dHeight = iframe.contentWindow.document.documentElement.scrollHeight;
			var height = Math.max(bHeight, dHeight);
			iframe.height = height;
			console.log(height);
		}catch (ex){}
	}
	window.setInterval("reinitIframe()", 200);
</script>
	<!--引入js-->
	<!-- <script src="__PUBLIC__/js/jquery-2.2.2.min.js"></script> -->
    <!-- <script src="__PUBLIC__/plugins/bootstrap/js/bootstrap.min.js"></script> -->
</body>
</html>
