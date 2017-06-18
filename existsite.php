<?php
// Turn off all error reporting
error_reporting(1);

function existsite($url){
	$file_headers = @get_headers($url);
	if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
		$exists = false;
	}else {
		$exists = true;
	}
}

function url_exists3($url) {
	$handle   = curl_init($url);
	if (false === $handle)
	{
			return false;
	}
	
	curl_setopt($handle, CURLOPT_HEADER, false);
	curl_setopt($handle, CURLOPT_FAILONERROR, true);  // this works
	curl_setopt($handle, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15") ); // request as if Firefox
	curl_setopt($handle, CURLOPT_NOBODY, true);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 3);
	$connectable = curl_exec($handle);
	##print $connectable;
	curl_close($handle);
	if($connectable){
		return true;
	}
	return false;
}

function url_exists2($url) {
	
	//se passar a URL existe
	$c=curl_init();
	curl_setopt($c,CURLOPT_URL,$url);
	curl_setopt($c,CURLOPT_HEADER,1);//get the header
	curl_setopt($c,CURLOPT_NOBODY,false);//and *only* get the header
	curl_setopt($c,CURLOPT_RETURNTRANSFER,1);//get the response as a string from curl_exec(), rather than echoing it
	curl_setopt($c,CURLOPT_FRESH_CONNECT,1);//don't use a cached version of the url
	curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 3);
	$cc = curl_exec($c);
	//if(!$cc){
		//echo $url.' inexists';
	//	return false;
	//}else{
		//echo $url.' exists';
	//	return true;
	//}
	//$httpcode=curl_getinfo($c,CURLINFO_HTTP_CODE);
	//return ($httpcode<400);
	return $cc;
}

function url_exists($url) {
	$handle   = curl_init($url);
	if (false === $handle)
	{
			return false;
	}
	
	curl_setopt($handle, CURLOPT_HEADER, true);
	//curl_setopt($handle, CURLOPT_FAILONERROR, true);  // this works
	curl_setopt($handle, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15") ); // request as if Firefox
	curl_setopt($handle, CURLOPT_NOBODY, true);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($handle, CURLOPT_FRESH_CONNECT,1);
	//curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 3);
	$connectable = curl_exec($handle);
	##print $connectable;
	curl_close($handle);
	if($connectable){
		return true;
	}
	return false;
}

function Visit($url){
       $agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";$ch=curl_init();
       curl_setopt ($ch, CURLOPT_URL,$url );
       curl_setopt($ch, CURLOPT_USERAGENT, $agent);
       curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt ($ch,CURLOPT_VERBOSE,false);
       curl_setopt($ch, CURLOPT_TIMEOUT, 5);
       curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE);
       curl_setopt($ch,CURLOPT_SSLVERSION,3);
       curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, FALSE);
       $page=curl_exec($ch);
       //echo curl_error($ch);
       $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
       curl_close($ch);
       if($httpcode>=200 && $httpcode<300) return true;
       else return false;
}

function isDomainAvailible($domain)
{
	//check, if a valid url is provided
	if(!filter_var($domain, FILTER_VALIDATE_URL))
	{
		   return false;
	}

	//initialize curl
	$curlInit = curl_init($domain);
	curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
	curl_setopt($curlInit,CURLOPT_HEADER,true);
	curl_setopt($curlInit,CURLOPT_NOBODY,false);
	curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

	//get answer
	$response = curl_exec($curlInit);

	curl_close($curlInit);

	if ($response) return true;

	return false;
}

//$url = "vnexpress.net";
//$url = "glype.com";
//$url = "cubanos.guru";
$url = "unblocksite.org";
//https://www.glype.com/
if(url_exists3($url)){
	echo "$url is existing. url_exists3";
}else{
	echo "$url is not existing url_exists3";
}
echo "<br>\n";
if(!url_exists2($url)){
	echo "$url is not existing. url_exists2";
}else{
	echo "$url is existing url_exists2";
	
}
echo "<br>\n";
if(url_exists($url)) {
	echo "$url is existing";
}else{
	echo "$url is not existing";
	// create the context
	//$arContext['http']['timeout'] = 3;
	//$context = stream_context_create($arContext);
	
	// Fetch data
	//$url_data = file_get_contents($url, 0, $context);
	$url_data = file_get_contents("https://".$url);
	//echo $url_data;
	//echo 'zzz';
}

//echo file_get_contents("http://www.".$url);
echo url_exists2($url);
/*
ini_set("default_socket_timeout","03");
set_time_limit(3);
$f=@fopen($url,"r");
if($f){
	$r=@fread($f,1000);
	if(strlen($r)>1) {
		echo("<span class='online'>Online</span>");
	} else {
		echo("<span class='offline'>Offline</span>");
	}
}else{
	echo "wrong f";
}

fclose($f);*/