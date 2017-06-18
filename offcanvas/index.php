<?php

// Turn off all error reporting
error_reporting(1);

define('__ROOT__', (dirname(__FILE__)));

$subdomain = substr( $_SERVER['SERVER_NAME'], 0, strpos($_SERVER['SERVER_NAME'], '.bannedadsense.com') );
//echo $subdomain;

$array_for_replace = array("http://","https://","//","www.","'","\"");
//$url = trim($_GET['domainname']);
$url = $subdomain;
// remove all string in array if existing
$url = str_replace($array_for_replace,'',$url);
// add http:// to url because it will show $parse['host']
$url = "http://" . $url;
$parse = parse_url($url);

//var_dump($parse);

$domainname = isset($parse['host']) ? $parse['host'] : '';

//Make Database connectivity
include_once "dbConfig.php";
include_once "function.php";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<?php
	require_once(__ROOT__.'/head.php');
	?>
  </head>

  <body>

	<?php
	require(__ROOT__.'/header.php');
	?>
	
	<div class="container">
		
		<div class="row row-offcanvas row-offcanvas-right">

			<div class="col-xs-12 col-sm-9">
			  <p class="pull-right visible-xs">
				<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
			  </p>
			  
			  
			  
			  <div class="jumbotron">
				
				<h1><?php echo $domainname ?> is banned adsense ?</h1>
				
				<?php
				require(__ROOT__.'/submenu.php');
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
				<?php
				
				if($domainname!='') {
					$isbanned = bannedadsensecheck($domainname);
					
					if($isbanned) {
						echo "<img src='google-adsense-banned-me.png' alt='Website is banned by Google Adsense' width='150' align='middle'> Sorry, the website $domainname is banned by Google Adsense.";
					}else{
						echo "<img src='google-adsense-not-banned-me.png' alt='Website is not banned by Google Adsense' width='150' align='middle'> The website $domainname is not banned by Google Adsense.";
					}
					
					if(url_exist($domainname)) {
						
						$sql = "INSERT INTO domainlist (domain, status) VALUES ('$domainname', '$isbanned');";
						mysqli_query($link, $sql);
						
						
						
					}else{
						echo "<br><br>$domainname is not existing.";
					}
				}
				?>
				&nbsp;
				</h3>
				
				
				<br>
				<h2>Latest websites checked in AdsenseBannedCheck</h2>
				<table class="table">
				
				<?php
				
				// Your SQL query go here. This query will display all record by setting the Limit.
				
				$sql = "SELECT * FROM domainlist ORDER BY id DESC LIMIT 20";
				$query = mysqli_query($link,$sql);
				
				while ($rec = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
				?>
				
				<tr>
					<td align="left"><a href="http://<?php echo $rec["domain"];?>.adsensebannedcheck.com" target="_blank"><?php echo $rec["domain"];?></a></td>
					<td align="left"><?php echo $rec["status"] ? "is banned" : "is not banned";?></td>
					<td><a href="http://<?php echo $rec["domain"];?>.adsensebannedcheck.com" target="_blank">update</a></td>
				</tr>
				
				<?php }	?>
				<?php
					mysqli_close($link);
				?>
				</table>
				
				<?php
				require(__ROOT__.'/submenu.php');
				?>
				
			  </div>
			  
			  <div class="row">
				<div class="col-xs-6 col-lg-4">
				  <h2>Heading</h2>
				  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
				  <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
				</div><!--/.col-xs-6.col-lg-4-->
				<div class="col-xs-6 col-lg-4">
				  <h2>Heading</h2>
				  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
				  <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
				</div><!--/.col-xs-6.col-lg-4-->
				<div class="col-xs-6 col-lg-4">
				  <h2>Heading</h2>
				  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
				  <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
				</div><!--/.col-xs-6.col-lg-4-->
				<div class="col-xs-6 col-lg-4">
				  <h2>Heading</h2>
				  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
				  <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
				</div><!--/.col-xs-6.col-lg-4-->
				<div class="col-xs-6 col-lg-4">
				  <h2>Heading</h2>
				  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
				  <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
				</div><!--/.col-xs-6.col-lg-4-->
				<div class="col-xs-6 col-lg-4">
				  <h2>Heading</h2>
				  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
				  <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
				</div><!--/.col-xs-6.col-lg-4-->
			  </div><!--/row-->
			</div><!--/.col-xs-12.col-sm-9-->

			<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
			  <div class="list-group">
				<a href="#" class="list-group-item active">Link</a>
				<a href="#" class="list-group-item">Link</a>
				<a href="#" class="list-group-item">Link</a>
				<a href="#" class="list-group-item">Link</a>
				<a href="#" class="list-group-item">Link</a>
				<a href="#" class="list-group-item">Link</a>
				<a href="#" class="list-group-item">Link</a>
				<a href="#" class="list-group-item">Link</a>
				<a href="#" class="list-group-item">Link</a>
				<a href="#" class="list-group-item">Link</a>
			  </div>
			</div><!--/.sidebar-offcanvas-->
		</div><!--/row-->
		
		<hr>
		
		<!-- footer -->
		  <?php
		  require_once(__ROOT__.'/footer.php');
		  ?>
	</div><!--/.container-->

	


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
			//url = url.replace(" ", "");
			url = url.replace(/ /g, '');
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
				var newurl = 'http://localhost/adsbannedcheck/offcanvas' + '/' + input_hostname + '.html';
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
	<script src="offcanvas.js"></script>
  </body>
</html>
