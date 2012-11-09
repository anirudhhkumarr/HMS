<head>
	<meta charset="utf-8">
	<title>Hall Management System</title>
	<script>
		$(document).ready(function(){			
			$("#update").click(function(event){
				filled=false;
				$( 'textarea' ).each( function(){
					filled=false;
					value =$(this).val();
					if(!(!value || /^\s*$/.test(value))){
						filled=true;
					}
				});
				if(filled){
					update_uphoneno = $("#update_uphone").val();
					update_ulocaladdr = $("#update_ulocaladdr").val();
					update_uemail = $("#update_uemail").val();
					$.post("<?php echo base_url("user/update_personal_info");?>",{update_uphoneno:update_uphoneno,update_ulocaladdr:update_ulocaladdr,update_uemail:update_uemail}, function(response){
								if(response == 'Successful'){
									window.location="<?php echo base_url();?>";
								}else{
									alert(response);
								}
							});
					}
				else{
					alert('Please fill all (*) marked fields');
				}
			});
		});
	</script>
</head>
  <center>
	<h1>Update Personal Information</h1>
	Username:(*)<textarea type="text" disabled="disabled" id="update_uname"  cols="10" rows="1" maxlength="20" size="60"><?php echo $this->session->userdata('session_uname');?></textarea><br />
	Email:(*)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea  type="text" disabled="disabled" cols="10" rows="1" maxlength="50" id="update_uemail" size="50" ><?php echo $this->session->userdata('session_uemail');?></textarea><br />
	Role:(*)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea  type="text" disabled="disabled" cols="10" rows="1" maxlength="20" id="update_urole" ><?php echo $this->session->userdata('session_urole');?></textarea><br />
	Phone no:(*)<textarea  type="text" id="update_uphone" cols="10" rows="1" maxlength="20" size = "20" ><?php echo $this->session->userdata('session_uphoneno');?></textarea><br />
	Local Address:<textarea  type="text" id="update_ulocaladdr" cols="10" rows="3" maxlength="200" size="200"><?php echo $this->session->userdata('session_ulocaladdress');?></textarea><br />
	<div class="button_options">
		<div id="update" class="button">Update</div>
  	</div>
  </center>
</body>
</html>
