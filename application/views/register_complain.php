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
		<form>
			<table align="center" cellspacing="0" border="0">
			   <tbody>
				   <tr>
					<td  align="right">Subject:</td>
					<td  align="left">
						<input type="text"  id="subject" value="" size="100" onfocus="alreadyFocused=true;">
					</td>
				   </tr>
				   <tr>
					<td  align="right">Description:</td>
					<td  colspan="2">
						 &nbsp;&nbsp;<textarea  id="description" rows="20" cols="76" wrap="virtual" onfocus="alreadyFocused=true;"></textarea><br>
					  </td>
				   </tr>
				</tbody>
			</table>
		</form>
		<div id="submit" class="button">Submit</button>
		</div>
    <center>
  </body>
</html>
