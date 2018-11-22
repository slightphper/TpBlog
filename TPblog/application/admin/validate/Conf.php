<?php
namespace app\admin\validate;
use think\Validate;
class Conf extends Validate{

	protected $rule = [
		'ename' => 'require|unique:conf',
		'cname' => 'require|unique:conf',
	];

	protected $message = [
		'ename.require' => '请填写英文名称！',
		'ename.unique' => '英文名称已存在，请重新填写！',
		'cname.require' => '请填写中文名称！',
		'cname.unique' => '中文名称已存在，请重新填写！',
	];

	protected $scene = [
		'add' => ['ename','cname'],
		'edit'=> ['ename','cname' => 'require'],
	];
}