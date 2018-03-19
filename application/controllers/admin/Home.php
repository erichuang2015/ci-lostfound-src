<?php
/**
 *@author yzk <2273716951@qq.com>
 * 
 */

class Home extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->isAdminLogin();
	}

	
	/**
	 * 后台管理首页
	 * function
	 * @author yzk <2273716951@qq.com>
	 * @version  [version]
	 * @dateTime 2016-06-22T13:25:40+0800
	 * @return   None
	 */
	public function index () {
		$this->load->model('Home_Model','', true);
		$data['_info'] = $this->Home_Model->count_info();
		//$data['_info'] = array('count'=>100,'last_time'=>'1222','last_ip'=>'12345658');
		$data['user'] = $_SESSION['ADMIN'];
		$this->page('home',
			array(
				'title'=>"失物招领管理后台",
				'css'=>array('index','main'),
				'js'=>array('index')
				),
			$data
			);
	}

	///////////////
	///系统管理///
	//////////////
	//公告列表
	public  function newsList () {
		$this->load->model('News_Model','', true);
		$data['news'] = $this->News_Model->get_news();
		$this->page('news_list',
			array(
				'title'=>"公告列表",
				'css'=>array("news"),
				'js'=>array('news'),
				),
			$data
			);
	}

	//编辑
	public function newsEdit () {
		$this->load->model('News_Model','', true);
		$data['news'] = $this->News_Model->get_by_id();
		$this->page('news_edit',
			array(
				'title'=>"编辑修改公告",
				'css'=>array("news"),
				'js'=>array('news'),
				),
			$data
			);
	}

	//添加
	public function newsAdd () {
		$this->load->model('News_Model','', true);
		$this->page('news_add',
			array(
				'title'=>"添加公告",
				'css'=>array("news"),
				'js'=>array('news'),
				)
			);
	}

	//修改密码
	public function alterPass () {
		$this->page('alter_pass',
			array(
				'title'=>"管理员密码修改",
				//'css'=>array("news"),
				'js'=>array('alter_pass'),
				)
			);
	}

	//执行修改密码
	public function exeAlterPass () {
		$this->load->model('Home_Model','',true);
		$rs = $this->Home_Model->alter_pass();
		echo json_encode($rs);
	}

	////////////
	///会员相关界面////
	///		////
	//查看会员
	public function userList () {
		$this->load->model('User_Model', '' ,true);
		$this->load->library('pagination');
		//每页显示数量
		$per_page = 1;
		$config['base_url'] = site_url('admin/Home/userList/page');
		
		$config['per_page'] = $per_page;
		$config['reuse_query_string'] = true;
		$config['first_link'] = false;
		$config['prev_link'] = '';
		$config['next_link'] = '';
		$config['last_link'] = false;
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$rs = $this->User_Model->user_list($per_page);
		$config['total_rows'] = $rs['total'];
		$this->pagination->initialize($config);
		$obj['user'] = $rs['data'];
		$obj['page'] = $this->pagination->create_links();
		$this->page('user_list',
			array(
				'title'=>"查看会员",
				'css'=>array("user_list"),
				'js'=>array('user_list'),
				),
			$obj
			);
	}

	//编辑用户
	public function userEdit () {
		$this->load->model('User_Model','', true);
		$data['user'] = $this->User_Model->get_by_id();
		$this->page('user_edit',
			array(
				'title'=>"编辑修改公告",
				'css'=>array("user"),
				'js'=>array('user'),
				),
			$data
			);
	}

	//
	public function msgList () {
		$this->load->model('Message_Model','',true);
		$this->load->library('pagination');
		$rule['type'] = isset($_POST['type'])?$this->input->post('type'):'';
		$rule['status'] = isset($_POST['status'])?$this->input->post('status'):'';
		$per_page = 10;
		$config['base_url'] = site_url('admin/Home/msgList/page');
		
		$config['per_page'] = $per_page;
		$config['reuse_query_string'] = true;
		$config['first_link'] = false;
		$config['prev_link'] = '';
		$config['next_link'] = '';
		$config['last_link'] = false;
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$rs = $this->Message_Model->msg_list($per_page);
		$config['total_rows'] = $rs['total'];
		$this->pagination->initialize($config);
		$obj['msg'] = $rs['data'];
		$obj['rule'] = $rule;
		$obj['page'] = $this->pagination->create_links();
		$this->page('msg_list',
			array(
				'title'=>"查看会员",
				'css'=>array("lost_list"),
				'js'=>array('lost_list'),
				),
			$obj
			);
	}

	//编辑修改
	public function msgEdit() {
		$this->load->model('Message_Model','',true);
		$this->load->model('Goods_cats_Model','',true);
		$this->load->model('Areas_Model','',true);
		$cats = $this->Goods_cats_Model->get();
		$rs = $this->Message_Model->get_by_id();
		$obj['msg'] = $rs;
		$obj['cats'] = $cats;
		$this->page('msg_edit',
			array(
				'title'=>"修改{$rs['msg_title']}信息",
				'css'=>array('msg_edit')
				),
			$obj
			);
	}

	//新增信息
	public function msgAdd () {
		//$this->load->model('Message_Model','',true);
		$this->load->model('Goods_cats_Model','',true);
		$this->load->model('Areas_Model','',true);
		$cats = $this->Goods_cats_Model->get();
		$obj['cats'] = $cats;
		$this->page('msg_add',
			array(
				'title'=>"添加信息",
				'css'=>array('msg_edit')
				),
			$obj
			);
	}

	//所以交易单
	public function orderList () {
		$this->load->model('Orders_Model','',true);
		$this->load->library('pagination');
		$rule['order_type'] = isset($_POST['order_type'])?$this->input->post('order_type'):'';
		$rule['status'] = isset($_POST['status'])?$this->input->post('status'):'';
		$rule['found_username'] = isset($_POST['found_username'])?$this->input->post('found_username'):'';
		$rule['lost_username'] = isset($_POST['lost_username'])?$this->input->post('lost_username'):'';
		$rule['msg_title'] = isset($_POST['msg_title'])?$this->input->post('msg_title'):'';
		$per_page = 5;
		$config['base_url'] = site_url('admin/Home/orderList/page');
		
		$config['per_page'] = $per_page;
		$config['reuse_query_string'] = true;
		$config['first_link'] = false;
		$config['prev_link'] = '';
		$config['next_link'] = '';
		$config['last_link'] = false;
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$rs = $this->Orders_Model->order_list($per_page);
		$config['total_rows'] = $rs['total'];
		$this->pagination->initialize($config);
		$obj['data'] = $rs['data'];
		$obj['rule'] = $rule;
		$obj['page'] = $this->pagination->create_links();
		$this->page('order_list',
			array(
				'title'=>"查看交易",
				'css'=>array("order_list"),
				'js'=>array('order_list'),
				),
			$obj
			);
	}
}