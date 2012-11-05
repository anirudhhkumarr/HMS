
<head>
       <title>Messages</title>
</head>
<body>
<center>
       <h1><?php echo $message_type; ?> Messages</h1>
       <?php 
       if(sizeof($messages) == 0){
           echo 'No messages<br>';
       }else{
			foreach($messages as $message){?> 
				<tr valign="top">
					<?php if($message_type=='Recieved'){?>
						<td  align="left" title="<?php echo $message['message_sender'];?>"><label for="msg976"><?php echo $message['message_sender'];?></label></td>
					<?php }else{?>
						<td  align="left" title="<?php echo $message['message_recipient'];?>"><label for="msg976"><?php echo $message['message_recipient'];?></label></td>
					<?php }?>
					<td  align="left">
						<a href="<?php echo base_url('message/view/message/'.$message['message_id']);?>">
							<?php if ($message['message_status']==0 && $message_type=='Recieved'){?>
								<b><?php echo $message['message_subject'];?></b>
							<?php }else{?>
								<?php echo $message['message_subject'];?>
							<?php }?>
						</a>
					</td>
				</tr>
				<br>-------------------------------------<br>
			<?php } }?>  
</center>
</body>
</html>
