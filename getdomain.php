<?php

$url = 'http://_cafe.google.com/dhasjkdas/sadsdds/sdda/sdads.html';
$parse = parse_url($url);
//print $parse['host']; // prints 'google.com'



function is_valid_domain($url){

    $validation = FALSE;
    /*Parse URL*/
    $urlparts = parse_url(filter_var($url, FILTER_SANITIZE_URL));
    /*Check host exist else path assign to host*/
    if(!isset($urlparts['host'])){
        $urlparts['host'] = $urlparts['path'];
    }

    if($urlparts['host']!=''){
       /*Add scheme if not found*/
        if (!isset($urlparts['scheme'])){
            $urlparts['scheme'] = 'http';
        }
        /*Validation*/
        if(checkdnsrr($urlparts['host'], 'A') && in_array($urlparts['scheme'],array('http','https')) && ip2long($urlparts['host']) === FALSE){ 
            $urlparts['host'] = preg_replace('/^www\./', '', $urlparts['host']);
            $url = $urlparts['scheme'].'://'.$urlparts['host']. "/";            
            
            if (filter_var($url, FILTER_VALIDATE_URL) !== false && @get_headers($url)) {
                $validation = TRUE;
            }
        }
    }

	if(!$validation){
		echo "Its Invalid Domain Name.";
	}else{
		echo " $url is a Valid Domain Name.";
	}

}

//Function Call
is_valid_domain('http://kinhdoanh.vnexpress.net/');

$domain = str_ireplace('www.', '', parse_url('//banned-adsense-list.com/isbanned', PHP_URL_HOST));

echo "<br><br>";
if(preg_match("/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/i",$domain)) {
	echo $domain;
}else{
	echo "<br>";
	echo "false";
}

























