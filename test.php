<?php

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



$url = "unblocksite.org";
//$stringfile3 = $stringfile2 = $stringfile = file_get_contents("http://{$url}");
//$stringfile3 = $stringfile2 = $stringfile = file_get_contents("http://{$url}");
$stringfile3 = $stringfile2 = $stringfile = file_get_contents("http://{$url}");
//$stringfile3 = $stringfile2 = $stringfile = file_get_contents("http://{$url}");

// find google adsense id
$findme = 'google_ad_client';

$pos = strpos($stringfile, $findme);
if($pos){
	$stringfile = substr($stringfile, $pos);

	$stringfile = substr($stringfile, 0, 43);

	//echo $stringfile;

	$arr = array("google_ad_client:","\""," ");

	$adsense_id = str_replace($arr, "", $stringfile);

	echo "<br>";
	echo $adsense_id;
	echo "<br>";
}else{
	echo "<br>";
	echo "No goooogle adsense id";
	echo "<br>";
}

// find google analytics id
$findme = "ga('create', '";

$pos = strpos($stringfile2, $findme);

if($pos){
	
	$stringfile2 = substr($stringfile2, $pos);

	$stringfile2 = substr($stringfile2, 0, 29);

	//echo $stringfile2;

	$arr = array("ga","("," ","'","\"","create",",");

	$analytics_id = str_replace($arr, "", $stringfile2);
	echo "<br>";
	echo $analytics_id;
	echo "<br>";
	
}else{
	
	echo "<br>";
	echo "No goooogle analytics id";
	echo "<br>";
	
}

//function displayUrls($string) {
//    $pattern = '~\bhref\s*+=\s*+["\']?+\K(?!#)[^\s"\'>]++~';
//    preg_match_all($pattern, $string, $out);
//    print_r($out[0]);
//}
//displayUrls($stringfile3);


$doc = new DOMDocument();
@$doc->loadHTML($stringfile3);
$links = $doc->getElementsByTagName('a');
$result = "";
foreach($links as $link) {
    $href = $link->getAttribute('href');
    if ($href[0] != '#') $result[] = $href;
}
print_r($result);
echo "<br>";
echo "<br>";
$arr = array("./","../",$url);
$pos = strpos($stringfile2, $findme);

$i = 0;
foreach($result as $item) {
	//if((strlen($item)<4) || substr($item,0,1)=="." || substr($item,0,1)=="/" || strpos($item, "vnexpress.net") || (substr($item,0,1)=="j" && substr($item,-1)==";")) unset($result[$i]);
	//if(!preg_match("/^[a-z]/i",$item)) unset($result[$i]);
	//if(!preg_match("/^http/i",$item) || !preg_match("/^///i",$item) || preg_match("/bannedadsense.com/i",$item)) unset($result[$i]);
	
	//if(strlen($item)<4) unset($result[$i]);
	
	//if(!preg_match("/^[a-z]/i",$item)) { unset($result[$i]); continue; }
	//if(!preg_match("/^http/i",$item)) $item = "http:".$item;
	//$domain = str_ireplace('www.', '', parse_url($item, PHP_URL_HOST));
	//$result[$i] = $domain;
	
	// with a right url then alway need http, https or //
	if(!preg_match("/^(http|https|\/\/)/i",$item) || strpos($item, $url)){
		//$result[$i] = "//".$item;
		//$item = "//".$item;
		unset($result[$i]);
	}else{
		$item = str_ireplace('www.', '', parse_url($item, PHP_URL_HOST));
		$result[$i] = $item;
	}
	
	//$item = str_ireplace('www.', '', parse_url($item, PHP_URL_HOST));
	//if(!$item){
	//	unset($result[$i]);
	//}else{
	//	if(!preg_match("/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/i",$item) || preg_match("/(.htm|.html|.php|.php5|.asp|.aspx)$/i",$item)) {
	//		unset($result[$i]);
	//	}else{
	//		$result[$i] = $item;
	//	}
	//if(!is_valid_domain($item)){
	//	unset($result[$i]);
	//}
	//}
	
	$i++;
}
$result = array_unique($result);
print_r($result);