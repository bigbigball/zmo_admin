<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller {
	
	function __construct()
	{
	   	parent::__construct();
		$this->load->model('feedback_model','',true);
	}
    function edit(){
        if(isset($_POST['id']) and $_POST['id'] >0){
            $result = $this->db->where('id' , $_POST['id'])->update('year' ,
                array(
                    'price' => $this->input->post('price'),
                    'title' => $this->input->post('title'),
                )
            );
            if($result){
                echo 1;exit;
            }
            echo 1;exit;
        }else{
            echo 0;exit;
        }
    }
    function editYear(){
        $data = array();
        $this->db->select('*');
        $this->db->where('id',$_GET['id']);
        $query = $this->db->get('year');
        if($query->num_rows() > 0){
            $info = $query->row_array();
            $data['info'] = $info;
        }
        $this->load->view('feedback/edityear' , $data);
    }
    function 	year(){
        $get = $this->input->get();
        $option['limit'] = 50;
        $option['page'] = empty($get['page']) ? 1 : $get['page'];
        $option['status'] = 0 ;
        $this->load->library('pagination');
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['base_url'] = site_url('feedback/feedback/year') . '?';
        $config['total_rows'] = $this->feedback_model->get_year_count($option);
        $config['per_page'] = $option['limit'];
        $config['cur_page'] = $option['page'];

        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        $list = $this->feedback_model->get_year_list($option);
        $data['list'] = !empty($list['info']) ? $list['info'] : array();
        $data['page'] = $pagination;
        $this->load->view('feedback/year' , $data);
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
        $config['base_url'] = site_url('feedback/feedback/show') . '?';
        $config['total_rows'] = $this->feedback_model->get_count($option);
        $config['per_page'] = $option['limit'];
        $config['cur_page'] = $option['page'];
		
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
		$list = $this->feedback_model->get_list($option);
		$data['list'] = !empty($list['info']) ? $list['info'] : array();
		$data['page'] = $pagination;
		$this->load->view('feedback/show' , $data);	
	}
	
	public function deleteFeedback(){
		$post = $this->input->get();
		if(empty($post)){
			show_error('您没有传递要删除内容的编号');	
		}
		$info = $this->feedback_model->getFeedback($post);
		if($info['ret'] != 200){
			show_error('您要删除的数据已不存在');
		}
		if($info['info']['status'] != 0){
			show_error('您要删除的数据状态已是非删除状态,查阅后重新操作');	
		}
		$info = $this->feedback_model->deleteFeedback($post);
		switch($info['ret']){
			case 400 :
				show_error('您没有传递要删除内容的编号');	
				break;
			case 204 :
				show_error('您要删除的数据已不存在');	
				break;
			case 200 :
				redirect('feedback/feedback/show');
				break;	
		}	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */