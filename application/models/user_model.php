<?php
class User_model extends CI_Model {
	
	public function check_login($username = FALSE, $password = FALSE)
	{
	  if($username && $password){
	    $sql="SELECT * FROM hms_users WHERE user_name = '".$username."'";
	    $query = $this->db->query($sql);
	    $user = $query->row_array();
	    if($user['user_password'] == $password){
	      if($user['user_role']=='staff'){
			$sql="SELECT * FROM hms_staffs WHERE staff_email = '".$user['user_email']."'";
			$query = $this->db->query($sql);
			$staff = $query->row_array();
			  $newdata = array(
					   'session_uname'  => $user['user_name'],
					   'session_uemail' => $user['user_email'],
					   'session_urole' => $user['user_role'],
					   'session_ustaff_privilege' =>$staff['staff_privilege'],
				  );
			}else{
				$newdata = array(
                   'session_uname'  => $user['user_name'],
                   'session_uemail' => $user['user_email'],
                   'session_urole' => $user['user_role'],
				);
			}
	      $this->session->set_userdata($newdata);
	      return '1';
	    }else{
	      return '-1';
	    }
	  }else{
	    return '-1';
	  }
	}
}
?>