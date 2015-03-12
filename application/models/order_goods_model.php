<?php
	
class Order_Goods_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    //根据用户id数组获取用户列表
    function get_list_by_order_ids($ids){
		$this->db->select();
        $this->db->where_in('order_id', $ids);
		$query = $this->db->get('order_goods');
		if($query->num_rows() > 0){
			$result = $query->result_array();
            $list = array();
            foreach($result as $val){
                $list[$val['order_id']] = $val;
            } 
            return $list;
		}
		return false;
    }

}
