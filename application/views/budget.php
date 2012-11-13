
<head>
       <title>Budgets</title>
       <script>
		$(document).ready(function(){
			$("#delete").click(function(event){
				budget_id = "<?php echo $budget["budget_id"]; ?>";
				$.post("<?php echo base_url("budget/delete_budget");?>",{budget_id:budget_id}, function(response){					  
				    if(response=='Successful'){
				      window.location="<?php echo base_url() ;?>";
				    }else{
				      alert(response);
				    }
				});
			});
			$("#approve").click(function(event){
				budget_id = "<?php echo $budget["budget_id"]; ?>";
				$.post("<?php echo base_url("budget/approve_budget");?>",{budget_id:budget_id}, function(response){					  
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
   <h1>budget</h1>
	<table  class="table1" width="100%" cellpadding="1" cellspacing="0" border="0" align="center">
		<tbody>
			<tr><td height="5" colspan="2" ></td></tr>
			<tr>
				<td align="center">
					<table width="100%" cellpadding="0" cellspacing="2" border="0" align="center" >
						<tbody>
							<tr>
								<td align="right" valign="top" width="20%"><b>Recipient:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $budget['budget_recipient'];?></td>
							</tr>
							<tr>
								<td align="right" valign="top" width="20%"><b>Proposed By:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $budget['budget_sender'];?></td>
							</tr>
							<tr>
								<td align="right" valign="top" width="20%"><b>Subject:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $budget['budget_subject'];?></td>
							</tr>
							<tr>
								<td align="right" valign="top" width="20%"><b>Amount:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $budget['budget_amount'];?></td>
							</tr>
							<tr>
								<td align="right" valign="top" width="20%"><b>Date:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $budget['budget_timestamp'];?></td>
							</tr>
							<?php if($budget['budget_status']==1){?>
								<tr>
									<td align="right" valign="top" width="20%"><b>Status:&nbsp;&nbsp;</b></td>
									<td align="left" valign="top" width="80%">Approved</td>
								</tr>
							<? }elseif($budget['budget_status']==0){?>
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
				<td align="left"><br><pre><?php echo $budget['budget_description'];?></pre></td>
			</tr>
			<tr><td height="5" colspan="2" ></td></tr>
		</tbody>
	</table>
	<?php if($budget['budget_status']!=1 && ($this->session->userdata('session_urole')=='warden' || $this->session->userdata('session_urole')=='hec')){
			echo '<br><a href="'.base_url("budget/view/modify_budget/".$budget["budget_id"]).'">';
			echo '<div class="modify_budget_button button" id="modify_budget_'.$budget["budget_id"].'">Modify</div>';
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
