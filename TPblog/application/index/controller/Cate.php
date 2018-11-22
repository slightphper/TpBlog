<?php
namespace app\index\controller;
use app\index\controller\Base;
use think\Db;
class Cate extends Base
{
   //列表首页
  public function lst(){
    $getData = input('get.');
    //分类筛选
    if(isset($getData['cate'])){
      $where = array();
      $where['cateid'] = ['=',$getData['cate']];
      // halt($where);
    }
    //关键字搜索
    if(request()->isPost()){
      $postData = input('post.');
      $where = array();
      $where['title'] = ['like','%'.$postData['search'].'%'];
    }
    
    //如果未选择分类要给where赋值，避免报错
    if(!isset($where)){
        $where = 1;
    }
    //显示文章
    $articleRes = Db::name('article')->alias('a')
                ->join('cate c','c.id = a.cateid')
                ->field('a.*,c.catename')->where($where)->order('a.state DESC,a.id DESC')->select();
    $this->assign([
        'articleRes' => $articleRes,
        ]);
    // return $articleRes;
    return view();
   }
}
