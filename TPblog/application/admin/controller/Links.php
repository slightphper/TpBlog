<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Links as LinksModel;
use think\Db;
class Links extends Base{

	//显示链接
	public function lst(){
		$links = LinksModel::paginate(15);
		$this->assign('links',$links);
		return $this->fetch();
	}

	//添加链接
	public function add(){
		//接收数据
		if(request()->isPost()){
			$data = [
				'title' => input('title'),
				'url' 	=> input('url'),
				'desc'  => input('desc'),
				'pic'	=> input('pic'),
			];

		//验证
		$validate = \think\Loader::validate('Links');
		if(!$validate->scene('add')->check($data)){
			$this->error($validate->getError());
		}

		//添加
		if(Db::name('links')->insert($data)){
			$this->success('链接添加成功','links/lst');
		}else{
			$this->error('链接添加失败');
		}
		return;
		}
		return $this->fetch();
	}

	//修改链接
	public function edit(){
		//接收修改id参数
		$id = input('id');
		$admins = db('links')->find($id);
		//接收修改数据
		if(request()->isPost()){
			$data = [
				'id'	=> input('id'),
				'title' => input('title'),
				'url' => input('url'),
				'desc' => input('desc'),
			];
		//验证
		$validate = \think\Loader::validate('Links');
		if(!$validate->scene('edit')->check($data)){
			$this->error($validate->getError());
		}
		//判断
		if(Db::name('links')->update($data)){
			$this->success('链接修改成功','links/lst');
		}else{
			$this->error('链接修改失败');
		}
		return;
		}
		//赋值
		$this->assign('admins',$admins);
		return $this->fetch();
	}

	//删除链接
	public function del(){
		$id = input('id');
		if(Db::name('links')->delete($id)){
			$this->success('链接删除成功','links/lst');
		}else{
			$this->error('链接删除失败');
		}

	}
}