<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Hall Management System</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#submit").click(function(event){
				username = $("#username").val();
				password = $("#password").val();
				$.post("<?php echo base_url("user/login");?>",{username:username,password:password}, function(response){
					if(response=='Successfull'){
					  window.location="<?php echo base_url();?>";
					}else{
					  alert(response);
					}
				});
			});
		});
	</script>
</head>
<body>
    <center>
	<h1>Welcome to Hall Managment System</h1>
	Username: <input type="text" id="username" size="15" /><br />	
	Password: <input type="password" id="password" size="15" /><br />
	<div>
	  <button id="submit">Login</button>
	</div>
    <center>
  </body>
</html>
