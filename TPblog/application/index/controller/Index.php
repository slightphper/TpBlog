<?php
namespace app\index\controller;
use app\index\controller\Base;
class Index extends Base
{
    public function index()
    {	
    	//获取文章
    	$articles = db('article')->field('id,title,pic,desc,time')->order('id desc')->paginate(3);
    	//赋值
    	$this->assign([
    		'articles' => $articles,
    		]);
        return $this->fetch();
    }

}
