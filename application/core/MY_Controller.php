<?php
	
class MY_Controller extends CI_Controller {
	
    function __construct()
    {
        parent::__construct();
		if(empty($_SESSION['uid']) || empty($_SESSION['uname'])){
			$this->err();
		}
    }
	
	function err(){
		err_msgs('请登入' , site_url('home/home'));	
	}
	
}