<?php
	
class Member_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    //获取指定条件下用户列表
	function get_list($post){
		$this->db->select();
		$this->db->order_by('id' , 'desc');
		$this->db->limit($post['limit'],(($post['page']-1) * $post['limit']));
		$query = $this->db->get('user');
		if($query->num_rows() > 0){
			$info = $query->result_array();
            return $info;
		}
		return false;
	}

    //获取指定条件下的用户总条数
	function get_count($post){
        $count = $this->db->count_all_results('user');
        return $count;
	}

    //根据用户id获取用户详细信息
    function get_detail_by_id($post){
        $this->db->where('id', $post['id']);
        $this->db->limit(1);
        $query = $this->db->get('user');
        if($query->num_rows() > 0){
            $detail = $query->row_array();
            return $detail;
        }
        return array();
    }

}
