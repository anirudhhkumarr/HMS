<head>
	<title>Hall Management System</title>
	<script>
		$(document).ready(function(){
			$("#submit").click(function(event){
				email= $("#email").val();
				role = $("#role").val();	
				$.post("<?php echo base_url("admin/create_role");?>",{email:email,role:role}, function(response){
					alert(response);
				});
			});
		});
	</script>
</head>
	<span>Email Id:</span> <textarea class="small" type="text" id="email" size="50"></textarea><br />	
	<span>Role: </span><select id="role">
		  <option value=student>Student</option>
		  <option value=hec>HEC</option>
		  <option value=staff>Staff</option>
		  <option value=senate>Senate</option>
		  <option value=iwd>IWD</option>
		  <option value=warden>Warden</option>
		  <option value=dosa>DOSA</option>
		  
	      </select> <br />
	<div>
		<div id="submit" class="button">Create</div>
  	</div>
	</div>
</body>
</html>
