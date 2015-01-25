<?php
	
class Active_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_count($post){
		$this->db->where('status' , '0');
        $count = $this->db->count_all_results('active');
        return $count;
	}
	
	function get_list($post){
		$data = array();
		$this->db->select('id , title,theme , img , desc,stime,etime,quota,is_price,price,address');
		$this->db->where('status' , '0');
		$this->db->order_by('order' , 'desc');
		$this->db->order_by('id' , 'desc');
		$this->db->limit($post['limit'],(($post['page']-1) * $post['limit']));
		$query = $this->db->get('active');
		if($query->num_rows() > 0){
			$info = $query->result_array();
			$data['info'] = $info;
		}
		return $data;	
	}

	function addActive($post){
		if(!empty($post)){
			return $this->db->insert('active' , $post);
		}
	}
	
	function editActive($post){
		if(empty($post['id'])){
			show_error('参数错误，没有要修改内容的编号');	
		}
		if(!empty($post)){
			$this->db->where('id' , $post['id'])->update('active' , $post);
		}
	}
	
	function getActive($post){
		$data['ret'] = 400;
		if(!empty($post['id'])){
			$this->db->select('*');
			$this->db->where('status' , '0');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('active');
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
	
	function deleteActive($post){
		$data['ret'] = 400;
		if(!empty($post['id'])){
			$this->db->select('id');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('active');
			if($query->num_rows() > 0){
				$data['ret'] = 200;
				$info = $query->row_array();
				$this->db->where('id' , $info['id'])->update('active' , array('status' => 1));
			}else{
				$data['ret'] = 204;	
			}
		}
		return $data;	
	}
}