<!DOCTYPE html>
<html lang="en">
<head>
       <meta charset="utf-8">
       <title>Message</title>
       <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
       <script>
               $(document).ready(function(){
               });
       </script>
</head>
<center>
		<?php
		echo 'Sender: '.$message['message_sender'];
		echo '<br>Recipient'.$message['message_recipient'];
		echo '<br>Subject: '.$message['message_subject'];
		echo '<br>Description: '.$message['message_description'];
       ?>    
</center>
</body>
</html>
