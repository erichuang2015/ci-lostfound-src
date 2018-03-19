<?php
/**
 * 基础控制器
 */
class MY_Model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	/**
	 * 检查登录
	 */
	public function isLogin(){
		//
	}
	/**
	 * 检查ajax登录
	 */
	public function isAjaxLogin(){
		//
	}
	/**
     * 用来处理内容中为空的判断
     */
	public function checkEmpty($data,$isDie = false){
	    foreach ($data as $key=>$v){
			if(trim($v)==''){
				if($isDie)die("{\"status\":-1,\"key\":\"$key\"}");
				return false;
			}
		}
		return true;
	}

	/**
 * 处理转义字符
 * @param $str 需要处理的字符串
 */
function myAddslashes($str){
	if (!get_magic_quotes_gpc()){
		if (!is_array($str)){
			$str = addslashes($str);
		}else{
			foreach ($str as $key => $val){
				$str[$key] = addslashes($val);
			}
		}
	}
	return $str;
}
}