<?php
class Activity_model extends CI_Model {
	public function get_activities()
	{
      $sql="SELECT activity_id,activity_subject FROM hms_activities";	  
	  $query = $this->db->query($sql);
	  $activities = $query->result_array();	
	  return $activities;
	}
	public function get_activity($activity_id = False){
		if($activity_id){
			$sql="SELECT * FROM hms_activities WHERE activity_id = '".$activity_id."'";
			$query = $this->db->query($sql);
			$activity =$query->row_array();	
			return $activity;
		}
	}	
	public function create_activity($activity_type = FALSE, $activity_subject = FALSE,$activity_description = FALSE,$activity_start= TRUE, $activity_end= TRUE)
	{
	  if($activity_type && $activity_subject && $activity_description&&$activity_start&&$activity_end){
		$activity_start=explode("/",$activity_start);
		$activity_end=explode("/",$activity_end);
		$activity_start = $activity_start[2]."-".$activity_start[1]."-".$activity_start[0];
		$activity_end = $activity_end[2]."-".$activity_end[1]."-".$activity_end[0];
		$data = array(
		  'activity_type' => $activity_type ,
		  'activity_subject' => $activity_subject ,
		  'activity_description' => $activity_description,
		  'activity_startdate' => $activity_start,
		  'activity_enddate' => $activity_end,
		);
		$query=$this->db->insert('hms_activities', $data);
		if($query){
			return '1';
	    }else{
			return '-1';
		}
	  }else{
	    return '-1';
	  }
	}

	public function modify_activity($activity_id=FALSE ,$activity_type = FALSE, $activity_subject = FALSE,$activity_description = FALSE,$activity_start= TRUE, $activity_end= TRUE)
	{
	  if($activity_type && $activity_subject && $activity_description && $activity_id){
	      $data = array(
		      'activity_type' => $activity_type ,
		      'activity_subject' => $activity_subject ,
		      'activity_description' => $activity_description,
		      'activity_startdate' => $activity_start,
		      'activity_enddate' => $activity_end,
	      );
	      $this->db->where('activity_id', $activity_id);
	      $query=$this->db->update('hms_activities', $data);
	      if($this->db->_error_message()){
			return '-1';
	      }else{
			return '1';
	      }
	  }else{
	    return '-1';
	  }
	}
	public function delete_activity($activity_id=FALSE)
	{
	  if($activity_id){
		$this->db->where('activity_id', $activity_id);
		$query=$this->db->delete('hms_activities');
		if($this->db->_error_message()){
			return '-1';
	    }else{
		  return '1';
	    }
	  }else{
	    return '-1';
	  }
	}
   
}
?>