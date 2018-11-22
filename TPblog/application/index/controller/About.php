<?php
namespace app\index\controller;
use app\index\controller\Base;
class About extends Base{

	public function index(){
		
		return $this->fetch('about/about');
	}

}