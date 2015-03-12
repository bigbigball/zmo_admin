<?php
	
class Collect_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    //根据用户id数组获取用户列表
    function get_list_by_uid($uid){
		$this->db->select();
        $this->db->where('user_id', $uid);
        $this->db->order_by('type' , 'asc');
		$query = $this->db->get('collect');
		if($query->num_rows() > 0){
			$list = $query->result_array();
            return $list;
		}
		return false;
    }
}
