<?php
/**
 * 地区 控制器
 * @author yzk <2273716951@qq.com>
 */
class Area extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Areas_Model','',true);
		//$this->isAjaxLogin();
	}
	/**
	 * 根据省获取城市
	 */
	public function get_next(){
		$rs = $this->Areas_Model->get_next_by_parent();
		echo json_encode($rs);
	}
	/**
	 * 获取所有省份
	 */
	public function provinceList(){
		$rs = $this->Areas_Model->get_province();
		echo json_encode($rs);
	}
	/**
	 * 获取所有省份跟城市
	 */
	public function get_all(){
		$rs = $this->Areas_Model->get_all();
		echo json_encode($rs);
	}
	/**
	 * 选中城市
	 */
	public function city(){
		
		$rs = $this->Areas_Model->city();
		$url = site_url('Home/index');
		header("refresh:3;url={$url}");
		echo "<br/>";
		echo "<br/>";
		echo "<br/>";
		echo "<h3 align='center'>选择城市成功！正在跳转到首页，或者<a href ='".$url."'>点击这里直接跳转</a>，请稍等...<br>三秒后自动跳转</h3>";

	}
}
?>