
<?php 

/**
 * @author ArronKiller
 * 
 */


class Home extends CI_Controller {


	public function __construct() {
		parent::__construct();

	}
	//
	public function isLogin () {
		if ( !isset($_SESSION['USER']) ) {
			header("Location:".site_url('Home/loginView'));
		}
	}
	//
	public function isAjaxLogin () {
		if ( !isset($_SESSION['USER']) ) {
			die('{"status":-999}');
		}
	}

	/**
	 * 默认首页
	 * @return None
	 */
	public function index() {
		$this->home();
	} 


	/**
	 * 页面装载器
	 * @param  string $_page         装载的页面
	 * @param  Array  $_param_head   顶部参数
	 * @param  Array $_param_header  头部参数
	 * @param  Array $_param_page    页面参数
	 * @param  Array $_param_footer  尾部参数
	 * @param  Array $_param_foot    底部参数
	 * @return None
	 */
	public function page($_page, $_param_head = '', $_param_header = '', $_param_page = '',$_param_footer = '', $_param_foot = '') {
		$this->load->model('Areas_Model','',true);
		$_param_header['city'] = $this->Areas_Model->get_default_city();
		$this->load->view('templates/head.php', $_param_head, false);
		$this->load->view('templates/header.php', $_param_header, false);

		$this->load->view($_page, $_param_page, false);

		$this->load->view('templates/footer.php', $_param_footer, false); 
		$this->load->view('templates/foot.php', $_param_foot, false);
	}

	/**
	 * test
	 */
	public function test(){
		$id = '110102';
		echo $id[5];
		var_dump($_SESSION['city']);
	}
	/**
	 * 主页
	 * @return None
	 */
	public function home() {
		$this->load->model('Areas_Model','',true);
		$this->load->model('Message_Model','',true);
		$this->Areas_Model->get_default_city();
		$data['lostMsg'] = $this->Message_Model->lostMsgList();
		$data['foundMsg'] = $this->Message_Model->foundMsgList();
		//var_dump($data);
		$this->page('home', array(
			'css' => array('main', 'home')
			),
			'',
			$data
		);
	}


	//////////////
	// 失物招领相关界面 //
	//////////////


	public function lostView() {
		$this->load->model('Message_Model','',true);
		$this->load->library('pagination');
		$per_page = 4;
		
		$config['base_url'] = site_url('Home/lostView/page');
		
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
		$config['cur_tag_open'] = '<li><a style="color:red;" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$rs = $this->Message_Model->lostMsgPage($per_page);
		$config['total_rows'] = $rs['total'];
		$this->pagination->initialize($config);
		$obj['data'] = $rs['data'];
		$obj['page'] = $this->pagination->create_links();
		$this->lfView(1,$obj);
	}

	public function lostDetailView() {
		$this->load->model('Message_Model','',true);
		$rs = $this->Message_Model->get_by_id();
		$this->detailView(1,$rs);
	}

	public function findView() {
		$this->load->model('Message_Model','',true);
		$this->load->library('pagination');
		$per_page = 4;
		
		$config['base_url'] = site_url('Home/findView/page');
		
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
		$config['cur_tag_open'] = '<li><a style="color:red;" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$rs = $this->Message_Model->foundMsgPage($per_page);
		$config['total_rows'] = $rs['total'];
		$this->pagination->initialize($config);
		$obj['data'] = $rs['data'];
		$obj['page'] = $this->pagination->create_links();
		$this->lfView(2,$obj);
	}

	public function findDetailView() {
		$this->load->model('Message_Model','',true);
		$rs = $this->Message_Model->get_by_id();
		$this->detailView(2,$rs);
	}

	/**
	 * 丢失东西和找到东西统一的查询界面
	 * @param  Integer    此值为1表示是丢失东西的界面，为2表示是找到东西的界面(默认为1)
	 * @return None
	 */
	public function lfView($_lostOrFound = 1,$obj) {

		if ($_lostOrFound == 1) {   // 丢失东西的界面及其数据

		}

		if ($_lostOrFound == 2) {	// 找到东西的界面及其数据

		}
		$this->load->model('Goods_cats_Model','',true);
		$cats = $this->Goods_cats_Model->get();
		$this->page('lf_view', array(
			'css' => array('main', 'lf_view')
			),
			'',
			array(
				'lostOrFound' => $_lostOrFound,	// 传入页面类型参数
				'obj' => $obj,
				'cats' => $cats
				)
		);
	}

