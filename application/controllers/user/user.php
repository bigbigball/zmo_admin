<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class user extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('user_model' , '' , true);
	}
	
	/*
	*用户登录
	*/
	public function login(){
		$this->load->view('user/login');	
	}
	
	public function doLogin(){
		$post = $this->input->post();
		if(!empty($post['uname']) && !empty($post['upwd'])){
			$info = $this->user_model->login($post);
			if($info['ret'] == 200){
				$_SESSION['uid'] = $info['id'];
				redirect('index/index');
			}else{
				$data['msg'] = '帐号密码错误';
				$this->load->view('user/login' , $data);	
			}
		}else{
			$data['msg'] = '没有输入用户名或者密码';
			$this->load->view('user/login' , $data);
		}
	}
	
	public function updatePassword(){
		$uinfo = $this->user_model->get_userdata();
		if($uinfo['ret'] == 200){
			$data['user'] = $uinfo['user'];	
		}
		$this->load->view('user/uppwd' , $data);
	}
	
	public function doUpdatePassword(){
		$post = $this->input->post();
		$data['ret'] = '400';
		if(empty($post['npwd']) && !empty($post['npwd2'])){
			if($post['npwd'] === $post['npwd2']){
				$info = $this->user_model->update_password($post);
				$data['ret'] = $info['ret'] ;
				if($info['ret'] == 200){
					$data['msg'] = '修改成功';	
				}else if($info['ret'] == 204){
					$data['msg'] = '原密码输入有误';	
				}else if($info['ret'] == 205){
					$data['msg'] = '新密码和重复密码输入有误';	
				}
			}else{
				$data['ret'] = 205 ;
				$data['msg'] = '新密码和重复密码不一致';	
			}
		}else{
			$data['msg'] = '输入的内容有误';
		}
		$info = $this->user_model->get_user_info();
		if($info['ret'] == 200){
			$data['info'] = $info['info'];
		}
		$this->load->view('admin/info' , $data);
	}
	public function loginout(){
		$this->session->unset_userdata('user');
		redirect('user/user/login');
	}
	public function info(){
		$this->load->model('admin_model' , '' , true);
		$user = $this->session->userdata('user');
		if(empty($user['uid'])){ exit('您的操作有误。');}
		$post['admin_id'] = $user['uid'];
		$info = $this->admin_model->getinfo($post);
		if($info['ret'] == 200){
			$data['info'] = $info['info'];	
		}
		$this->load->view('user/info' , $data);	
	}
}
/* End of file mileage.php */
/* Location: ./application/controllers/mileage.php */