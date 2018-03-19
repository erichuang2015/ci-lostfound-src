<?php
/**
 * 广告模型
 */
class Ad_Model extends MY_Model {
	/**
	 * 所有广告 应该比较少所以不分页
	 */
	public function list(){
		$query = $this->db->query("select * from ad order by ad_id desc");
		$rs = $query->result_array();
		return $rs;
	}

?>