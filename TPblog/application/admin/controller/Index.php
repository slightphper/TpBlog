<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class Index extends Base
{
    public function index()
    {	
    	//获取后台信息
    	$allArticle = Db::name('article')->count();
    	$allDiary = Db::name('diary')->count();
    	$allLinks = Db::name('links')->count();
    	$this->assign([
    		'allArticle' => $allArticle,
    		'allDiary'	 => $allDiary,
    		'allLinks'	 => $allLinks,
    		]);
        return $this->fetch();
    }
}
