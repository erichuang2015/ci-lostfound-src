<?php
/**
 * @author yzk <[<email address>]>
 */
class News_Model extends MY_Model {
	public function __construct () {
		parent::__construct ();
	}

	//获取公告
	public function get_news () {
		$query = $this->db->get('news');
		return $query->result_array();
	}

	//插入
	public function insert () {
		$rd = array('status'=>-1);
		$data['title'] = $this->input->post('title');
		$data['content'] = $this->input->post('content');
		$data['add_time'] = date("Y-m-d h:i:s");
		$this->checkEmpty( $data, true );
		$rs = $this->db->insert('news', $data );
		if ($rs) {
			$rd['status'] = 1;
		}
		return $rd;
	}

	//根据id获取详情
	public function get_by_id () {
		$news_id = (int)(isset($_GET['id'])?$this->input->get('id'):$this->input->post('id'));
		$query = $this->db->get_where('news', array('news_id'=>$news_id));
		return $query->row_array();
	}

	//编辑
	public function edit () {
		$rd = array('status'=>-1);
		$news_id = (int)(isset($_GET['id'])?$this->input->get('id'):$this->input->post('id'));
		$data = $this->input->post('obj');
		$this->checkEmpty( $data, true );
		$rs = $this->db->update('news', $data, array('news_id'=>$news_id));
		if ($rs) {
			$rd['status'] = 1;
		}
		return $rd;
	}

	//启用
	public function on () {
		$rd = array('status'=>-1);
		$id = $this->input->post('id');
		if (is_array($id)){
			$count_error = 0; $count_right = 0;
			foreach ($id as $k=>$v ) {
				$rs = $this->db->update('news',array('status'=>1), array('news_id'=>(int)$v));
				if (false == $rs) {
					$error = array($v);
					$count_error++;
				}else{
					$right = array($v);
					$count_right++;
				}
			}
			if ($count_error == 0) {
				$rd['status'] = 1;
				$rd['error'] = $right;
				$rd['count'] = $count_right;
			}else{
				$rd['error'] = $error;
				$rd['count'] = $count_error;
			}
		}else{
			$rs = $this->db->update('news',array('status'=>1), array('news_id'=>(int)$id));
			if (false == $rs){
				$rd['status'] = -2;
			}else{
				$rd['status'] = 1;
			}
		}
		return $rd;
	}

	//停用
	public function off () {
		$id = $this->input->post('id');
		if (is_array($id)){
			$count_error = 0; $count_right = 0;
			foreach ($id as $k=>$v ) {
				$rs = $this->db->update('news',array('status'=>2), array('news_id'=>(int)$v));
				if (false == $rs) {
					$error = array($v);
					$count_error++;
				}else{
					$right = array($v);
					$count_right++;
				}
			}
			if ($count_error == 0) {
				$rd['status'] = 1;
				$rd['error'] = $right;
				$rd['count'] = $count_right;
			}else{
				$rd['error'] = $error;
				$rd['count'] = $count_error;
			}
		}else{
			$rs = $this->db->update('news',array('status'=>2), array('news_id'=>(int)$id));
			if (false == $rs){
				$rd['status'] = -2;
			}else{
				$rd['status'] = 1;
			}
		}
		return $rd;
	}

	//删除
	public function del () {
		$rd = array('status'=>-1);
		$id = $this->input->post('id');
		if (is_array($id)){
			$count_error = 0; $count_right = 0;
			foreach ($id as $k=>$v ) {
				$rs = $this->db->delete('news', array('news_id'=>(int)$v));
				if (false == $rs) {
					$error = array($v);
					$count_error++;
				}else{
					$right = array($v);
					$count_right++;
				}
			}
			if ($count_error == 0) {
				$rd['status'] = 1;
				$rd['error'] = $right;
				$rd['count'] = $count_right;
			}else{
				$rd['error'] = $error;
				$rd['count'] = $count_error;
			}
		}else{
			$rs = $this->db->delete('news', array('news_id'=>(int)$id));
			if (false == $rs){
				$rd['status'] = -2;
			}else{
				$rd['status'] = 1;
			}
		}
		return $rd;
	}
}