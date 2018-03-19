<?php
/**
 * 交易控制器
 */
class Trade extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Orders_Model','',true);
		$this->isAjaxLogin();
	}
	/**
	 * 申请认领
	 */
	public function found(){
		$this->isAjaxLogin();
		//$this->load->model('Orders_Model','',true);
		$rs = $this->Orders_Model->claim();
		echo json_encode($rs);
	}
	/**
	 * 申请归还
	 */
	public function back(){
		$this->isAjaxLogin();
		$rs = $this->Orders_Model->back();
		echo json_encode($rs);
	}

	//确认已经送出
	public function sended () {
		$rs = $this->Orders_Model->sended();
		echo json_encode($rs);
	}

	//收货
	public function received () {
		$rs = $this->Orders_Model->received();
		echo json_encode($rs);
	}

	//退款
	public function refund () {
		$rs = $this->Orders_Model->refund();
		echo json_encode($rs);
	}

	//同意退
	public function agree () {
		$rs = $this->Orders_Model->agree();
		echo json_encode($rs);
	}

	//不同意退
	public function reject () {
		$rs = $this->Orders_Model->reject();
		echo json_encode($rs);
	}

	//查
	public function getInfo () {
		$rs = $this->Orders_Model->get_info();
		echo json_encode($rs);
	}

	//查联系方式
	public function getLink () {
		$rs = $this->Orders_Model->get_link();
		echo json_encode($rs);
	}
}