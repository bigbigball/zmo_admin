<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model' , '' , true);
	}
	
	public function show(){
		$get = $this->input->get();
		$option['limit'] = 5;
        $option['page'] = empty($get['page']) ? 1 : $get['page'];
		$option['status'] = 0 ;
        $this->load->library('pagination');
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE; 
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
        $config['base_url'] = site_url('admin/admin/show') . '?';
        $config['total_rows'] = $this->admin_model->get_count($option);
        $config['per_page'] = $option['limit'];
        $config['cur_page'] = $option['page'];
		
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
		$list = $this->admin_model->get_list($option);
		$data['list'] = !empty($list['info']) ? $list['info'] : array();
		$data['page'] = $pagination;
		$power = $this->admin_model->get_power();
		$data['power'] = $power;
		$this->load->view('admin/show' , $data);	
	}

	function doAddAdmin(){
		$post = $this->input->post();
		$data = array();
		$upload_data = array();
		$dir = get_upload_file_dir();
		$base_dir = get_base_dir();
		if(!empty($_FILES['file']) && $_FILES['file']['error'] == 0){
			$config['upload_path'] 		= $dir;
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['overwrite']		= FALSE;
			$config['max_size']			= 0 ;
			$config['max_width']		= 0 ;
			$config['max_height']		= 0 ;
			$config['max_filename']		= 0 ;
			$config['encrypt_name']		= true;
			$config['remove_spaces'] 	= true;
			$this->load->library('upload' , $config);
			if ( ! $this->upload->do_upload('file')){
				show_error($this->upload->display_errors());
			} 
			else{
				$upload_data = $this->upload->data('file');
			}
		}
		if(!empty($upload_data)){
			$post['path'] = str_replace($base_dir , '' , $dir) . $upload_data['file_name'];	
			$this->load->library("image_lib");
			$config_thumb['image_library'] = 'gd2';
			$config_thumb['quality'] = 100;
			$config_thumb['source_image'] = $upload_data['full_path'];
			$config_thumb['new_image'] = $upload_data['file_name'] ;
			$config_thumb['create_thumb'] = true;
			$config_thumb['width']	= 72;  
			$config_thumb['height'] = 72;  
			$config_thumb['thumb_marker']="_72_72";
			$this->image_lib->initialize($config_thumb); 
            if(!$this->image_lib->resize()){
				show_error($this->image_lib->display_errors());	
			}
			$data['img'] = str_replace($base_dir , '' , $dir) . $upload_data['raw_name'] . '_72_72' . $upload_data['file_ext'] ;
		}
		$data['uname'] = $post['title'];
		$data['power_group'] = implode(',' , $post['power']);
		$data['ctime'] = time();
		$data['status'] = 0;
		$data['passwd'] = md5($post['password']);
		$ret = $this->admin_model->add_admin($data);
		redirect('admin/admin/show');
	}
	function deleteAdmin(){
		$get = $this->input->get();
		if(!empty($get['id'])){
			$get_info = $this->admin_model->getinfo(array('admin_id' => $get['id']));
			if($get_info['ret'] == 200){
				$this->admin_model->deleteAdmin($get['id']);
			}
		}
		redirect('admin/admin/show');
	}
	public function power(){
		$get = $this->input->get();
		$option['limit'] = 5;
        $option['page'] = empty($get['page']) ? 1 : $get['page'];
		$option['status'] = 0 ;
        $this->load->library('pagination');
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE; 
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
        $config['base_url'] = site_url('admin/admin/power') . '?';
        $config['total_rows'] = $this->admin_model->get_power_count($option);
        $config['per_page'] = $option['limit'];
        $config['cur_page'] = $option['page'];
		
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
		$list = $this->admin_model->get_power_info($option);
		$data['list'] = !empty($list) ? $list : array();
		$data['page'] = $pagination;
		$action = $this->admin_model->get_action_info();
		$data['action'] = $action;
		$this->load->view('admin/power' , $data);
	}
	public function doAddPower(){
		$post = $this->input->post();
		$data['zh_name'] = $post['zh_name'];
		$data['action'] = '';
		if(!empty($post['power']) && count($post['power']) > 0){
			$post['power'][] = 5;
			$data['action'] = implode($post['power'],',');
		}
		$this->admin_model->add_power($data);
		redirect('admin/admin/power');
	}

	public function deletePower(){
		$get = $this->input->get();
		if(!empty($get) && isset($get['id'])){
			$this->admin_model->delete_power($get);
		}
		redirect('admin/admin/power');
	}
}
/* End of file mileage.php */
/* Location: ./application/controllers/mileage.php */