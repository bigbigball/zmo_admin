<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('home_model' , '' , true);
	}
	
	/*
	*用户登录
	*/
	public function carousel(){
		$get = $this->input->get();
		$option['limit'] = 10;
        $option['page'] = empty($get['page']) ? 1 : $get['page'];
        $this->load->library('pagination');
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE; 
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
        $config['base_url'] = site_url('home/home/carousel') . '?';
        $config['total_rows'] = $this->home_model->get_carousel_count($option);
        $config['per_page'] = $option['limit'];
        $config['cur_page'] = $option['page'];
		
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
		$list = $this->home_model->get_carousel($option);
		$data['list'] = !empty($list['info']) ? $list['info'] : array();
		$data['page'] = $pagination;
		$this->load->view('home/carousel' , $data);	
	}
	
	public function addCarousel(){
		$this->load->view('home/add-carousel');
	}
	
	public function doAddCarousel(){
		$post = $this->input->post();
//		$upload_data = array();
		$dir = get_upload_file_dir();
		$base_dir = get_base_dir();
//		if(!empty($_FILES['file'])){
//			$config['upload_path'] 		= $dir;
//			$config['allowed_types'] 	= 'gif|jpg|png';
//			$config['overwrite']		= FALSE;
//			$config['max_size']			= 0 ;
//			$config['max_width']		= 0 ;
//			$config['max_height']		= 0 ;
//			$config['max_filename']		= 0 ;
//			$config['encrypt_name']		= true;
//			$config['remove_spaces'] 	= true;
//			$this->load->library('upload' , $config);
//			if ( ! $this->upload->do_upload('file')){
//				show_error($this->upload->display_errors());
//			} 
//			else{
//				$upload_data = $this->upload->data('file');
//			}
//		}
		
//		if(!empty($upload_data)){
//			$post['path'] = str_replace($base_dir , '' , $dir) . $upload_data['file_name'];	
//		}
		if(!empty($post['file_path'])){
			$file_path= $post['file_path'];
			$path = explode('/', $file_path);
			$file_name = $path[count($path)-1];
			$name_ext = explode('.', $file_name);
			$raw_name = $name_ext[0];
			$file_ext = '.' . $name_ext[1];
		}
		$post['path'] = str_replace($base_dir , '' , $dir) . $raw_name . $file_ext ;
		$info = $this->home_model->addCarousel($post);
		redirect('home/home/carousel');
	}
	
	public function editCarousel(){
		$post = $this->input->get();
		if(!empty($post['id'])){
			$info = $this->home_model->getCarousel($post);
			switch($info['ret']){
				case 400 :
					show_error('参数错误');	
					break;
				case 204 :
					show_error('您要修改的数据已不存在');	
					break;
				case 200 :
					$data['info'] = $info['info'];
					$this->load->view('home/edit-carousel' , $data);
					break;	
			}
		}else{
			show_error('参数错误');	
		}
	}
	
	public function doEditCarousel(){
		$post = $this->input->post();
		if(empty($post['id'])){
			show_error('参数错误，没有要修改内容的编号');	
		}
		$info = $this->home_model->getCarousel($post);
		if($info['ret'] != 200){
			show_error('您要修改的数据已不存在');
		}
		$dir = get_upload_file_dir();
		$base_dir = get_base_dir();
//		$upload_data = array();
//		if(!empty($_FILES['file']) && $_FILES['file']['error'] == 0){
//			$config['upload_path'] 		= $dir;
//			$config['allowed_types'] 	= 'gif|jpg|png';
//			$config['overwrite']		= FALSE;
//			$config['max_size']			= 0 ;
//			$config['max_width']		= 0 ;
//			$config['max_height']		= 0 ;
//			$config['max_filename']		= 0 ;
//			$config['encrypt_name']		= true;
//			$config['remove_spaces'] 	= true;
//			$this->load->library('upload' , $config);
//			if ( ! $this->upload->do_upload('file')){
//				show_error($this->upload->display_errors());
//			} 
//			else{
//				$upload_data = $this->upload->data('file');
//			}
//		}
//		if(!empty($upload_data)){
//			$post['path'] = str_replace($base_dir , '' , $dir) . $upload_data['file_name'];	
//		}
		if(!empty($post['file_path'])){
			$file_path= $post['file_path'];
			$path = explode('/', $file_path);
			$file_name = $path[count($path)-1];
			$name_ext = explode('.', $file_name);
			$raw_name = $name_ext[0];
			$file_ext = '.' . $name_ext[1];
		}
		$post['path'] = str_replace($base_dir , '' , $dir) . $raw_name . $file_ext ;
		$info = $this->home_model->editCarousel($post);
		redirect('home/home/carousel');	
	}
	public function deleteCarousel(){
		$post = $this->input->get();
		if(empty($post)){
			show_error('您没有传递要删除内容的编号');	
		}
		$info = $this->home_model->getCarousel($post);
		if($info['ret'] != 200){
			show_error('您要删除的数据已不存在');
		}
		if($info['info']['status'] != 0){
			show_error('您要删除的数据状态已是非删除状态,查阅后重新操作');	
		}
		$info = $this->home_model->deleteCarousel($post);
		switch($info['ret']){
			case 400 :
				show_error('您没有传递要删除内容的编号');	
				break;
			case 204 :
				show_error('您要删除的数据已不存在');	
				break;
			case 200 :
				redirect('home/home/carousel');
				break;	
		}
	}
}
/* End of file mileage.php */
/* Location: ./application/controllers/mileage.php */