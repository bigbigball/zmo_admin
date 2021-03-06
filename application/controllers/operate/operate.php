<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Operate extends CI_Controller {
	
	function __construct()
	{
	   	parent::__construct();
		$this->load->model('operate_model','',true);
		$this->load->library('form_validation');
	}
	
	function show(){
		$get = $this->input->get();
		$option['limit'] = 50;
        $option['page'] = empty($get['page']) ? 1 : $get['page'];
		$option['status'] = 0 ;
        $this->load->library('pagination');
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE; 
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
        $config['base_url'] = site_url('operate/operate/show') . '?';
        $config['total_rows'] = $this->operate_model->get_count($option);
        $config['per_page'] = $option['limit'];
        $config['cur_page'] = $option['page'];
		
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
		$list = $this->operate_model->get_list($option);
		$data['list'] = !empty($list['info']) ? $list['info'] : array();
		$data['page'] = $pagination;
		$this->load->view('operate/show' , $data);	
	}
	function doAddOperate(){
		$post = $this->input->post();
		$this->operate_model->add_operate($post);
		redirect('operate/operate/show');
	}
	public function deleteOperate(){
		$post = $this->input->get();
		if(empty($post)){
			show_error('您没有传递要删除内容的编号');	
		}
		$info = $this->operate_model->getOperate($post);
		if($info['ret'] != 200){
			show_error('您要删除的数据已不存在');
		}
		if($info['info']['status'] != 0){
			show_error('您要删除的数据状态已是非删除状态,查阅后重新操作');	
		}
		$info = $this->operate_model->deleteOperate($post);
		switch($info['ret']){
			case 400 :
				show_error('您没有传递要删除内容的编号');	
				break;
			case 204 :
				show_error('您要删除的数据已不存在');	
				break;
			case 200 :
				redirect('operate/operate/show');
				break;	
		}	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */