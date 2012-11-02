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
	public function view_recieved($user=FALSE)
	{
		if(!$user){
			return '-1';
		}
		$sql="SELECT * FROM hms_messages WHERE message_recipient = '".$user."'";
		$query = $this->db->query($sql);
		$recieved_messages = $query->result_array();
		return $recieved_messages;
	}
	public function view_sent($user=FALSE)
	{
		if(!$user){
			return '-1';
		}
		$sql="SELECT * FROM hms_messages WHERE message_sender = '".$user."'";
		$query = $this->db->query($sql);
		$sent_messages = $query->result_array();
		return $sent_messages;
	}
}
?>
