<?php
	
class Teacher_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_list($post)
	{
		$data = array();
		$this->db->select('id , name , position,portrait , occupation as occ,top,home_img');
		if(!empty($post['top']) && $post['top'] == 1){
			$this->db->where('top' , $post['top']);	
		}
		$this->db->where('status = ' , 0);
		$this->db->order_by('position' , 'asc');
		$this->db->order_by('id' , 'asc');
		$this->db->limit($post['limit'],(($post['page']-1) * $post['limit']));
		$query = $this->db->get('tutor');
		if($query->num_rows() > 0){
			$info = $query->result_array();
			$data['info'] = $info;
		}
		return $data;	
	}
	function get_count(){
		$this->db->where('status', 0);
        $count = $this->db->count_all_results('tutor');
        return $count;
	}
	function addTeacher($post){
		$data = array();
		if(!empty($post['name'])){
			$data['name'] = $post['name'] ;	
		}
		if(!empty($post['position'])){
			$data['position'] = $post['position'] ;	
		}
		if(!empty($post['occ'])){
			$data['occupation'] = $post['occ'] ;	
		}
		if(!empty($post['path'])){
			$data['path'] = $post['path'] ;	
		}
		if(!empty($post['thumb'])){
			$data['portrait'] = $post['thumb'] ;	
		}
		if(!empty($post['desc'])){
			$data['desc'] = $post['desc'] ;	
		}
		if(!empty($post['resume'])){
			$data['resume'] = $post['resume'] ;	
		}
		if(!empty($post['order'])){
			$data['order'] = $post['order'] ;	
		}
		if(!empty($post['hot'])){
			$data['hot'] = $post['hot'] ;	
		}
		if(!empty($post['status'])){
			$data['status'] = $post['status'] ;	
		}
		if(!empty($post['utime'])){
			$data['utime'] = time() ;	
		}
		if(count($data) > 0){	
			$this->db->insert('tutor' , $data);
		}
	}
	function editTeacher($post){
		if(empty($post['id'])){
			show_error('参数错误，没有要修改内容的编号');	
		}
		$data = array();
		if(!empty($post['name'])){
			$data['name'] = $post['name'] ;	
		}
		if(!empty($post['position'])){
			$data['position'] = $post['position'] ;	
		}
		if(!empty($post['occ'])){
			$data['occupation'] = $post['occ'] ;	
		}
		if(!empty($post['path'])){
			$data['path'] = $post['path'] ;	
		}
		if(!empty($post['thumb'])){
			$data['portrait'] = $post['thumb'] ;	
		}
		if(!empty($post['desc'])){
			$data['desc'] = $post['desc'] ;	
		}
		if(!empty($post['resume'])){
			$data['resume'] = $post['resume'] ;	
		}
		if(isset($post['order'])){
			$data['order'] = $post['order'] ;	
		}
		if(!empty($post['status'])){
			$data['status'] = $post['status'] ;	
		}
		$data['utime'] = time() ;	
		if(!empty($post['home_img'])){
			$data['home_img'] = $post['home_img'];	
		}
		if(isset($post['top'])){
			$data['top'] = $post['top'];	
		}
		if(count($data) > 0){	
			$this->db->where('id' , $post['id'])->update('tutor' , $data);
		}
	}
	function addHomeTeacher($post){
		$post['top'] = 1;
		$this->editTeacher($post);
	}
	function getTeacher($post){
		$data['ret'] = 400;
		if(!empty($post['id'])){
			$this->db->select('id , name , position,portrait , home_img , occupation as occ , desc,resume,status,top,order');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('tutor');
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
	function deleteTeacher($post){
		$data['ret'] = 400;
		if(!empty($post['id'])){
			$this->db->select('id');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('tutor');
			if($query->num_rows() > 0){
				$data['ret'] = 200;
				$info = $query->row_array();
				$this->db->where('id' , $info['id'])->update('tutor' , array('status' => 1));
			}else{
				$data['ret'] = 204;	
			}
		}
		return $data;	
	}
	
	function get_all_teacher(){
		$this->db->select('id , name , portrait');
		$this->db->where('status' , 0 );
		$this->db->order_by('order' , 'desc');
		$this->db->order_by('id' , 'desc');
		$query = $this->db->get('tutor');
		if($query->num_rows()>0){
			$info = $query->result_array();
			return $info ;
		}
		return false;	
	}
}