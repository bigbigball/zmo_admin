<?php
	
class Order_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
    //根据用户id获取用户详细信息
    function get_by_user_id($uid){
        $this->db->where('user_id', $uid);
        $query = $this->db->get('order');
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }
        return array();
    }
}
