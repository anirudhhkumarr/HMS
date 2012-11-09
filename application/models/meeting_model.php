<?php
class Meeting_model extends CI_Model {
	
	public function propose_meeting($proposer=FALSE,$subject=FALSE,$description=FALSE,$type=FALSE,$date=false)
	{
		if (!($proposer||$subject||$description||$type||$date)){
			return '0';
		}
		else{
			$date=explode("/",$date);
			$date = $date[2]."-".$date[1]."-".$date[0];

			$meeting = array(
				'meeting_proposer' => $proposer,
				'meeting_subject' => $subject,
				'meeting_description' => $description,
				'meeting_type' => $type,
				'meeting_date' => $date,				
			);
			$this->db->insert('hms_meetings', $meeting); 
			return '1';
		}
	}
	public function modify_meeting($meeting_id=FALSE,$proposer=FALSE,$subject=FALSE,$description=FALSE,$type=FALSE,$date=false)
	{
		if (!($meeting_id || $proposer||$subject||$description||$type||$date)){
			return '0';
		}
		else{
			$date=explode("/",$date);
			$date = $date[2]."-".$date[1]."-".$date[0];
		
			$meeting = array(
				'meeting_proposer' => $proposer,
				'meeting_subject' => $subject,
				'meeting_description' => $description,
				'meeting_type' => $type,				
				'meeting_date' => $date,				
			);

			$this->db->where('meeting_id',$meeting_id);
			$this->db->update('hms_meetings', $meeting); 
			return '1';
		}
	}
	public function delete_meeting($meeting_id=False)
	{
	  $meeting = $this->get_meeting($meeting_id);
	  if(($this->session->userdata('session_urole')== 'warden' || $meeting['meeting_proposer']==$this->session->userdata('session_uemail')) && $meeting['meeting_status']!=1){
	    $this->db->where('meeting_id', $meeting_id);
	    $this->db->delete('hms_meetings');
	    return '1';
	  }else{
	    return '-1';
	  }
	}
	public function approve_meeting($meeting_id=False)
	{
	  $meeting = $this->get_meeting($meeting_id);
	  if($this->session->userdata('session_urole')== 'warden' ){
		  $data=array(
			'meeting_status'=>1
		  );
	    $this->db->where('meeting_id', $meeting_id);
	    $this->db->update('hms_meetings',$data);
	    return '1';
	  }else{
	    return '-1';
	  }
	}
	public function get_proposed_meetings()
	{
		$sql="SELECT meeting_id,meeting_subject,meeting_type,meeting_proposer FROM hms_meetings WHERE meeting_proposer = '".$this->session->userdata('session_uemail');
		$sql .="' ORDER BY meeting_timestamp DESC";
		$query = $this->db->query($sql);
		$meetings = $query->result_array();
		return $meetings;
	}

	public function get_recieved_meetings()
	{
		$sql="SELECT meeting_id,meeting_subject,meeting_proposer FROM hms_meetings WHERE meeting_type = '".$this->session->userdata('session_urole');
		$sql .= "' and meeting_proposer != '".$this->session->userdata('session_uemail')."' ORDER BY meeting_timestamp DESC";
		$query = $this->db->query($sql);
		$meetings = $query->result_array();
		return $meetings;
	}

	public function get_meeting($meeting_id=false)
	{
		if(!$meeting_id){
			return '-1';
		}
		$sql="SELECT * FROM hms_meetings WHERE meeting_id = '".$meeting_id."'";
		$query = $this->db->query($sql);
		$meeting = $query->row_array();
		return $meeting;
	}
}
?>
