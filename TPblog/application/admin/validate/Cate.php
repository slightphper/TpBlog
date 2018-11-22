<?php
namespace app\admin\validate;
use think\Validate;

class Cate extends Validate{

	//验证规则
	protected $rule = [
		'catename'=> 'require|max:15|unique:cate',
	];

	//错误提示
	protected $message = [
		'catename.require' => '分类名不能为空',
		'catename.max' =>  '长度不得超过15',
		'catename.unique' => '分类名不能重复！',
		
		];

	protected $scene = [
		'add'  => ['catename'=>'require|unique:cate'],
		'edit' => ['catename' => 'require|unique:cate'],
	];
}