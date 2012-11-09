<head>
	<title>Complains</title>
	<script>
		$(document).ready(function(){
		});
	</script>
</head>
	<h1>Complains</h1>
	<?php if(sizeof($complains) == 0){
		echo 'No complains<br>';
	}else{
		foreach($complains as $complain){?>
			<tr valign="top">
				<a href="<?php echo base_url('complain/view/complain/'.$complain['complain_id']);?>">Subject:<?php echo $complain['complain_subject'];?></a>
					<td  align="left"><?php $complain['complain_subject'];?></td>
				</a>
				<td  align="center" nowrap=""><b><small>&nbsp;</small></b></td>				
				<td  align="left" title="<?php echo $complain['complain_sender'];?>"><label for="msg976"><?php echo $complain['complain_sender'];?></label></td>
			</tr>
			<br>--------------------------------------------------<br>
	<?php } }?>
</body>
</html>

