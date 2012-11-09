<!DOCTYPE html>
<html lang="en">
<head>
       <meta charset="utf-8">
       <title>Complains</title>
       <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
       <script>
               $(document).ready(function(){
               });
       </script>
</head>
<body>
<center>
		<?php
		echo 'Sender: '.$message['message_sender'];
		echo '<br>Recipient'.$message['message_recipient'];
		echo '<br>Subject: '.$message['message_subject'];
		echo '<br>Description: '.$message['message_description'];
       $data = array(
			'message_status' => 1
       );
       this->db->where('message_id'=$message['message_id']);
       this->db->update('hms_messages',$data);
       ?>
       <a href="<?php echo base_url();?>">Home</a>        
</center>
</body>
</html>
