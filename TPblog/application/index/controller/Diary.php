<?php
namespace app\index\controller;
use app\index\controller\Base;
class Diary extends Base{
	//显示随笔
	public function index(){
		$diarys = db('diary')->order('id desc')->select();
		$this->assign('diarys',$diarys);
		return $this->fetch('diary/diary');
	} 
}