<?php
/**
 * 信息控制器
 * @author jerr <2273716951@qq.com>
 */
class Msg extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Message_Model','',true);
	}
	/**
	 * 发布丢失信息视图
	 */
	public function toLost(){
		$this->isLogin();
		$this->load->view('publish_lost');
	}
	/**
	 * 插入
	 */
	public function add(){
		$this->isAjaxLogin();
		$rs = $this->Message_Model->insert();
		echo json_encode($rs);
	}

	//关闭信息
	public function closeMsg () {
		$this->isAjaxLogin();
		echo json_encode($this->Message_Model->close());
	}

	//删除
	public function delMsg () {
		$this->isAjaxLogin();
		echo json_encode($this->Message_Model->del());
	}
}