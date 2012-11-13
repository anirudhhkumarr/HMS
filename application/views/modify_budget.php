

<head>
	<meta charset="utf-8">
	<title>Hall Management System</title>
	<link rel="stylesheet" type="text/css" href="http://localhost/hms/styles/datepicker.css" />	
	<script language="javascript" type="text/javascript" src="http://localhost/hms/scripts/glDatePicker.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#submit").click(function(event){
				filled=false;
				$( 'textarea' ).each( function(){
					filled=false;
					value =$(this).val();
					if(!(!value || /^\s*$/.test(value))){
						filled=true;
					}
				});
				if(filled){
					budget_sender = "<?php echo $this->session->userdata('session_uemail');?>";
					budget_id = "<?php echo $budget['budget_id'];?>";
					budget_recipient = $("#budget_recipient").val();
					budget_subject = $("#budget_subject").val();
					budget_description = $("#budget_description").val();
					budget_amount = $("#budget_amount").val();
					if ((/^\d*$/.test(budget_amount)))
					{
						$.post("<?php echo base_url("budget/modify_budget");?>",{budget_id:budget_id,budget_sender:budget_sender,budget_recipient:budget_recipient,budget_subject:budget_subject,budget_description:budget_description,budget_amount:budget_amount}, function(response){
							if(response == 'Successful'){
								alert('Budget Modified');	
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
	<h1> Modify budget</h1>
	<form>
		<table align="center" cellspacing="0" border="0">
		   <tbody>
			   <tr>
				<td  align="right" width="10%">Recepient:(*)</td>
				<td  align="left" width="90%">
					<input type="text" disabled="disabled" value="<?php echo $budget['budget_recipient'];?>" id="budget_recipient"  size="60" onfocus="alreadyFocused=true;"><br>
				</td>
			   </tr>
			   <tr>
				<td  align="right">Subject:(*)</td>
				<td  align="left">
					<input type="text" id="budget_subject"  value="<?php echo $budget['budget_subject'];?>" size="100" onfocus="alreadyFocused=true;">
				</td>
			   </tr>
			   <tr>
				<td  align="right">Description:(*)</td>
				<td  colspan="2">
					 &nbsp;&nbsp;<textarea id="budget_description" rows="20" cols="76" wrap="virtual" onfocus="alreadyFocused=true;"><?php echo $budget['budget_description'];?></textarea><br>
				  </td>
			   </tr>
			   <tr>
				<td  align="right" width="10%">Amount(INR)(*)</td>
				<td  align="left" width="90%">
					<input type="text" id="budget_amount"  <?php echo $budget['budget_amount'];?> size="10" onfocus="alreadyFocused=true;"><br>
				</td>
			   </tr>
		   </tbody>
		</table>
	</form>
	<div>
		<div id="submit" class="button">Modify</div>
  	</div>
</body>
</html>
