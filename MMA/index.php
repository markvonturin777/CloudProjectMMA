<?php 
SESSION_start(); 
require 'connection.php';
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>MMA</title>
    <link href="index.css" rel="stylesheet" type="text/css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	
	<script src="js/main.js"></script>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('sfondo.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Account Login
				</span>

				
				<form class="login100-form validate-form p-b-33 p-t-5" action="loginControl.php" method="post">

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
						
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

                       
        			<a href="register.php">Non sei ancora registrato? Clicca qui</a> 

					<div class="container-login100-form-btn m-t-32">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>		
					<div  style="display:none;" class="error container-login100-form-btn m-t-32">
						<span><b>errore di login</b></span>
					</div>

					<?php 
						if($_SESSION['resultLogin']==1){
							echo "	<script> 
										$(document).ready(function(){
											$('.error').slideDown('slow');
											$('.error').slideUp('slow');
										});
									</script>";
							$_SESSION['resultLogin']=0;
						}
					?>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	

</body>
</html>