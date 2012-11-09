<head>
	<title>Make Request</title>
	<script>
		$(document).ready(function(){
			$("#submit").click(function(event){
				subject = $("#subject").val();
				description = $("#description").val();
				reciever = $("#reciever").val();
				if(!subject || /^\s*$/.test(subject)){
					alert('Please give a subject to your request');
				}
				else if(!description || /^\s*$/.test(description)){
					alert('Please give description of your request');
				}else{
					$.post("<?php echo base_url("request/make_request");?>",{subject:subject,description:description,reciever:reciever}, function(response){
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
		<h1>Make Request</h1>
		<table align="center" cellspacing="0" border="0">
		   <tbody>
			   <tr>
				<td  align="right" width="10%">To:</td>
				<td  align="left" width="90%">
					<select id="reciever">
						<option value=staff>Staff</option>
						<option value=warden>Warden</option>
						<option value=dosa>DOSA</option>
					</select>
				</td>
			   </tr>
			   <tr>
				<td  align="right">Subject:</td>
				<td  align="left">
					&nbsp;&nbsp;<textarea id="subject" rows="3" cols="10" maxlength="100" wrap="virtual" onfocus="alreadyFocused=true;"></textarea><br>
				</td>
			   </tr>
			   <tr>
				<td  align="right">Description:</td>
				<td  colspan="2">
					 &nbsp;&nbsp;<textarea id="description" rows="20" maxlength="500" cols="76" wrap="virtual" onfocus="alreadyFocused=true;"></textarea><br>
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
