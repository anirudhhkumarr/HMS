<?php
class User_model extends CI_Model {
	
	public function check_login($username = FALSE, $password = FALSE)
	{
	  if($username && $password){
	    $sql="SELECT * FROM hms_users WHERE user_name = '".$username."'";
	    $query = $this->db->query($sql);
	    $user = $query->row_array();
	    if($query->num_rows()>0 && $user['user_password'] == $password){
	      if($user['user_role']=='staff'){
			$sql="SELECT * FROM hms_staffs WHERE staff_email = '".$user['user_email']."'";
			$query = $this->db->query($sql);
			$staff = $query->row_array();
			  $newdata = array(
					   'session_uname'  => $user['user_name'],
					   'session_uemail' => $user['user_email'],
					   'session_urole' => $user['user_role'],
					   'session_ustaff_privilege' =>$staff['staff_privilege'],
					   'session_uphoneno' => $user['user_phone_no'],
					   'session_ulocaladdress' => $user['user_local_address'],				  
				  );
			}else{
				$newdata = array(
                   'session_uname'  => $user['user_name'],
                   'session_uemail' => $user['user_email'],
                   'session_urole' => $user['user_role'],
                   'session_uphoneno' => $user['user_phone_no'],
                   'session_ulocaladdress' => $user['user_local_address'],
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
	public function update_personal_info($update_uphoneno = FALSE, $update_ulocaladdr = FALSE,$update_uemail=FALSE)
	{
	  if($update_uphoneno && $update_ulocaladdr && $update_uemail){
	    $data = array(
               'user_phone_no' => $update_uphoneno,
               'user_local_address' => $update_ulocaladdr
            );
	    $this->db->where('user_email', $update_uemail);
	    $this->db->update('hms_users', $data);
	      return '1';
	    }else{
	      return '-1';
	    }
	}
}
?>