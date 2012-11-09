	<h1>Meetings</h1>
		<?php if(sizeof($meetings) == 0){
		echo 'No meetings<br>';
		}?>
	<tr valign="top">
		<?php foreach($meetings as $meeting){?>
			<tr valign="top">
				<a href="<?php echo base_url('meeting/view/meeting/'.$meeting['meeting_id']);?>">
					<td  align="left"><?php echo $meeting['meeting_subject'];?></td>
				</a>
			</tr>
			<br>--------------------------------------------------<br>
		<?php }?>
	</tr>
</body>
</html>