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
					budget_sender = "<?php echo $this->session->userdata('session_uemail');?>";
					budget_recipient = $("#budget_recipient").val();
					budget_subject = $("#budget_subject").val();
					budget_description = $("#budget_description").val();
					budget_amount = $("#budget_amount").val();
					if(!isValidEmailAddress(budget_recipient))
					{
						alert('Email address of recepient is valid');
					}else if ((/^\d*$/.test(budget_amount)))
					{
						$.post("<?php echo base_url("budget/propose_budget");?>",{budget_sender:budget_sender,budget_recipient:budget_recipient,budget_subject:budget_subject,budget_description:budget_description,budget_amount:budget_amount}, function(response){
							if(response == 'Successful'){
								alert('budget created');	
								window.location="<?php echo base_url('budget/view/view_proposed_budgets');?>";
							}else{
								alert(response);
							}
						});
					}else{
						alert("Amount entered is not valid");
					}
				}else{
					alert("All fields marked with (*) are compulsory");					
				}
			});
		});
	</script>
</head>
<center>
	<h1> Propose budget</h1>
	<form>
		<table align="center" cellspacing="0" border="0">
		   <tbody>
			   <tr>
				<td  align="right" width="10%">Recepient:(*)</td>
				<td  align="left" width="90%">
					<input type="text" id="budget_recipient"  maxlength="50" size="60" onfocus="alreadyFocused=true;"><br>
				</td>
			   </tr>
			   <tr>
				<td  align="right">Subject:(*)</td>
				<td  align="left">
					&nbsp;&nbsp;<textarea id="budget_subject" maxlength="100" rows="3" cols="10" wrap="virtual" onfocus="alreadyFocused=true;"></textarea><br>
				</td>
			   </tr>
			   <tr>
				<td  align="right">Description:(*)</td>
				<td  colspan="2">
					 &nbsp;&nbsp;<textarea id="budget_description" maxlength="500" rows="20" cols="76" wrap="virtual" onfocus="alreadyFocused=true;"></textarea><br>
				  </td>
			   </tr>
			   <tr>
				<td  align="right" width="10%">Amount(*)</td>
				<td  align="left" width="90%">
					<input type="text" id="budget_amount"  maxlength="5" size="10" onfocus="alreadyFocused=true;"><br>
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
