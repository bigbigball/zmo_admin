<?php
	
class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function login($post)
	{
		$data['ret'] = '400';
		if(!empty($post['uname']) && !empty($post['upwd'])){
			$this->db->select('id,uname');
			$this->db->where('uname' , $post['uname']);
			$this->db->where('passwd' , md5($post['upwd']));
			$query = $this->db->get('admin');
			if($query->num_rows() > 0){
				$info = $query->row_array();
				$newdata['user'] = array('uid' => $info['id'],'uname' => $info['uname']);
				$this->session->set_userdata($newdata);
				$data['ret'] = 200;
				$data['id'] = $info['id'];
			}else{
				$data['ret'] = '204';	
			}
		}
		return $data;	
	}
	function update_password($post){
		$data['ret'] = 400;
		if(!empty($post['npwd']) && !empty($post['npwd2'])){
			if($post['npwd'] !== $post['npwd2']){
				$data['ret'] = 205;
			}else{
				$uinfo = $this->get_userdata();
				if($uinfo['ret'] == 200){
					$this->db->select('id');
					$this->db->where('id' , $uinfo['user']['uid']);
					$this->db->where('passwd' , md5($post['opwd']));
					$query = $this->db->get('admin');
					if($query->num_rows()>0){
						$info = $query->row_array();
						$udata['passwd'] = md5($post['npwd']);
						$this->db->where('id' , $info['id'])->update('admin' , $udata);
						$data['ret'] = 200;
					}else{
						$data['ret'] = 204 ;	
					}
				}
			}
		}
		return $data;
	}

	function get_user_info(){
		$user = $this->session->userdata('user');
		$data['ret'] = '400';
		$this->db->select('id,uname,power_group,power_action');
		$this->db->where('id' , $user['uid']);
		$query = $this->db->get('admin');
		if($query->num_rows() > 0){
			$info = $query->row_array();
			$data['ret'] = '200';
			$data['info'] = $info;
		}else{
			$data['ret'] = '204';	
		}
		return $data;
	}
	function get_userdata(){
		$data['ret'] = 400 ;
		if($this->session->userdata('user')){
			$data['ret'] = 200;
			$data['user'] = $this->session->userdata('user');	
		}	
		return $data;
	}
}