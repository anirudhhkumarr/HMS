<head>
	<meta charset="utf-8">
	<title>Send Message</title>
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
    <center>
	<h1>Send Message</h1>
	<form>
		<table align="center" cellspacing="0" border="0">
		   <tbody>
			   <tr>
				<td  align="right" width="10%">To:</td>
				<td  align="left" width="90%">
					<input type="text" id="to" value="" size="50" onfocus="alreadyFocused=true;"><br>
				</td>
			   </tr>
			   <tr>
				<td  align="right">Subject:</td>
				<td  align="left">
					<input type="text" id="subject" value="" size="100" onfocus="alreadyFocused=true;">
				</td>
			   </tr>
			   <tr>
				<td  align="right">Description:</td>
				<td  colspan="2">
					 &nbsp;&nbsp;<textarea id="description" rows="20" cols="76" wrap="virtual" onfocus="alreadyFocused=true;"></textarea><br>
				  </td>
			   </tr>
		   </tbody>
		</table>
	</form>
	<div id="send" class="button">Send</div>
	</div>
    <center>
  </body>
</html>
