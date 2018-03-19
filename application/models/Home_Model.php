<?php
/**
 * @author yzk <[<email address>]>
 */
class Home_Model extends MY_Model {
	public function __construct () {
		parent::__construct ();
	}

	//修改密码
	public function alter_pass () {
		$rd = array('status'=>-1);
		$user = $_SESSION('ADMIN');
		$query = $this->db->select('userid,password')->get_where('admin',array('userid'=>$user['userid']));
		$urs = $query->row_array();
		if (!$urs){
			$rd['status'] = -3;//没查到用户信息
			return $rd;
		}
		if ( $urs['password'] == md5($this->input->post('password')) ) {
			$uprs = $this->db->update('admin',array('password'=>md5($this->input->post('post.newpassword'))), array('userid'=>$user['userid']));
			//return $uprs;
			if (false !== $uprs) {
				$rd['status'] = 1;
			}
		} else {
			$rd['status'] = -2;
		}
		return $rd;
	}

	//获取后台首页统计信息
	public function count_info () {
		$query = $this->db->query("select count(*) as counts from user");
		$rs = $query->row_array();
		$rd['userNum'] = $rs['counts'];
		$query = $this->db->query("select count(*) as counts from message");
		$rs = $query->row_array();
		$rd['msgNum'] = $rs['counts'];
		$query = $this->db->query("select count(*) as counts from orders");
		$rs = $query->row_array();
		$rd['orderNum'] = $rs['counts'];
		return $rd;
	}

	//管理员登录验证
	public function login () {
		$rd = array('status'=>-1);
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$query = $this->db->select('*')->get_where('admin',array('username'=>$username));
		$rs = $query->row_array();
		if ( $rs['password'] == md5($password) ) {
			$rd['status'] = 1;
			$rd['admin'] = $rs;
		}
		return $rd;
	}
}