<?php

// Turn off all error reporting
error_reporting(1);

define('__ROOT__', (dirname(__FILE__))); 

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
		   
		  
            <h1 class="cover-heading">About us</h1>
			
			<?php
			require(__ROOT__.'/submenu.php');
			?>
			
            <p class="lead">I'm a freelancer web developer, nearly i have bought some websites, they showed me alexa rank, page views, visitors each day, ..., i believed. After a month, i put banners of google adsense but the banners didn't appear. I lose so much money because i didn't know how to check a website is banned by google adsense. And i decided to create this website with the purpose to help me to check is banned by google adsense exactly, so that i can estimate website worth exact more, Bannedadsense.com are useful for investors, website managers</p>

			
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
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
