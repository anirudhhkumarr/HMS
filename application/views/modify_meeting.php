<head>
	<meta charset="utf-8">
	<title>Hall Management System</title>
	<link rel="stylesheet" type="text/css" href="http://localhost/hms/styles/datepicker.css" />	
	<script language="javascript" type="text/javascript" src="http://localhost/hms/scripts/glDatePicker.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#meeting_date").glDatePicker(
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
					meeting_type = $("#meeting_type").val();
					meeting_id = "<?php echo $meeting['meeting_id'];?>";
					meeting_proposer = "<?php echo $this->session->userdata('session_uemail');?>";
					meeting_subject = $("#meeting_subject").val();
					meeting_description = $("#meeting_description").val();
					meeting_date = $("#meeting_date").val();
					if (ValidateDate(meeting_date))
					{
						var today = new Date();
						var dd = today.getDate();
						var mm = today.getMonth()+1; //January is 0!
						var yyyy = today.getFullYear();
						today_date=dd+'/'+mm+'/'+yyyy;
						if(Date.parse(today_date) > Date.parse(meeting_date)){
							alert("Meeting should date in future");						
						}else{
							$.post("<?php echo base_url("meeting/modify_meeting");?>",{meeting_id:meeting_id,meeting_proposer:meeting_proposer,meeting_type:meeting_type,meeting_subject:meeting_subject,meeting_description:meeting_description,meeting_date:meeting_date}, function(response){
								if(response == 'Successful'){
									alert('Meeting Modified');	
									window.location="<?php echo base_url('meeting/view/view_proposed_meetings');?>";
								}else{
									alert(response);
								}
							});
						}						
					}else{
						alert("Meeting Date provided are not valid");
					}
				}else{
					alert("Please fill all (*) marked fields");
				}
			});
		});
	</script>
</head>
<center>
	<h1>Propose Meeting</h1>
	<form>
		<table align="center" cellspacing="0" border="0">
		   <tbody>
			   <tr>
				<td  align="right" width="10%">Type:</td>
				<td  align="left" width="90%">
					<select id="meeting_type">
						<?php if($meeting['meeting_type']=='warden'){?>
							<option value="hec">HEC</option>
							<option value="warden" selected="selected">Warden</option>
						<?php }else{?>
							<option value="hec" selected="selected">HEC</option>
							<option value="warden" >Warden</option>
						<?php }?>
					</select>
				</td>
			   </tr>
			   <tr>
				<td  align="right">Subject:(*)</td>
				<td  align="left">
					<textarea id="meeting_subject" rows="3" maxlength="100" cols="10" wrap="virtual" onfocus="alreadyFocused=true;"></textarea><br>
				</td>
			   </tr>
			   <tr>
				<td  align="right">Description:(*)</td>
				<td  colspan="2">
					 &nbsp;&nbsp;<textarea id="meeting_description" maxlength="500" rows="20" cols="76" wrap="virtual" onfocus="alreadyFocused=true;"></textarea><br>
				  </td>
			   </tr>
			   <tr>
				<td  align="right" width="10%">Date(*)</td>
				<td  align="left" width="90%">
					<input type="text" id="meeting_date"  maxlength="10"size="10" onfocus="alreadyFocused=true;"><br>
				</td>
			   </tr>
		   </tbody>
		</table>
	</form>
	<div class="button_options">
		<div id="submit" class="button">Create</div>
  	</div>
	<br>
</center>
</body>
</html>
