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
		   
		  
            <h1 class="cover-heading">THIS PAGE IS NOT FOUND</h1>
			
			<?php
			require(__ROOT__.'/submenu.php');
			?>
			
            <p class="lead">TRY GO TO MENU</p>

			
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
