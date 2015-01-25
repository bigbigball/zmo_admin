<?php
	
class Video_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_user_info(){
		$config = $this->config->item('ccvoide');
		$api = $config['api']['user_info'];
		$query_string = 'format=json&userid=' . $config['uid'] . '&time=' . time();
		$hash = md5($query_string . '&salt=' . $config['key']);
		$api = $api . '?' .$query_string . '&hash=' . $hash;
		$info = callHttpCommon($api , 'GET' , '' , array('user_id' => $config['uid']));
		return $info;
	}
	
	function get_videos(){
		$this->db->select('id,vid,title,content,img,ctime,tag');
		$this->db->where('status' , '0');
		$this->db->order_by('id','desc');
		$query = $this->db->get('video');
		if($query->num_rows() > 0){
			$info = $query->result_array();
		}
		/*$config = $this->config->item('ccvoide');
		$api = $config['api']['videos'];
		$query_string = 'format=json&userid=' . $config['uid'] . '&time=' . time();
		$hash = md5($query_string . '&salt=' . $config['key']);
		$api = $api . '?' .$query_string . '&hash=' . $hash;
		$info = callHttpCommon($api , 'GET' , '' , array('user_id' => $config['uid']));*/
		return $info ;
	}
	
	function update_local($post){
		$this->db->select('id,vid');
		$this->db->where('id' , $post['id']);
		$this->db->limit(1);
		$query= $this->db->get('video');
		$vid = '';
		if($query->num_rows() > 0 ){
			$info = $query->row_array();
			$vid = $info['vid'];
		}
		$config = $this->config->item('ccvoide');
		$api = $config['api']['video'];
		$qs['format'] = 'json';
		$qs['userid'] =  $config['uid'];
		$qs['videoid'] = $vid;
		$query_string = $this->get_query_string($qs,$config['key']);
		$api = $api . '?' .$query_string;
		$info = callHttpCommon($api , 'GET' );
		
		if(!empty($info) && !empty($info['video']) ){
			$v = $info['video'];
			$data = array();
			$data['vid'] = $v['id'];
			$data['title'] = $v['title'];
			$data['tag'] = $v['tags'];
			$data['content'] = $v['desp'];
			$data['utime'] = time();
			$data['img'] = $v['image'];

			$this->db->update('video' , $data, array('id'=>$post['id']));
			return true;
		}
		return false;
	}
	function tolocal(){
		$this->db->select('id,vid');
		$this->db->order_by('id','desc');
		$this->db->limit(1);	
		$query= $this->db->get('video');
		$vid = '';
		if($query->num_rows() > 0 ){
			$info = $query->row_array();
			//$vid = $info['vid'];
		}
		$config = $this->config->item('ccvoide');
		$api = $config['api']['videos'];
		$qs['format'] = 'json';
		$qs['userid'] =  $config['uid'];
		$qs['videoid_from'] = $vid;
		$query_string = $this->get_query_string($qs,$config['key']);
		$api = $api . '?' .$query_string;
		$info = callHttpCommon($api , 'GET' );
		if(!empty($info) && !empty($info['videos']) && $info['videos']['total'] > 0){
			foreach($info['videos']['video'] as $k => $v){
				$data = array();
				$data['vid'] = $v['id'];
				$data['title'] = $v['title'];
				$data['tag'] = $v['tags'];
				$data['content'] = $v['desp'];
				$data['ctime'] = time();
				$data['utime'] = time();
				$data['img'] = $v['image'];
				
				$res = $this->db->insert('video' , $data);
			}
			return $data['ret'] = 200;;
		}
		return $data['ret'] = '204';
	}
	
	function get_query_string($post,$key){
		if(!empty($post) && is_array($post)){
			ksort($post);
			$query_string = '';
			foreach($post as $k => $v){
				$query_string .= '&' . $k . '=' . $v ;	
			}
			$query_string = trim($query_string , '&');
			$t = time();
			$hash = md5($query_string .'&time='.$t.'&salt='.$key);
			$query_string = $query_string .'&time='.$t.'&hash='.$hash;
			return $query_string;
		}	
	}
	function getVideo($post){
		$data['ret'] = 400;
		if(!empty($post['id'])){
			$this->db->select('*');
			$this->db->where('status' , '0');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('video');
			if($query->num_rows() > 0){
				$data['ret'] = 200;
				$info = $query->row_array();
				$data['info'] = $info;
			}else{
				$data['ret'] = 204;	
			}
		}
		return $data ;	
	}
	function deleteVideo($post){
		$data['ret'] = 400;
		if(!empty($post['id'])){
			$this->db->select('id');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('video');
			if($query->num_rows() > 0){
				$data['ret'] = 200;
				$info = $query->row_array();
				$this->db->where('id' , $info['id'])->update('video' , array('status' => 1));
			}else{
				$data['ret'] = 204;	
			}
		}
		return $data;	
	}
	function editVideo($post, $where){
		if(!empty($post) && !empty($where)){
			return $this->db->update('video' , $post, $where);
		}
	}
}