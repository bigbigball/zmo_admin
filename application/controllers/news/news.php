<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class news extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('news_model' , '' , true);
	}
	
	/*
	*用户登录
	*/
	function addNews(){
		$data['type'] = array('1' => '人物' ,'2' => '热点' ,'3' => '行业' );
		$this->load->view('news/add-news' , $data);	
	}
	function show(){
		$get = $this->input->get();
		$option['limit'] = 5;
        $option['page'] = empty($get['page']) ? 1 : $get['page'];
		$option['status'] = 0 ;
        $this->load->library('pagination');
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE; 
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
        $config['base_url'] = site_url('news/news/show') . '?';
        $config['total_rows'] = $this->news_model->get_count($option);
        $config['per_page'] = $option['limit'];
        $config['cur_page'] = $option['page'];
		
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
		$list = $this->news_model->get_list($option);
		$data['list'] = !empty($list['info']) ? $list['info'] : array();
		$data['page'] = $pagination;
		$data['type'] = array('1' => '人物' ,'2' => '热点' ,'3' => '行业' );
		$this->load->view('news/show' , $data);		
	}
	function doAddNews(){
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
			$data['type'] = $post['type'];
			$data['author'] = $post['author'];
			$data['desc'] = $post['desc'];
			$data['content'] = $post['web_description'];
			$data['ctime'] = time();
			$data['utime'] = time();
			$res = $this->news_model->addNews($data);
			redirect('news/news/show');
		}else{
			$data['type'] = array('1' => '人物' ,'2' => '热点' ,'3' => '行业' );
			$this->addNews();	
		}	
	}
	
	function edit(){
		$get = $this->input->get();
		$id =$get['id'];
		if (empty ( $id )) {
			ss ( '参数错误' );
		}
		$post = array('id' => $id);
		$info = $this->news_model->getNews ($post);
		$info['type'] = array('1' => '人物' ,'2' => '热点' ,'3' => '行业' );
		
		if (! empty ( $info )) {
			$this->load->view ( 'news/edit', $info);
		} else {
			ss ( '您要访问的资讯不存在' );
		}
	}
	
	function doEdit(){
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
			$data['type'] = $post['type'];
			$data['author'] = $post['author'];
			$data['desc'] = $post['desc'];
			$data['content'] = $post['web_description'];
			$data['utime'] = time();
			$res = $this->news_model->editNews($data, array('id' => $post['id']));
		}
		redirect('news/news/show');
	}
	
	function deleteNews(){
		$post = $this->input->get();
		if(empty($post)){
			show_error('您没有传递要删除内容的编号');	
		}
		$info = $this->news_model->getNews($post);
		if($info['ret'] != 200){
			show_error('您要删除的数据已不存在');
		}
		if($info['info']['status'] != 0){
			show_error('您要删除的数据状态已是非删除状态,查阅后重新操作');	
		}
		$info = $this->news_model->deleteNews($post);
		switch($info['ret']){
			case 400 :
				show_error('您没有传递要删除内容的编号');	
				break;
			case 204 :
				show_error('您要删除的数据已不存在');	
				break;
			case 200 :
				redirect('news/news/show');
				break;	
		}		
	}
}
/* End of file mileage.php */
/* Location: ./application/controllers/mileage.php */
