<?php
if ( ! function_exists('callHttpCommon'))
{	
	function callHttpCommon($url, $type = 'GET', $useragent = '', $params = null, $header = '', $encoding = '', $referer = '', $cookie = '') {
		$ch = curl_init ();
		$timeout = 5;
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
		if ('' != $useragent) {
			curl_setopt ( $ch, CURLOPT_USERAGENT, $useragent );
		}
		if ('' != $encoding) {
			curl_setopt ( $ch, CURLOPT_ENCODING, $encoding );
		}
		if ('' != $header) {
			curl_setopt ( $ch, CURLOPT_HTTPHEADER, $header );
		}
		if (null != $params) {
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, $params );
		}
		if ('' != $referer) {
			curl_setopt ( $ch, CURLOPT_REFERER, $referer );
		}
		if ('' != $cookie) {
			curl_setopt ( $ch, CURLOPT_COOKIE, $cookie );
		}
		switch ($type) {
			case "GET" :
				curl_setopt ( $ch, CURLOPT_HTTPGET, true );
				break;
			case "POST" :
				curl_setopt ( $ch, CURLOPT_POST, true );
				break;
			case "PUT" :
				curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "PUT" );
				break;
			case "DELETE" :
				curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "DELETE" );
				break;
		}
		$result = curl_exec ( $ch );
		$curl_errno = curl_errno ( $ch );
		$curlinfo = curl_getinfo ( $ch );
		$requestTime = $curlinfo['total_time'] * 1000;
		curl_close ( $ch );
		if ($curl_errno > 0) {
			return false;
		}
		$ret = json_decode ( $result, TRUE );
		return $ret;
	}
}

if ( ! function_exists('callHttpPost'))
{	
	function callHttpPost($url,$params = null)
    {
		$header = array("Content-Type: application/x-www-form-urlencoded;");
		$post_url = '';
		foreach ($params as $key=>$value){
            if(!empty($value)){
                $post_url .= $key.'='.urlencode($value).'&';
            }else{
                $post_url .= $key.'='.$value.'&';
            }
		} 
		$post_url = rtrim($post_url, '&'); 
		$result = callHttpCommon($url,'POST','',$post_url,$header,'gzip');
		$result = json_decode($result,true);
		return $result;
	}
}

if ( ! function_exists('callHttpRequest'))
{
    function callHttpRequest($url,$params = array())
    {
        return callHttpPost($url, $params);
    }
}

if ( ! function_exists('base62'))
{
	function base62($x)
	{
    	$show = ''; 
        while($x > 0) { 
            $s = $x % 62; 
            if ($s > 35) { 
                $s = chr($s+61);
            } elseif ($s > 9 && $s <=35) { 
                $s = chr($s + 55); 
            } 
            $show .= $s; 
            $x = floor($x/62); 
        } 
        return $show;   
	}
}
 
if ( ! function_exists('urlShort'))
{
  function urlShort($url) 
  { 
      $url = crc32($url); 
      $result = sprintf("%u", $url); 
      return base62($result); 
  } 
}

