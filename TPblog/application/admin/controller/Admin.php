<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
use app\admin\model\Admin as AdminModel;
class Admin extends Base
{
	//显示用户列表页
    public function lst()
    {	
    	$model = new AdminModel();
    	$list = AdminModel::paginate(10);
    	$this->assign('list',$list);
        return $this->fetch();
    }

    public function add()
    {	
    	if(request()->isPost()){
    		$data = [
                'username'=>input('username'),
    			'nickname'=>input('nickname'),
    			'password'=>md5(input('password')),
    		];
    		$validate = \think\Loader::Validate('Admin');
    		if(!$validate->check($data)){
    			$this->error($validate->getError());
    		}
    		if(Db::name('admin')->insert($data)){
    			return $this->success('添加管理员成功','admin/lst');
    		}else{
    			return $this->error('添加管理员失败');
    		}
    		return;
    	}
        return $this->fetch();
    }

    //页面修改
    public function edit(){
    	$id = input('id');
    	$admins = db('admin')->find($id);
    	//接收数据
    	if(request()->isPost()){
    		$data = [
    			'id' =>input('id'),
                'username' =>input('username'),
    			'nickname' =>input('nickname'),
    			
    		];
    		//密码加密
    		if(input('password')){
    			$data['password'] = md5(input('password'));
    		}
    		//验证
    		$validate = \think\Loader::validate('Admin');
    		if(!$validate->scene('edit')->check($data)){
    			$this->error($validate->getError());
    		}

    		if(db('admin')->update($data)){
    			$this->success('修改成功','admin/lst');
    		}else{
    			$this->error('修改失败');
    		}
    		return;
    	}

    	$this->assign('admins',$admins);
    	return $this->fetch();
    }


    //管理员删除
    public function del(){
    	$id = input('id');
    	if($id != 2){
    		if(db('admin')->delete(input('id'))){
    			$this->success("管理员删除成功",'admin/lst');
    		}else{
    			$this->error('管理员删除失败！');
    			}
    		}else{
    			$this->error('当前管理员不能删除');
    		}
    	
    }

    //退出登录
    public function logout(){
        session(null);
        $this->success('退出成功','login/index');
    }
}


