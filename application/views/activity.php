<head>
	<meta charset="utf-8">
	<title>Activities</title>
	<script>
		$(document).ready(function(){
			$(".delete_activity").click(function(event){
				activity_id = $(this).attr('id').replace('delete_activity_','');
				$.post("<?php echo base_url("activity/delete_activity");?>",{activity_id:activity_id}, function(response){					  
				    if(response=='Successful'){
						alert('Activity deleted');
						window.location="<?php echo base_url('activity/view/view_activities');?>";
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
	<h1>Activity</h1>
	<table  width="100%" cellpadding="1" cellspacing="0" border="0" align="center">
		<tbody>
			<tr><td height="5" colspan="2" ></td></tr>
			<tr>
				<td align="center">
					<table width="100%" cellpadding="0" cellspacing="2" border="0" align="center" bgcolor="#dcdcdc">
						<tbody>
							<tr>
								<td align="right" valign="top" width="20%"><b>Type:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $activity['activity_type'];?></td>
							</tr>
							<tr>
								<td align="right" valign="top" width="20%"><b>Subject:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $activity['activity_subject'];?></td>
							</tr>
							<tr>
								<td align="right" valign="top" width="20%"><b>Start Date:&nbsp;&nbsp;</b></td>
								<td align="left" valign="top" width="80%"><?php echo $activity['activity_startdate'];?></td>
							</tr>
							<tr>
								<td align="right" valign="top" width="20%"><b>End Date</b></td>
								<td align="left" valign="top" width="80%"><?php echo $activity['activity_enddate'];?></td>
							</tr>
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
				<td align="left"><br><pre><?php echo $activity['activity_description'];?></pre></td>
			</tr>
			<tr><td height="5" colspan="2" ></td></tr>
		</tbody>
	</table>
		<?php if($this->session->userdata('session_urole')=='hec'){?>
			<br>
			<br>
			<a href="<?php echo base_url("activity/view/modify_activity/".$activity['activity_id']);?>">
				<div class="modify_activity button" id="modify_activity_<?php echo $activity['activity_id'];?>">Modify</div>
			</a>
			<br>
			<div class="delete_activity button" id="delete_activity_<?php echo $activity['activity_id'];?>">Delete</div>
		<?php }?>
		<br>--------------------------------------------------<br>
  </center>
</body>
</html>
