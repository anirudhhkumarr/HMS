<head>
  <title>Hall Managment System</title>
</head>
<script>
	$(document).ready(function(){
		$("#login").click(function(event){
			username = $("#username").val();
			password = $("#password").val();
			if(!username || /^\s*$/.test(username)){
				alert('Please enter username');
			}else if(!password || /^\s*$/.test(password)){ 
				alert('Please enter password');			
			}else{
				$.post("<?php echo base_url("user/login");?>",{username:username,password:password}, function(response){
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
      <div id="login_form">
	  <span>Username:</span> <input type="text" id="username" size="15" /><br />	
	  <span>Password:</span> <input type="password" id="password" size="15" /><br />
	  <div id="login" class="button">Login</div>
      </div>
    </div>
  </body>
</html>
