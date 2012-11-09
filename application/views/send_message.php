<head>
	<meta charset="utf-8">
	<title>Send Message</title>
	<script>
		$(document).ready(function(){
			function ValidateDate(dtValue)
			{
				var dtRegex = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);
				return dtRegex.test(dtValue);
			}
			function isValidEmailAddress(emailAddress) {
				var email = emailAddress.split('@');
				if(email[1] == 'iitk.ac.in')
				{
					return true;
				}else{
					return false;
				}
			}	
		$("#send").click(function(event){
				to = $("#to").val();
				subject = $("#subject").val();
				description = $("#description").val();
				if(!isValidEmailAddress(to)){
					alert('Email address of recipient is not valid')
				}else{
					$.post("<?php echo base_url("message/send_message");?>",{to:to,subject:subject,description:description}, function(response){
						if(response=='Successful'){
						  alert('Message Sent');
						  window.location="<?php echo base_url();?>";
						}else{
						  alert(response);
						}
					});
				}
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
					<input type="text" id="to" value="" size="61" maxlength="50" onfocus="alreadyFocused=true;"><br>
				</td>
			   </tr>
			   <tr>
				<td  align="right">Subject:</td>
				<td  align="left">
					&nbsp;&nbsp;<textarea id="subject" rows="3" cols="10" maxlength="100" wrap="virtual" onfocus="alreadyFocused=true;"></textarea><br>
				</td>
			   </tr>
			   <tr>
				<td  align="right">Description:</td>
				<td  colspan="2">
					 &nbsp;&nbsp;<textarea id="description" rows="20" maxlength="500" cols="76" wrap="virtual" onfocus="alreadyFocused=true;"></textarea><br>
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
