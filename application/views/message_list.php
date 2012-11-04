
<!DOCTYPE html>
<html lang="en">
<head>
       <meta charset="utf-8">
       <title>Messages</title>
       <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
</head>
<body>
<center>
       <h1><?php echo $messages_type; ?> Messages</h1>
       <h3>You are logged in as <?php echo $this->session->userdata('session_urole');?></h3>
       <?php 
       if(sizeof($messages) == 0){
           echo 'No messages<br>';
       }
       function read_message($data){
			$this->load->view("messages",$data);
		}
       foreach($messages as $message){  
            echo '<b>Sender: </b>'.$message['message_sender'];
            echo '<br><b>Recipient: </b>'.$message['message_recipient'];
            $data['message'] = $message;
            if ($message['message_status']==0){
                echo '<br><b>Subject: '.$message['message_subject'].'</b>';
            }
            else{
                echo '<br><b>Subject: </b>'.$message['message_subject'];
            }
            echo '<br><input value="Read" type="button" onclick="read_message($data)">';
            echo '<br>-------------------------------------<br>';
            
       }?>
       <a href="<?php echo base_url();?>">Home</a>        
</center>
</body>
</html>
