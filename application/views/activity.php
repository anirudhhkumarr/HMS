<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Complains</title>
	<script src="http://localhost/hms/scripts/jquery.min.js"></script>
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
	    <span>Subject:<?php echo $activity['activity_subject'];?></span>
	    <br><span>Description:<?php echo $activity['activity_description'];?></span>
	    <br><span>Start date:<?php echo $activity['activity_startdate'];?></span>
	    <br><span>End date<?php echo $activity['activity_enddate'];?></span>
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
