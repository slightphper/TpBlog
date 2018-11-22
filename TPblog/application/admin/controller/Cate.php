<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Cate as CateModel;
use think\Db;

class Cate extends Base
{
    public function lst()
    {
    	$list = CateModel::paginate(7);
    	$this->assign('list',$list);
        return $this->fetch('cate/lst');
    }

    //添加分类
    public function add(){
    	if(request()->isPost()){
    		$data = [
    			'catename' => input('catename'),
    		];
    	$validate = \think\Loader::validate('Cate');
    	if(!$validate->scene('add')->check($data)){
    		$this->error($validate->getError());die();
    	}
    	if(db('cate')->insert($data)){
    		return $this->success('添加分类成功','cate/lst');
    	}else{
    		return $this->error('添加分类失败');
    	}
    	return;
    }
        return $this->fetch();
}

	//修改分类
	public function edit(){
		$id = input('id');
		$admins = db('cate')->find($id);
		//接收数据
		if(request()->isPost()){
			$data = [
			'id'	   => input('id'),
			'catename' => input('catename'),
			];
		
		//验证数据
		$validate = \think\Loader::validate('cate');
		if(!$validate->scene('edit')->check($data)){
			$this->error($validate->getError());die();
		}

		//提交
		if(db('cate')->update($data)){
			$this->success('修改分类成功！','lst');
		}else{
			$this->error('修改分类失败');
		}
		return;
	}
		//赋值
		$this->assign('admins',$admins);
		return $this->fetch();
	}

	//删除分类
	public function del(){
		$id = input('id');
		if(db('cate')->delete($id)){
			$this->success('分类删除成功','cate/lst');
		}else{
			$this->error('分类删除失败');
		}
		return $this->fetch();
	}

}
