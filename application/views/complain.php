<head>
	<title>Complain</title>
	<script>
		$(document).ready(function(){
			$(".reject_complain").click(function(event){
				complain_id = $(this).attr('id').replace('reject_complain_','');
				$.post("<?php echo base_url("complain/reject_complain");?>",{complain_id:complain_id}, function(response){					  
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
		<h1>Complain</h1>
		<table  class="table1" width="100%" cellpadding="1" cellspacing="0" border="0" align="center">
			<tbody>
				<tr><td height="5" colspan="2" ></td></tr>
				<tr>
					<td align="center">
						<table  width="100%" cellpadding="0" cellspacing="2" border="0" align="center" >
							<tbody>
								<tr>
									<td align="right" valign="top" width="20%"><b>From:&nbsp;&nbsp;</b></td>
									<td align="left" valign="top" width="80%"><?php echo $complain['complain_sender'];?>?></td>
								</tr>
								<tr>
									<td align="right" valign="top" width="20%"><b>Subject:&nbsp;&nbsp;</b></td>
									<td align="left" valign="top" width="80%"><?php echo $complain['complain_subject'];?></td>
								</tr>
								<tr>
									<td align="right" valign="top" width="20%"><b>Date:&nbsp;&nbsp;</b></td>
									<td align="left" valign="top" width="80%"><?php echo $complain['complain_timestamp'];?></td>
								</tr>
							<?php if($complain['complain_status']=='1'){?>
								<tr>
									<td align="right" valign="top" width="20%"><b>Handler:&nbsp;&nbsp;</b></td>
									<td align="left" valign="top" width="80%"><?php echo $complain['complain_handler'];?></td>
								</tr>
								<tr>
									<td align="right" valign="top" width="20%"><b>Comments:&nbsp;&nbsp;</b></td>
									<td align="left" valign="top" width="80%"><?php echo $complain['complain_comments'];?></td>
								</tr>
								<tr>
									<td align="right" valign="top" width="20%"><b>Expected date:&nbsp;&nbsp;</b></td>
									<td align="left" valign="top" width="80%"><?php echo $complain['complain_expected_date'];?></td>
								</tr>
							<?php }elseif($complain['complain_status']=='-1'){?>
								<tr>
									<td align="right" valign="top" width="20%"><b>Status:&nbsp;&nbsp;</b></td>
									<td align="left" valign="top" width="80%">Rejected</td>
								</tr>
							<?php }else{?>
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
					<td align="left"><br><pre><?php echo $complain['complain_description'];?></pre></td>
				</tr>
				<tr><td height="5" colspan="2" ></td></tr>
			</tbody>
		</table>
	    <br>
		<?php if($complain['complain_status'] == '0'&& $this->session->userdata('session_urole')== 'staff' && $this->session->userdata('session_ustaff_privilege')== '1'){?>
			<br><a href="<?php echo base_url('complain/view/act_on_complain/'.$complain['complain_id']);?>">
					<div class="act_on_complain button" id="act_on_complain_<?php echo $complain['complain_id'];?>">Act</div>
				</a>
				<br><br><div class="reject_complain button" id="reject_complain_<?php echo $complain['complain_id'];?>">Reject</div>
	    <?php }?>
	    <br>
  </center>
</body>
</html>
