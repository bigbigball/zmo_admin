<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class index extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		
		$this->load->view('index/stat-index');
	}
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */