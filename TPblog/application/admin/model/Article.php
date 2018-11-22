<?php
namespace app\admin\model;
use think\Model;

class Article extends Model{

	public function tags(){
		return $this->belongsTo('tags','tagsid');
	}

	public function cate(){
		return $this->belongsTo('cate','cateid');
	}

	public function admin(){
		return $this->belongsTo('admin','userid');
	}
}