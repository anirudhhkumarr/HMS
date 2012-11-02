<?php

class Message extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('message_model');
		$this->load->model('user_model');
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
	public function view_recieved_messages()
	{
		$user = $this->security->xss_clean($this->session->userdata('session_uemail'));
		$data['messages'] = $this->message_model->view_recieved($user);
		$data['messages_type'] = 'Recieved';
		$this->load->view('messages',$data);
	}
	
	public function view_sent_messages()
	{
		$user = $this->security->xss_clean($this->session->userdata('session_uemail'));
		$data['messages'] = $this->message_model->view_sent($user);
		$data['messages_type'] = 'Sent';
		$this->load->view('messages',$data);
	}
	
}
?>
