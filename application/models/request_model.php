<?php
class Request_model extends CI_Model {
	
	public function make_request($subject = False , $description=False,$sender=False,$reciever = False)
	{
	  if($subject && $description && $sender && $reciever){
		  $data = array(
			    'request_subject' => $subject ,
			    'request_description' => $description,
			    'request_sender' => $sender,
			    'request_reciever' => $reciever
			);
		$this->db->insert('hms_requests', $data);
		return '1';
	  }else{
	    return '-1';
	  }
	}
	public function get_requests()
	{
	  if($this->session->userdata('session_urole')== 'student' || $this->session->userdata('session_urole')== 'hec'){
	    $sql="SELECT request_id,request_subject FROM hms_requests WHERE request_sender = '".$this->session->userdata('session_uemail')."'";
	  }else{
	    $sql="SELECT request_id,request_subject FROM hms_requests WHERE request_reciever = '".$this->session->userdata('session_urole')."'";	  
	  }
	  $sql .= " ORDER BY request_timestamp DESC";
	  $query = $this->db->query($sql);
	  $requests =$query->result_array();	
	  return $requests;
	}
	public function get_request($request_id = False){
		if($request_id){
			$sql="SELECT * FROM hms_requests WHERE request_id = '".$request_id."'";
		  $query = $this->db->query($sql);
		  $request =$query->row_array();	
		  return $request;
		}
	}
	public function reject_request($request_id=False)
	{
	  if(($this->session->userdata('session_urole')== 'staff' ||  $this->session->userdata('session_urole')== 'warden' || $this->session->userdata('session_urole')== 'dosa')&& $request_id){
	    $data = array(
               'request_status' => '-1',
            );
	    $this->db->where('request_id', $request_id);
	    $this->db->update('hms_requests', $data);
	    return '1';
	  }else{
	    return '-1';
	  }
	}
	public function approve_request($request_id=False)
	{
	  if(($this->session->userdata('session_urole')== 'staff' || $this->session->userdata('session_urole')== 'warden' || $this->session->userdata('session_urole')== 'dosa') && $request_id){
		$data = array(
				'request_status' => '1',
            );
	    $this->db->where('request_id', $request_id);
	    $this->db->update('hms_requests', $data);
	    return '1';
	  }else{
	    return '-1';
	  }
	}

}
?>
