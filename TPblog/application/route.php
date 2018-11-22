<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
//跟目录
// Route::rule('/','index/Index/index');
Route::rule('index','index/Index/index','get',['ext'=>'html|htm']);
//文章列表
Route::rule('article/:id','index/Article/index','get',['ext'=>'html'],['id'=>'\d+']);
//分类
Route::rule('cate','index/Cate/lst','get',['ext'=>'html']);
//随笔
Route::rule('diary','index/Diary/index','get',['ext'=>'html']);
//友链
Route::rule('link','index/Link/index','get',['ext'=>'html']);
//关于
Route::rule('about','index/About/index','get',['ext'=>'html']);

