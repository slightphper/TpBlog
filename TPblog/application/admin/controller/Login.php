<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;

class Login extends Controller{

	//显示登录页面
	public function index(){
		if(request()->isPost()){
			$admin = new Admin();
			$data  = input('post.');
			$num   = $admin->Login($data);
			if($num == 3){
				$this->success('登录成功','index/index');
			}elseif($num == 4){
				$this->error('验证码错误！');
			}else{
				$this->error('用户名或密码错误');
			}
		}
		return $this->fetch('Login/login');
	}
}