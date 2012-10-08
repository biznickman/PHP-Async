<?php
function curl_post_async($url, $params, $overridePort=80)
{
    $post_string = http_build_query($params);
    $parts=parse_url($url);

    $fp = fsockopen($parts['host'],
        isset($parts['port'])?$parts['port']:$overridePort,
        $errno, $errstr, 30);
	
	if(!$fp)
	{
		//Perform whatever logging you want to have happen b/c this call failed!	
	}
    $out = "POST ".$parts['path']." HTTP/1.1\r\n";
    $out.= "Host: ".$parts['host']."\r\n";
    $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
    $out.= "Content-Length: ".strlen($post_string)."\r\n";
    $out.= "Connection: Close\r\n\r\n";
    if (isset($post_string)) $out.= $post_string;

    fwrite($fp, $out);
    fclose($fp);
}
?>
