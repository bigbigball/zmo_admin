<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class active extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('active_model' , '' , true);
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
        $config['base_url'] = site_url('active/active/show') . '?';
        $config['total_rows'] = $this->active_model->get_count($option);
        $config['per_page'] = $option['limit'];
        $config['cur_page'] = $option['page'];
		
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
		$list = $this->active_model->get_list($option);
		$data['list'] = !empty($list['info']) ? $list['info'] : array();
		$data['page'] = $pagination;
		$data['type'] = array('1' => 'meeting up' , '2' => 'weeked');
		$this->load->view('active/show' , $data);	
	}
	public function info(){
	
	}
	public function newactive(){
		$data['action'] = 'add-active';
		$data['type'] = array('1' => 'meeting up' , '2' => 'weeked');
		$this->load->view('active/add-active'  , $data);	
	}
	public function doAddActive(){
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
			$config_thumb['width']	= 250;  
			$config_thumb['height'] = 285;  
			$config_thumb['thumb_marker']="_250_285";
			$this->image_lib->initialize($config_thumb); 
            if(!$this->image_lib->resize()){
				show_error($this->image_lib->display_errors());	
			}
			$data['img'] = str_replace($base_dir , '' , $dir) . $upload_data['raw_name'] . '_250_285' . $upload_data['file_ext'] ;
		}
		if(!empty($post)){
			$data['title'] = $post['title'];	
			$data['theme'] = $post['theme'];	
			$data['quota'] = $post['amount'];	
			$data['is_price'] = (!empty($post['is_price'])) ? $post['is_price'] : 0;	
			$data['price'] = $post['price'];	
			$data['content'] = $post['web_description'];
			$data['desc'] = $post['desc'];
			$data['address'] = $post['address'];
			$data['type'] = $post['type'];
			$data['ctime'] = time();
			$data['stime'] = strtotime($post['stime']);
			$data['etime'] = strtotime($post['etime']);
			$res = $this->active_model->addActive($data);
			redirect('active/active/show');
		}else{
			$this->newactive();	
		}
	}
	
	public function deleteActive(){
		$post = $this->input->get();
		if(empty($post)){
			show_error('您没有传递要删除内容的编号');	
		}
		$info = $this->active_model->getActive($post);
		if($info['ret'] != 200){
			show_error('您要删除的数据已不存在');
		}
		if($info['info']['status'] != 0){
			show_error('您要删除的数据状态已是非删除状态,查阅后重新操作');	
		}
		$info = $this->active_model->deleteActive($post);
		switch($info['ret']){
			case 400 :
				show_error('您没有传递要删除内容的编号');	
				break;
			case 204 :
				show_error('您要删除的数据已不存在');	
				break;
			case 200 :
				redirect('active/active/show');
				break;	
		}	
	}
}
/* End of file mileage.php */
/* Location: ./application/controllers/mileage.php */