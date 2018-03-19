<?php 
/**
 * 用户控制器
 */
class User extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('User_Model','',true);
	}
	/**
	 * 修改密码
	 */
	public function change_pass() {
		$this->isAjaxLogin();
		echo json_encode($this->User_Model->change_pass());
	}

	//
}
?>