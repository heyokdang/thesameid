<?php
// Turn off all error reporting
error_reporting(1);
function url_exist($url) {
	
	//se passar a URL existe
	$c=curl_init();
	curl_setopt($c,CURLOPT_URL,$url);
	curl_setopt($c,CURLOPT_HEADER,0);//get the header
	curl_setopt($c,CURLOPT_NOBODY,0);//and *only* get the header
	curl_setopt($c,CURLOPT_RETURNTRANSFER,1);//get the response as a string from curl_exec(), rather than echoing it
	curl_setopt($c,CURLOPT_FRESH_CONNECT,1);//don't use a cached version of the url
	//if(!curl_exec($c)){
		//echo $url.' inexists';
	//	return false;
	//}else{
		//echo $url.' exists';
	//	return true;
	//}
	//$httpcode=curl_getinfo($c,CURLINFO_HTTP_CODE);
	//return ($httpcode<400);
	$output = curl_exec($c);
	curl_close($c);
	return $output;
}
function urlExist($url)
{
                $handle   = curl_init($url);
                if (false === $handle)
                {
                        return false;
                }
                curl_setopt($handle, CURLOPT_HEADER, false);
                curl_setopt($handle, CURLOPT_FAILONERROR, true);  // this works
                curl_setopt($handle, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15") ); // request as if Firefox
                curl_setopt($handle, CURLOPT_NOBODY, true);
                curl_setopt($handle, CURLOPT_RETURNTRANSFER, false);
                $connectable = curl_exec($handle);
                ##print $connectable;
                curl_close($handle);
                return $connectable;
}
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
		return 0;
		//echo "Its Invalid Domain Name.";
	}else{
		return 1;
		//echo " $url is a Valid Domain Name.";
	}

}

//status.twitterstat.us
//twitter.com
$sss = url_exist("twitter.com");
echo $sss;
//if($sss!="") echo "success";
//else echo "failed";
