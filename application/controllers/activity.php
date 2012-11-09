<?php

class Activity extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('activity_model');
		$this->load->model('notification_model');
	}
	public function view($page='view_activities',$activity_id=False){
		if($this->session->userdata('session_uemail')){
			$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
			if($activity_id){
				$data['activity'] = $this->activity_model->get_activity($activity_id);
				if(sizeof($data['activity'])!= 0){
					if($this->session->userdata('session_urole')=='hec')
					{
						$this->load->view('masthead',$data);			
						$this->load->view($page,$data);
					}else{
						$this->load->view('masthead',$data);			
						$this->load->view('activity',$data);				
					}
				}else{
					$this->load->view('masthead',$data);			
					$this->load->view('home',$data);				
				}
			}elseif($page=='view_activities'){
				$data['activities'] = $this->activity_model->get_activities();			
				$this->load->view('masthead',$data);			
				$this->load->view($page,$data);
			}
			else{
				$this->load->view('masthead',$data);						
				$this->load->view($page);			
			}
		}else{
			$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
			$this->load->view('masthead',$data);					
			$this->load->view('prelogin');					
		}
	}	
	public function create_activity()
	{
		if($this->session->userdata('session_uemail')){
			if($this->session->userdata('session_urole')=='hec'){
				$activity_type = $this->security->xss_clean($this->input->post('activity_type'));
				$activity_subject = $this->security->xss_clean($this->input->post('activity_subject'));
				$activity_description = $this->security->xss_clean($this->input->post('activity_description'));
				$activity_start = $this->security->xss_clean($this->input->post('activity_start'));
				$activity_end = $this->security->xss_clean($this->input->post('activity_end'));
				$status = $this->activity_model->create_activity($activity_type,$activity_subject,$activity_description,$activity_start,$activity_end);
				if($status=='1'){    
				  echo "Successful";
				}
				else if($status=='-1'){
				  echo "Failed Activity Creation";		
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
		
	public function modify_activity()
	{
		if($this->session->userdata('session_uemail')){
			if($this->session->userdata('session_urole')=='hec'){
				$activity_id = $this->security->xss_clean($this->input->post('activity_id'));
				$activity_type = $this->security->xss_clean($this->input->post('activity_type'));
				$activity_subject = $this->security->xss_clean($this->input->post('activity_subject'));
				$activity_description = $this->security->xss_clean($this->input->post('activity_description'));
				$activity_start = $this->security->xss_clean($this->input->post('activity_start'));
				$activity_end = $this->security->xss_clean($this->input->post('activity_end'));
				$status = $this->activity_model->modify_activity($activity_id,$activity_type,$activity_subject,$activity_description,$activity_start,$activity_end);
				if($status=='1'){    
				  echo "Successful";
				}
				else if($status=='-1'){
				  echo "Failed Activity Modification";		
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
	
    public function delete_activity()
	{
		if($this->session->userdata('session_uemail')){
			if($this->session->userdata('session_urole')=='hec'){
				$activity_id = $this->security->xss_clean($this->input->post('activity_id'));
				$status = $this->activity_model->delete_activity($activity_id);
				if($status=='1'){    
				  echo "Successful";
				}
				else if($status=='-1'){
				  echo "Failed Activity Deletion";		
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
		$this->view();
	}
}
?>
