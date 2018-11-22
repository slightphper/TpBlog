<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate{

	//验证规则
	protected $rule = [
		'username'=> 'require|max:15|unique:admin',
		'password'=> 'require',
		'nickname'=> 'require|max:15|unique:admin',
	];

	//错误提示
	protected $message = [
		'username.require' => '管理员名称不能为空',
		'username.max' =>  '长度不得超过25',
		'username.unique' =>  '管理员名称不得重复',
		'password.require' => '管理员密码必须填写',
	];

	protected $scene = [
		'add' => ['username','password','nickname'],
		'edit' => ['password','nickname'],
	];
}