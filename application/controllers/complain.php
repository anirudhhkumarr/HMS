<?php

class Complain extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('complain_model');
		$this->load->model('user_model');
		$this->load->model('notification_model');
	}
	public function view($page='view_complains',$complain_id=False){
		if($this->session->userdata('session_uemail')){
			$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
			if($complain_id){
				$data['complain'] = $this->complain_model->get_complain($complain_id);
				if(sizeof($data['complain'])!= 0){
					if($page=='act_on_complain' && $this->session->userdata('session_urole')=='staff' && $this->session->userdata('session_ustaff_privilege')== '1'){
						$this->load->view('masthead',$data);			
						$this->load->view($page,$data);
					}else if($page=='act_on_complain'){
						$this->load->view('masthead',$data);					
						$this->load->view('home');													
					}else if($this->session->userdata('session_uemail') == $data['complain']['complain_sender'] || $this->session->userdata('session_urole')=='staff'){
						$this->load->view('masthead',$data);			
						$this->load->view($page,$data);
					}
					else{
						$this->load->view('masthead',$data);					
						$this->load->view('home');									
					}
				}else{
					$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
					$this->load->view('masthead',$data);					
					$this->load->view('home');									
				}
			}elseif($page=='view_complains'){
				$this->notification_model->delete_notification('complain');
				$data['complains'] = $this->complain_model->get_complains();			
				$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
				$this->load->view('masthead',$data);			
				$this->load->view($page,$data);
			}
			else{
				$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
				$this->load->view('masthead',$data);						
				$this->load->view($page);			
			}
		}else{
		      $data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
			$this->load->view('masthead',$data);					
			$this->load->view('prelogin');					
		}
	}	
	
	public function register_complain()
	{
		if($this->session->userdata('session_uemail')){
			if($this->session->userdata('session_urole')=='student' || $this->session->userdata('session_urole')=='hec'){
				$subject = $this->security->xss_clean($this->input->post('subject'));
				$description = $this->security->xss_clean($this->input->post('description'));
				$sender = $this->security->xss_clean($this->session->userdata('session_uemail'));
				$status = $this->complain_model->register_complain($subject,$description,$sender);
				if($status=='1'){
					$sql="SELECT * FROM hms_staffs WHERE staff_privilege = 1";
					$query = $this->db->query($sql);
					$staffs = $query->result_array();
					if($query->num_rows()>0)
					{
						foreach ($staffs as $staff)
							$this->notification_model->set_notification($staff['staff_email'],'complain');	
					}
					echo "Successful";
				}
				else if($status=='-1'){
				  echo "Error.Please try again";		
				}	
			}else{
				$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
				$this->load->view('masthead',$data);						
				$this->load->view('home');						
			}
		}else{
			$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
			$this->load->view('masthead',$data);					
			$this->load->view('prelogin');							
		}
	}
	public function reject_complain()
	{
		if($this->session->userdata('session_uemail')){
			if($this->session->userdata('session_urole')=='staff' && $this->session->userdata('session_ustaff_privilege')== '1'){
				$complain_id = $this->security->xss_clean($this->input->post('complain_id'));
				$status = $this->complain_model->reject_complain($complain_id);
				if($status=='1'){
				  echo "Successful";
				}
				else if($status=='-1'){
				  echo "Error.Please try again";		
				}	
			}else{
				$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
				$this->load->view('masthead',$data);						
				$this->load->view('home');						
			}
		}else{
			$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
			$this->load->view('masthead',$data);					
			$this->load->view('prelogin');							
		}
	}
	public function act_on_complain()
	{
		if($this->session->userdata('session_uemail')){
			if($this->session->userdata('session_urole')=='staff' && $this->session->userdata('session_ustaff_privilege')== '1'){
				$complain_id = $this->security->xss_clean($this->input->post('complain_id'));
				$complain_expected_date = $this->security->xss_clean($this->input->post('complain_expected_date'));
				$complain_comments = $this->security->xss_clean($this->input->post('complain_comment'));
				$complain_handler = $this->security->xss_clean($this->input->post('complain_handler'));
				$status = $this->complain_model->act_on_complain($complain_id,$complain_expected_date,$complain_comments,$complain_handler);
				if($status=='1'){
				  echo "Successful";
				}
				else if($status=='-1'){
				  echo "Error.Please try again";		
				}	
			}else{
				$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
				$this->load->view('masthead',$data);						
				$this->load->view('home');						
			}
		}else{
			$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
			$this->load->view('masthead',$data);					
			$this->load->view('prelogin');							
		}
	}

	public function index()
	{
	}
}
?>
