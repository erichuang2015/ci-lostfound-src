<?php
/**
 *@author yzk <2273716951@qq.com>
 * 
 */

class News extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('News_Model','',true);
	}

	//插入
	public function add () {
		$rs = $this->News_Model->insert();
		echo json_encode( $rs );
	}

	//关闭
	public function off () {
		$rs = $this->News_Model->off();
		echo json_encode( $rs );
	}
	
	//关闭
	public function on () {
		$rs = $this->News_Model->on();
		echo json_encode( $rs );
	}

	//删除
	public function del () {
		$rs = $this->News_Model->del();
		echo json_encode( $rs );
	}

	//编辑
	public function edit () {
		$rs = $this->News_Model->edit();
		echo json_encode( $rs );
	}
}