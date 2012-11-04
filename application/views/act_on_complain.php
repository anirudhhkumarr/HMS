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
					complain_expected_date = $("#complain_expected_date").val();
					complain_comment = $("#complain_comment").val();
					complain_handler = $("#complain_handler").val();
					complain_id = "<?php echo $complain['complain_id'];?>";
					var expected_timestamp=Date.parse(complain_expected_date);
					if (!isNaN(expected_timestamp))
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
	Subject:(*)<textarea class="medium"type="text" disabled="disabled" id="complain_subject"  size="100"><?php echo $complain['complain_subject'];?></textarea><br />
	Description:(*)  <textarea class="large" type="text" disabled="disabled" id="complain_description" size="500" ><?php echo $complain['complain_description'];?></textarea><br />
	Complain date:(*) 	<textarea class="small" type="text" disabled="disabled" id="complain_date" ><?php echo $complain['complain_timestamp'];?></textarea><br />
	Expected date:(*)	<textarea class="small" type="text" id="complain_expected_date"></textarea><br />
	Comment:(*)	<textarea class="large" type="text" id="complain_comment" size="200"></textarea><br />
	Handler:(*)  <textarea class="large" type="text" id="complain_handler" size="500"></textarea><br />
	<div>
		<div id="submit" class="button">Submit</div>
  	</div>
  </center>
</body>
</html>
