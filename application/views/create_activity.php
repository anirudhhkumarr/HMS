<head>
	<meta charset="utf-8">
	<title>Hall Management System</title>
	<link rel="stylesheet" type="text/css" href="http://localhost/hms/styles/datepicker.css" />	
	<script language="javascript" type="text/javascript" src="http://localhost/hms/scripts/glDatePicker.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#activity_start,#activity_end").glDatePicker(
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
					alert('here');
					activity_type = $("#activity_type").val();
					activity_subject = $("#activity_subject").val();
					activity_description = $("#activity_description").val();
					activity_start = $("#activity_start").val();
					activity_end = $("#activity_end").val();
					var start_timestamp=Date.parse(activity_start);
					var end_timestamp=Date.parse(activity_start);
					valid=false;
					if (!isNaN(start_timestamp)&&!isNaN(start_timestamp))
					{
						var today = new Date();
						var dd = today.getDate();
						var mm = today.getMonth()+1; //January is 0!
						var yyyy = today.getFullYear();
						today_date=dd+'/'+mm+'/'+yyyy;
						if(Date.parse(today_date) > Date.parse(activity_start)){
							alert("Activity should start in future");						
						}
						else if(Date.parse(activity_start) > Date.parse(activity_end)) {	
							alert("Start Date of activity cannot be after End Date!");
						}else{
							$.post("<?php echo base_url("activity/create_activity");?>",{activity_type:activity_type,activity_subject:activity_subject,activity_description:activity_description,activity_start:activity_start,activity_end:activity_end}, function(response){
								if(response == 'Successful'){
									alert('Activity created');	
									window.location="<?php echo base_url('activity/view/view_activities');?>";
								}else{
									alert(response);
								}
							});
						}						
					}else{
						alert("Dates provided are not valid");
					}
				}else{
					alert("Please fill all (*) marked fields");
				}
			});
		});
	</script>
</head>
	<h1>Create Activity</h1>
	<form>
		<table align="center" cellspacing="0" border="0">
		   <tbody>
			   <tr>
				<td  align="right" width="10%">Type:(*)</td>
				<td  align="left" width="90%">
					<input type="text" id="activity_type"  size="60" onfocus="alreadyFocused=true;"><br>
				</td>
			   </tr>
			   <tr>
				<td  align="right">Subject:(*)</td>
				<td  align="left">
					<input type="text" id="activity_subject"  size="100" onfocus="alreadyFocused=true;">
				</td>
			   </tr>
			   <tr>
				<td  align="right">Description:(*)</td>
				<td  colspan="2">
					 &nbsp;&nbsp;<textarea id="activity_description" rows="20" cols="76" wrap="virtual" onfocus="alreadyFocused=true;"></textarea><br>
				  </td>
			   </tr>
			   <tr>
				<td  align="right" width="10%">Start Date(*)</td>
				<td  align="left" width="90%">
					<input type="text" id="activity_start"  size="10" onfocus="alreadyFocused=true;"><br>
				</td>
			   </tr>
			   <tr>
				<td  align="right" width="10%">End Date(*)</td>
				<td  align="left" width="90%">
					<input type="text" id="activity_end" size="10" onfocus="alreadyFocused=true;"><br>
				</td>
			   </tr>
		   </tbody>
		</table>
	</form>
	<div>
		<div id="submit" class="button">Create</div>
  	</div>
</body>
</html>
