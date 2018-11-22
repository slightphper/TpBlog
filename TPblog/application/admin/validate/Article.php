<?php
namespace app\admin\validate;
use think\Validate;

class Article extends Validate{

	protected $rule = [
		'title' => 'require|max:60',
		'cateid'=> 'require',
	];

	protected $message  = [
		'title.require' => '请填写文章标题',
		'title.max'     => '文章标题长度不得超过60位',
		'cateid'		=> '请选择所属分类',
	];

	protected $scene = [
		'add' => ['title','cateid'],
		'edit' => ['title','cateid'],
	];
}