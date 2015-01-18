<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['ccvoide']['charset'] = 'utf8';
$config['ccvoide']['uid'] 	= '679140E95FB4BB36';
$config['ccvoide']['key']	= '5EYhWHaSZtA4dglRT0SHPutpH5V55sAb';
//获取用户信息
$config['ccvoide']['api']['user_info']	= 'http://spark.bokecc.com/api/user';
//获取视频列表
$config['ccvoide']['api']['videos']		= 'http://spark.bokecc.com/api/videos';
//获取播放视频
$config['ccvoide']['api']['playcode'] 	= 'http://spark.bokecc.com/api/video/playcode';
//删除视频
$config['ccvoide']['api']['deletevideo']= 'http://spark.bokecc.com/api/video/delete';
//更新视频
$config['ccvoide']['api']['editvideo']	= 'http://spark.bokecc.com/api/video/update';
//获取单个视频
$config['ccvoide']['api']['video']	    = 'http://spark.bokecc.com/api/video';
//获取视频分类
$config['ccvoide']['api']['category']	= 'http://spark.bokecc.com/api/video/category';
