
<head>
       <title>Fines</title>
</head>
<body>
<center>
       <h1>Fine</h1>
       <?php 
		echo '<b>Sender: </b>'.$fine['fine_sender'];
		echo '<br><b>Recipient: </b>'.$fine['fine_recipient'];
		echo 'Subject:'.$fine['fine_subject'];
		echo '<br>Description:'.$fine['fine_description'];
		echo '<br>Amount:'.$fine['fine_amount'];
		echo '<br>Timestamp:'.$fine['fine_timestamp'];

		echo '<a href="'.base_url('fine/view/fine/'.$fine['fine_id']).'">';
				echo '<br><b>Subject: </b>'.$fine['fine_subject'];
		echo '</a>';
		echo '<br>-------------------------------------<br>';
       ?>
</center>
</body>
</html>
