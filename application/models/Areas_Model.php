<?php
/**
 * 地区模型
 * @author yzk <2273716951@qq.com>
 */
class Areas_Model extends MY_Model {
	/**
	 * 获取省份
	 */
	public function get_province(){
		$query = $this->db->query("select area_id,area_name from areas where area_type=0");
		$rs = $query->result_array();
		return $rs;
	}
	/**
	 * 根据上一级地区获取下一级地区
	 */
	public function get_next_by_parent($parent_id=''){
		if ($parent_id == ''){
			$parent_id = (int)(isset($_GET['id'])?$this->input->get('id'):$this->post('id'));
		}
		//$parent_id = ($parent_id!='')?$parent_id:$this->input->post('parent_id');
		$query = $this->db->query("select area_id,area_name,parent_id from areas where parent_id={$parent_id}");
		$rs = $query->result_array();
		return $rs;
	}
	/**
	 * 获取所有province跟city
	 */
	public function get_all(){
		$query = $this->db->query("select area_id, area_name, parent_id from areas where parent_id=0");
		$rp = $query->result_array();
		foreach ($rp as $i=>$p){
			$city_query = $this->db->query("select area_id,area_name,parent_id from areas where parent_id={$p['area_id']}");
			$rc = $city_query->result_array();
			$rp[$i]['city'] = $rc;
		}
		return $rp;
	}
	/**
	 * 选中城市
	 */
	public function city(){
		$rd = array('status'=>-1);
		$id = (int)(isset($_GET['id'])?$this->input->get('id'):$this->input->post('id'));
		//将选中city记录到session中
		$city['area_id'] = $id;
		$q = $this->db->query("select area_name from areas where area_id={$id}");
		//确认省份
		$p_id = (string)$id;
		$p_id[3] = 0;
		$p_id[4] = 0;
		$p_id[5] = 0;
		$p_id = (int)$p_id;
		$p_q = $this->db->query("select area_name from areas where area_id={$p_id}");
		$c_name = $q->row_array();
		$p_name = $p_q->row_array();
		if ($c_name){
			$city['area_name'] = $c_name['area_name'];
			$city['province_name'] = $p_name['area_name'];
			$_SESSION['city'] = $city;
			//如果用户是登录的
			if (isset($_SESSION['user'])){
				//将city存入用户的常用城市数据表
				$user = $_SESSION['user'];
				$data['common_city'] = json_encode($city);
				$rs = $this->db->update('user',$data,array('userid'=>$user['userid']));
			}
			$rd['status'] = 1;
		}
		return $rd;
	}
	/**
	 * 获取常用城市
	 */
	public function get_default_city(){
		if (!isset($_SESSION['city'])){
			if (isset($_SESSION['user'])){
				$user = $_SESSION['user'];
				$this->db->select('city_id,common_city');
				$query = $this->db->get_where('user',array('userid'=>$user['userid']));
				$rs = $query->row_array();
				$city = json_decode($rs['common_city'],true);
			}else{
				$city = array('area_id'=>110100,'area_name'=>'北京市','province_name'=>'北京');
			}
			$_SESSION['city'] = $city;
		}else{
			$city = $_SESSION['city'];
		}
		return $city;
	}
}