<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class Diary extends Base{

	public function lst(){
		$diarys = Db::name('diary')->order('id desc')->paginate(20);
		$this->assign('diarys',$diarys);
		return $this->fetch();
	}

	public function add(){
		if(request()->isPost()){
			$data = [
				'content' => input('content'),
				'time'	  => time(),
			];
			//过滤
			$validate = \think\Loader::Validate('Diary');
			if(!$validate->scene('edit')->check($data)){
			$this->error($validate->getError());die;
			}
			if(Db::name('diary')->insert($data)){
				$this->success('随笔添加成功','diary/lst');
			}else{
				$this->error('随笔添加失败!');
			}
			return;
		}
		return $this->fetch();
	}

	public function edit(){
		$id = input('id');
		if(request()->isPost()){
			$data = [
				'id'	=> $id,
				'content'=>input('content'),
			];
			//过滤
			$validate = \think\Loader::Validate('Diary');
			if(!$validate->scene('edit')->check($data)){
			$this->error($validate->getError());die;
			}
			if(Db::name('diary')->update($data)){
				$this->success('随笔修改成功','diary/lst');
			}else{
				$this->error('随笔修改失败!');
			}
			return;
		}
		$diary = Db::name('diary')->find($id);
		$this->assign('diary',$diary);
		return $this->fetch();
	}

	public function del(){
		$id = input('id');
		if(Db::name('diary')->delete($id)){
			return 1;  //删除成功
		}else{
			return 0; //删除失败
		}
	}
}