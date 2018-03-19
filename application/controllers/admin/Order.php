<?php
/**
 *@author yzk <2273716951@qq.com>
 * 
 */

class Order extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Orders_Model','',true);
	}

	//编辑
	public function edit () {
		echo json_encode($this->Orders_Model->admin_edit());
	}

	//托管
	public function trusteeship () {
		echo json_encode($this->Orders_Model->admin_trusteeship());
	}

	//删除
	public function del () {
		echo json_encode($this->Orders_Model->admin_del());
	}
}