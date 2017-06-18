<?php

// Turn off all error reporting
error_reporting(1);

define('__ROOT__', (dirname(__FILE__))); 
$action=$_REQUEST['action'];

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
			require_once(__ROOT__.'/header.php');
			?>
		
          <div class="inner cover">
		  
            <h1 class="cover-heading">CONTACT FORM</h1>
			
			<?php
			require(__ROOT__.'/submenu.php');
			?>
			
			<?php
			
			if ($action=="")
			{
				?>
				
				<form  action="" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="action" value="submit">
					<div class="form-group">
						<label for="name">Your name:</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
					</div>
					<div class="form-group">
						<label for="email">Your email:</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Email">
					</div>
					<div class="form-group">
						<label for="message">Your message:</label>
						<textarea class="form-control" rows="7" id="message" name="message"></textarea>
					</div>
					<div class="form-group" style="text-align:center">
						<button type="submit" class="btn btn-default">Send email</button>
					</div>
				</form>
				
				<?php
			} else {
				/* send the submitted data */
				$name=$_REQUEST['name'];
				$email=$_REQUEST['email'];
				$message=$_REQUEST['message'];
				if (($name=="")||($email=="")||($message==""))
					{
						echo "All fields are required, please fill <a href='contact'>the form</a> again. <a href='contact'>Click back</a>";
					}
				else{
						$from="From: $name<$email>\r\nReturn-path: $email";
						$subject="Message sent using your contact form";
						mail("heyokdang@gmail.com", $subject, $message, $from);
						echo "Email sent!";
					}
				}
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
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