	/**
	 * 丢失东西和找到东西统一的详情界面s
	 * @return None
	 */
	public function detailView($_lostOrFound,$data) {

		if ($_lostOrFound == 1) {   // 丢失东西的界面及其数据

		}

		if ($_lostOrFound == 2) {	// 找到东西的界面及其数据

		}

		$this->page('detail_view', array(
			'css' => array('main', 'detail_view')
			),
			'',
			array(
				'lostOrFound' => $_lostOrFound,	// 传入页面类型参数
				'data' => $data
				)
		);
	}


	//////////////
	// 网站用户相关界面 //
	//////////////


	public function registerView() {
		$this->page('register_view', array(
			'css' => array('main', 'register_view')
			)
		);
	}

	public function loginView() {
		$this->page('login_view', array(
			'css' => array('main', 'login_view')
			)
		);
	}

	public function personCenter() {
		$this->page('person_center', array(
				'css' => array('main', 'person_center')
			),
		'',
		'',
		'',
		array(
			'script' => array('person_center')
			)
		);
	}
	/**
	 * 个人中心其他操作
	 */
	//基本信息
/*	public function basicInfo(){
		$user = $_SESSION['USER'];
		var_dump($user);
	}
	//交易单
	public function tradeOrder(){
		//
	}
	//站内信
	public function siteEmail(){
		//
	}
	//我的发布
	public function myPublish(){
		//
	}
	//密码修改
	public function changePass(){
		//
	}*/


	//////////
	// 其他界面 //
	//////////


	public function chooseCity() {
		$this->load->model('Areas_Model','',true);
		$data['province'] = $this->Areas_Model->get_all();
		$this->page('choose_city',
			array(
				'css' => array('main', 'choose_city')
				),
			'',
			$data
			);
	}


	public function news() {
		$this->page('news', array(
			'css' => array('main', 'news')
			)
		);
	}

	public function aboutus() {
		$this->page('aboutus', array(
			'css' => array('main', 'aboutus')
			)
		);
	}


	public function publishLost() {
		// 发布丢失的东西
		$this->isLogin();
		$this->publish(1);

	}

	public function publishFound() {
		// 发布找到的东西
		$this->isLogin();
		$this->publish(2);
	}


	// 丢失东西和找到东西统一的发布平台
	public function publish($_lostOrFound) {

		if ($_lostOrFound == 1) {   // 丢失东西的界面及其数据

		}

		if ($_lostOrFound == 2) {	// 找到东西的界面及其数据

		}
		$this->load->model('Goods_cats_Model','',true);
		$this->load->model('Areas_Model','',true);
		$cats = $this->Goods_cats_Model->get();
		$this->page('publish', array(
			'css' => array('main', 'publish')
			),
			'',
			array(
				'lostOrFound' => $_lostOrFound,	// 传入页面类型参数
				'cats' => $cats
				)
		);
	}


	public function ifind() {
		// 我找到丢失的东西

	}

	public function ineed() {
		// 这是我丢的东西，我要认领
		$this->page('ineed', array(
			'css' => array('main', 'ineed')
			)
		);


	}


	///////////////////
	// 用户中心的页面Ajax返回 //
	///////////////////

	public function basicInfo() {
		$this->isLogin();
		$data['user'] = $_SESSION['USER'];
		//var_dump($data['user']);
		echo $this->load->view('person_center/basic_info', $data, true);
	}

	public function tradeOrder() {
		$this->isAjaxLogin();
		$this->load->model('Orders_Model','',true);
		$data['obj'] = $this->Orders_Model->get_user_orders();
		//var_dump($data['obj']);
		echo $this->load->view('person_center/trade_order', $data, true);
	}

	public function siteEmail() {
		$this->isAjaxLogin();
		$this->load->model('Sms_Model','',true);
		$data['obj'] = $this->Sms_Model->query_by_list();
		//var_dump($data['obj']);
		echo $this->load->view('person_center/site_email', $data, true);
	}

	public function myPublish() {
		$this->isAjaxLogin();
		$this->load->model('Message_Model','',true);
		$data['obj'] = $this->Message_Model->my_publish();
		//var_dump($data['obj']);
		echo $this->load->view('person_center/my_publish', $data, true);
	}

	public function changePass() {
		$this->isAjaxLogin();
		echo $this->load->view('person_center/change_pass','',true);
	}


	//////////
	// 关于我们 //
	//////////

	public function siteBrief() {
		
	}

	public function dutyDeclare() {

	}

	public function privacy() {

	}

	public function contactUs() {

	}

}
