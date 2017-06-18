<?php

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
	curl_setopt($handle, CURLOPT_RETURNTRANSFER,1);
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

function get_contents($url) {
	
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
	
	return $cc;
}

$sitelist = array();
$url = "cubanos.guru";
$sitelist[] = $url;
$j=0;

while($j < count($sitelist)){
	$url = $sitelist[$j];

	if(url_exists($url)){
		$contentfile = get_contents($url);
		
		// find google adsense id
		//$findme = 'data-ad-client';
		//$pos = strpos($contentfile, $findme);
		$adsense_id = "";
		if(preg_match('/data-ad-client="(.*?)"/', $contentfile, $adsense_id)){
			
			//$adsense_id = substr($contentfile, $pos);
			//$adsense_id = substr($adsense_id, 0, 42);
			//echo $adsense_id;
			//$arr = array("google_ad_client:","\""," ");
			//$arr = array("data-ad-client=","\""," ");
			//$adsense_id = str_replace($arr, "", $adsense_id);
			echo "<br>$j ";
			echo $adsense_id[1];
			echo "<br>";
		}else{
			echo "<br>$j ";
			echo "No goooogle adsense id";
			echo "<br>";
		}
		
		// find google analytics id
		//$findme = "ga('create', '";
		//$pos = strpos($contentfile, $findme);
		$analytics_id = "";
		if(preg_match("/ga\('create', '(.*?)', 'auto'\)/", $contentfile, $analytics_id) || preg_match("/gaTracker\('create', '(.*?)', 'auto'\)/", $contentfile, $analytics_id)){
			//$analytics_id = substr($contentfile, $pos);
			//$analytics_id = substr($analytics_id, 0, 29);
			//echo $analytics_id;
			//$arr = array("ga","("," ","'","\"","create",",");
			//$analytics_id = str_replace($arr, "", $analytics_id);
			echo "<br>";
			echo $analytics_id[1];
			echo "<br>";
		}else{
			echo "<br>";
			echo "No goooogle analytics id";
			echo "<br>";
		}
		
		$doc = new DOMDocument();
		@$doc->loadHTML($contentfile);
		$links = $doc->getElementsByTagName('a');
		$result = array();
		foreach($links as $link) {
			$href = $link->getAttribute('href');
			//echo $href[0];
			//echo "<br>";
			if (preg_match("/^(http|https|\/\/)/i",$href)){
				$href = str_ireplace('www.', '', parse_url($href, PHP_URL_HOST));
				if($href!='') $result[] = $href;
			}
		}
		
		if(count($result)>0){
			$result = array_unique($result);
			$sitelist = array_merge($sitelist, $result);
			$sitelist = array_unique($sitelist);
		}
		
		$j++;
		if($j==5) {
			//exit(0);
			break;
		}
		
	}else{
		echo "<br>";
		echo "$j can't see $url";
		echo "<br>";
		$j++;
		if($j==5) {
			//exit(0);
			break;
		}
	}
}
print_r($sitelist);