<?php
/**
 * 
 */
class Goods_cats_Model extends MY_Model {
	/**
	 * 获取物品类别
	 */
	public function get(){
		$query = $this->db->query("select cat_id,cat_name from goods_cats");
		return $query->result_array();
	}
}