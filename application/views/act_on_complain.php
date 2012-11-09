<head>
	<meta charset="utf-8">
	<title>Hall Management System</title>
	<link rel="stylesheet" type="text/css" href="http://localhost/hms/styles/datepicker.css" />	
	<script language="javascript" type="text/javascript" src="http://localhost/hms/scripts/glDatePicker.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#complain_expected_date").glDatePicker(
			{
				onChange: function(target, newDate)
				{
					target.val
					(
						newDate.getDate() +	"/"+				
						(newDate.getMonth()+1) + "/" +
						newDate.getFullYear() 

					);
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

			$("#submit").click(function(event){
				filled=false;
				$( 'textarea,input' ).each( function(){
					filled=false;
					value =$(this).val();
					if(!(!value || /^\s*$/.test(value))){
						filled=true;
					}
				});
				if(filled){
					complain_expected_date =$("#complain_expected_date").val();
					complain_comment = $("#complain_comment").val();
					complain_handler = $("#complain_handler").val();
					complain_id = "<?php echo $complain['complain_id'];?>";
					if(!isValidEmailAddress(complain_handler))
					{
						alert("Complain handler's email id is not valid");												
					}else if (ValidateDate(complain_expected_date))
					{
						var today = new Date();
						var dd = today.getDate();
						var mm = today.getMonth()+1; //January is 0!
						var yyyy = today.getFullYear();
						today_date=dd+'/'+mm+'/'+yyyy;
						if(Date.parse(today_date) > Date.parse(complain_expected_date)){
							alert("Complain processing date should be in future");						
						}else{
							$.post("<?php echo base_url("complain/act_on_complain");?>",{complain_id:complain_id,complain_expected_date:complain_expected_date,complain_comment:complain_comment,complain_handler:complain_handler}, function(response){
								if(response == 'Successful'){
									alert('Action recorded');	
									window.location="<?php echo base_url('complain/view/view_complains');?>";
								}else{
									alert(response);
								}
							});
						}						
					}else{
						alert("Expected Date provided is not valid");
					}
				}else{
					alert('Please fill all (*) marked fields');
				}
			});
		});
	</script>
</head>
  <center>
  <h1>Act on complain</h1>
	<form>
		<table align="center" cellspacing="0" border="0">
		   <tbody>
			   <tr>
				<td  align="right">Sender:</td>
				<td  align="left">
					<input type="text" disabled="disabled"  id="complain_sender" value="<?php echo $complain['complain_sender'];?>" size="50" onfocus="alreadyFocused=true;">
				</td>
				</tr>
				<tr>
				<td  align="right">Subject:</td>
				<td  align="left">
					<input type="text" disabled="disabled"  id="complain_subject" value="<?php echo $complain['complain_description'];?>" size="100" onfocus="alreadyFocused=true;">
				</td>
			   </tr>
			   <tr>
				<td  align="right">Description:</td>
				<td  colspan="2">
					 &nbsp;&nbsp;<textarea disabled="disabled"  id="complain_description" rows="7" cols="76" wrap="virtual" onfocus="alreadyFocused=true;"><?php echo $complain['complain_subject'];?></textarea><br>
				  </td>
			   </tr>
			   <tr>
				<td  align="right">Date:</td>
				<td  align="left">
					<input type="text" disabled="disabled"  id="complain_date" value="<?php echo $complain['complain_timestamp'];?>" size="20" onfocus="alreadyFocused=true;">
				</td>
			   </tr>
			   <tr>
				<td  align="right">Handler(*):</td>
				<td  align="left">
					<input type="text" id="complain_handler" value="<?php echo $complain['complain_handler'];?>" size="50" onfocus="alreadyFocused=true;">
				</td>
			   </tr>
			   <tr>
				<td  align="right">Comments(*):</td>
				<td  colspan="2">
					 &nbsp;&nbsp;<textarea id="complain_comment" rows="7" cols="70" wrap="virtual" onfocus="alreadyFocused=true;"></textarea><br>
				  </td>
			   </tr>
			   <tr>
				<td  align="right" width="10%">Expected Date(*):</td>
				<td  align="left" width="90%">
					<input type="text" id="complain_expected_date"  size="10" onfocus="alreadyFocused=true;"><br>
				</td>
			   </tr>
		   </tbody>
		</table>
	</form>
	<div>
		<div id="submit" class="button">Submit</div>
  	</div>
  </center>
</body>
</html>
