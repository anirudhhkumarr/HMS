
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
					fine_sender = "<?php echo $this->session->userdata('session_uemail');?>";
					fine_recipient = $("#fine_recipient").val();
					fine_subject = $("#fine_subject").val();
					fine_description = $("#fine_description").val();
					fine_amount = $("#fine_amount").val();
					if ((/^\d*$/.test(fine_amount)))
					{
						$.post("<?php echo base_url("fine/propose_fine");?>",{fine_sender:fine_sender,fine_recipient:fine_recipient,fine_subject:fine_subject,fine_description:fine_description,fine_amount:fine_amount}, function(response){
							if(response == 'Successful'){
								alert('fine created');	
								window.location="<?php echo base_url('fine/view/view_fines');?>";
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
	<h1> Propose Fine</h1>
	Person to Fine : (*)<textarea type="text" id="fine_recipient"></textarea><br />
	Fine Subject:(*) 	<textarea class="medium" type="text" id="fine_subject" size="100"></textarea><br />
	Fine Description:(*)  <textarea class="large" type="text" id="fine_description" size="500"></textarea><br />
	Fine Amount(INR):(*) 	<textarea type="text" id="fine_amount"></textarea><br />
	<div>
		<div id="submit" class="button">Create</div>
  	</div>
</body>
</html>
