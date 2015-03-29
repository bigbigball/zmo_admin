<?php
	
class Feedback_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
	function get_count($post){
        $count = $this->db->count_all_results('feedback');
        return $count;
	}
    function get_year_count($post){
        $count = $this->db->count_all_results('year');
        return $count;
	}
    function get_year_list($post){
		$data = array();
		$this->db->select('*');
		$this->db->limit($post['limit'],(($post['page']-1) * $post['limit']));
		$query = $this->db->get('year');
		if($query->num_rows() > 0){
			$info = $query->result_array();
			$data['info'] = $info;
		}
		return $data;
	}
	function get_list($post){
		$data = array();
		$this->db->select('*');
		$this->db->where('status' , '0');
		$this->db->order_by('ctime' , 'desc');
		$this->db->limit($post['limit'],(($post['page']-1) * $post['limit']));
		$query = $this->db->get('feedback');
		if($query->num_rows() > 0){
			$info = $query->result_array();
			$data['info'] = $info;
		}
		return $data;
	}
	function getFeedback($post){
		$data['ret'] = 400;
		if(!empty($post['id'])){
			$this->db->select('*');
			$this->db->where('status' , '0');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('feedback');
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
	function deleteFeedback($post){
		$data['ret'] = 400;
		if(!empty($post['id'])){
			$this->db->select('id');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('feedback');
			if($query->num_rows() > 0){
				$data['ret'] = 200;
				$info = $query->row_array();
				$this->db->where('id' , $info['id'])->update('feedback' , array('status' => 1));
			}else{
				$data['ret'] = 204;	
			}
		}
		return $data;	
	}
}