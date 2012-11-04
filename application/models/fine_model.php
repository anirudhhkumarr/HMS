<?php
class fine_model extends CI_Model {
	
	public function propose_fine($sender=FALSE,$recipient=FALSE,$subject=FALSE,$description=FALSE,$amount=FALSE)
	{
		if (!($sender||$recipient||$subject||$description||$amount)){
			return '0';
		}
		else{
			$sql="SELECT user_name FROM hms_users WHERE user_email = '".$recipient."'";
			$query = $this->db->query($sql);
			if(!$query->num_rows()){
				return '2';
			}
			$fine = array(
				'fine_sender' => $sender,
				'fine_recipient' => $recipient,
				'fine_subject' => $subject,
				'fine_description' => $description,
				'fine_amount' => $amount,				
			);
			$this->db->insert('hms_fines', $fine); 
			return '1';
		}
	}
	public function get_recieved_fines($uemail=false)
	{
		if(!$uemail){
			return '-1';
		}
		$sql="SELECT fine_id,fine_subject,fine_sender ,fine_recipient FROM hms_fines WHERE fine_recipient = '".$uemail."' ORDER BY fine_timestamp DESC";
		$query = $this->db->query($sql);
		$recieved_fines = $query->result_array();
		return $recieved_fines;
	}
	public function get_proposed_fines()
	{
		$sql="SELECT fine_id,fine_subject,fine_recipient,fine_sender FROM hms_fines ORDER BY fine_timestamp DESC";
		$query = $this->db->query($sql);
		$sent_fines = $query->result_array();
		return $sent_fines;
	}
	public function get_fine($fine_id=false)
	{
		if(!$fine_id){
			return '-1';
		}
		$sql="SELECT * FROM hms_fines WHERE fine_id = '".$fine_id."'";
		$query = $this->db->query($sql);
		$fine = $query->row_array();
		return $fine;
	}
}
?>
