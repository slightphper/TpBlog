<?php
namespace app\index\controller;
use app\index\controller\Base;
class Link extends Base{
	//显示友情链接
	public function index(){
		$linkRes = db('links')->order('id desc')->select();
		$this->assign('linkRes',$linkRes);
		return $this->fetch('link/link');
	}
}