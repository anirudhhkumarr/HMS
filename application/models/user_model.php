<?php
class User_model extends CI_Model {
	
	public function check_login($username = FALSE, $password = FALSE)
	{
	  if($username && $password){
	    $sql="SELECT * FROM hms_users WHERE u_name = '".$username."'";
	    $query = $this->db->query($sql);
	    $user = $query->row_array();
	    if($user['u_password'] == $password){
	      $newdata = array(
                   'session_uname'  => $user['u_name'],
                   'session_uemail' => $user['u_email'],
                   'session_urole' => $user['u_role'],
              );
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