<?php
class budget_model extends CI_Model {
	
	public function propose_budget($sender=FALSE,$recipient=FALSE,$subject=FALSE,$description=FALSE,$amount=FALSE)
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
			$budget = array(
				'budget_sender' => $sender,
				'budget_recipient' => $recipient,
				'budget_subject' => $subject,
				'budget_description' => $description,
				'budget_amount' => $amount,				
			);
			$this->db->insert('hms_budgets', $budget); 
			return '1';
		}
	}
	public function modify_budget($budget_id=FALSE,$sender=FALSE,$recipient=FALSE,$subject=FALSE,$description=FALSE,$amount=FALSE)
	{
		if (!($budget_id||$sender||$recipient||$subject||$description||$amount)){
			return '0';
		}
		else{
			$data = array(
				'budget_sender' => $sender,
				'budget_recipient' => $recipient,
				'budget_subject' => $subject,
				'budget_description' => $description,
				'budget_amount' => $amount,				
			);
			$this->db->where('budget_id',$budget_id);
			$this->db->update('hms_budgets', $data); 
			return '1';
		}
	}
	public function delete_budget($budget_id=False)
	{
	  $budget = $this->get_budget($budget_id);
	  if(($this->session->userdata('session_urole')== 'warden' || $budget['budget_sender']==$this->session->userdata('session_uemail')) && $budget['budget_status']!=1){
	    $this->db->where('budget_id', $budget_id);
	    $this->db->delete('hms_budgets');
	    return '1';
	  }else{
	    return '-1';
	  }
	}
	public function approve_budget($budget_id=False)
	{
	  $budget = $this->get_budget($budget_id);
	  if($this->session->userdata('session_urole')== 'warden' ){
		  $data=array(
			'budget_status'=>1
		  );
	    $this->db->where('budget_id', $budget_id);
	    $this->db->update('hms_budgets',$data);
	    return '1';
	  }else{
	    return '-1';
	  }
	}
	public function get_recieved_budgets($uemail=false)
	{
		if(!$uemail){
			return '-1';
		}
		$sql="SELECT budget_id,budget_subject,budget_sender ,budget_recipient FROM hms_budgets WHERE budget_recipient = '".$uemail."' ORDER BY budget_timestamp DESC";
		$query = $this->db->query($sql);
		$recieved_budgets = $query->result_array();
		return $recieved_budgets;
	}
	public function get_proposed_budgets()
	{
		$sql="SELECT budget_id,budget_subject,budget_recipient,budget_sender FROM hms_budgets ORDER BY budget_timestamp DESC";
		$query = $this->db->query($sql);
		$sent_budgets = $query->result_array();
		return $sent_budgets;
	}
	public function get_budget($budget_id=false)
	{
		if(!$budget_id){
			return '-1';
		}
		$sql="SELECT * FROM hms_budgets WHERE budget_id = '".$budget_id."'";
		$query = $this->db->query($sql);
		$budget = $query->row_array();
		return $budget;
	}
}
?>
