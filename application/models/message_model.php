<?php
class Message_model extends CI_Model {
	
	public function send($sender=FALSE,$recipient=FALSE,$subject=FALSE,$description=FALSE)
	{
		if (!$recipient){
			return '0';
		}
		else{
			$sql="SELECT user_name FROM hms_users WHERE user_email = '".$recipient."'";
			$query = $this->db->query($sql);
			if(!$query->num_rows()){
				return '2';
			}
			$message = array(
				'message_sender' => $sender,
				'message_recipient' => $recipient,
				'message_subject' => $subject,
				'message_description' => $description
			);

			$this->db->insert('hms_messages', $message); 
			return '1';
		}
	}
	public function get_recieved_messages($uemail=false)
	{
		if(!$uemail){
			return '-1';
		}
		$sql="SELECT message_id,message_subject,message_sender,message_status FROM hms_messages WHERE message_recipient = '".$uemail."'";
		$query = $this->db->query($sql);
		$recieved_messages = $query->result_array();
		return $recieved_messages;
	}
	public function get_sent_messages($uemail=false)
	{
		if(!$uemail){
			return '-1';
		}
		$sql="SELECT message_id,message_subject,message_recipient,message_status FROM hms_messages WHERE message_sender = '".$uemail."'";
		$query = $this->db->query($sql);
		$sent_messages = $query->result_array();
		return $sent_messages;
	}
	public function get_message($message_id=false)
	{
		if(!$message_id){
			return '-1';
		}
		$sql="SELECT * FROM hms_messages WHERE message_id = '".$message_id."'";
		$query = $this->db->query($sql);
		$message = $query->row_array();
		if($message['message_sender']!=$this->session->userdata('session_uemail')){
			$data = array(
				'message_status' => 1
			);
			$this->db->where('message_id',$message_id);
			$this->db->update('hms_messages',$data);
		}
		return $message;
	}

}
?>
