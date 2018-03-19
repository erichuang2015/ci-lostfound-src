<?php
/**
 *@author yzk <2273716951@qq.com>
 * 
 */

class Login extends MY_Controller {
	public function __construct() {
		parent::__construct();
	}

	//登录视图
	public function toLogin () {
		$this->page('toLogin',
			array(
				'title'=>"欢迎登录失物招领管理后台",
				'css'=>array('login')
				)
			);
		$this->load->view('admin/templates/footer','',false);
	}

	//登录
	public function login () {
		$this->load->model('Home_Model','',true);
		$rs = $this->Home_Model->login();
		if ( $rs['status'] ==1 ) {
			$_SESSION['ADMIN'] = $rs['admin'];
			unset($rs['admin']);
		}
		echo json_encode($rs);
	}
}