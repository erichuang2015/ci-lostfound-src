<?php 
/**
 * 
 */
class Msg extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Message_Model','',true);
		$this->isAdminAjaxLogin();
	}

	//编辑
	public function edit () {
		echo json_encode($this->Message_Model->admin_edit());
	}

	//定价
	public function pricing () {
		echo json_encode($this->Message_Model->pricing());
	}

	//删除
	public function del () {
		echo json_encode($this->Message_Model->del());
	}

	//启用
	public function on () {
		echo json_encode($this->Message_Model->on());
	}

	//关闭
	public function off () {
		echo json_encode($this->Message_Model->off());
	}

	//发布
	public function add () {
		echo json_encode($this->Message_Model->admin_add());
	}
}