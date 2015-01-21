<?php
	
class Lesson_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_list($post)
	{
		$data = array();
		$this->db->select('id , title , desc , guest_id, thumb ,is_price,price,type,address,tag_info');
		$this->db->where('status' , '0');
		$this->db->order_by('order' , 'desc');
		$this->db->order_by('id' , 'desc');
		$this->db->limit($post['limit'],(($post['page']-1) * $post['limit']));
		$query = $this->db->get('lesson');
		if($query->num_rows() > 0){
			$info = $query->result_array();
			$data['info'] = $info;
		}
		return $data;	
	}
	
	function get_count(){
		$this->db->where('status', 0);
        $count = $this->db->count_all_results('lesson');
        return $count;
	}
	
	function addLesson($post){
		if(!empty($post)){
			return $this->db->insert('lesson' , $post);
		}
	}
	
	function updateLesson($post){
		if(empty($post['id'])){
			show_error('参数错误，没有要修改内容的编号');	
		}
		if(!empty($post)){
			return $this->db->where('id' , $post['id'])->update('lesson' , $post);
		}
	}
	
	function getLesson($post){
		$data['ret'] = 400;
		if(!empty($post['id'])){
			$this->db->select('*');
			$this->db->where('status' , '0');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('lesson');
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
	function deleteLesson($post){
		$data['ret'] = 400;
		if(!empty($post['id'])){
			$this->db->select('id');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('lesson');
			if($query->num_rows() > 0){
				$data['ret'] = 200;
				$info = $query->row_array();
				$this->db->where('id' , $info['id'])->update('lesson' , array('status' => 1));
			}else{
				$data['ret'] = 204;	
			}
		}
		return $data;		
	}
}