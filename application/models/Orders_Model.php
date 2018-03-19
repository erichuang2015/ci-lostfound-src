<?php
/**
 * 订单模型
 */
class Orders_Model extends MY_Model {
	/**
	 * 认领
	 */
	public function claim(){
		//$this->isAjaxLogin();
		$rd = array('status'=>-1);
		$user = $_SESSION['USER'];
		$msg_id = (int)$this->input->post('id');
		//检查
		$query = $this->db->query("select m.type,m.status,m.userid,m.price,u.username from message m,user u where m.msg_id={$msg_id} and u.userid=m.userid limit 1");
		$mrs = $query->row_array();
		if ($mrs['status'] != 1) die('{"status":-2}');	//信息状态不符合
		if ($mrs['type'] !=2) die('{"status":-3}');	//该信息是丢失信息只能归还不能认领
		//接收申请人的描述
		$data['description'] = $this->input->post('description');
		$data['lost_userid'] = $user['userid'];
		$data['lost_username'] = $user['username'];
		$data['found_userid'] = $mrs['userid'];
		$data['found_username'] = $mrs['username'];
		$data['price'] = $mrs['price'];
		$data['msg_id'] = $msg_id;
		if ($this->checkEmpty($data,true)){
			$data['add_time'] = date("Y-m-d h:i:s");
			$data['status'] = 1;	//创建订单待托管资金
			$data['trusteeship_price'] = 0.00;
			$data['order_type'] = $mrs['type'];
			$this->db->trans_start();
			$this->db->update('message',array('status'=>3),array('msg_id'=>$msg_id));	//更新信息状态为交易状态
			$irs = $this->db->insert('orders',$data);
			$rs = $this->db->trans_complete();
			if ($rs){
				//生成提醒信息
				$data = array();
				$data['receive_userid'] = $mrs['userid'];
				$data['send_userid'] = $user['userid'];
				$data['sms_title'] = "你捡到的东西有人申请认领啦！快去看看吧";
				$data['sms_content'] = "你捡到的东西有人申请认领啦！ <a href='".site_url('Trade/detail')."/id/".$irs."'点击此处去查看详情</a>";
				$data['add_time'] = date("Y-m-d h:i:s");
				$data['status'] = 0;	//未读状态
				$this->db->insert('sms',$data);
				$rd['status'] = 1;
			}
		}
		return $rd;
	}
	/**
	 * 归还
	 */
	public function back(){
		//$this->isAjaxLogin();
		$rd = array('status'=>-1);
		$user = $_SESSION['USER'];
		$msg_id = (int)$this->input->post('id');
		//检查
		$query = $this->db->query("select m.type,m.status,m.userid,m.price,u.username from message m,user u where m.msg_id={$msg_id} and u.userid=m.userid limit 1");
		$mrs = $query->row_array();
		if ($mrs['status'] != 1) die('{"status":-2}');	//信息状态不符合
		if ($mrs['type'] !=1) die('{"status":-4}');	//该信息是拾物信息只能认领不能归还
		//接收申请人的描述
		$data['description'] = $this->input->post('description');
		$data['lost_userid'] = $mrs['userid'];
		$data['lost_username'] = $mrs['username'];
		$data['found_userid'] = $user['userid'];
		$data['found_username'] = $user['username'];
		$data['price'] = $mrs['price'];
		$data['msg_id'] = $msg_id;
		if ($this->checkEmpty($data,true)){
			$data['status'] = 1;	//创建订单待托管资金
			$data['add_time'] = date("Y-m-d h:i:s");
			$data['order_type'] = $mrs['type'];
			$data['trusteeship_price'] = $mrs['trusteeship_price'];
			$this->db->trans_start();
			$this->db->update('message',array('status'=>3),array('msg_id'=>$msg_id));	//更新信息状态为交易状态
			$irs = $this->db->insert('orders',$data);
			$rs = $this->db->trans_complete();
			if ($rs){
				//生成提醒信息
				$data = array();
				$data['receive_userid'] = $mrs['userid'];
				$data['send_userid'] = $user['userid'];
				$data['sms_title'] = "你丢失的东西有人申请归还啦！快去看看吧";
				$data['sms_content'] = "你丢失的东西有人申请归还啦！ <a href='".site_url('Trade/detail')."/id/".$irs."'点击此处去查看详情</a>";
				$data['add_time'] = date("Y-m-d h:i:s");
				$data['status'] = 0;	//未读状态
				$this->db->insert('sms',$data);
				$rd['status'] = 1;
			}
		}
		return $rd;
	}
	/**
	 * 编辑修改
	 */
	public function edit(){
		$order_id = (int)$this->input->post('id');
	}
	/**
	 * 获取指定订单详情
	 */
	public function get(){
		$order_id = (int)(isset($_GET['id'])?$this->input->get('id'):$this->input->post('id'));
		$query = $thid->db->query("select o.* m.msg_title msg_id from message m,orders o where order_id={$order_id} limit 1");
		$rs = $query->row_array();
		if ($user['userid'] !== $rs['lost_userid'] || $user['userid'] !== $rs['found_userid']){
			die('{"status":-2}'); //无权限查看
		}
		return $rs;
	}
	/**
	 * 查询当前用户的交易单
	 */
	public function get_user_orders(){
		$user = $_SESSION['USER'];
		$sql = "select m.msg_title,m.msg_id,m.link as msg_link,o.price,o.order_id,o.lost_userid,o.found_userid,o.status,o.trusteeship_price,o.order_type,u.username from message m,orders o,user u where o.msg_id=m.msg_id and m.userid=u.userid and (o.lost_userid={$user['userid']} or o.found_userid={$user['userid']}) ";
		$sql .= " order by o.order_id desc";
		$query = $this->db->query($sql);
		$root = $query->result_array();
		foreach ($root as $k => $v){
			$root[$k]['msg_link'] = json_decode($v['msg_link'],true);
			$q_lost = $this->db->query("select username as lost_username from user where userid={$v['lost_userid']}");
			$q_found = $this->db->query("select username as found_username from user where userid={$v['found_userid']}");
			$rlost = $q_lost->row_array();
			$rfound = $q_found->row_array();
			$root[$k]['lost_username'] = $rlost['lost_username'];
			$root[$k]['found_username'] = $rfound['found_username'];
		}
		//确定lost 跟 found 信息
		return $root;
	}
	/**
	 * 获取所有订单 多条件查询
	 */
	public function getAll(){
		$user = $_SESSION['USER'];
		$order_type = $this->input->post('order_type');
		$status = $this->input->post('status');
		$sql = "select m.msg_title,o.price order_id,u.username from message m,orders o,user u where o.msg_id=m.msg_id and m.userid=u.userid and o.lost_userid={$user['userid']} or o.found_userid={$user['userid']} ";
		if (false != $order_type) $sql .= " and o.order_type=".$order_type;
		if (false != $status) $sql .= " and o.status=".$status;
		$sql .= " order by o.order_id desc";
		$total = $this->db->query("select count(*) counts from (".$sql.") as a");
		$total = $total->row_array();
		$query = $this->db->query($sql);
		$root = $query->result_array();
		return $root;
	}
	/**
	 * 丢失物品已经发货给失主
	 */
	public function sended(){
		$rd = array('status'=>-1);
		$user = $_SESSION['USER'];
		$order_id = (int)(isset($_GET['id'])?$this->input->get('id'):$this->input->post('id'));
		//检查权限跟状态
		$query = $this->db->query("select price,status,found_userid from orders where order_id={$order_id}");
		$ors = $query->row_array();
		if ($user['userid'] != $ors['found_userid']) die('{"status":-2}');	//此订单物品不是该用户拾取到的无权限操作
		if ($ors['price'] != 0){
			if ($ors['status'] != 2) die('{"status":-3}');	//此订单没有托管资金
		}
		$urs = $this->db->update('orders',array('status'=>3),array('order_id'=>$order_id));
		if ($urs){
			$rd['status'] = 1;
		}
		return $rd;
	}
	/**
	 * 失主确认收到了物品
	 */
	public function received(){
		$rd = array('status'=>-1);
		$user = $_SESSION['USER'];
		$order_id = (int)(isset($_GET['id'])?$this->input->get('id'):$this->input->post('id'));
		//检查权限跟状态
		$query = $this->db->query("select price,status,found_userid,lost_userid from orders where order_id={$order_id}");
		$ors = $query->row_array();
		if ($user['userid'] != $ors['lost_userid']) die('{"status":-2}');	//此订单物品不是该用户丢失的无权限操作
		if ($ors['price'] != 0){
			if ( $ors['status'] != 3 ) die('{"status":-3}');	//此订单z状态不对
		}
		$urs = $this->db->update('orders',array('status'=>6),array('order_id'=>$order_id));
		if ($urs){
			$rd['status'] = 1;
		}
		return $rd;
	}
	/**
	 * 失主申请退款
	 */
	public function refund(){
		//$this->isAjaxLogin();
		$rd = array('status'=>-1);
		$user = $_SESSION['USER'];
		$order_id = (int)(isset($_GET['id'])?$this->input->get('id'):$this->input->post('id'));
		//检查权限跟状态
		$query = $this->db->query("select price,status,found_userid,lost_userid from orders where order_id={$order_id}");
		$ors = $query->row_array();
		if ($user['userid'] != $ors['lost_userid']) die('{"status":-2}');	//此订单物品不是该用户丢失的无权限操作
		if ($ors['price'] != 0){
			if ( !($ors['status'] == 2 || $ors['status'] == 3) ) die('{"status":-3}');	//此订单z状态不对
		}else{
			die('{"status":-4}');	//没钱怎么退款~
		}
		//接收退款原因
		$data = array();
		$data['reason'] = $this->input->post('reason');
		$data['order_id'] = $order_id;
		if ($this->checkEmpty($data,true)){
			$data['add_time'] = date("Y-m-d h:i:s");
			$data['create_userid'] = $user['userid'];
			$data['refund_type'] = 1;
			$this->db->trans_start();
			$this->db->insert('refund',$data);
			$this->db->update('orders',array('status'=>4),array('order_id'=>$order_id));
			$rs = $this->db->trans_complete();
			if ($rs){
				//生成提醒信息
				/*$data = array();
				$data['receive_userid'] = $ors['found_userid'];
				$data['send_userid'] = $user['userid'];
				$data['sms_title'] = "你捡到的东西生成的订单有人申请退款！快去看看吧";
				$data['sms_content'] = "你捡到的东西生成的订单有人申请退款啦！ <a href='".site_url('Trade/detail')."/id/".$irs."'点击此处去查看详情</a>";
				$data['add_time'] = date("Y-m-d h:i:s");
				$data['status'] = 0;	//未读状态
				$sms_rs = $this->db->insert('sms',$data);
				if ($sms_rs){*/
					$rd['status'] = 1;
				//}
			}
		}
		return $rd;
	}
	/**
	 * 拾取方同意退款
	 */
	public function agree(){
		//$this->isAjaxLogin();
		$rd = array('status'=>-1);
		$user = $_SESSION['USER'];
		$order_id = (int)(isset($_GET['id'])?$this->input->get('id'):$this->input->post('id'));
		//检查权限跟状态
		$query = $this->db->query("select price,status,found_userid,lost_userid from orders where order_id={$order_id}");
		$ors = $query->row_array();
		if ($user['userid'] != $ors['found_userid']) die('{"stuats":-2}');	//此订单物品不是该用户捡到的无权限操作
		if ($ors['price'] != 0){
			if ($ors['status'] != 4) die('{"status":-3}');	//此订单z状态不对
		}else{
			die('{"status":-4}');	//没钱怎么退款~
		}
		$rs = $this->db->update('orders',array('status'=>7),array('order_id'=>$order_id));
		if ($rs){
			//生成提醒信息
		/*	$data = array();
			$data['receive_userid'] = $ors['lost_userid'];
			$data['send_userid'] = $user['userid'];
			$data['sms_title'] = "你丢失的东西生成的订单对方同意退款！快去看看吧";
			$data['sms_content'] = "你丢失的东西生成的订单对方同意退款啦！ <a href='".site_url('Trade/detail')."/id/".$irs."'点击此处去查看详情</a>";
			$data['add_time'] = date("Y-m-d h:i:s");
			$data['status'] = 0;	//未读状态
			$sms_rs = $this->db->insert('sms',$data);
			if ($sms_rs){*/
				$rd['status'] = 1;
			//}
		}
		return $rd;

	}
	/**
	 * 拾取方不同意退款
	 */
	public function reject(){
		//$this->isAjaxLogin();
		$rd = array('status'=>-1);
		$user = $_SESSION['USER'];
		$order_id = (int)(isset($_GET['id'])?$this->input->get('id'):$this->input->post('id'));
		//检查权限跟状态
		$query = $this->db->query("select price,status,found_userid,lost_userid from orders where order_id={$order_id}");
		$ors = $query->row_array();
		if ($user['userid'] != $ors['found_userid']) die('{"stuats":-2}');	//此订单物品不是该用户捡到的无权限操作
		if ($ors['price'] != 0){
			if ($ors['status'] != 4) die('{"status":-3}');	//此订单z状态不对
		}else{
			die('{"status":-4}');	//没钱怎么退款~
		}
		//接收退款原因
		$data = array();
		$data['reason'] = $this->input->post('reason');
		$data['order_id'] = $order_id;
		if ($this->checkEmpty($data,true)){
			$data['add_time'] = date("Y-m-d h:i:s");
			$data['create_userid'] = $user['userid'];
			$data['refund_type'] = 2;	//拒绝退款
			$this->db->trans_start();
			$this->db->insert('refund',$data);
			$this->db->update('orders',array('status'=>5),array('order_id'=>$order_id));
			$rs = $this->db->trans_complete();
			if ($rs){
				//生成提醒信息
				/*$data = array();
				$data['receive_userid'] = $ors['found_userid'];
				$data['send_userid'] = $user['userid'];
				$data['sms_title'] = "你丢失的东西生成的订单有人申请退款！快去看看吧";
				$data['sms_content'] = "你丢失的东西生成的订单有人申请退款啦！ <a href='".site_url('Trade/detail')."/id/".$irs."'点击此处去查看详情</a>";
				$data['add_time'] = date("Y-m-d h:i:s");
				$data['status'] = 0;	//未读状态
				$sms_rs = $this->db->insert('sms',$data);
				if ($sms_rs){*/
					$rd['status'] = 1;
				//}
			}
		}
		return $rd;
	}

