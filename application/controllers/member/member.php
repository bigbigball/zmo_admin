<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* =============================================================================
#     FileName: member.php
#         Desc: 会员管理 
#       Author: zhangliang
#       Encode: UTF-8
#   CreateTime: 2015-03-06 14:06:36
#   LastChange: 2015-03-06 14:06:36
============================================================================= */

class member extends CI_Controller {
	
	function __construct()
	{
	   	parent::__construct();
		$this->load->model('member_model','',true);
		$this->load->library('form_validation');
	}
	
    //会员列表页面（包括普通会员和付费会员）
	function index(){
		$get = $this->input->get();
		$option['limit'] = 15;
        $option['page'] = empty($get['page']) ? 1 : $get['page'];
        $this->load->library('pagination');
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE; 
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
        $config['base_url'] = site_url('member/member/index') . '?';
        $config['total_rows'] = $this->member_model->get_count($option);
        $config['per_page'] = $option['limit'];
        $config['cur_page'] = $option['page'];
		
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
		$list = $this->member_model->get_list($option);
		$data['list'] = $list ? $list : array();
		$data['page'] = $pagination;
		$this->load->view('member/index', $data);	
	}

    //根据用户id获取用户的详细信息
    function detail(){
		$this->load->model('order_model','',true);
		$get = $this->input->get();
		$option['id']   = $get['id'];
        $data = array();
		$data["detail"]     = $this->member_model->get_detail_by_id($option);
		$data["payInfo"]    = $this->order_model->get_by_user_id($get['id']);
		$this->load->view('member/detail', $data);	
    }

    function normal(){
		$this->load->view('member/normal');	
    }

    function rechargeable(){
		$this->load->view('member/rechargeable');	
    }
}

/* End of file member.php */
/* Location: ./application/controllers/member/member.php */
