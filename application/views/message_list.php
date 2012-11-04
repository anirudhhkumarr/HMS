
<head>
       <title>Messages</title>
</head>
<body>
<center>
       <h1><?php echo $message_type; ?> Messages</h1>
       <?php 
       if(sizeof($messages) == 0){
           echo 'No messages<br>';
       }
       foreach($messages as $message){  
			if($message_type=='Recieved'){
				echo '<b>Sender: </b>'.$message['message_sender'];
			}else{
				echo '<br><b>Recipient: </b>'.$message['message_recipient'];
			}
			echo '<a href="'.base_url('message/view/message/'.$message['message_id']).'">';
				if ($message['message_status']==0 && $message_type=='Recieved'){
					echo '<br><b>Subject: '.$message['message_subject'].'</b>';
				}
				else{
					echo '<br><b>Subject: </b>'.$message['message_subject'];
				}
			echo '</a>';
            echo '<br>-------------------------------------<br>';
            
       }?>
</center>
</body>
</html>
