<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->session->userdata('session_uname');?></title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#submit").click(function(event){
				$.post("<?php echo base_url("user/logout");?>",{}, function(){					  
				  location.reload();
				});
			});

		});
	</script>
</head>
<body>
  <center>
	<h1><?php echo $this->session->userdata('session_uname');?>,Welcome to Hall Managment System</h1>
	<h3>You are logged in as <?php echo $this->session->userdata('session_urole');?></h3>
	<a href="<?php echo base_url('pages/view/register_complain');?>">Register Complain</a><br />
	<a href="<?php echo base_url('pages/view/send_message');?>">Send Message</a>
	<div>
		<div id="submit"><button>Logout</button></div>
  	</div>
  </center>
</body>
</html>
