<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Base extends Controller
{

	public function _initialize(){
		$this->_cateRes();
		$this->_hotRes();
		$this->_stateRes();
		$this->_linkRes();
		$this->_confRes();
	}

	//获取文章分类
	public function _cateRes(){
		$cateRes = Db::name('cate')->order('id ASC')->select();
    	$this->assign('cateRes',$cateRes);
	}

	//获取置顶文章
	public function _stateRes(){
    	$stateRes = Db::name('article')->where('state','1')->field('id,title')->order('id desc')->limit(2)->select();
    	$this->assign('stateRes',$stateRes);
	}

	//获取热门文章
	public function _hotRes(){	
    	$hotRes = Db::name('article')->field('id,title')->order('click desc')->limit(7)->select();
    	$this->assign('hotRes',$hotRes);
	}

	//获取友情链接
	public function _linkRes(){
		$linkRes = Db::name('links')->order('id desc')->limit(12)->select();
		$this->assign('linkRes',$linkRes);
	}

	//获取配置项
	public function _confRes(){
		$_confRes = Db::name('conf')->field('ename,value')->select();
		$confRes = array();
		foreach ($_confRes as $k => $v) {
			$confRes[$v['ename']] = $v['value'];
		}
		$this->assign('configs',$confRes);
	}
	
}