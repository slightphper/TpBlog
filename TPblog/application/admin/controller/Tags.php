<?php
namespace app\admin\controller;
use app\admin\controller\Base;

class Tags extends Base{

	//显示标签
	public function lst(){
		$tags = db('tags')->paginate(7);
		$this->assign('tags',$tags);
		return $this->fetch();
	}

	//添加标签
	public function add(){
		if(request()->isPost()){
			$data = [
				'tagname'=>input('tagname'),
			];
		$validate = \think\Loader::Validate('Tags');
		if(!$validate->scene('add')->check($data)){
			$this->error($validate->getError());die();
		}
		if(db('tags')->insert($data)){
			$this->success('标签添加成功','tags/lst');
		}else{
			$this->error('标签添加失败');
		}
		return;
		}
		return $this->fetch();

	}

	//标签修改
	public function edit(){
		$id = input('id');
		if(request()->isPost()){
			$data = [
				'id'     =>input('id'),
				'tagname'=>input('tagname'),
				];
		//过滤
		$validate = \think\Loader::Validate('Tags');
		if(!$validate->scene('edit')->check($data)){
			$this->error($validate->getError());die;
		}
		if(db('tags')->update($data)){
			$this->success('标签修改成功','tags/lst');
		}else{$this->success('标签修改失败！');}
			return;
		}
		$tag = db('tags')->find($id);
		$this->assign('tag',$tag);
		return $this->fetch();
	}

	//标签删除
	public function del(){
		$id = input('id');
		if(db('tags')->delete($id)){
			$this->success('标签删除成功','tags/lst');
		}else{
			$this->success('标签删除失败！');
		}
	}
}