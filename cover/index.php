<?php

// Turn off all error reporting
error_reporting(1);

define('__ROOT__', (dirname(__FILE__)));



//Make Database connectivity
include_once "dbConfig.php";

$array_for_replace = array("http://","https://","//","www.","'","\"");
$url = trim($_GET['domainname']);
// remove all string in array if existing
$url = str_replace($array_for_replace,'',$url);
// add http:// to url because it will show $parse['host']
$url = "http://" . $url;
$parse = parse_url($url);

//var_dump($parse);

$domainname = isset($parse['host']) ? $parse['host'] : '';
echo $domainname;

function url_exist($url) {
	
	//se passar a URL existe
	$c=curl_init();
	curl_setopt($c,CURLOPT_URL,$url);
	curl_setopt($c,CURLOPT_HEADER,1);//get the header
	curl_setopt($c,CURLOPT_NOBODY,1);//and *only* get the header
	curl_setopt($c,CURLOPT_RETURNTRANSFER,1);//get the response as a string from curl_exec(), rather than echoing it
	curl_setopt($c,CURLOPT_FRESH_CONNECT,1);//don't use a cached version of the url
	if(!curl_exec($c)){
		//echo $url.' inexists';
		return false;
	}else{
		//echo $url.' exists';
		return true;
	}
	//$httpcode=curl_getinfo($c,CURLINFO_HTTP_CODE);
	//return ($httpcode<400);
	
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

/*
$sitelist = array();
$url = $domainname;
$sitelist[] = $url;
$j=0;

while($j < count($sitelist)){

	$url = $sitelist[$j];
	//echo $url;

	if(url_exist($url)){
		//echo "see it";
		$stringfile3 = $stringfile2 = $stringfile = file_get_contents("http://{$url}");
		
		// find google adsense id
		$findme = 'data-ad-client';

		$pos = strpos($stringfile, $findme);
		if($pos){
			$stringfile = substr($stringfile, $pos);

			$stringfile = substr($stringfile, 0, 42);

			//echo $stringfile;

			//$arr = array("google_ad_client:","\""," ");
			$arr = array("data-ad-client=","\""," ");
			
			
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
		
		$doc = new DOMDocument();
		@$doc->loadHTML($stringfile3);
		$links = $doc->getElementsByTagName('a');
		$result = array();
		foreach($links as $link) {
			$href = $link->getAttribute('href');
			//echo $href[0];
			//echo "<br>";
			if (preg_match("/^(http|https|\/\/)/i",$href)){
				$href = str_ireplace('www.', '', parse_url($href, PHP_URL_HOST));
				$result[] = $href;
			}
		}
		
		//print_r($result);
		//echo "<br>";
		//echo "<br>";
		//$arr = array("./","../",$url);
		//$pos = strpos($stringfile2, $findme);
		
		//$i = 0;
		//foreach($result as $item) {
			// with a right url then alway need http, https or //
		///	if(!preg_match("/^(http|https|\/\/)/i",$item) || strpos($item, $url)){
				//$result[$i] = "//".$item;
				//$item = "//".$item;
		//		unset($result[$i]);
		//	}else{
		//		$item = str_ireplace('www.', '', parse_url($item, PHP_URL_HOST));
		//		$result[$i] = $item;
		//	}
		//	$i++;
		//}
		if(count($result)>0){
			$result = array_unique($result);
			$sitelist = array_merge($sitelist, $result);
			$sitelist = array_unique($sitelist);
		}
		$j++;
		if($j==3) {
			exit(0);
		}
		
	}else{
		echo "can't see it";
	}
}
//print_r($result);
*/

?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<?php
	require_once(__ROOT__.'/head.php');
	?>
  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">
		
			<?php
			require(__ROOT__.'/header.php');
			?>
			
			<div class="inner cover">

			<h1 class="cover-heading"><?php echo $domainname ?> is banned adsense ?</h1>

			<?php
			require_once(__ROOT__.'/submenu.php');
			?>

			<p style="text-align:justify">
			Google AdSense want to maintain a strong ecosystem for both advertisers and publishers. As a publisher, you are responsible for maintaining high quality inventory and traffic. If the traffic Google AdSense receive from a publisher violates policies and/or is invalid, then that publisher will no longer be eligible to participate in AdSense or other publisher products. This kind of traffic is damaging to Google advertisers, as well as legitimate publishers, as it can reduce advertisers’ trust in the rest of the network.
			</p>

			<p>
			Copy and paste the url Below to Check the website is Banned by Google Adsense or No
			</p>
			<form class="form-inline">
			  <div class="form-group">
				<label class="sr-only" for="domain">Domain Name</label>
				<input type="text" class="form-control domainname" name="domainname" id="domain" placeholder="Domain Name Example: checkdomains.com" value="<?php echo $domainname;?>">
			  </div>
			  <button type="button" class="btn btn-default" id="checknow" onclick="checkurl()">CHECK NOW</button>
			</form>

			<h3>

			&nbsp;
			</h3>
			<br>
			
			<?php
			
			
			$sitelist = array();
			$url = $domainname;
			$sitelist[] = $url;
			$j=0;

			while($j < count($sitelist)){

				$url = $sitelist[$j];
				//echo $url;

				if(url_exist($url)){
					//echo "see it";
					$stringfile3 = $stringfile2 = $stringfile = file_get_contents("http://{$url}");
					
					// find google adsense id
					$findme = 'data-ad-client';

					$pos = strpos($stringfile, $findme);
					if($pos){
						$stringfile = substr($stringfile, $pos);

						$stringfile = substr($stringfile, 0, 42);

						//echo $stringfile;

						//$arr = array("google_ad_client:","\""," ");
						$arr = array("data-ad-client=","\""," ");
						
						
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
					
					$doc = new DOMDocument();
					@$doc->loadHTML($stringfile3);
					$links = $doc->getElementsByTagName('a');
					$result = array();
					foreach($links as $link) {
						$href = $link->getAttribute('href');
						//echo $href[0];
						//echo "<br>";
						if (preg_match("/^(http|https|\/\/)/i",$href)){
							$href = str_ireplace('www.', '', parse_url($href, PHP_URL_HOST));
							$result[] = $href;
						}
					}
					
					//print_r($result);
					//echo "<br>";
					//echo "<br>";
					//$arr = array("./","../",$url);
					//$pos = strpos($stringfile2, $findme);
					
					//$i = 0;
					//foreach($result as $item) {
						// with a right url then alway need http, https or //
					///	if(!preg_match("/^(http|https|\/\/)/i",$item) || strpos($item, $url)){
							//$result[$i] = "//".$item;
							//$item = "//".$item;
					//		unset($result[$i]);
					//	}else{
					//		$item = str_ireplace('www.', '', parse_url($item, PHP_URL_HOST));
					//		$result[$i] = $item;
					//	}
					//	$i++;
					//}
					if(count($result)>0){
						$result = array_unique($result);
						$sitelist = array_merge($sitelist, $result);
						$sitelist = array_unique($sitelist);
					}
					$j++;
					if($j==10) {
						//exit(0);
						break;
					}
					
				}else{
					echo "can't see it";
				}
			}
			print_r($sitelist);

			
			
			?>

			</div>
			
			<?php
			require(__ROOT__.'/submenu.php');
			?>
			
			<!-- footer -->
			<?php
			require_once(__ROOT__.'/footer.php');
			?>

        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../js/bootstrap.min.js"></script>
	<script type="text/javascript">
	
		$(document).ready(function() {
			$("input#domain").focus(function() { $(this).select(); } );
		});
		
		function gethostname(url) {
			url = url.replace("http://", "");
			url = url.replace("https://", "");
			//url = url.replace("//", "");
			//url = url.replace(" ", "");
			url = url.replace(/ /g, '');
			// secure all domain with http://
			url = "http://" + url;
			var hostname = $('<a>').prop('href', url).prop('hostname');
			hostname = hostname.replace("www.", "");
			return hostname; 
		}
		
		function checkurl() {
			var input_hostname = gethostname(document.getElementById('domain').value);
			//var brower_hostname = gethostname(window.location.href);
			//var newurl = window.location.protocol + '//' + window.location.hostname + (window.location.port ? ':' + window.location.port: '') + '/' + input_hostname + '.html';
			if(domainnameValid(input_hostname)) {
				var newurl = 'http://localhost/thesameid/cover' + '/' + input_hostname + '.html';
				location.href = newurl;
			}else{
				alert(input_hostname + " is not a domain name");
			}
			//var newurl = window.location.protocol + '//' + window.location.hostname;
			//alert(newurl);
			//return false;
		}
		
		
		document.getElementById("domain").addEventListener("keyup", function(event) {
			event.preventDefault();
			if (event.keyCode == 13) {
				document.getElementById("checknow").click();
			}
		});
		
		function domainnameValid(domainname)
		{
			if (/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/.test(domainname)){
				return true;
			}
			return false;
		}
		
	</script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
