<?php 
SESSION_start(); 
require 'connection.php';
error_reporting(0);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registrazione</title>
    <link href="index.css" rel="stylesheet" type="text/css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>


<script>
	function validateForm(){

		var a = document.forms["registration"]["name"].value;
		var b = document.forms["registration"]["surname"].value;
		var c = document.forms["registration"]["email"].value;
		var d = document.forms["registration"]["psw"].value;
		var ex = "@";
		if (a == "") {
			alert("Name must be filled out");
			return false;
		}
		if (b == "") {
			alert("Surname must be filled out");
			return false;
		}
		if (c == "") {
			alert("Email must be filled out");
			return false;
		}
		if (c.includes(ex)==false) {
			alert("Email must be correct");
			return false;
		}
		if (d == "") {
			alert("Password must be filled out");
			return false;
		}
	}
</script>

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('sfondo.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Account Login
				</span>
				<form name="registration" class="login100-form validate-form p-b-33 p-t-5" onsubmit="return validateForm()"  action="registerControl.php" method="post">

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="name" placeholder="Name">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>
                    
                    <div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="surname" placeholder="Surname">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>
                    
                    <div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>
                    
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="psw" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					

					<div class="container-login100-form-btn m-t-32">
						<button type="submit" class="login100-form-btn">
							Register
						</button>
					</div>

					<div  style="display:none;" class="error container-login100-form-btn m-t-32">
						<span><b>registration error</b></span>
					</div>
					<div  style="display:none;" class="error1 container-login100-form-btn m-t-32">
						<span><b>email already registered</b></span>
					</div>    
					
						<?php 
							if($_SESSION['resultRegistration']==1){
								echo "	<script> 
											$(document).ready(function(){
												$('.error').slideDown('slow');
												$('.error').slideUp('slow');
											});
										</script>";
								$_SESSION['resultRegistration']=0;
							}
							if($_SESSION['resultRegistration']==2){
								echo "	<script> 
											$(document).ready(function(){
												$('.error1').slideDown('slow');
												$('.error1').slideUp('slow');
											});
										</script>";
								$_SESSION['resultRegistration']=0;
							}
						?>
				</form>
			</div>
		</div>
	</div>
	
	<div id="dropDownSelect1"></div>
	
</body>
</html>