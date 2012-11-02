<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Send Message</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#send").click(function(event){
				to = $("#to").val();
				subject = $("#subject").val();
				description = $("#description").val();
				$.post("<?php echo base_url("message/send_message");?>",{to:to,subject:subject,description:description}, function(response){
					if(response=='Successful'){
					  alert('Message Sent');
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
	<h1>Send Message</h1>
	To: <input type="text" id="to" size="100" /><br />	
	Subject: <input type="text" id="subject" size="100" /><br />
	Description: <input type="text" id="description" size="10000" /><br />

	<div>
	  <button id="send">Send</button>
	</div>
    <center>
  </body>
</html>
