
<head>
       <title>Fines</title>
       <script>
		$(document).ready(function(){
			$("#delete").click(function(event){
				fine_id = "<?php echo $fine["fine_id"]; ?>";
				$.post("<?php echo base_url("fine/delete_fine");?>",{fine_id:fine_id}, function(response){					  
				    if(response=='Successful'){
				      window.location="<?php echo base_url() ;?>";
				    }else{
				      alert(response);
				    }
				});
			});
			$("#approve").click(function(event){
				fine_id = "<?php echo $fine["fine_id"]; ?>";
				$.post("<?php echo base_url("fine/approve_fine");?>",{fine_id:fine_id}, function(response){					  
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
   <h1>Fine</h1>
	<table  width="100%" cellpadding="1" cellspacing="0" border="0" align="center">
		<tbody>
			<tr><td height="5" colspan="2" ></td></tr>
			<tr>
				<td align="center">
					<table width="100%" cellpadding="0" cellspacing="2" border="0" align="center" bgcolor="#dcdcdc">
						<tbody>
							<tr>
								<td align="right" valign="top" width="20%"><b>Recipient:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $fine['fine_recipient'];?></td>
							</tr>
							<tr>
								<td align="right" valign="top" width="20%"><b>Sender:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $fine['fine_sender'];?></td>
							</tr>
							<tr>
								<td align="right" valign="top" width="20%"><b>Subject:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $fine['fine_subject'];?>;?></td>
							</tr>
							<tr>
								<td align="right" valign="top" width="20%"><b>Amount:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $fine['fine_amount'];?></td>
							</tr>
							<tr>
								<td align="right" valign="top" width="20%"><b>Date:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $fine['fine_timestamp'];?></td>
							</tr>
							<?php if($fine['fine_status']==1){?>
								<tr>
									<td align="right" valign="top" width="20%"><b>Status:&nbsp;&nbsp;</b></td>
									<td align="left" valign="top" width="80%">Approved</td>
								</tr>
							<? }elseif($fine['fine_status']==0){?>
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
	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
		<tbody>
			<tr>
				<td align="left"><br><pre><?php echo $fine['fine_description'];?></pre></td>
			</tr>
			<tr><td height="5" colspan="2" ></td></tr>
		</tbody>
	</table>
	<?php if($fine['fine_status']!=1 && ($this->session->userdata('session_urole')=='warden' || ($this->session->userdata('session_urole')=='hec' && $this->session->userdata('session_uemail')!=$fine['fine_recipient']))){
			echo '<br><a href="'.base_url("fine/view/modify_fine/".$fine["fine_id"]).'">';
			echo '<div class="modify_fine_button button" id="modify_fine_'.$fine["fine_id"].'">Modify</div>';
			echo '</a>';
			echo '<br><div id="delete" class="button">Delete</div>';
			if($this->session->userdata('session_urole')=='warden'){
				echo '<br><div id="approve" class="button">Approve</div>';
			}
		}
		echo '<br>-------------------------------------<br>';
       ?>
</center>
</body>
</html>
