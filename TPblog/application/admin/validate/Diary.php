<?php
namespace app\admin\validate;
use think\Validate;

class Diary extends Validate{

	protected $rule = [
		'content' => 'require|unique:diary',
	];

	protected $message = [
		'content.require'=>'请填写内容',
		'tagname.unique' =>'内容不得重复',
	];

	protected $scene = [
		'add' => ['content'],
		'edit'=> ['content'],
	];
}