<?php
class Notification_model extends CI_Model {

	
	
	public function get_number($id,$notification_type){
	      
	      
	      $sql="SELECT count(*) AS num FROM hms_notification WHERE notification_to='".$id."'  AND notification_type='".$notification_type."'";
	      
	      $query=$this->db->query($sql);
	      $result=$query->row_array();
	      $num=$result['num'];
	      return $num;
	  
	}
	
	public function get_notifications($user_id){
	    
	    $data=array(
		 'no_complains'=>$this->get_number($user_id,'complain'),
		 'no_messages'=>$this->get_number($user_id,'message'),
		 
	    );
	  
	
	  return $data;
	
	}
	
	public function set_notification($to=False,$type=False){
	    $data=array(
		    'notification_to'=>$to,
		    'notification_type'=>$type,
	      );
	      $this->db->insert('hms_notification', $data);
	
	}
	public function delete_notification($type=False){
	      $data=array(
		    'notification_to'=>$this->session->userdata('session_uemail'),
		    'notification_type'=>$type,
	      );
	      $this->db->delete('hms_notification', $data);
	}
}
?>