<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->helper('url');

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title> Dashboard</title>
	<script type="text/javascript">
		function validateForm() {
			if (document.forms['login']['username'].value == "") {
				alert("enter a username");
				return false;
			}
			if (document.forms['login']['password'].value == "") {
				alert("enter a password");
				return false;
			}
		}
	</script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style.css">
</head>

<body>
	<div class="loginbox">
		<h1>Welcome to Awesoft comapany</h1>
		<form id="loginform" name="login" action="<?php echo base_url(); ?>index.php/welcome/dologin" method="post" onsubmit="return validateForm()">
			<label for="uname">Username</label><br>
			<input type="text" id="usernameid" name="username" value=""><br>
			<label for="lname">Password</label><br>
			<input type="password" id="passwordid" name="password" value=""><br><br>
			<input type="submit" value="Submit">
		</form>
		<div>
			<form id="loginform" action="<?php echo base_url(); ?>index.php/welcome/adduser" method="get">
				<input type="submit" value="Register">
			</form>
			
		</div>
	</div>
	<img src="q&a.png" alt="image q&a"  style="width:128px;height:128px;padding:15px;border-radius:circle;">
</body>
<body>
	<div>
		<a href="http://localhost/awesoftdb1/index.php/welcome/dashboardq" class="buttong">Guest</a>
	
		</form>
	</div>
</body>


</html>