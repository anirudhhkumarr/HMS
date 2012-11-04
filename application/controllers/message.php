<?php

class Message extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('message_model');
		$this->load->model('user_model');
	}
	public function view($page="view_recieved_messages",$message_id=False)
	{
		if($this->session->userdata('session_uemail')){
			if($message_id){
				$data['message'] = $this->message_model->get_message($message_id);
				if($this->session->userdata('session_uemail') == $data['message']['message_sender'] || $this->session->userdata('session_uemail') == $data['message']['message_recipient']){
					$this->load->view('masthead');			
					$this->load->view($page,$data);
				}else{
					$this->load->view('masthead');					
					$this->load->view('home');									
				}
			}elseif($page=='send_message'){
				$this->load->view('masthead');
				$this->load->view($page);
			}else{
				if($page=='view_recieved_messages'){
					$data['messages'] = $this->message_model->get_recieved_messages($this->session->userdata('session_uemail'));
					$data['message_type'] = 'Recieved';
				}else{
					$data['messages'] = $this->message_model->get_sent_messages($this->session->userdata('session_uemail'));
					$data['message_type'] = 'Sent';					
				}
				$this->load->view('masthead');			
				$this->load->view('message_list',$data);
			}
		}else{
			$this->load->view('masthead');					
			$this->load->view('prelogin');					
		}
	}
	public function send_message()
	{
		$sender = $this->security->xss_clean($this->session->userdata('session_uemail'));
		$recipient = $this->security->xss_clean($this->input->post('to'));
		$subject = $this->security->xss_clean($this->input->post('subject'));
		$description = $this->security->xss_clean($this->input->post('description'));
		$status = $this->message_model->send($sender,$recipient,$subject,$description);
		if($status=='1'){
		    echo "Successful";
		}
		else if($status=='0'){
		    echo "Please specify a recipient";
		}
		else if($status=='2'){
			echo "User does not exist. Message sending failed";
		}
	}
	
}
?>
