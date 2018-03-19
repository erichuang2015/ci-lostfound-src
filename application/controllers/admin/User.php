<?php 
/**
 * 用户控制器
 */
class User extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('User_Model','',true);
		$this->isAdminAjaxLogin();
	}
	/**
	 * 修改密码
	 */
	public function change_pass() {
		echo json_encode($this->User_Model->change_pass());
	}

	//删除
	public function del () {
		echo json_encode($this->User_Model->del());
		
	}

	//编辑
	public function edit () {
		echo json_encode($this->User_Model->admin_edit());
		
	}
}
?>