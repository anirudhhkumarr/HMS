<head>
	<title>Register Complain</title>
	<script>
		$(document).ready(function(){
			$("#submit").click(function(event){
				subject = $("#subject").val();
				description = $("#description").val();
				if(!subject || /^\s*$/.test(subject)){
					alert('Please give a subject to your complain');
				}
				else if(!description || /^\s*$/.test(description)){
					alert('Please give description of your complain');
				}else{
					$.post("<?php echo base_url("complain/register_complain");?>",{subject:subject,description:description}, function(response){
						if(response=='Successful'){
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
		<h1>Register Complain</h1>
		<span>Subject: <textarea class="medium" type="text" id="subject" size="100"></textarea><br />	
		<span>Description: <textarea class="large" type="text" id="description" size="500"></textarea><br />
		<div id="submit" class="button">Submit</button>
		</div>
    <center>
  </body>
</html>
