<?php
	
class Admin_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function getinfo($post){
		$data['ret'] = '400';
		if(!empty($post['admin_id'])){
			$this->db->select('id,uname,power_group,power_action');
			$this->db->where('id' , $post['admin_id']);
			$query = $this->db->get('admin');
			if($query->num_rows() > 0){
				$info = $query->row_array();
				$data['ret'] = '200';
				$data['info'] = $info;
			}else{
				$data['ret'] = '204';	
			}
		}
		return $data;
	}

	function get_count($post){
		$this->db->where('status' , '0');
        $count = $this->db->count_all_results('admin');
        return $count;
	}

	function get_list($post){
		$data = array();
		$this->db->select('id , uname,power_group , power_action , ctime,status,img');
		$this->db->where('status' , '0');
		$this->db->order_by('id' , 'desc');
		$this->db->limit($post['limit'],(($post['page']-1) * $post['limit']));
		$query = $this->db->get('admin');
		if($query->num_rows() > 0){
			$info = $query->result_array();
			$data['info'] = $info;
		}
		return $data;	
	}

	function get_power(){
		$data = array();
		$this->db->select('id , zh_name' );
		$this->db->where('id !=','5');
		$query = $this->db->get('admin_power');
		if($query->num_rows() > 0){
			$data = $query->result_array();
		}
		return $data;
	}

	function add_admin($post){
		if(!empty($post)){
			return $this->db->insert('admin' , $post);
		}
	}

	function deleteAdmin($post){
		if(!empty($post) && isset($post['id'])){
			$data['ret'] = 400;
			$this->db->select('id');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('admin');
			if($query->num_rows() > 0){
				$data['ret'] = 200;
				$info = $query->row_array();
				$this->db->where('id' , $info['id'])->update('admin' , array('status' => 1));
			}
			
		}else{
			$data['ret'] = 204;	
		}
		return $data;
	}
	function get_power_info($post){
		$data = array();
		$this->db->select('id,zh_name,action');
		$this->db->order_by('id','desc');
		$this->db->limit($post['limit'],(($post['page']-1) * $post['limit']));
		$query = $this->db->get('admin_power');
		if($query->num_rows() > 0){
			$info = $query->result_array();
			$data = $info;
		}
		return $data;
	}
	function get_action_info(){
		$data = array();
		$this->db->select('id,zh_name');
		$this->db->order_by('id','desc');
		$query = $this->db->get('admin_action');
		if($query->num_rows() >0){
			$info = $query->result_array();
			if(!empty($info)){
				foreach($info as $k => $v){
					$data[$v['id']] = $v; 
				}
			}
		}
		return $data;
	}
	function get_power_count(){
        $count = $this->db->count_all_results('admin_power');
        return $count;
	}
	function add_power($post){
		if(!empty($post)){
			$post['ctime'] = time();
			return $this->db->insert('admin_power' , $post);
		}
	}
	function delete_power($post){
		if(!empty($post['id'])){
			$this->db->select('id');
			$query = $this->db->get('admin_power');
			if($query->num_rows() > 0){
				return $this->db->where('id' , $post['id'])->delete('admin_power');
			}
		}
	}
}