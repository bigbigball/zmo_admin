<?php
	
class Operate_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_count($post){
		$this->db->where('type' , '0');
        $count = $this->db->count_all_results('code');
        return $count;
	}
	
	function get_list($post){
		$data = array();
		$this->db->select('id,code,mail,phone,expire,ctime,status,title');
		$this->db->where('type','0');
		$this->db->order_by('status','asc');
		$this->db->order_by('id' , 'desc');
		$this->db->limit($post['limit'],(($post['page']-1) * $post['limit']));
		$query = $this->db->get('code');
		if($query->num_rows() > 0){
			$info = $query->result_array();
			$data['info'] = $info;
		}
		return $data;
	}
	function add_operate($post){
		$data = array();
		$data['title'] = $post['title'];
		$data['expire'] = strtotime($post['etime']);
		$data['ctime']  = time();
		$data['type'] = 0 ;
		$data['status'] = 0 ;
		$code = $this->get_code($post['amount']);
		if(!empty($code) && count($code) > 0){
			foreach($code as $val){
				$data['code'] = $val;
				$this->db->insert('code' , $data);
			}
		}
		return true;
	}

	private function get_code($num , $arr = array()){
		$cinfo = $arr ;
		if(!empty($num)){
			for($i = 0 ; $i < $num ; $i ++){
				$t = explode(' ',microtime());
				$r = rand(0,99999999);
				$st=md5(($t[1]+$t[0])*10000 . $r . 'cmlove');
				$code = substr($st , 13 , 6);
				if(in_array($code , $cinfo)){
					$num = $num - count($cinfo);
					$cinfo = $this->get_code($num , $cinfo);
				}else{
					$count = $this->db->where('code' , $code)->count_all_results('code');
					if($count > 0){
						$cinfo = $this->get_code($num , $cinfo);
					}else{
						$cinfo[] = $code;	
					}
				}
				
			}
		}
		return $cinfo;
	}
	function getOperate($post){
		$data['ret'] = 400;
		if(!empty($post['id'])){
			$this->db->select('*');
			$this->db->where('status' , '0');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('code');
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
	function deleteOperate($post){
		$data['ret'] = 400;
		if(!empty($post['id'])){
			$this->db->select('id');
			$this->db->where('id' , $post['id']);
			$query = $this->db->get('code');
			if($query->num_rows() > 0){
				$data['ret'] = 200;
				$info = $query->row_array();
				$this->db->where('id' , $info['id'])->update('code' , array('status' => 1));
			}else{
				$data['ret'] = 204;	
			}
		}
		return $data;	
	}
}
