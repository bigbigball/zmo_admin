<?php
	
class News_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function addNews($post){
		if(!empty($post)){
			return $this->db->insert('news' , $post);
		}
	}
	function get_list($post){
		$data = array();
		$this->db->select('id , title,desc,author,ctime,img');
		$this->db->where('status' , '0');
		$this->db->order_by('order' , 'desc');
		$this->db->order_by('id' , 'desc');
		$this->db->limit($post['limit'],(($post['page']-1) * $post['limit']));
		$query = $this->db->get('news');
		if($query->num_rows() > 0){
			$info = $query->result_array();
			$data['info'] = $info;
		}
		return $data;	
	}
	function get_count($post){
		$this->db->where('status' , '0');
        $count = $this->db->count_all_results('news');
        return $count;
	}
	function getNews($post){
		$data['ret'] = 400;
		if(!empty($post['id'])){
			$this->db->select('id , title,author,ctime,img');
			$this->db->where('status' , '0');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('news');
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
	function deleteNews($post){
		$data['ret'] = 400;
		if(!empty($post['id'])){
			$this->db->select('id');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('news');
			if($query->num_rows() > 0){
				$data['ret'] = 200;
				$info = $query->row_array();
				$this->db->where('id' , $info['id'])->update('news' , array('status' => 1));
			}else{
				$data['ret'] = 204;	
			}
		}
		return $data;	
	}
}