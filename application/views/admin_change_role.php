<head>
	<title>Hall Management System</title>
	<script>
		$(document).ready(function(){
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
				email= $("#email").val();
				role = $("#role").val();	
				if(!isValidEmailAddress(email)){
					$.post("<?php echo base_url("admin/change_role");?>",{email:email,role:role}, function(response){
						alert(response);
					});
				}else{
					alert('Email address is not valid');
				}
			});
		});
	</script>
</head>
	<span>Email Id: </span><textarea class="small" type="text" id="email" size="50"></textarea><br />	
	<span>New Role: </span><select id="role">
		  <option value=student>Student</option>
		  <option value=hec>HEC</option>
		  <option value=staff>Staff</option>
		  <option value=senate>Senate</option>
		  <option value=iwd>IWD</option>
		  <option value=warden>Warden</option>
		  <option value=dosa>DOSA</option>
		  
	      </select> <br />
	<div>
		<div id="submit" class="button">Change</div>
  	</div>
</body>
</html>
