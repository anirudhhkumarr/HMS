<head>
	<title>Complains</title>
	<script>
		$(document).ready(function(){
			$("#submit").click(function(event){
				$.post("<?php echo base_url("user/logout");?>",{}, function(){					  
				  location.reload();
				});
			});
			$(".reject_complain").click(function(event){
				complain_id = $(this).attr('id').replace('reject_complain_','');
				$.post("<?php echo base_url("complain/reject_complain");?>",{complain_id:complain_id}, function(response){					  
				    if(response=='Successful'){
				      location.reload();  
				    }else{
				      alert(response);
				    }
				});
			});
		});
	</script>
</head>
  <center>
	<h1>Complain</h1>
	    <span>Subject:<?php echo $complain['complain_subject'];?></span>
	    <br><span>Description:<?php echo $complain['complain_description'];?></span>
	    <br><span>Timestamp: <?php echo$complain['complain_timestamp'];?></span>
    	<br><span>Handler: <?php echo $complain['complain_handler'];?></span>
	    <br><span>Comments: <?php echo $complain['complain_comments'];?></span>
	    <br><span>Expected date: <?php echo $complain['complain_expected_date'];?></span>
	    <br>
		<?php if($complain['complain_status'] == '0'&& $this->session->userdata('session_urole')== 'staff'){?>
			<br><a href="<?php echo base_url('complain/view/act_on_complain/'.$complain['complain_id']);?>">
					<div class="act_on_complain button" id="act_on_complain_<?php echo $complain['complain_id'];?>">Act</div>
				</a>
				<br><br><div class="reject_complain button" id="reject_complain_<?php echo $complain['complain_id'];?>">Reject</div>
	    <?php }elseif($complain['complain_status'] == '0'&& $this->session->userdata('session_urole')== 'student'){?>
			<div class="complain" id="complain_<?php echo $complain['complain_id'];?>">Pending</div>
	    <?php }elseif($complain['complain_status'] == '-1'){?>
			<div class="reject_complain" id="reject_complain_<?php echo $complain['complain_id'];?>">Rejected</div>
	    <?php }elseif($complain['complain_status'] == '1' && $this->session->userdata('session_urole')=='student'){?>
			<br><div class="act_on_complain" id="act_on_complain_'.$complain['complain_id'].'">Action taken</div>
	    <?php }else{?>
			<br><a href="<?php echo base_url('complain/view/act_on_complain/'.$complain['complain_id']);?>">
					<div class="act_on_complain button" id="act_on_complain_<?php echo $complain['complain_id'];?>">Act</div>
				</a>
	    <?php }?>
	    <br>
	    <br>--------------------------------------------------<br>
  </center>
</body>
</html>
