<?php
/**
 * 基础控制器
 */
class MY_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
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
	public function page($_page, $_param_head = '', $_param_page = '',$_param_footer = '', $_param_foot = '') {
		
		$this->load->view('admin/templates/head.php', $_param_head, false);
		//$this->load->view('admin/templates/header.php', $_param_header, false);

		$this->load->view('admin/'.$_page, $_param_page, false);

		//$this->load->view('admin/templates/footer.php', $_param_footer, false); 
		$this->load->view('admin/templates/foot.php', $_param_foot, false);
	}
	/**
	 * 检查登录
	 */
	public function isAdminLogin(){
		if ( !isset($_SESSION['ADMIN']) ) {
			header("Location:".site_url('admin/Login/toLogin'));
		}
	}
	/**
	 * 检查ajax登录
	 */
	public function isAdminAjaxLogin(){
		if ( !isset($_SESSION['ADMIN']) ) {
			die('{"status":-999}');
		}
	}

	/////////////
	//// 前台 //
	///////////
	public function isLogin () {
		if ( !isset($_SESSION['USER']) ) {
			header("Location:".site_url('Login/toLogin'));
		}
	}

	//ajax
	public function isAjaxLogin() {
		if ( !isset($_SESSION['USER']) ) {
			die('{"status":-999}');
		}
	}

	//////////
	///公共///
	//////////
	//图片上传
	public function uploadPic () {
		$config['upload_path']      = './upload/';
        $config['allowed_types']    = 'gif|jpg|png';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors($opean='', $close=''));
            $rd['status'] = -1;
            $rd['errmsg'] = $error['error'];
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            //处理
            $rd['status'] = 1;
            $rd['data']['file_url'] = base_url().'upload/'.$data['upload_data']['file_name'];
            //echo $rd['data'];
            //return $rd;
        }
        echo json_encode($rd);
	}
}