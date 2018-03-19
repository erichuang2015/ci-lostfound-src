<?php
/**
 * 信息模型
 */
class Sms_Model extends MY_Model {
	/**
	 * 列表查询 信息 支持多条件查询
	 */
	public function query_by_list(){
		$user = $_SESSION['USER'];
		$query = $this->db->query("select s.*,m.type,u.username as send_username from sms s,message m,user u where s.receive_userid = {$user['userid']} and u.userid=s.send_userid and s.msg_id=m.msg_id");
		$rs = $query->result_array();
		return $rs;
	}
	/**
	 * 获取单条详情
	 */
	public function get(){
		$sms_id = (int)((isset($_GET['sms_id']))?$this->input->get('sms_id'):$this->input->post('sms_id'));
		$query = $this->query("select * from sms where sms_id={$sms_id} limit 1");
		$rs = $query->row_array();
		return $rs;
	}
	/**
	 * 新增发送信息
	 */
	public function insert(){
		$rd = array('status'=>-1);
		$admin = $_SESSION['ADMIN'];
		$data['receive_userid'] = $this->input->post('receive_userid');
		$data['send_userid'] = $admin['userid'];
		$data['sms_title'] = $this->input->post('sms_title');
		$data['sms_content'] = $this->input->post('sms_content');
		if ($this->checkEmpty($data)){
			$data['add_time'] = date("Y-m-d h:i:s");
			$data['status'] = 0;
			$rs = $this->db->insert('sms',$data);
			if ($rs){
				$rd['status'] = 1;
			}
		}
		return $rd;
	}
	/**
	 * 编辑
	 */
	public function edit(){
		$rd = array('status'=>-1);
		$sms_id = (int)((isset($_GET['sms_id']))?$this->input->get('sms_id'):$this->input->post('sms_id'));
		$data['receive_userid'] = $this->input->post('receive_userid');
		$data['sms_title'] = $this->input->post('sms_title');
		$data['sms_content'] = $this->input->post('sms_content');
		if ($this->checkEmpty($data)){
			$data['status'] = 0;
			$rs = $this->db->update('sms',$data,array('sms_id'=>$sms_id));
			if ($rs){
				$rd['status'] = 1;
			}
		}
		return $rd;
	}
	/**
	 * [del 删除]
	 * @return array 删除结果
	 */
	public function del(){
		$rd = array('status'=>-1);
		$sms_id = (int)((isset($_GET['sms_id']))?$this->input->get('sms_id'):$this->input->post('sms_id'));
		$rs = $this->db->delete('sms',array('sms_id'=>$sms_id));
		if ($rs) {
			$rd['status'] = 1;
		}
		return $rd;
	}
}