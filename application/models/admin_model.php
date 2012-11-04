<?php
class Admin_model extends CI_Model {
	
	public function create_role($email = FALSE, $role = FALSE)
	{
	  if($email&& $role){
	      if($role=='student'||$role=='hec'||$role=='senate'){
		$sql="SELECT student_name FROM system_student WHERE student_email = '".$email."'";
		$query=$this->db->query($sql);
		//Exception handlling if no name entry present for give email id
		$row = $query->result_array();
		if(sizeof($row)!=1){
		    
		    return 'No such id exist';
		}
		else{
		    $name=$row[0]['student_name'];
		  }
	      }
	      else{
		  $sql="SELECT employee_name FROM system_employee WHERE employee_email = '".$email."'";
		  $query=$this->db->query($sql);
		  $row = $query->result_array();
		  $name=$row[0]['employee_name'];
	      }
	    
	    
	    $sql="INSERT INTO `hms_users`(`user_name`, `user_password`, `user_email`, `user_role`) VALUES ('".$name."','".$email."','".$email."','".$role."')";
	    $query = $this->db->query($sql);
	    
	    return '1';
	  }else{
	    return '-1';
	  }
	}
	
	
	public function change_role($email = FALSE, $role = FALSE)
	{
	  
	  if($email&& $role){
		
		$sql="SELECT user_role FROM hms_users WHERE user_email= '".$email."'";
		
		
		$query=$this->db->query($sql);
		//Exception handlling if no name entry present for give email id
		$row = $query->result_array();
		
		if(sizeof($row)!=1){
		    return 'No user with given id exist';
		}
		$previous_role=$row[0]['user_role'];
		
		
		
		if($previous_role=='student'||$previous_role=='hec'||$previous_role=='senate'){
		  if($role=='student'||$role=='hec'||$role=='senate'){
		  
		  $sql="UPDATE `hms_users` SET `user_role`='".$role."' WHERE `user_email`='".$email."'";
		  $query = $this->db->query($sql);
		  }
		  else{
		    return "Error:".$role." can't be assigned to this user as its privious role was ".$privious_role;
		  }
		}
		else{
	      
		      if($role!='student' && $role!='hec' && $role!='senate'){
			  $sql="UPDATE `hms_users` SET `user_role`='".$role."' WHERE `user_email`='".$email."'";
			  $query = $this->db->query($sql);
			}
		  else{
			return "Error:".$role." can't be assigned to this user as its privious role was ".$privious_role;
		      }
		
		  return '1';
		}}	
	  else{
		  return '-1';
	      }
	  
	}  
	  
	  
	
	public function check_email($email = FALSE)
	{
	  if($email){
	    $sql=
	    $sql="SELECT * FROM login WHERE u_email = '".$email."'";
	    return '1';
	  }else{
	    return '-1';
	  }
	}
}
?>