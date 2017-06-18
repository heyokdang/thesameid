<?php

// Turn off all error reporting
error_reporting(1);

/********************************************

For More Detail please Visit: 

http://www.discussdesk.com/download-pagination-in-php-and-mysql-with-example.htm

************************************************/

//Make Database connectivity
include_once "dbConfig.php";

include_once "function.php";

if(isset($_GET["page"]))
	$page = (int)$_GET["page"];
else
	$page = 1;

//echo $page;
//echo "<br>";

$where = "";
$banned = "";
if(isset($_GET["isbanned"])) {
	//$isbanned = (int)$_GET["isbanned"];
	$isbanned = (trim($_GET["isbanned"])=='isbanned') ? 1 : 0;
	$where = "WHERE status=$isbanned";
	//$banned = "isbanned=".trim($_GET['isbanned'])."&";
	$banned = trim($_GET["isbanned"])."/";
}

//echo $isbanned;
//echo "<br>";


$setLimit = 10;
$pageLimit = ($page * $setLimit) - $setLimit;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="keywords" content="<?php echo $domainname."," ?>banned, adsense, google, domain, website, worth, value, check, checker, buy">
    <meta name="description" content="Do You want to buy <?php echo $domainname ? $domainname : "a website" ?> ? let check google adsense is banned or no, the website worth is depending on the advertisement of google">
	<meta name="author" content="">
	<base href="http://localhost/adsbannedcheck/carousel/">
    <link rel="icon" href="favicon.ico">
	
    <title><?php echo $domainname ?> is banned by google adsense ? check it now here</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="cover.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<style>
	ul.setPaginate li.setPage{
	padding:15px 10px;
	font-size:14px;
	}

	ul.setPaginate{
	margin:0px;
	padding:0px;
	height:100%;
	overflow:hidden;
	font:12px 'Tahoma';
	list-style-type:none;	
	}  

	ul.setPaginate li.dot{padding: 3px 0;}

	ul.setPaginate li{
	float:left;
	margin:0px;
	padding:0px;
	margin-left:5px;
	}

	ul.setPaginate li a
	{
	background: none repeat scroll 0 0 #ffffff;
	border: 1px solid #cccccc;
	color: #999999;
	display: inline-block;
	font: 15px/25px Arial,Helvetica,sans-serif;
	margin: 5px 3px 0 0;
	padding: 0 5px;
	text-align: center;
	text-decoration: none;
	}	

	ul.setPaginate li a:hover,
	ul.setPaginate li a.current_page
	{
	background: none repeat scroll 0 0 #0d92e1;
	border: 1px solid #000000;
	color: #ffffff;
	text-decoration: none;
	}

	ul.setPaginate li a{
	color:black;
	display:block;
	text-decoration:none;
	padding:5px 8px;
	text-decoration: none;
	}
	</style>
  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="inner cover">
            <h1 class="cover-heading"><?php echo $domainname ?> is banned adsense ?</h1>
			<ul><li>
				<a href="http://localhost/adsbannedcheck/carousel/banned-adsense-list/isbanned/1">is banned list</a>
				</li>
				<li>
				<a href="http://localhost/adsbannedcheck/carousel/banned-adsense-list/isnotbanned/1">is not banned list</a>
				</li>
				<li>
				<a href="http://localhost/adsbannedcheck/carousel/banned-adsense-list">checked banned adsense recently</a>
				</li>
			</ul>
			<table class="table">

			<?php
			
			// Your SQL query go here. This query will display all record by setting the Limit.
			
			
			$sql = "SELECT * FROM domainlist $where LIMIT ".$pageLimit." , ".$setLimit;
			$query = mysql_query($sql);
			
			while ($rec = mysql_fetch_array($query)) {
			?>
			
			<tr>
				<td align="left"><a href="http://bannedadsense.com/<?php echo $rec["domain"];?>.html" target="_blank"><?php echo $rec["domain"];?></a></td>
				<td align="left"><?php echo $rec["status"] ? "is banned" : "is not banned";?></td>
				<td><a href="http://bannedadsense.com/<?php echo $rec["domain"];?>.html" target="_blank">update</a></td>
			</tr>
			
			<?php }	?>
			
			</table>
			
			<?php
			// Call the Pagination Function to load Pagination.
			
			echo displayPaginationBelow($setLimit,$page,$banned,$where);
			
			?>
			
          </div>
		  
		  <!--
          <div class="mastfoot">
            <div class="inner">
              <p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
            </div>
          </div>
		  -->

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
				var newurl = 'http://localhost/adsbannedcheck/cover' + '/' + input_hostname + '.html';
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
<?php
mysql_close($link);
?>
