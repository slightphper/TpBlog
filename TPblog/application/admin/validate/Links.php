<?php
namespace app\admin\validate;
use think\Validate;

class Links extends Validate{

	protected $rule = [
		'title' => 'require|max:40',
		'url'	=> 'require',
	];

	protected $message = [
		'title.require' => '请填写链接标题',
		'url.require'   => '请填写链接网址',
	];

	protected $scene  = [
		'add'  => ['title','url'],
		'edit' => ['title','url'],
	];
}