	//根据id获取双方信息
	public function get_info () {
		$rd = array('status'=>-1);
		$order_id = (int)(isset($_GET['id'])?$this->input->get('id'):$this->input->post('id'));
		$query = $this->db->select("*")->get_where('orders', array('order_id'=>$order_id));
		$ors = $query->row_array();
		$query = $this->db->select("link")->get_where('message',array('msg_id'=>$ors['msg_id']));
		$link = $query->row_array();
		$data['msg_info'] = $ors;
		if ( $ors['order_type']==1 ) {
			$query = $this->db->select("userid,username,mobile,address")->get_where('user', array('userid'=>$ors['found_userid']));
			$rs = $query->row_array();
			$data['lost_info'] = json_decode($link['link'],true);
			$data['lost_info']['userid'] = $ors['lost_userid'];
			$data['found_info'] = $rs;
		}else{
			$query = $this->db->select("userid,username,mobile,address")->get_where('user', array('userid'=>$ors['found_userid']));
			$rs = $query->row_array();
			$data['found_info'] = json_decode($link['link']);
			$data['found_info']['userid'] = $ors['lost_userid'];
			$data['lost_info'] = $rs;
		}
		return $data;
		
	}

	//获取对方联系方式
	public function get_link () {
		$user = $_SESSION['USER'];
		$order_id = (int)(isset($_GET['id'])?$this->input->get('id'):$this->input->post('id'));
		$query = $this->db->select("*")->get_where('orders', array('order_id'=>$order_id));
		$ors = $query->row_array();
		if ( $ors['status'] < 2 ) die('{"status":"-1"}');
		$query = $this->db->select("userid,link")->get_where('message', array('msg_id'=>$ors['msg_id']));
		$rs = $query->row_array();
		$publish_userid = $rs['userid'];
		if ( $rs['userid'] == $user['userid'] ) {
			$query = $this->db->select("userid,email,username,mobile,address")->get_where('user', array('userid'=>$ors['found_userid']));
			$linkrs = $query->row_array();
			$link['linkman'] = $linkrs['username'];
			$link['email'] = $linkrs['email'];
			$link['mobile'] = $linkrs['mobile'];
			$link['address'] = $linkrs['address'];
			$link['qq'] = '无';
		} else {
			//$query = $this->db->select("link")->get_where('message',array('msg_id'=>$ors['msg_id']));
			$link = json_decode( $rs['link'], true );
		}
		return $link;
	}

