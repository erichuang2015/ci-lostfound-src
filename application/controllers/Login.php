<?php
/**
 * 登录控制器
 */
class Login extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}
	/**
	 * 登录视图
	 */
	public function toLogin(){
		//
	}
	/**
	 * 登录验证
	 */
	public function login(){
		$this->load->model('User_Model','',true);
		$rs = $this->User_Model->login();
		if ($rs['status'] === 1){
			$_SESSION['USER'] = $rs['user'];
			unset($rs['user']);
		}
		echo json_encode($rs);
	}
	/**
	 * 注册视图
	 */
	public function toRegister(){
		//
	}
	/**
	 * 注册
	 */
	public function register(){
		$this->load->model('User_Model','',true);
		$rs = $this->User_Model->register();
		echo json_encode($rs);
	}
	/**
	 * 登出
	 */
	public function logout(){
		unset($_SESSION['USER']);
		$url = site_url('Home/index');
		header("Location:{$url}");
	}
}