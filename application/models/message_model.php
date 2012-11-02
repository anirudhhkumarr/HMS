<?php
class Message_model extends CI_Model {
	
	public function send($sender=FALSE,$recipient=FALSE,$subject=FALSE,$description=FALSE)
	{
		if (!$recipient){
			return '0';
		}
		else{
			$sql="SELECT user_name FROM hms_users WHERE user_name = '".$recipient."'";
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
}
?>
