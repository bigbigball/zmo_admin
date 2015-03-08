<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class lesson extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('lesson_model' , '' , true);
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
        $config['base_url'] = site_url('lesson/lesson/show') . '?';
        $config['total_rows'] = $this->lesson_model->get_count($option);
        $config['per_page'] = $option['limit'];
        $config['cur_page'] = $option['page'];
		
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
		$list = $this->lesson_model->get_list($option);
		$data['list'] = !empty($list['info']) ? $list['info'] : array();
		$data['page'] = $pagination;
		$this->load->model('teacher_model' , '' , true);
		$data['tinfo'] = $this->teacher_model->get_all_teacher();
		$data['type'] = array('1' => '线上课程' , '2' => '线下课程');
		$this->load->view('lesson/show' , $data);	
	}
	
	public function addLesson(){
		$this->load->model('teacher_model' , '' , true);
		$data['tinfo'] = $this->teacher_model->get_all_teacher();
		//ss($data);
		$data['type'] = array('1' => '线上课程' , '2' => '线下课程');
		$this->load->view('lesson/add-lesson' , $data);
	}
	public function doAddLesson(){
		$post = $this->input->post();
		$data = array();
//		$upload_data = array();
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
		if(!empty($post['file_path'])){
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
			$data['img'] = str_replace($base_dir , '' , $dir) . $raw_name . $file_ext ;
			$data['thumb'] = str_replace($base_dir , '' , $dir) . $raw_name . '_250_285' . $file_ext;
		}
		if(!empty($post)){
			$data['sequence'] = $post['sequence'];
			$data['title'] = $post['title'];
			$data['type'] = $post['type'];
			$data['guest_id'] = $post['teacher'];
			$data['tag_info'] = (!empty($post['tag'])) ? trim(str_replace('；' , '|' , str_replace(';' , '|' , $post['tag'])) , '|'):'';
			$data['is_price'] = (!empty($post['is_price'])) ? $post['is_price'] : 0;	
			$data['price'] = $post['price'];
			$data['desc'] = $post['desc'];
			$data['position'] = $post['position'];
			$data['address'] = $post['address'];
			$data['content'] = $post['web_description'];
			date_default_timezone_set("Asia/Shanghai");
			$data['ctime'] = time();
			$data['utime'] = $data['ctime'];
			$data['stime'] = strtotime($post['stime']);
			$data['etime'] = strtotime($post['etime']);
			$res = $this->lesson_model->addLesson($data);
		}
		redirect('lesson/lesson/show');
	}
	
	function editLesson(){
		$post = $this->input->get();
		if(empty($post)){
			show_error('您没有传递要编辑内容的编号');	
		}
		$info = $this->lesson_model->getLesson($post);
		if($info['ret'] != 200){
			show_error('您要编辑的数据已不存在');
		}
		if($info['info']['status'] != 0){
			show_error('您要编辑的数据状态已是非编辑状态,查阅后重新操作');	
		}
		
		$this->load->model('teacher_model' , '' , true);
		$data['tinfo'] = $this->teacher_model->get_all_teacher();
		$data['type'] = array('1' => '线上课程' , '2' => '线下课程');
		$data['info'] = $info;
		$this->load->view('lesson/edit-lesson', $data);
	}
	
	public function doEditLesson(){
		$post = $this->input->post();
		$info = $this->lesson_model->getLesson($post);
		if($info['ret'] != 200){
			show_error('您要修改的数据已不存在');
		}
		
		$data = array();
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
			if(!empty($post['file_path'])){
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
			$data['img'] = str_replace($base_dir , '' , $dir) . $raw_name . $file_ext ;
			$data['thumb'] = str_replace($base_dir , '' , $dir) . $raw_name . '_250_285' . $file_ext;
		}
		if(!empty($post)){
			$data['id'] = $post['id'];
			$data['sequence'] = $post['sequence'];
			$data['title'] = $post['title'];
			$data['type'] = $post['type'];
			$data['guest_id'] = implode(',',$post['teacher']);
			$data['tag_info'] = (!empty($post['tag'])) ? trim(str_replace('；' , '|' , str_replace(';' , '|' , $post['tag'])) , '|'):'';
			$data['is_price'] = (!empty($post['is_price'])) ? $post['is_price'] : 0;	
			$data['price'] = $post['price'];
			$data['desc'] = $post['desc'];
			$data['position'] = $post['position'];
			$data['address'] = $post['address'];
			$data['content'] = $post['web_description'];
			date_default_timezone_set("Asia/Shanghai");
			$data['ctime'] = time();
			$data['utime'] = $data['ctime'];
			$data['stime'] = strtotime($post['stime']);
			$data['etime'] = strtotime($post['etime']);
		}
		$res = $this->lesson_model->updateLesson($data);
		redirect('lesson/lesson/show');
	}
	
	function deleteLesson(){
		$post = $this->input->get();
		if(empty($post)){
			show_error('您没有传递要删除内容的编号');	
		}
		$info = $this->lesson_model->getLesson($post);
		if($info['ret'] != 200){
			show_error('您要删除的数据已不存在');
		}
		if($info['info']['status'] != 0){
			show_error('您要删除的数据状态已是非删除状态,查阅后重新操作');	
		}
		$info = $this->lesson_model->deleteLesson($post);
		switch($info['ret']){
			case 400 :
				show_error('您没有传递要删除内容的编号');	
				break;
			case 204 :
				show_error('您要删除的数据已不存在');	
				break;
			case 200 :
				redirect('lesson/lesson/show');
				break;	
		}		
	}
}
/* End of file mileage.php */
/* Location: ./application/controllers/mileage.php */