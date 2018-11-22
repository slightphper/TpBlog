<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Validate;
use think\Db;
class Conf extends Base{

	//显示配置项
	public function lst(){
		if(request()->isPost()){
			$data = input('post.');
			foreach ($data['sort'] as $k => $v) {
				Db::name('conf')->where('id',$k)->update(['sort' => $v]);
			}
		}
		$confRes = Db::name('Conf')->order('sort ASC')->paginate(10); 
		$this->assign([
			'confRes' => $confRes,
			]);
		return view();
	}

	//增加配置项
	public function add(){
		if(request()->isPost()){
			$data = input('post.');
			//替换中文符号
			if($data['form_type'] == 'radio' || $data['form_type'] ==  'checkbox' || $data['form_type'] == 'select'){
				$data['values'] = str_replace('，',',',$data['values']);
				$data['value'] = str_replace('，',',',$data['value']);
			}
			//验证
			$validate = validate('Conf');
			if(!$validate->scene('add')->check($data)){
				$arr = ['error' => 0,'message' => $validate->getError()];
				return json($arr);
			}
			if(Db::name('Conf')->insert($data)){
				return 1;  //添加成功
			}else{
				return 2; //添加失败
			}
		}
		return view();
	}

	//修改配置项
	public function edit(){
		if(request()->isPost()){
			$data = input('post.');
			//替换中文，
			if($data['form_type'] == 'radio' || $data['form_type'] ==  'checkbox' || $data['form_type'] == 'select'){
				$data['values'] = str_replace('，',',',$data['values']);
				$data['value'] = str_replace('，',',',$data['value']);
			}
			//验证
			$validate = validate('Conf');
			if(!$validate->scene('edit')->check($data)){
				$arr = ['error' => 0,'message' => $validate->getError()];
				return json($arr);
			}
			if(Db::name('Conf')->update($data)){
				return 1;  //修改成功
			}else{
				return 2;  //添加失败
			}
		}
		
		$id = input('id');
		$confRes = Db::name('conf')->find($id);
		$this->assign([
			'confRes' => $confRes,
			]);
		return view();
	}

	//删除配置项
	public function del(){
		$id = input('id');
		if(Db::name('conf')->delete($id)){
			return 1; //删除成功
		}else{
			return 0; //删除失败
		}
	}

	//设置配置项
	public function confList(){
		if(request()->isPost()){
			$data = input('post.');
			//复选框选中问题(如果未选的话，默认还是当前的选中状态)
			$checkFields = Db::name('conf')->field('ename')->where('form_type','checkbox')->select();
			//变为一维数组
			$checkField = array();
			if($checkFields){
				foreach ($checkFields as $k1 => $v1) {
					$checkField[] = $v1['ename'];
				}
			}

			//所有字段变为数组
			$allFields = array();
			foreach ($data as $k => $v) {
				$allFields[] = $k;
				if(is_array($v)){
					$value = implode(',',$v);
					Db::name('conf')->where('ename',$k)->update(['value'=>$value]);
				}else{
					Db::name('conf')->where('ename',$k)->update(['value'=>$v]);
				}
			}
			//判断是否提交复选框 逻辑：如果$checkfield 不在提交过来的allFields数组里面，则为未选中复选
			if($checkField){
				foreach ($checkField as $k3 => $v3) {
					if(!in_array($v3,$allFields)){
						Db::name('conf')->where('ename',$v3)->update(['value' => '']);
					}
				}
			}
			//图片上传
			if($_FILES){
				foreach ($_FILES as $k => $v) {
					if($v['tmp_name']){
						$imgs = Db::name('conf')->field('value')->where('ename',$k)->find();
						if($imgs['value']){
							$oldImg = IMG_UPLOADS.$imgs['value'];
							if(file_exists($oldImg)){
								@unlink($oldImg);
							}
						}
						$imgSrc = $this->upload($k);
						Db::name('conf')->where('ename',$k)->update(['value'=>$imgSrc]);
					}	
				}
			}

			$this->success('配置成功！');
		}

		//赋值
		$indexRes = Db::name('conf')->where('conf_type','1')->order('sort ASC')->select();
		$adminRes = Db::name('conf')->where('conf_type','2')->order('sort ASC')->select();
		$this->assign([
			'indexRes' => $indexRes,
			'adminRes' => $adminRes,
			]);
		return view();
	}

	//图片上传
	public function upload($imgName){
		//获取表单上传文件
		$file = request()->file($imgName);

		//移动到相应目录  /public/static/uploads
		if($file){
			$info = $file->move(ROOT_PATH.'public'.DS.'static'.DS.'uploads');
			if($info){
				//成功返回图片保存名
				return $info->getSaveName();
			}else{
				echo $file->getError();
				die();
			}
		}
	}

}