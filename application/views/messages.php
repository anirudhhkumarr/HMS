<!DOCTYPE html>
<html lang="en">
<head>
       <meta charset="utf-8">
       <title>Complains</title>
       <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
       <script>
               $(document).ready(function(){
                       $("#submit").click(function(event){
                               $.post("<?php echo base_url("user/logout");?>",{}, function(){                                          
                                 location.reload();
                               });
                       });

               });
       </script>
</head>
<body>
<center>
	   <h1><?php echo $messages_type; ?> Messages</h1>
       <h3>You are logged in as <?php echo $this->session->userdata('session_urole');?></h3>
       <?php if(sizeof($messages) == 0){
           echo 'No messages<br>';
       }
       foreach($messages as $message){		   
			echo 'Sender: '.$message['message_sender'];
			if ($message['message_status']==0){
				echo '<br><b>Subject: '.$message['message_subject'].'</b>';
			}
			else{
				echo '<br>Subject: '.$message['message_subject'];
			}
			echo '<br>Description: '.$message['message_description'];
			echo '<br>------------------------------------------------<br>';
       }?>
       <a href="<?php echo base_url();?>">Home</a>        
</center>
</body>
</html>