	//////////////
	///
	/// 管理后台 交易单
	///
	//////////////
	//查看所有交易单
	public function order_list ($per_page) {
		$order_type = $this->input->post('order_type');
		$status = $this->input->post('status');
		$found_username = $this->input->post('found_username');
		$lost_username = $this->input->post('lost_username');
		$onset = $this->uri->segment(5)==''?0:$this->uri->segment(5);
		$sql = "select m.msg_title,m.userid,m.cat_id,m.price_type,msg_content,o.*,c.cat_name,u.username from user u,message m,orders o,goods_cats c where o.msg_id=m.msg_id and c.cat_id=m.cat_id and u.userid=m.userid ";
		if (false != $order_type) $sql .= " and o.order_type=".$order_type;
		if (false != $status) $sql .= " and o.status=".$status;
		if ( $this->input->post('found_username')!='') $sql .= " and o.found_userid in select userid from user where username=".$this->input->post('found_username');
		if ( $this->input->post('msg_title')!='') $sql .= " and m.msg_title like '%".$this->myAddslashes($this->input->post('msg_title'))."%'";
		if (false != $lost_username) $sql .= " and o.lost_username=".$lost_username;
		//if (false != $found_username) $sql .= " and o.found_username=".$found_username;
		$total = $this->db->query("select count(*) as counts from (".$sql.") as a");
		$total = $total->row_array();
		$sql .= " order by o.order_id desc limit {$onset}, {$per_page} ";
		$query = $this->db->query($sql);
		$rd['data'] = $query->result_array();
		$rd['total'] = $total['counts'];
		return $rd;
	}

	//托管
	public function admin_trusteeship () {
		$rd = array('status'=>-1);
		$id = (int)$this->input->post('id');
		$trusteeship_price = $this->input->post('trusteeship_price');
		$query = $this->db->select('price,trusteeship_price,status')->get_where('orders',array('order_id'=>$id));
		$rs = $query->row_array();
		if ( $trusteeship_price > $rs['price']) die('{"status":-2}');
		if ( $trusteeship_price + $rs['trusteeship_price'] == $rs['price'] ) {
			$data['status'] = 2;
		}
		$data['trusteeship_price'] = $trusteeship_price + $rs['trusteeship_price'];
		$rs = $this->db->update('orders', $data, array('order_id'=>$id));
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
				$rs = $this->db->delete('orders', array('order_id'=>(int)$v));
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
			$rs = $this->db->delete('orders', array('order_id'=>(int)$id));
			if (false == $rs){
				$rd['status'] = -2;
			}else{
				$rd['status'] = 1;
			}
		}
		return $rd;
	}
}