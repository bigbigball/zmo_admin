<?php
	
class Home_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_carousel($post)
	{
		$data = array();
		$this->db->select('id , title , status , uri , order , ctime , position,status,path');
		$this->db->where('status = ' , 0);
		$this->db->order_by('order' , 'desc');
		$this->db->order_by('id' , 'desc');
		$this->db->limit($post['limit'],(($post['page']-1) * $post['limit']));
		$query = $this->db->get('carousel');
		if($query->num_rows() > 0){
			$info = $query->result_array();
			$data['info'] = $info;
		}
		return $data;	
	}
	function get_carousel_count(){
		$this->db->where('status', 0);
        $count = $this->db->count_all_results('carousel');
        return $count;
	}
	function addCarousel($post){
		$data['title'] = $post['title'];
		$data['path'] = $post['path'];
		$data['status'] = 0;
		$data['uri'] = $post['uri'];
		$data['order'] = 0 ;
		$data['position'] = $post['position'];
		$data['ctime'] = time();	
		$this->db->insert('carousel' , $data);
	}
	function editCarousel($post){
		if(empty($post['id'])){
			show_error('参数错误，没有要修改内容的编号');	
		}
		$data['title'] = $post['title'];
		if(!empty( $post['path'])){
			$data['path'] = $post['path'];
		}
		$data['uri'] = $post['uri'];
		$data['position'] = $post['position'];
		$data['ctime'] = time();	
		$this->db->where('id' , $post['id'])->update('carousel' , $data);
	}
	function getCarousel($post){
		$data['ret'] = 400;
		if(!empty($post['id'])){
			$this->db->select('id , title , status , uri , order , position,ctime , status,path');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('carousel');
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
	function deleteCarousel($post){
		$data['ret'] = 400;
		if(!empty($post['id'])){
			$this->db->select('id , title , status , uri , order , ctime , status,path');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('carousel');
			if($query->num_rows() > 0){
				$data['ret'] = 200;
				$info = $query->row_array();
				$this->db->where('id' , $info['id'])->update('carousel' , array('status' => 1));
			}else{
				$data['ret'] = 204;	
			}
		}
		return $data;	
	}
}