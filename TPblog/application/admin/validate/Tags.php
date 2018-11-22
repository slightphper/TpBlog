<?php
namespace app\admin\validate;
use think\Validate;

class Tags extends Validate{

	protected $rule = [
		'tagname' => 'require|max:15|unique:tags',
	];

	protected $message = [
		'tagname.require'=>'请填写标签名',
		'tagname.max'	 =>'标签名长度超过15位',
		'tagname.unique' =>'标签不得重复',
	];

	protected $scene = [
		'add' => ['tagname'],
		'edit'=> ['tagname'],
	];
}