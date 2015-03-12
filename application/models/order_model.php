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

    //获取用户id列表
    function get_uids($option){
        $this->db->select('distinct(user_id)');
        $this->db->limit($option['limit'], ($option['page']-1) * $option['limit']);
        $query = $this->db->get('order');
        if($query->num_rows() > 0){
            $list = $query->result_array();
            $uids = array();
            foreach($list as $val){
                $uids[] = $val['user_id'];
            }
            return $uids;
        }
        return array();
    }

    //获取不通user_id总数
    function get_count_different_uids(){
        $this->db->select('distinct(user_id)');
        $query = $this->db->get('order');
        if($query->num_rows() > 0){
            return count($query->result_array());
        }
        return 0;
    }
}
