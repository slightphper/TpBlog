<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Article  as ArticleModel;
use think\Db;
class Article extends Base
{
    public function lst()
    {
    	
    	// $articles = db('article')->alias('a')->join('cate c','c.id=a.cateid')->field('a.id,a.title,a.pic,a.author,a.state,c.catename')->paginate(4);
        $articles = ArticleModel::paginate(20);
        // halt($articles);
    	$this->assign([
            'articles' => $articles,
            ]);
        return $this->fetch();
    }

    //添加文章
    public function add(){
    	//接收数据
    	if(request()->isPost()){
    		$data = [
    			'title'   => trim(input('title')),
    			'desc'    => input('desc'),
    			'tagsid'  => input('tagsid'),
    			'content' => input('content'),
    			'cateid'  => input('cateid'),
                'userid'  => session('uid'),
    			'time'	  => time(),
    		];
    		if(input('state') == 'on'){
    			$data['state'] = 1;
    		}
    		if($_FILES['pic']['tmp_name']){
    			$file = request()->file('pic');
    			$info = $file->move(ROOT_PATH.'public'.DS.'static/uploads');
    			$data['pic'] = '/uploads/'.$info->getSaveName();
    		}
    		//验证
    		// $validate = \think\Loader::validate('Article');
    		// if(!$validate->scene('add')->check($data)){
    		// 	$this->error($validate->getError());die();
    		// }
    		if(Db::name('article')->insert($data)){
    			$this->success('文章添加成功','article/lst');
    		}else{
    			$this->error('文章添加失败');
    		}
    		return;
    	}

    	$cates = Db::name('cate')->select();
        $tags  = Db::name('tags')->select();
        $this->assign([
            'cates' => $cates,
            'tags' => $tags,
            ]);
    	return $this->fetch();
    }

    //修改文章
    public function edit(){
    	$id = input('id');
    	$articles = Db::name('article')->find($id);
    	//接收数据
    	if(request()->isPost()){
    		$data = [
    			'id' 	   => input('id'),
    			'title'    => input('title'),
    			'desc'     => input('desc'),
    			'keywords' => input('keywords'),
    			'content'  => input('content'),
    			'cateid'   => input('cateid'),
                'userid'   => session('uid'),
    			'time'	   => time(),
    		];
    	if(input('state')=='on'){
    		$data['state'] = '1';
    	}else
    	{
    		$data['state'] = '0';
    	}
    	if($_FILES['pic']['tmp_name']){
    		$file = request()->file('pic');
    		$info = $file->move(ROOT_PATH.'public'.DS.'static/uploads');
    		$data['pic'] = '/uploads/'.$info->getSaveName();
    	}
    	//验证
    	// $validate = \think\Loader::validate('Article');
    	// if(!$validate->scene('edit')->check($data)){
    	// 	$this->error($validate->getError());die();
    	// }	
    	if(DB::name('article')->update($data)){
    		$this->success('文章修改成功','article/lst');
    	}else
    	{
    		$this->error('文章修改失败！');
    	}
    	return;
    	}
    	//赋值
    	$cates = DB::name('cate')->select();
        $tags = DB::name('tags')->select();
        $this->assign([
            'tags'     => $tags,
            'cates'    => $cates,
            'articles' => $articles,
            ]);
    	return $this->fetch();
    }

    //删除文章
    public function del(){
    	$id = input('id');
        $pic = Db::name('article')->field('pic')->find($id);
        $picSrc = ROOT_PATH.'public'.DS.'static'.$pic['pic'];
        if(file_exists($picSrc)){
            @unlink($picSrc);
        }
    	if(Db::name('article')->delete($id)){
    		return 1;  //删除成功
    	}else
    	{
    		return 0; //删除失败 
    	}

    }
}
