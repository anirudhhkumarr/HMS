<head>
	<title>Requests</title>
	<script>
		$(document).ready(function(){
			$("#submit").click(function(event){
				$.post("<?php echo base_url("user/logout");?>",{}, function(){					  
				  location.reload();
				});
			});
			$(".reject_request").click(function(event){
				request_id = $(this).attr('id').replace('reject_request_','');
				$.post("<?php echo base_url("request/reject_request");?>",{request_id:request_id}, function(response){					  
				    if(response=='Successful'){
				      location.reload();  
				    }else{
				      alert(response);
				    }
				});
			});
			$(".approve_request").click(function(event){
				request_id = $(this).attr('id').replace('approve_request_','');
				$.post("<?php echo base_url("request/approve_request");?>",{request_id:request_id}, function(response){					  
				    if(response=='Successful'){
				      location.reload();  
				    }else{
				      alert(response);
				    }
				});
			});
		});
	</script>
</head>
  <center>
	<h1>Request</h1> 
	<table  class="table1" width="100%" cellpadding="1" cellspacing="0" border="0" align="center">
		<tbody>
			<tr><td height="5" colspan="2" ></td></tr>
			<tr>
				<td align="center">
					<table width="100%" cellpadding="0" cellspacing="2" border="0" align="center" >
						<tbody>
							<?php if($this->session->userdata('session_uemail')!= $request['request_sender']){?>
								<tr>
									<td align="right" valign="top" width="20%"><b>Sender:&nbsp;&nbsp;</b></td>
									<td align="left" valign="top" width="80%"><?php echo $request['request_sender'];?></td>
								</tr>
							<?php }?>
							<tr>
								<td align="right" valign="top" width="20%"><b>Subject:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $request['request_subject'];?></td>
							</tr>
							<tr>
								<td align="right" valign="top" width="20%"><b>Date:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $request['request_timestamp'];?></td>
							</tr>
							<?php if($request['request_status']==1){?>
								<tr>
									<td align="right" valign="top" width="20%"><b>Status:&nbsp;&nbsp;</b></td>
									<td align="left" valign="top" width="80%">Approved</td>
								</tr>
							<? }elseif($request['request_status']==0){?>
								<tr>
									<td align="right" valign="top" width="20%"><b>Status:&nbsp;&nbsp;</b></td>
									<td align="left" valign="top" width="80%">Pending</td>
								</tr>
							<?php }?>
						</tbody>
					</table>
				</td>
			</tr>
			<tr><td height="5" colspan="2" ></td></tr>
		</tbody>
	</table>
	<table class="table2" width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
		<tbody>
			<tr>
				<td align="left"><br><pre><?php echo $request['request_description'];?></pre></td>
			</tr>
			<tr><td height="5" colspan="2" ></td></tr>
		</tbody>
	</table>
	<?php if($request['request_status'] == 0 && ($this->session->userdata('session_ustaff_privilege')== '1' || $this->session->userdata('session_urole')== 'warden' || $this->session->userdata('session_urole')== 'dosa')){?>
			<br><br><div class="approve_request button" id="approve_request_<?php echo $request['request_id'];?>">Approve</div>
			<br><br><div class="reject_request button" id="reject_request_<?php echo $request['request_id'];?>">Reject</div>
	<?php }?>
	</center>

</body>
</html>
