<?php
namespace app\admin\controller;
use think\Controller;

class Base extends Controller{

	public $config;  //定义公共配置项，使得别的控制器也可使用

	public function _initialize(){
		if(!session('username')){
			$this->error('请先登录系统','login/index');
		}
		$this->_getConfs(); //获取配置项

	}

	//系统配置
	public function _getConfs(){
		$configs = model('Conf')->getConfs();
		$this->config = $configs;
		$this->assign('configs',$configs);
	}

}