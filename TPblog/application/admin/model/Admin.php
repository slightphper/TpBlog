<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Admin extends Model{
	//验证账号密码是否正确
	public function Login($data){
		$captcha = new \think\captcha\Captcha();
		if(!$captcha->check($data['code'])){
			return 4;
		}

		$user = Db::name('admin')->where('username','=',$data['username'])->find();
		if($user){
			if($user['password'] == md5($data['password'])){
				session('username',$user['username']);
				session('uid',$user['id']);
				return 3;  //信息正确
			}else{
				return 2;  //密码不正确
			}
		}else{
			return 1; //账号不存在
		}
	}
	
}