<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {
	
	function __construct()
	{
	   	parent::__construct();
		$this->load->model('order_model','',true);
		$this->load->library('form_validation');
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
        $config['base_url'] = site_url('order/order/show') . '?';
        $config['total_rows'] = $this->order_model->get_count($option);
        $config['per_page'] = $option['limit'];
        $config['cur_page'] = $option['page'];
		
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
		$list = $this->order_model->get_list($option);
		$data['list'] = !empty($list['info']) ? $list['info'] : array();
		$data['page'] = $pagination;
		$this->load->view('order/show' , $data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */