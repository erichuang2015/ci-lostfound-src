<?php
/**
 * 用户模型
 * @author yzk <2273716951@qq.com>
 */
class User_Model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}
	/**
	 * 查询用户是否已经存在
	 * @return   array.status 1-存在，-1-不存在
	 */
	public function checkLoginKey( $username ='' ){
		$rd = array('status'=>-1);
		$username = ($username!='')?$username:$this->input->post('username');
		$query = $this->db->query("select userid from user where username='{$username}'");
		$rs = $query->row_array();
		if ($rs){
			$rd['status'] = 1;
		}
		return $rd;
	}
	/**
	 * 注册
	 */
	public function register(){
		$rd = array('status'=>-1);
		$username = $this->input->post('username');
		$crs = $this->checkLoginKey($username);
		if ($crs['status'] == -1){
			$password = $this->input->post('password');
			$repassword = $this->input->post('confirmpassword');
			if ($repassword !== $password) die('{"status":3}');//两次密码不一样
			$data['password'] = $password;
			$data['nickname'] = $this->input->post('nickname');
			$data['username'] = $this->input->post('username');
			$data['email'] = $this->input->post('email');
			$data['regdate'] = date("Y-m-d h:i:s");
			//$data['sex'] = $this->input->post('sex');
			//$data['birthday'] = $this->input->post('birthday');
			$data['mobile'] = $this->input->post('mobile');
			//$data['province_id'] = $this->input->post('province_id');
			//$data['city_id'] = $this->input->post('city_id');
			//$data['address'] = $this->input->post('address');
			if ($this->checkEmpty($data,true)) {
				$data['password'] = md5($data['password']);
				$irs = $this->db->insert('user',$data);
				if ($irs){
					$rd['status'] = 1;	//注册成功
				}
			}
		}else{
			$rd['status'] = 2;	//该用户名已经存在
		}
		return $rd;
	}
	/**
	 * 校验登录
	 */
	public function login(){
		$rd = array('status'=>-1);
		$username = $this->input->post('username');
		$sql = "select * from user where username='{$username}' limit 1";
		$query = $this->db->query($sql);
		$rs = $query->row_array();
		if (!$rs) die('{"status":-2}');	//	用户名不存在
		$password = $this->input->post('password');
		if (md5($password) === $rs['password']){
			$rd['status'] = 1;
			unset($rs['password']);
			$rd['user'] = $rs;
		}
		return $rd;
	}
	/**
	 * 编辑修改用户信息
	 */
	public function edit(){
		$rd = array('status'=>-1);
		$userid = isset($_GET['userid'])?$this->input->get('userid'):$this->input->post('userid');
		$data['nickname'] = $this->input->post('nickname');
		$data['email'] = $this->input->post('email');
		$data['sex'] = $this->input->post('sex');
		$data['birthday'] = $this->input->post('birthday');
		$data['mobile'] = $this->input->post('mobile');
		$data['province_id'] = $this->input->post('province_id');
		$data['city_id'] = $this->input->post('city_id');
		$data['address'] = $this->input->post('address');
		if ($this->checkEmpty($data,true)){
			$this->db->where('userid',$userid);
			$rs = $this->db->update('user',$data);
			if ($rs){
				$rd['status'] = 1;
			}
		}
		return $rd;
	}
	/**
	 * 修改密码
	 */
	public function change_pass() {
		$rd = array('status' => -1);
		$old_password = $this->input->post('old_password');
		$data['password'] = $this->input->post('password');
		$repassword = $this->input->post('repassword');
		if ($repassword !== $data['password']) die('{"status":-2}');//两次密码不一样
		$user = $_SESSION['userid'];
		$this->db->select('password');
		$query = $this->db->get_where('user',array('userid'=>$user['userid']));
		$u = $query->row_array();
		if ($u['password'] != md5('old_password')) die('{"status":-3}');	//原密码错误
		$rs = $this->db->update('user',$data,array('userid'=>$user['userid']));
		if ($rs){
			$rd['status'] = 1;
		}
		return $rd;
	}
	/**
	 * 修改用户密码
	 */
	public function modPassword(){
		$rd = array('status'=>-1);
		$userid = isset($_GET['userid'])?$this->input->get('userid'):$this->input->post('userid');
		$password = $this->input->post('password');
		$repassword = $this->input->post('repassword');
		if ($repassword !== $password) die('{"status":3}');//两次密码不一样
		$data['password'] = $password;
		if ($this->checkEmpty($data,true)){
			$data['password'] = md5($data['password']);
			$rs = $this->db->update('user',$data,array('userid'=>$userid));
			if (false !== $rs) {
				$rd['status'] = 1;
			}
		}
		return $rd;
	}


	////////////////
	///
	///后台管理相关
	///
	///////////////
	//所有会员列表
	public function user_list ($per_page) {
		$sql = "select * from user where flag=1 ";
		$onset = $this->uri->segment(5)==''?0:$this->uri->segment(5);
		//条件
		$totalSql = "select count(*) as counts from (".$sql.") as a";
		$query = $this->db->query($totalSql);
		$total = $query->row_array();
		$sql .= " order by userid desc limit {$onset}, {$per_page}";
		$query = $this->db->query($sql);
		$rd['data'] = $query->result_array();
		$rd['total'] = $total['counts'];
		return $rd;
	}

	//修改
	public function admin_edit () {
		$rd = array('status'=>-1);
		$id = (int)$this->input->post('id');
		$data = $this->input->post('obj');
		if ( $this->checkEmpty ($data,true) ) {
			$rs = $this->db->update('user', $data, array('userid'=>$id));
			if (false !== $rs) {
				$rd['status'] = 1;
			}
		}
		return $rd;
	}

	//删除
	public function del () {
		$id = $this->input->post('id');
		if (is_array($id)){
			$count_error = 0; $count_right = 0;
			foreach ($id as $k=>$v ) {
				$rs = $this->db->delete('user', array('userid'=>(int)$v));
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
			$rs = $this->db->delete('user', array('userid'=>(int)$id));
			if (false == $rs){
				$rd['status'] = -2;
			}else{
				$rd['status'] = 1;
			}
		}
		return $rd;
	}

	//根据id获取详情
	public function get_by_id () {
		$id = (int)(isset($_GET['id'])?$this->input->get('id'):$this->input->post('id'));
		$query = $this->db->get_where('user', array('userid'=>$id));
		return $query->row_array();
	}
}