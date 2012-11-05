<?php
class Complain_model extends CI_Model {
	
	public function register_complain($subject = False , $description=False,$sender=False)
	{
	  if($subject && $description && $sender){
		  $data = array(
			    'complain_subject' => $subject ,
			    'complain_description' => $description,
			    'complain_sender' => $sender
			);
		$this->db->insert('hms_complains', $data);
		return '1';
	  }else{
	    return '-1';
	  }
	}
	public function get_complains()
	{
	  if($this->session->userdata('session_urole')!= 'staff'){
	    $sql="SELECT complain_id,complain_subject,complain_sender FROM hms_complains WHERE complain_sender = '".$this->session->userdata('session_uemail')."'";
	  }elseif($this->session->userdata('session_ustaff_privilege')== '1'){
	    $sql="SELECT complain_id,complain_subject,complain_sender FROM hms_complains";	  
	  }else{
	    $sql="SELECT complain_id,complain_subject,complain_sender FROM hms_complains WHERE complain_handler = '".$this->session->userdata('session_uemail')."'";	  	  
	  }
	  $sql .= " ORDER BY complain_timestamp DESC";
	  $query = $this->db->query($sql);
	  $complains =$query->result_array();	
	  return $complains;
	}
	public function get_complain($complain_id = False){
		if($complain_id){
			$sql="SELECT * FROM hms_complains WHERE complain_id = '".$complain_id."'";
		  $query = $this->db->query($sql);
		  $complain =$query->row_array();	
		  return $complain;
		}
	}
	public function reject_complain($complain_id=False)
	{
	  if($this->session->userdata('session_urole')== 'staff' && $complain_id){
	    $data = array(
               'complain_status' => '-1',
            );
	    $this->db->where('complain_id', $complain_id);
	    $this->db->update('hms_complains', $data);
	    return '1';
	  }else{
	    return '-1';
	  }
	}
	public function act_on_complain($complain_id=False,$complain_expected_date=False,$complain_comments=False,$complain_handler=False)
	{
	  if($this->session->userdata('session_urole')== 'staff' && $complain_id && $complain_expected_date && $complain_comments && $complain_handler){
		$sql="SELECT staff_email FROM hms_staff WHERE staff_email = '".$complain_handler."'";
		$query=$this->db->where($sql);
		if($query->num_rows() >0){
			$complain_expected_date=explode("/",$complain_expected_date);
			$complain_expected_date = $complain_expected_date[2]."-".$complain_expected_date[1]."-".$complain_expected_date[0];

			$data = array(
					'complain_expected_date'=> $complain_expected_date,
					'complain_comments'=> $complain_comments,
					'complain_handler'=> $complain_handler,
					'complain_status' => '1',
				);
			$this->db->where('complain_id', $complain_id);
			$this->db->update('hms_complains', $data);
			return '1';
		}else{
			return'-1';
		}
	  }else{
	    return '-1';
	  }
	}

}
?>