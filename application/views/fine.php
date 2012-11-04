
<head>
       <title>Fines</title>
       <script>
		$(document).ready(function(){
			$("#delete").click(function(event){
				fine_id = "<?php echo $fine["fine_id"]; ?>";
				$.post("<?php echo base_url("fine/delete_fine");?>",{fine_id:fine_id}, function(response){					  
				    if(response=='Successful'){
				      window.location="<?php echo base_url() ;?>";
				    }else{
				      alert(response);
				    }
				});
			});
			$("#approve").click(function(event){
				fine_id = "<?php echo $fine["fine_id"]; ?>";
				$.post("<?php echo base_url("fine/approve_fine");?>",{fine_id:fine_id}, function(response){					  
				    if(response=='Successful'){
				      window.location="<?php echo base_url() ;?>";
				    }else{
				      alert(response);
				    }
				});
			});
		});
	</script>
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
		if($fine['fine_status']!=1 && ($this->session->userdata('session_urole')=='warden' || ($this->session->userdata('session_urole')=='hec' && $this->session->userdata('session_uemail')!=$fine['fine_recipient']))){
			echo '<br><a href="'.base_url("fine/view/modify_fine/".$fine["fine_id"]).'">';
			echo '<div class="modify_fine_button button" id="modify_fine_'.$fine["fine_id"].'">Modify</div>';
			echo '</a>';
			echo '<br><div id="delete" class="button">Delete</div>';
			if($this->session->userdata('session_urole')=='warden'){
				echo '<br><div id="approve" class="button">Approve</div>';
			}
		}
		echo '<br>-------------------------------------<br>';
       ?>
</center>
</body>
</html>
