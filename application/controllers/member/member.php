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
    function year(){
        $get = $this->input->get();
        $option['limit'] = 15;
        $option['page'] = empty($get['page']) ? 1 : $get['page'];
        $this->load->library('pagination');
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['base_url'] = site_url('member/member/year') . '?';
        $config['total_rows'] = $this->member_model->get_year_count($option);
        $config['per_page'] = $option['limit'];
        $config['cur_page'] = $option['page'];
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        $list = $this->member_model->get_year_list($option);
        $data['list'] = $list ? $list : array();
        $data['page'] = $pagination;
        $this->load->view('member/index', $data);
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
		$payList    = $this->order_model->get_by_user_id($get['id']);
		$data["payInfo"]    = $payList;
        if($payList){
            $order_ids = array();
            foreach($payList as $val){
                $order_ids[] = $val['id'];
            }
		    $this->load->model('order_goods_model','',true);
            $orderGoods = $this->order_goods_model->get_list_by_order_ids($order_ids);
            $payInfo = array();
            foreach($payList as $key=>$item){
                $payList[$key]['goods_title']   = $orderGoods[$item['id']]['goods_title'];
                $payList[$key]['goods_type']    = $orderGoods[$item['id']]['type'] == 2 ? "活动" : "课程";
            }
		    $data["payInfo"]    = $payList;
        }
        $this->load->model('collect_model','',true);
        $favourite = $this->collect_model->get_list_by_uid($option['id']);
        $favourList = array();
        if($favourite){
            $lesson = array();
            $activity = array();
            $teacher = array();
            foreach($favourite as $item){
                if($item['type'] == 2){
                    $lesson[] = $item['relation_id'];
                }elseif($item['type'] == 3){
                    $activity[] = $item['relation_id'];
                }elseif($item['type'] == 4){
                    $teacher[] = $item['relation_id'];
                }
            }
            if($lesson){
                $this->load->model('lesson_model','',true);
                $lessonResult = $this->lesson_model->get_list_by_ids($lesson);
                $favourList[2] = $lessonResult;
            }
            if($activity){
                $this->load->model('active_model','',true);
                $activityResult = $this->active_model->get_list_by_ids($activity);
                $favourList[3] = $activityResult;
            }
            if($teacher){
                $this->load->model('teacher_model','',true);
                $teacherResult = $this->teacher_model->get_list_by_ids($teacher);
                $favourList[4] = $teacherResult;
            }
        }
       // echo "<pre>";print_r($favourList);die;
		$data["isfee"]      = $get['isfee'];
		$data["favourList"] = $favourList;
		$this->load->view('member/detail', $data);	
    }

    //付费会员
    function rechargeable(){
		$get = $this->input->get();
		$option['limit'] = 15;
        $option['page'] = empty($get['page']) ? 1 : $get['page'];
        $this->load->library('pagination');
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE; 
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
        $config['base_url'] = site_url('member/member/rechargeable') . '?';
		$this->load->model('order_model','',true);
        //获取发生过付费的用户总数
        $config['total_rows'] = $this->order_model->get_count_different_uids();
        $config['per_page'] = $option['limit'];
        $config['cur_page'] = $option['page'];
		
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        //分页获取发生过付费的用户id组成的数组
		$ids = $this->order_model->get_uids($option);

        $list = $this->member_model->get_list_by_ids($ids);
        // echo "<pre>";print_r($list);die;

        $data = array();
		$data['list'] = $list ? $list : array();
		$data['page'] = $pagination;
		$this->load->view('member/rechargeable', $data);	
    }
}

/* End of file member.php */
/* Location: ./application/controllers/member/member.php */
