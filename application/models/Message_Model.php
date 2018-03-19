<?php
/**
 * 信息模型
 */
class Message_Model extends MY_Model {
	/**
	 * 查询当前用户的发布
	 */
	public function my_publish(){
		$user = $_SESSION['USER'];
		$sql = "select m.*,g.cat_name,a.area_name from message m,goods_cats g,areas a where m.cat_id=g.cat_id and a.area_id=m.city_id and m.userid={$user['userid']}";
		$query = $this->db->query($sql);
		$rs = $query->result_array();
		return $rs;
	}
	/**
	 * 查询列表
	 */
	public function lostMsgList(){
		//$rd = array('status'=>-1);
		$cat_id = (int)(isset($_GET['cat_id'])?$this->input->get('cat_id'):$this->input->post('cat_id'));
		$price_type = (int)$this->input->post('price_type');
		$province_id = (int)(isset($_GET['province_id'])?$this->input->get('province_id'):$this->input->post('province_id'));
		$city = $_SESSION['city'];
		$city_id = $city['area_id'];
		//$city_id = (int)(isset($_GET['city_id'])?$this->input->get('city_id'):$this->input->post('city_id'));
		$sql = "select m.*,u.username nickname,g.cat_name,a.area_name from message m,user u, goods_cats g,areas a where m.userid=u.userid and m.cat_id=g.cat_id and a.area_id=m.city_id and type=1 ";
		if (false != $this->input->post('status')) $sql .= " and m.status=".$this->input->post('status');
		if (false != $cat_id) $sql .= " and m.cat_id=".$cat_id;
		if (false != $price_type) $sql .= " and m.price_type=".$price_type;
		if (false != $province_id) $sql .= " and m.province_id=".$province_id;
		if (false != $city_id) $sql .= " and m.city_id=".$city_id;
		$sql .= " order by msg_id desc";
		//echo $sql;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	 * 获取所有失物信息 支持多条件查询分页
	 */
	public function lostMsgPage($per_page) {
		//$rd = array('status'=>-1);
		$goods_cat_id = (int)$this->input->post('goods_cat_id');
		$price_type = (int)$this->input->post('price_type');
		$province_id = (int)$this->input->post('province_id');
		$city = $_SESSION['city'];
		$city_id = $city['area_id'];
		//$city_id = (int)$this->input->post('city_id');
		$onset = $this->uri->segment(4)==''?0:$this->uri->segment(4);
		//$offset = $onset+$per_page;
		$sql = "select m.*,u.username nickname,g.cat_name,a.area_name from message m,user u, goods_cats g,areas a where m.userid=u.userid and m.cat_id=g.cat_id and a.area_id=m.city_id and type=1 ";
		if ($this->input->post('status')!='') $sql .= " and m.status=".$this->input->post('status');
		if (0 != $goods_cat_id) $sql .= " and m.goods_cat_id=".$goods_cat_id;
		if (0 != $price_type) $sql .= " and m.price_type=".$price_type;
		if (0 != $province_id) $sql .= " and m.province_id=".$province_id;
		if (0 != $city_id) $sql .= " and m.city_id=".$city_id;
		$totalSql = "select count(*) counts from (".$sql.") as a";
		$q_total = $this->db->query($totalSql);
		$rs_total = $q_total->result_array();
		$total = $rs_total[0]['counts'];
		$sql .= " order by msg_id desc limit {$onset},{$per_page}";
		$query = $this->db->query($sql);
		$rs = $query->result_array();
		$rd['total'] = $total;
		$rd['data'] = $rs;
		return $rd;
	}
	/**
	 * 获取所有招领 支持多条件查询
	 */
	public function foundMsgList() {
		//$rd = array('status'=>-1);
		$cat_id = (int)(isset($_GET['cat_id'])?$this->input->get('cat_id'):$this->input->post('cat_id'));
		$price_type = (int)$this->input->post('price_type');
		$province_id = (int)(isset($_GET['province_id'])?$this->input->get('province_id'):$this->input->post('province_id'));
		$city = $_SESSION['city'];
		$city_id = $city['area_id'];
		//$city_id = (int)(isset($_GET['city_id'])?$this->input->get('city_id'):$this->input->post('city_id'));
		$sql = "select m.*,u.username nickname,g.cat_name,a.area_name from message m,user u, goods_cats g,areas a where m.userid=u.userid and m.cat_id=g.cat_id and a.area_id=m.city_id and type=2 ";
		if (false != $this->input->post('status')) $sql .= " and m.status=".$this->input->post('status');
		if (false != $cat_id) $sql .= " and m.cat_id=".$cat_id;
		if (false != $price_type) $sql .= " and m.price_type=".$price_type;
		if (false != $province_id) $sql .= " and m.province_id=".$province_id;
		if (false != $city_id) $sql .= " and m.city_id=".$city_id;
		$sql .= " order by msg_id desc";
		//echo $sql;die();
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	 * 分页查询
	 */
	public function foundMsgPage($per_page){
		//$rd = array('status'=>-1);
		$goods_cat_id = (int)$this->input->post('goods_cat_id');
		$price_type = (int)$this->input->post('price_type');
		$province_id = (int)$this->input->post('province_id');
		//$city_id = (int)$this->input->post('city_id');
		$city = $_SESSION['city'];
		$city_id = $city['area_id'];
		$onset = $this->uri->segment(4)==''?0:$this->uri->segment(4);
		//$offset = $onset+$per_page;
		$sql = "select m.*,u.username nickname,g.cat_name,a.area_name from message m,user u, goods_cats g,areas a where m.userid=u.userid and m.cat_id=g.cat_id and a.area_id=m.city_id and type=2 ";
		if ($this->input->post('status')!='') $sql .= " and m.status=".$this->input->post('status');
		if (0 !== $goods_cat_id) $sql .= " and m.goods_cat_id=".$goods_cat_id;
		if (0 !== $price_type) $sql .= " and m.price_type=".$price_type;
		if (0 !== $province_id) $sql .= " and m.province_id=".$province_id;
		if (0 != $city_id) $sql .= " and m.city_id=".$city_id;
		$totalSql = "select count(*) counts from (".$sql.") as a";
		$q_total = $this->db->query($totalSql);
		$rs_total = $q_total->result_array();
		$total = $rs_total[0]['counts'];
		$sql .= " order by msg_id desc limit {$onset},{$per_page}";
		$query = $this->db->query($sql);
		$rs = $query->result_array();
		$rd['total'] = $total;
		$rd['data'] = $rs;
		return $rd;
	}
	/**
	 * 插入
	 */
	public function insert(){
		$rd = array('status'=>-1);
		$user = $_SESSION['USER'];
		$data['type'] = $this->input->post('type');
		$data['userid'] = $user['userid'];
		$data['status'] = $this->input->post('status');
		$data['price_type'] = $this->input->post('price_type');
		$data['add_time'] = date("Y-m-d h:i:s");
		$data['cat_id'] = $this->input->post('cat_id');
		$data['qu_id'] = $this->input->post('qu_id');
		$data['msg_title'] = $this->input->post('msg_title');
		//$data['thank_method'] = $this->input->post('thank_method');//报酬方式：网站公平定价/个人自己定价/免费
		$data['province_id'] = $this->input->post('province_id');
		$data['city_id'] = $this->input->post('city_id');
		$data['msg_content'] = $this->input->post('msg_content');
		//$data['trusteeship_price'] = $this->input->post('trusteeship_price');
		$data['time'] = $this->input->post('time');
		$data['place'] = $this->input->post('place');
		if ($this->checkEmpty($data,true)){
			$data['price'] = $this->input->post('price');
			$link['address'] = $this->input->post('address');
			$link['linkman'] = $this->input->post('linkman');
			$link['mobile'] = $this->input->post('mobile');
			$link['wechat'] = $this->input->post('wechat');
			$link['qq'] = $this->input->post('qq');
			$link['email'] = $this->input->post('email');
			$data['link'] = json_encode($link);
			$data['msg_imgs'] = $this->input->post('msg_imgs');
			$rs = $this->db->insert('message',$data);
			if ($rs){
				$rd['status'] = 1;
			}
		}
		return $rd;
	}
	/**
	 * 编辑修改
	 */
	public function edit(){
		$rd = array('status'=>-1);
		$msgid = (int)((isset($_GET['msgid']))?$this->input->get('msgid'):$this->db->post('msgid'));
		$user = $_SESSION['USER'];
		$query = $this->db->get("select status,userid from message where msgid={$msgid} limit 1");
		$mrs = $query->row_array();
		//检查
		if ($mrs['userid'] !== $user['userid']) die('{"status":-2}');	//没有权限操作
		if ($mrs['status'] == 2) die('{"status":-3}');	//状态不对正在交易中的不可修改
		$data['type'] = $this->input->post('type');
		$data['price'] = $this->input->post('price');
		$data['last_time'] = date("Y-m-d h:i:s");
		$data['goods_cat_id'] = $this->input->post('goods_cat_id');
		$data['msg_title'] = $this->input->post('msg_title');
		$data['price_type'] = $this->input->post('price_type');
		$data['province_id'] = $this->input->post('province_id');
		$data['city_id'] = $this->input->post('city_id');
		$data['msg_content'] = $this->input->post('msg_content');
		$data['trusteeship_price'] = $this->input->post('trusteeship_price');
		if ($this->checkEmpty($data,true)){
			$rs = $this->db->update('message',$data,array('msgid'=>$msgid));
			if ($rs){
				$rd['status'] = 1;
			}
		}
		return $rd;
	}
	/**
	 * 关闭
	 */
	public function close(){
		$rd = array('status'=>-1);
		$user = $_SESSION['USER'];
		$msgid = (int)$this->input->post('msgid');
		//检查状态
		$query = $this->db->query("select status,userid from message where msgid={$msgid} limit 1");
		$mrs = $query->row_array();
		if ($mrs['userid'] !== $user['userid']) die('{"status":-2}');	//没有权限操作
		if ($mrs['status'] == 2) die('{"status":-3}');	//状态不对正在交易中的不可删除
		$rs = $this->db->update('message',array('status'=>5),array('msgid'=>$msgid));
		if ($rs){
			$rd['status'] = 1;
		}
		return $rd;
	}

	//删除
	public function del () {
		$rd = array('status'=>-1);
		$user = $_SESSION['USER'];
		$msgid = (int)$this->input->get('msgid');
		//检查状态
		$query = $this->db->query("select status,userid from message where msgid={$msgid} limit 1");
		$mrs = $query->row_array();
		if ($mrs['userid'] !== $user['userid']) die('{"status":-2}');	//没有权限操作
		if ($mrs['status'] == 2) die('{"status":-3}');	//状态不对正在交易中的不可删除
		$rs = $this->db->delete('message',array('msgid'=>$msgid));
		if ($rs){
			$rd['status'] = 1;
		}
		return $rd;
	}
	/**
	 * 根据id 获取
	 */
	public function get_by_id(){
		$id = (int)(isset($_GET['id'])?$this->input->get('id'):$this->input->post('id'));
		$query = $this->db->query("select m.*,u.username nickname,g.cat_name,a.area_name from message m,user u, goods_cats g,areas a where m.userid=u.userid and m.cat_id=g.cat_id and a.area_id=m.city_id and msg_id={$id}");
		$rs = $query->row_array();
		//var_dump($rs);
		$qarea = $this->db->query("select area_name from areas where area_id={$rs['province_id']}");
		$area = $qarea->row_array();
		$rs['province_name'] = $area['area_name'];
		$rs['link'] = json_decode($rs['link'],true);
		return $rs;
	}


	//////////////
	///
	/// 后台管理 //
	///
	///////////////
	//分页获取信息
	public function msg_list ($per_page) {
		$goods_cat_id = (int)$this->input->post('goods_cat_id');
		$price_type = (int)$this->input->post('price_type');
		$province_id = (int)$this->input->post('province_id');
		$city_id = (int)$this->input->post('city_id');
		$onset = $this->uri->segment(5)==''?0:$this->uri->segment(5);
		//$offset = $onset+$per_page;
		$sql = "select m.*,u.username,u.nickname,g.cat_name,a.area_name from message m,user u, goods_cats g,areas a where m.userid=u.userid and m.cat_id=g.cat_id and a.area_id=m.city_id ";
		if ($this->input->post('status')!='') $sql .= " and m.status=".$this->input->post('status');
		if ($this->input->post('type')!='') $sql .= " and m.type=".$this->input->post('type');
		if (0 !== $goods_cat_id) $sql .= " and m.goods_cat_id=".$goods_cat_id;
		if (0 !== $price_type) $sql .= " and m.price_type=".$price_type;
		if (0 !== $province_id) $sql .= " and m.province_id=".$province_id;
		if (0 !== $city_id) $sql .= " and m.city_id=".$city_id;
		$totalSql = "select count(*) counts from (".$sql.") as a";
		$q_total = $this->db->query($totalSql);
		$rs_total = $q_total->result_array();
		$total = $rs_total[0]['counts'];
		$sql .= " order by msg_id desc limit {$onset},{$per_page}";
		$query = $this->db->query($sql);
		$rs = $query->result_array();
		$rd['total'] = $total;
		$rd['data'] = $rs;
		return $rd;
	}

	//编辑
	public function admin_edit () {
		$rd = array('status'=>-1);
		$msgid = (int)((isset($_GET['id']))?$this->input->get('id'):$this->input->post('id'));
		$query = $this->db->query("select status,userid from message where msg_id={$msgid} limit 1");
		$mrs = $query->row_array();
		//检查
		if ($mrs['status'] == 3) die('{"status":-3}');	//状态不对正在交易中的不可修改
		$data['type'] = $this->input->post('type');
		$data['price'] = $this->input->post('price');
		$data['last_time'] = date("Y-m-d h:i:s");
		$data['cat_id'] = $this->input->post('cat_id');
		$data['msg_title'] = $this->input->post('msg_title');
		//$data['price_type'] = $this->input->post('price_type');
		$data['province_id'] = $this->input->post('province_id');
		$data['city_id'] = $this->input->post('city_id');
		$data['qu_id'] = $this->input->post('qu_id');
		$data['msg_content'] = $this->input->post('msg_content');
		//$data['trusteeship_price'] = $this->input->post('trusteeship_price');
		$data['time'] = $this->input->post('time');
		$data['place'] = $this->input->post('place');
		if ($this->checkEmpty($data,true)){
			$link['linkman'] = $this->input->post('linkman');
			$link['address'] = $this->input->post('address');
			$link['mobile'] = $this->input->post('mobile');
			$link['wechat'] = $this->input->post('wechat');
			$link['qq'] = $this->input->post('qq');
			$link['email'] = $this->input->post('email');
			$data['link'] = json_encode($link);
			$rs = $this->db->update('message',$data,array('msg_id'=>$msgid));
			if (false !== $rs){
				$rd['status'] = 1;
			}
		}
		return $rd;
	}

	public function admin_add(){
		$rd = array('status'=>-1);
		$data['type'] = $this->input->post('type');
		$data['userid'] = 0;
		$data['status'] = $this->input->post('status');
		$data['price_type'] = $this->input->post('price_type');
		$data['add_time'] = date("Y-m-d h:i:s");
		$data['cat_id'] = $this->input->post('cat_id');
		$data['qu_id'] = $this->input->post('qu_id');
		$data['msg_title'] = $this->input->post('msg_title');
		//$data['thank_method'] = $this->input->post('thank_method');//报酬方式：网站公平定价/个人自己定价/免费
		$data['province_id'] = $this->input->post('province_id');
		$data['city_id'] = $this->input->post('city_id');
		$data['msg_content'] = $this->input->post('msg_content');
		//$data['trusteeship_price'] = $this->input->post('trusteeship_price');
		$data['time'] = $this->input->post('time');
		$data['place'] = $this->input->post('place');
		if ($this->checkEmpty($data,true)){
			$data['price'] = $this->input->post('price');
			$link['address'] = $this->input->post('address');
			$link['linkman'] = $this->input->post('linkman');
			$link['mobile'] = $this->input->post('mobile');
			$link['wechat'] = $this->input->post('wechat');
			$link['qq'] = $this->input->post('qq');
			$link['email'] = $this->input->post('email');
			$data['link'] = json_encode($link);
			$data['msg_imgs'] = $this->input->post('msg_imgs');
			$rs = $this->db->insert('message',$data);
			if ($rs){
				$rd['status'] = 1;
			}
		}
		return $rd;
	}
	//定价
	public function pricing () {
		$rd = array('status'=>-1);
		$id = (int)$this->input->post('id');
		//检查
		$query = $this->db->query("select status,userid from message where msg_id={$id} limit 1");
		$mrs = $query->row_array();
		//检查
		if ($mrs['status'] != 2) die('{"status":-3}');	//状态不对
		$data['price'] = $this->input->post('price');
		$data['status'] = 1;
		$this->checkEmpty($data,true);
		$rs = $this->db->update('message', $data, array('msg_id'=>$id));
		if ( false !== $rs ) {
			$rd['status'] = 1;
		}
		return $rd;
	}

	//删除
	public function admin_del () {
		$rd = array('status'=>-1);
		$id = $this->input->post('id');
		if (is_array($id)){
			$count_error = 0; $count_right = 0;
			foreach ($id as $k=>$v ) {
				$rs = $this->db->delete('message', array('msg_id'=>(int)$v));
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
			$rs = $this->db->update('message', array('msg_id'=>(int)$id));
			if (false == $rs){
				$rd['status'] = -2;
			}else{
				$rd['status'] = 1;
			}
		}
		return $rd;
	}

	//启用
	public function admin_on () {
		$rd = array('status'=>-1);
		$id = $this->input->post('id');
		if (is_array($id)){
			$count_error = 0; $count_right = 0;
			foreach ($id as $k=>$v ) {
				$rs = $this->db->update('message',array('is_on'=>1), array('msg_id'=>(int)$v));
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
			$rs = $this->db->update('message',array('is_on'=>1), array('msg_id'=>(int)$id));
			if (false == $rs){
				$rd['status'] = -2;
			}else{
				$rd['status'] = 1;
			}
		}
		return $rd;
	}

	//关闭
	public function admin_off () {
		$rd = array('status'=>-1);
		$id = $this->input->post('id');
		if (is_array($id)){
			$count_error = 0; $count_right = 0;
			foreach ($id as $k=>$v ) {
				$rs = $this->db->update('message',array('is_on'=>2), array('msg_id'=>(int)$v));
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
			$rs = $this->db->update('message',array('is_on'=>2), array('msg_id'=>(int)$id));
			if (false == $rs){
				$rd['status'] = -2;
			}else{
				$rd['status'] = 1;
			}
		}
		return $rd;
	}

	//确认用户托管了多少
	public function trusteeship () {
		
	}
}