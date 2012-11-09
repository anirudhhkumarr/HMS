<head>
       <title>Meeting</title>
       <script>
		$(document).ready(function(){
			$("#delete").click(function(event){
				meeting_id = "<?php echo $meeting["meeting_id"]; ?>";
				$.post("<?php echo base_url("meeting/delete_meeting");?>",{meeting_id:meeting_id}, function(response){					  
				    if(response=='Successful'){
				      window.location="<?php echo base_url() ;?>";
				    }else{
				      alert(response);
				    }
				});
			});
			$("#approve").click(function(event){
				meeting_id = "<?php echo $meeting["meeting_id"]; ?>";
				$.post("<?php echo base_url("meeting/approve_meeting");?>",{meeting_id:meeting_id}, function(response){					  
				    if(response=='Successful'){
				      window.location="<?php echo base_url() ;?>";
				    }else{
				      alert(response);
				    }
				});
			});
		});
	</script>
</head>
<body>
<center>
   <h1>Meeting</h1>
	<table  class="table1" width="100%" cellpadding="1" cellspacing="0" border="0" align="center">
		<tbody>
			<tr><td height="5" colspan="2" ></td></tr>
			<tr>
				<td align="center">
					<table width="100%" cellpadding="0" cellspacing="2" border="0" align="center" >
						<tbody>
							<tr>
								<td align="right" valign="top" width="20%"><b>Type:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $meeting['meeting_type'];?></td>
							</tr>
							<tr>
								<td align="right" valign="top" width="20%"><b>Proposer:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $meeting['meeting_proposer'];?></td>
							</tr>
							<tr>
								<td align="right" valign="top" width="20%"><b>Subject:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $meeting['meeting_subject'];?>;?></td>
							</tr>
							<tr>
								<td align="right" valign="top" width="20%"><b>Date:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $meeting['meeting_date'];?></td>
							</tr>
							<?php if($meeting['meeting_status']==1){?>
								<tr>
									<td align="right" valign="top" width="20%"><b>Status:&nbsp;&nbsp;</b></td>
									<td align="left" valign="top" width="80%">Approved</td>
								</tr>
							<? }elseif($meeting['meeting_status']==0){?>
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
				<td align="left"><br><pre><?php echo $meeting['meeting_description'];?></pre></td>
			</tr>
			<tr><td height="5" colspan="2" ></td></tr>
		</tbody>
	</table>
	<?php if($meeting['meeting_status']!=1 && ($this->session->userdata('session_urole')=='warden' || ($this->session->userdata('session_urole')=='hec' && $this->session->userdata('session_uemail')!=$meeting['meeting_proposer']))){
			echo '<br><a href="'.base_url("meeting/view/modify_meeting/".$meeting["meeting_id"]).'">';
			echo '<div class="modify_meeting_button button" id="modify_meeting_'.$meeting["meeting_id"].'">Modify</div>';
			echo '</a>';
			echo '<br><div id="delete" class="button">Delete</div>';
			if($this->session->userdata('session_urole')=='warden'){
				echo '<br><div id="approve" class="button">Approve</div>';
			}
		}
       ?>
</center>
</body>
</html>
