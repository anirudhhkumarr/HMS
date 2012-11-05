	<h1>Activities</h1>
		<?php if(sizeof($activities) == 0){
		echo 'No activities<br>';
		}?>
	<tr valign="top">
		<?php foreach($activities as $activity){?>
			<tr valign="top">
				<a href="<?php echo base_url('activity/view/activity/'.$activity['activity_id']);?>">Subject:<?php echo $activity['activity_subject'];?>
					<td  align="left"><?php echo $activity['activity_subject'];?></td>
				</a>
			</tr>
			<br>--------------------------------------------------<br>
		<?php }?>
	</tr>
</body>
</html>