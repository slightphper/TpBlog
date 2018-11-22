<?php
namespace app\index\controller;
use app\index\controller\Base;
use think\Db;
class Article extends Base
{
    public function index()
    {
    	//接收参数id
    	$arid = input('id');
    	//获取文章
    	//$articles = db('article')->find($arid);
        $articles=Db::name('article')->alias('a')
            ->join('tags t','t.id=a.tagsid')
            ->join('admin u','u.id = a.userid')
            ->field('a.id,a.title,a.content,a.click,a.time,a.cateid,t.tagname,u.nickname')
            ->find($arid);
        // halt($articles);
        //获取上一条和下一条文章
        $arr[] = Db::name('article')->where('id','<',$arid)->field('id,title')->order('id desc')->find();
        $arr[] = Db::name('article')->where('id','>',$arid)->field('id,title')->order('id asc')->find();
        // halt($arr[0]);
    	//点击率自增
    	Db::name('article')->where('id',$arid)->setInc('click',1);
    	//获取分类名称
    	// $cate = db('cate')->find($articles['cateid']);
    	$this->assign([
                // 'cate'      =>$cate,
                'articles'  =>$articles,
                'arr'       =>$arr,
            ]);

        return $this->fetch('article/lst');
    }
}
