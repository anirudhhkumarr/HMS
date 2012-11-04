<head>
	<title>Complains</title>
	<script>
		$(document).ready(function(){
		});
	</script>
</head>
  <center>
	<h1>Activities</h1>
        <?php if(sizeof($activities) == 0){
	    echo 'No activities<br>';
        }?>
        <?php foreach($activities as $activity){?>
			<a href="<?php echo base_url('activity/view/activity/'.$activity['activity_id']);?>">Subject:<?php echo $activity['activity_subject'];?></a>
			<br>--------------------------------------------------<br>
		<?php }?>
  </center>
</body>
</html>
