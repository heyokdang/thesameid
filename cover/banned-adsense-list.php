<?php

// Turn off all error reporting
error_reporting(1);

define('__ROOT__', (dirname(__FILE__))); 

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
$title = "checked is banned by google adsense ?";
if(isset($_GET["isbanned"])) {
	//$isbanned = (int)$_GET["isbanned"];
	if(trim($_GET["isbanned"])=='isbanned') {
		$isbanned = 1;
		$title = "is banned by google adsense list";
	}else{
		$isbanned = 0;
		$title = "is not banned by google adsense list";
	}
	
	$where = "WHERE status=$isbanned ";
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
    <?php
	require_once(__ROOT__.'/head.php');
	?>
	
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
			
			<?php
			require_once(__ROOT__.'/header.php');
			?>
			
          <div class="inner cover">
            <h1 class="cover-heading"><?php echo $title ?></h1>
			
			
			<?php
			require(__ROOT__.'/submenu.php');
			?>
			
			
			<table class="table">

			<?php
			
			// Your SQL query go here. This query will display all record by setting the Limit.
			
			
			$sql = "SELECT * FROM domainlist $where"."ORDER BY id DESC LIMIT ".$pageLimit." , ".$setLimit;
			$query = mysqli_query($link,$sql);
			
			while ($rec = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
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
			
			echo displayPaginationBelow($setLimit,$page,$banned,$where,$link);
			
			?>
			
			
			<?php
			require(__ROOT__.'/submenu.php');
			?>
			
          </div>
		  
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
