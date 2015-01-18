<?php
class Auth  
{  
    private $url_model;//所访问的模块，如：music  
    private $url_method;//所访问的方法，如：create  
    private $url_param;//url所带参数 可能是 1 也可能是 id=1&name=test  
    private $CI;  
   
    function __construct()  
    {  
        $this->CI = & get_instance();
        $url = $_SERVER['PHP_SELF'];  
        $arr = explode('/', $url);  
        $arr = array_slice($arr, array_search('index.php', $arr) + 1, count($arr));  
        $this->url_model = isset($arr[0]) ? $arr[0] : '';  
        $this->url_method = isset($arr[1]) ? $arr[1] : 'index';  
        $this->url_param = isset($arr[2]) ? $arr[2] : '';  
    }  
   
    function auth()  
    {  
		$RTR =& load_class('Router');
        $class  = $RTR->fetch_class();
        $method = $RTR->fetch_method();
		
		if(($class == 'user' && $method == 'index') || ($class == 'user' && $method == 'doLogin') || ($class == 'user' && $method == 'login') || $class == 'test' || $method == 'preview' || substr($class,0,10) == 'interface_' || substr($method,0,5) == 'ajax_' || substr($class,0,8) == 'outside_'){
			
        }else{
        	//登录认证
        	if( !$this->CI->session->userdata('user') )  redirect('user/user/login');
        }
    }  
}
