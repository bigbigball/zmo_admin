<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {
	
	function __construct()
	{
	   	parent::__construct();
		$this->load->model('video_model','',true);
		$this->load->library('form_validation');
		require_once APPPATH.'third_party/Video/class/charset.php';
		require_once APPPATH.'third_party/Video/class/xml2array.php';
		require_once APPPATH.'third_party/Video/class/spark_function.php';
	}
	
	function index(){
		$uinfo = $this->video_model->get_user_info();
		$data['uinfo'] = $uinfo;
		$this->load->view('video/index' , $data);
	}
	function send(){
		$this->load->view('video/send');
	}
	function getUploadUri(){
		$get = $this->input->get();
		$info = array();
		$info['title'] = trim($get['title']);
		$info['tag'] = trim($get['tag']);
		$info['description'] = trim($get['description']);
		$config = $this->config->item('ccvoide');
		$api = $config['api']['user_info'];
		$info['userid'] = $config['uid'];
		$time = time();
		$info['title'] = spark_function::convert($info['title'], $config['charset'], 'Utf-8');
		$info['tag'] = spark_function::convert($info['tag'], $config['charset'], 'Utf-8');
		$info['description'] = spark_function::convert($info['description'], $config['charset'], 'Utf-8');
		$request_url = spark_function::get_hashed_query_string($info, $time, $config['key']);
		exit($request_url);
	}
    function videoOrder(){
        $id = $this->input->post('id');
        $order = $this->input->post('order');
        $order_result = $this->video_model->update_video_order($id,$order);
        if($order_result){
            echo $order_result;
        }else{
            echo 0;
        }
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
        $config['base_url'] = site_url('video/video/show') . '?';
        $config['total_rows'] = $this->video_model->get_count($option);
        $config['per_page'] = $option['limit'];
        $config['cur_page'] = $option['page'];
		
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();

		$data['video'] = $this->video_model->get_list($option);
		$data['page'] = $pagination;
		$this->load->view('video/show' , $data);
	}
	
	function updateVideo(){
		$get = $this->input->get();
		$id =$get['id'];
		if (empty ( $id )) {
			ss ( '参数错误' );
		}
		$post = array('id' => $id);
		
		$ret = $this->video_model->update_local($post);
		$info['ret'] = $ret;
		if (! empty ( $info )) {
			$this->load->view ( 'video/update', $info);
		} else {
			ss ( '您要访问的资讯不存在' );
		}
	}
	function editVideo(){
		$get = $this->input->get();
		$id =$get['id'];
		if (empty ( $id )) {
			ss ( '参数错误' );
		}
		$post = array('id' => $id);
		$info = $this->video_model->getVideo ($post);
		$info['type'] = array('1' => '人物' ,'2' => '热点' ,'3' => '行业' );
		if (! empty ( $info )) {
			$this->load->view ( 'video/edit', $info);
		} else {
			ss ( '您要访问的资讯不存在' );
		}
	}
	function doEditVideo(){
		$post = $this->input->post();
		$data = array();
		$data['title'] = $post['title'];
		$data['tag'] = $post['tag'];
		$data['content'] = $post['content'];
		$data['utime'] = time();
		$res = $this->video_model->editVideo($data, array('id' => $post['id']));
		redirect('video/video/show');
	}
	
	function toLocal(){
		$this->video_model->tolocal();
		echo json_encode(array('ret' => 200));exit;
	}
	function doSuccess(){
		$info = $this->video_model->tolocal();
		echo json_encode(array('ret' => 200));exit;
	}
	function deleteVideo(){
		$post = $this->input->get();
		if(empty($post)){
			show_error('您没有传递要删除内容的编号');	
		}
		$info = $this->video_model->getVideo($post);
		if($info['ret'] != 200){
			show_error('您要删除的数据已不存在');
		}
		if($info['info']['status'] != 0){
			show_error('您要删除的数据状态已是非删除状态,查阅后重新操作');	
		}
		$info = $this->video_model->deleteVideo($post);
		switch($info['ret']){
			case 400 :
				show_error('您没有传递要删除内容的编号');	
				break;
			case 204 :
				show_error('您要删除的数据已不存在');	
				break;
			case 200 :
				redirect('video/video/show');
				break;	
		}		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
