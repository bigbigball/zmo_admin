<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class teacher extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('teacher_model' , '' , true);
	}
	

	public function show(){
		$get = $this->input->get();
		$option['limit'] = 5;
        $option['page'] = empty($get['page']) ? 1 : $get['page'];
        $this->load->library('pagination');
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE; 
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
        $config['base_url'] = site_url('teacher/teacher/show') . '?';
        $config['total_rows'] = $this->teacher_model->get_count($option);
        $config['per_page'] = $option['limit'];
        $config['cur_page'] = $option['page'];
		
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
		$list = $this->teacher_model->get_list($option);
		$data['list'] = !empty($list['info']) ? $list['info'] : array();
		$data['page'] = $pagination;
		$this->load->view('teacher/show' , $data);	
	}
	
	public function addTeacher(){
		$this->load->view('teacher/add-teacher');
	}
	
	public function doAddTeacher(){
		$post = $this->input->post();
		$upload_data = array();
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
		if(!empty($post)){
			$file_path= $post['file_path'];
			$path = explode('/', $file_path);
			$file_name = $path[count($path)-1];
			$name_ext = explode('.', $file_name);
			$raw_name = $name_ext[0];
			$file_ext = '.' . $name_ext[1];
			//$post['path'] = str_replace($base_dir , '' , $dir) . $upload_data['file_name'];	
			$this->load->library("image_lib");
			$config_thumb['image_library'] = 'gd2';
			$config_thumb['quality'] = 100;
			$config_thumb['source_image'] = $file_path;
			$config_thumb['new_image'] = $file_name;
			$config_thumb['create_thumb'] = true;
			$config_thumb['width']	= 250;  
			$config_thumb['height'] = 285;  
			$config_thumb['thumb_marker']="_250_285";
			$this->image_lib->initialize($config_thumb); 
            if(!$this->image_lib->resize()){
				show_error($this->image_lib->display_errors());	
			}
			$post['path'] = str_replace($base_dir , '' , $dir) . $raw_name . $file_ext ;
			$post['thumb'] = str_replace($base_dir , '' , $dir) . $raw_name . '_250_285' . $file_ext;
		}
		
//		if(!empty($upload_data)){
//			$post['path'] = str_replace($base_dir , '' , $dir) . $upload_data['file_name'];	
//			$this->load->library("image_lib");
//			$config_thumb['image_library'] = 'gd2';
//			$config_thumb['quality'] = 100;
//			$config_thumb['source_image'] = $upload_data['full_path'];
//			$config_thumb['new_image'] = $upload_data['file_name'] ;
//			$config_thumb['create_thumb'] = true;
//			$config_thumb['width']	= 250;  
//			$config_thumb['height'] = 285;  
//			$config_thumb['thumb_marker']="_250_285";
//			$this->image_lib->initialize($config_thumb); 
//            if(!$this->image_lib->resize()){
//				show_error($this->image_lib->display_errors());	
//			}
//			$post['thumb'] = str_replace($base_dir , '' , $dir) . $upload_data['raw_name'] . '_250_285' . $upload_data['file_ext'] ;
//		}
		$info = $this->teacher_model->addTeacher($post);
		redirect('teacher/teacher/show');
	}
	
	public function editTeacher(){
		$post = $this->input->get();
		if(!empty($post['id'])){
			$info = $this->teacher_model->getTeacher($post);
			if(empty($info) || empty($info['ret'])){
				show_error('[导师]数据错误');	
			}
			switch($info['ret']){
				case 400 :
					show_error('参数错误');	
					break;
				case 204 :
					show_error('您要修改的数据已不存在');	
					break;
				case 200 :
					$data['info'] = $info['info'];
					$this->load->view('teacher/edit-teacher' , $data);
					break;	
			}
		}else{
			show_error('参数错误');	
		}
	}
	
	public function doEditTeacher(){
		$post = $this->input->post();
		if(empty($post['id'])){
			show_error('参数错误，没有要修改内容的编号');	
		}
		$info = $this->teacher_model->getTeacher($post);
		if($info['ret'] != 200){
			show_error('您要修改的数据已不存在');
		}
		$upload_data = array();
		$dir = get_upload_file_dir();
		$base_dir = get_base_dir();
//		if(!empty($_FILES['file']) && $_FILES['file']['error'] == 0){
//			$config['upload_path'] 		= $dir;
//			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
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

		if(!empty($post)){
			$file_path= $post['file_path'];
			$path = explode('/', $file_path);
			$file_name = $path[count($path)-1];
			$name_ext = explode('.', $file_name);
			$raw_name = $name_ext[0];
			$file_ext = '.' . $name_ext[1];
			//$post['path'] = str_replace($base_dir , '' , $dir) . $upload_data['file_name'];	
			$this->load->library("image_lib");
			$config_thumb['image_library'] = 'gd2';
			$config_thumb['quality'] = 100;
			$config_thumb['source_image'] = $file_path;
			$config_thumb['new_image'] = $file_name;
			$config_thumb['create_thumb'] = true;
			$config_thumb['width']	= 250;  
			$config_thumb['height'] = 285;  
			$config_thumb['thumb_marker']="_250_285";
			$this->image_lib->initialize($config_thumb); 
            if(!$this->image_lib->resize()){
				show_error($this->image_lib->display_errors());	
			}
			$post['path'] = str_replace($base_dir , '' , $dir) . $raw_name . $file_ext ;
			$post['thumb'] = str_replace($base_dir , '' , $dir) . $raw_name . '_250_285' . $file_ext;
		}
//		if(!empty($upload_data)){
//			$post['path'] = str_replace($base_dir , '' , $dir) . $upload_data['file_name'];	
//			$this->load->library("image_lib");
//			$config_thumb['image_library'] = 'gd2';
//			$config_thumb['quality'] = 100;
//			$config_thumb['source_image'] = $upload_data['full_path'];
//			$config_thumb['new_image'] = $upload_data['file_name'] ;
//			$config_thumb['create_thumb'] = true;
//			$config_thumb['width']	= 250;  
//			$config_thumb['height'] = 285;  
//			$config_thumb['thumb_marker']="_250_285";
//			$this->image_lib->initialize($config_thumb); 
//            if(!$this->image_lib->resize()){
//				show_error($this->image_lib->display_errors());	
//			}
//			$post['thumb'] = str_replace($base_dir , '' , $dir) . $upload_data['raw_name'] . '_250_285' . $upload_data['file_ext'] ;
//		}
		$info = $this->teacher_model->editTeacher($post);
		redirect('teacher/teacher/show');	
	}
	public function deleteTeacher(){
		$post = $this->input->get();
		if(empty($post)){
			show_error('您没有传递要删除内容的编号');	
		}
		$info = $this->teacher_model->getTeacher($post);
		if($info['ret'] != 200){
			show_error('您要删除的数据已不存在');
		}
		if($info['info']['status'] != 0){
			show_error('您要删除的数据状态已是非删除状态,查阅后重新操作');	
		}
		$info = $this->teacher_model->deleteTeacher($post);
		switch($info['ret']){
			case 400 :
				show_error('您没有传递要删除内容的编号');	
				break;
			case 204 :
				show_error('您要删除的数据已不存在');	
				break;
			case 200 :
				redirect('teacher/teacher/show');
				break;	
		}
	}
	public function home(){
		$get = $this->input->get();
		$option['limit'] = 5;
		$option['top'] = 1;
        $option['page'] = empty($get['page']) ? 1 : $get['page'];
        $this->load->library('pagination');
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE; 
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
        $config['base_url'] = site_url('teacher/teacher/show') . '?';
        $config['total_rows'] = $this->teacher_model->get_count($option);
        $config['per_page'] = $option['limit'];
        $config['cur_page'] = $option['page'];
		
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
		$list = $this->teacher_model->get_list($option);
		$data['list'] = !empty($list['info']) ? $list['info'] : array();
		$data['page'] = $pagination;
		$this->load->view('teacher/home' , $data);	
	}
	
	public function addHome(){
		$info = $this->teacher_model->get_all_teacher();
		$data['info'] = array();
		if(!empty($info)){
			$data['info'] = $info;	
		}else{
			show_error('没有导师数据，请去添加导师数据');	
		}
		$this->load->view('teacher/add-home' , $data);	
	}
	
	public function doAddHomeTeacher(){
		$post = $this->input->post();
		if(empty($post)){
			show_error('您没有提交任何数据');	
		}
		$upload_data = array();
		$dir = get_upload_file_dir();
		$base_dir = get_base_dir();
		if(!empty($_FILES['file']) && $_FILES['file']['error'] == 0){
			$config['upload_path'] 		= $dir;
			$config['allowed_types'] 	= 'gif|jpg|png';
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
		}else{
			show_errow('因为首页展示和其他地方所需图片不一样，请上传图片');	
		}
		if(!empty($upload_data)){
			$post['home_img'] =str_replace($base_dir , '' , $dir) . $upload_data['file_name'];	
		}
		$info = $this->teacher_model->addHomeTeacher($post);
		redirect('teacher/teacher/home');
	}
	
	function deleteHomeTeacher(){
		$post = $this->input->get();
		if(empty($post)){
			show_error('您没有传递要删除内容的编号');	
		}
		$info = $this->teacher_model->getTeacher($post);
		if($info['ret'] != 200){
			show_error('您要删除的数据已不存在');
		}
		if($info['info']['top'] != 1){
			show_error('您要删除的数据状态已不是首页热门导师');	
		}
		$post['top'] = 0 ;
		$info = $this->teacher_model->editTeacher($post);
		redirect('teacher/teacher/home');	
	}
	
	function editHomeTeacher(){
		$post = $this->input->get();
		if(!empty($post['id'])){
			$info = $this->teacher_model->get_all_teacher();
			$data['info'] = array();
			if(!empty($info)){
				$data['info'] = $info;	
			}else{
				show_error('没有导师数据，请去添加导师数据');	
			}
			$cinfo = $this->teacher_model->getTeacher($post);
			if(empty($cinfo) || empty($cinfo['ret'])){
				show_error('[导师]数据错误');	
			}
			switch($cinfo['ret']){
				case 400 :
					show_error('参数错误');	
					break;
				case 204 :
					show_error('您要修改的数据已不存在');	
					break;
				case 200 :
					if($cinfo['info']['top'] != 1){
						show_error('你要修改的该数据，不是首页导师数据');	
					}
					$data['cinfo'] = $cinfo['info'];
					$this->load->view('teacher/edit-home' , $data);	
					break;	
			}
		}else{
			show_error('参数错误');	
		}
	}
}
/* End of file mileage.php */
/* Location: ./application/controllers/mileage.php */