<head>
	<meta charset="utf-8">
	<title>Hall Management System</title>
	<link rel="stylesheet" type="text/css" href="http://localhost/hms/styles/datepicker.css" />	
	<script language="javascript" type="text/javascript" src="http://localhost/hms/scripts/glDatePicker.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#submit").click(function(event){
				filled=false;
				$( 'textarea,input' ).each( function(){
					filled=false;
					value =$(this).val();
					if(!(!value || /^\s*$/.test(value))){
						filled=true;
					}
				});
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
				if(filled){
					fine_sender = "<?php echo $this->session->userdata('session_uemail');?>";
					fine_recipient = $("#fine_recipient").val();
					fine_subject = $("#fine_subject").val();
					fine_description = $("#fine_description").val();
					fine_amount = $("#fine_amount").val();
					if(!isValidEmailAddress(fine_recipient))
					{
						alert('Email address of recepient is valid');
					}else if ((/^\d*$/.test(fine_amount)))
					{
						$.post("<?php echo base_url("fine/propose_fine");?>",{fine_sender:fine_sender,fine_recipient:fine_recipient,fine_subject:fine_subject,fine_description:fine_description,fine_amount:fine_amount}, function(response){
							if(response == 'Successful'){
								alert('fine created');	
								window.location="<?php echo base_url('fine/view/view_proposed_fines');?>";
							}else{
								alert(response);
							}
						});
					}else{
						alert("Amount entered is not valid");
					}
				}else{
					alert("All fileds marked with (*) are compulsory");					
				}
			});
		});
	</script>
</head>
<center>
	<h1> Propose Fine</h1>
	<form>
		<table align="center" cellspacing="0" border="0">
		   <tbody>
			   <tr>
				<td  align="right" width="10%">Person to fine:(*)</td>
				<td  align="left" width="90%">
					<input type="text" id="fine_recipient"  maxlength="50" size="60" onfocus="alreadyFocused=true;"><br>
				</td>
			   </tr>
			   <tr>
				<td  align="right">Subject:(*)</td>
				<td  align="left">
					&nbsp;&nbsp;<textarea id="fine_subject" maxlength="100" rows="3" cols="10" wrap="virtual" onfocus="alreadyFocused=true;"></textarea><br>
				</td>
			   </tr>
			   <tr>
				<td  align="right">Description:(*)</td>
				<td  colspan="2">
					 &nbsp;&nbsp;<textarea id="fine_description" maxlength="500" rows="20" cols="76" wrap="virtual" onfocus="alreadyFocused=true;"></textarea><br>
				  </td>
			   </tr>
			   <tr>
				<td  align="right" width="10%">Amount(*)</td>
				<td  align="left" width="90%">
					<input type="text" id="fine_amount"  maxlength="5" size="10" onfocus="alreadyFocused=true;"><br>
				</td>
			   </tr>
		   </tbody>
		</table>
	</form>
	<div>
		<div id="submit" class="button">Create</div>
  	</div>
<center>
</body>
</html>
