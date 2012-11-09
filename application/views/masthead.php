<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link href="http://localhost/hms/styles/common.css" rel="stylesheet" type="text/css">
  <script src="http://localhost/hms/scripts/jquery.min.js"></script>
  <script>
	$(document).ready(function(){
		$('.header_options').mouseover(function(){
		  id = $(this).attr('id').replace('_options','');
		  $('.header_sub_options').addClass('hidden');
		  $('#'+id+'_sub_options').removeClass('hidden');
		});
		$('.header_options').mouseout(function(){
		  $('.header_sub_options').addClass('hidden');		  
		});
		$("#logout").click(function(event){
			$.post("<?php echo base_url("user/logout");?>",{}, function(){					  
					window.location="<?php echo base_url();?>";
			});
		});
	});
  </script>
</head>
<body>
<div id="main-wraper">
    <div id="banner">Hall Management System </div>
    <?php if($this->session->userdata('session_uemail') != ''){?>
      <div id="nav">
	<ul>
	  <li><a href="<?php echo base_url();?>"><div class="header_options">Home</div></a></li>
	  <li><div  id="activity_options" class="header_options">
		<div id="activity">Activity</div>
		<div id="activity_sub_options" class="header_sub_options hidden">
		    <a href="<?php echo base_url('activity/view/view_activities');?>">
				<div class="header_sub_option" id="view_activities">View activities</div>
		    <a>
			<?php if($this->session->userdata('session_urole') == 'hec'){?>
				<a href="<?php echo base_url('activity/view/create_activity');?>">
					<div class="header_sub_option" id="create_activity">Create activity</div>
				</a>
			<?php }?>
		</div>
	      </div>
	  </li>
	  <li><div id="complain_options" class="header_options" >
			<div id="complain"><?php 
				      if($notifications['no_complains']>0){
					    echo "Complain(".$notifications['no_complains'].")";
				      }
				      else{
					  echo "Complain";
				      }
			
			?></div>
			<div id="complain_sub_options" class="header_sub_options hidden">
				<?php if($this->session->userdata('session_urole')=='student' ||$this->session->userdata('session_urole')=='hec'){?>
				  <a href="<?php echo base_url('complain/view/register_complain');?>">
					<div class="header_sub_option" id="register_complain">Register complain</div>
				  </a>
				<?php }?>
				<a href="<?php echo base_url('complain/view/view_complains');?>">
					<div class="header_sub_option" id="view_complains">View complains</div>
				</a>
			</div>
		</div>
	  </li>
	  <li><div id="message_options" class="header_options">
		<div id="message"><div id="message"><?php 
				      if($notifications['no_messages']>0){
					    echo "Message(".$notifications['no_messages'].")";
				      }
				      else{
					  echo "Message";
				      }
			
			?></div>
		<div id="message_sub_options" class="header_sub_options hidden">
		  <a href="<?php echo base_url('message/view/send_message');?>">
		    <div class="header_sub_option" id="send_message">Send message</div>
		   </a>
		  <a href="<?php echo base_url('message/view/view_recieved_messages');?>">
		    <div class="header_sub_option" id="view_recieved_messages">Inbox</div>
		   </a>
		  <a href="<?php echo base_url('message/view/view_sent_messages');?>">
		    <div class="header_sub_option" id="view_sent_messages">Outbox</div>
		   </a>
		</div>
	      </div>
	  </li>
	  <?php if($this->session->userdata('session_urole')=='student' || $this->session->userdata('session_urole')=='hec' || $this->session->userdata('session_urole')=='warden'){?>
		  <li><div  id="fine_options" class="header_options">
			<div id="fine">Fine</div>
				<div id="fine_sub_options" class="header_sub_options hidden">
					<?php if($this->session->userdata('session_urole')=='student' || $this->session->userdata('session_urole')=='hec'){?>
						<a href="<?php echo base_url('fine/view/view_recieved_fines');?>">
							<div class="header_sub_option" id="view_recieved_fines">Recieved Fines</div>
						</a>
					<?php }?>
					<?php if($this->session->userdata('session_urole')=='hec' || $this->session->userdata('session_urole')=='warden'){?>
						<a href="<?php echo base_url('fine/view/view_proposed_fines');?>">
							<div class="header_sub_option" id="view_fines">Proposed Fines</div>
						</a>
						<a href="<?php echo base_url('activity/view/propose_fine');?>">
							<div class="header_sub_option" id="propose_fine">Propose Fine</div>
						</a>
					<?php } ?>
				</div>
			</div>
		  </li>
	<?php }?>
	  <?php if($this->session->userdata('session_urole')=='hec' || $this->session->userdata('session_urole')=='warden'){?>
		  <li><div  id="meeting_options" class="header_options">
			<div id="meeting">Meeting</div>
				<div id="meeting_sub_options" class="header_sub_options hidden">
					<a href="<?php echo base_url('meeting/view/view_recieved_meetings');?>">
						<div class="header_sub_option" id="view_recieved_meetings">View Meetings</div>
					</a>
					<a href="<?php echo base_url('meeting/view/view_proposed_meetings');?>">
						<div class="header_sub_option" id="view_fines">Proposed Meetings</div>
					</a>
					<a href="<?php echo base_url('meeting/view/propose_meeting');?>">
						<div class="header_sub_option" id="propose_fine">Propose Meeting</div>
					</a>
				</div>
			</div>
		  </li>
	<?php }?>

	<?php if($this->session->userdata('session_urole')=='admin'){?>
		  <li><div id="admin_options" class="header_options">
			<div id="Admin">Admin</div>
			<div id="admin_sub_options" class="header_sub_options hidden">
				<a href="<?php echo base_url('admin/view/admin_create_role');?>">
					<div class="header_sub_option" id="create_role">Create role</div>
				</a>
				<a href="<?php echo base_url('admin/view/admin_change_role');?>">
					<div class="header_sub_option" id="change_role">Change role</div>
				</a>
			</div>
			  </div>
		  </li>
		  
	  <?php }?>
	  <?php if($this->session->userdata('session_urole')!= 'admin'){?>
	  <li><div id="request_options" class="header_options" >
			<div id="request">Request</div>
			<div id="request_sub_options" class="header_sub_options hidden">
				<?php if($this->session->userdata('session_urole')=='student' ||$this->session->userdata('session_urole')=='hec'){?>
				  <a href="<?php echo base_url('request/view/make_request');?>">
					<div class="header_sub_option" id="make_request">Make Request</div>
				  </a>
				<?php }?>
				<a href="<?php echo base_url('request/view/view_requests');?>">
					<div class="header_sub_option" id="view_requests">View Requests</div>
				</a>
			</div>
		</div>
	  </li>
	  <?php }?>
	  <?php if($this->session->userdata('session_urole')!='admin'){?>
	  <li><div id="personal_info_options" class="header_options" >
			<div id="personal_info">Personal Info</div>
			<div id="personal_info_sub_options" class="header_sub_options hidden">
				<a href="<?php echo base_url('user/view/update_personal_info');?>">
					<div class="header_sub_option" id="update_personal_info">Update Info</div>
				</a>
			</div>
		</div>
	  </li>
	  <?php }?>
	  <li><div class="header_options" id="logout">Logout</div></li>
      </ul>
    </div>
  </div>
  <div id="container">
 <?php }?>
