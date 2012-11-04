
<head>
       <title>Fines</title>
</head>
<body>
<center>
       <h1>Fines</h1>
       <h3>You are logged in as <?php echo $this->session->userdata('session_urole');?></h3>
       <?php 
       if(sizeof($fines) == 0){
           echo 'No fines<br>';
       }
       else{
		   foreach($fines as $fine){  
				echo '<b>Sender: </b>'.$fine['fine_sender'];
				echo '<br><b>Recipient: </b>'.$fine['fine_recipient'];
				echo '<a href="'.base_url('fine/view/fine/'.$fine['fine_id']).'">';
						echo '<br><b>Subject: </b>'.$fine['fine_subject'];
				echo '</a>';
				echo '<br>-------------------------------------<br>';
		   }   
       }?>
</center>
</body>
</html>
