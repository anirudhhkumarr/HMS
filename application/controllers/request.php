<?php

class Request extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('request_model');
		$this->load->model('user_model');
		$this->load->model('notification_model');
	}
	public function view($page='view_requests',$request_id=False){
		if($this->session->userdata('session_uemail')){
			$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
			if($request_id){
				$data['request'] = $this->request_model->get_request($request_id);
				if(sizeof($data['request'] !=0)){
					if($this->session->userdata('session_uemail') == $data['request']['request_sender'] || ($this->session->userdata('session_urole')== 'staff' || $this->session->userdata('session_urole')== 'warden' || $this->session->userdata('session_urole')== 'dosa')){
						$this->load->view('masthead',$data);			
						$this->load->view($page,$data);
					}else{
						$this->load->view('masthead',$data);					
						$this->load->view('home');									
					}
				}else{
					$this->load->view('masthead',$data);					
					$this->load->view('home');													
				}
			}elseif($page=='view_requests'){
				$data['requests'] = $this->request_model->get_requests();			
				$this->load->view('masthead',$data);			
				$this->load->view($page,$data);
			}
			else{
				$this->load->view('masthead',$data);						
				$this->load->view($page);			
			}
		}else{
			$this->load->view('masthead');					
			$this->load->view('prelogin');					
		}
	}	
	
	public function make_request()
	{
		if($this->session->userdata('session_uemail')){
			if($this->session->userdata('session_urole')=='student' || $this->session->userdata('session_urole')=='hec'){
				$subject = $this->security->xss_clean($this->input->post('subject'));
				$reciever = $this->security->xss_clean($this->input->post('reciever'));
				$description = $this->security->xss_clean($this->input->post('description'));
				$sender = $this->security->xss_clean($this->session->userdata('session_uemail'));
				$status = $this->request_model->make_request($subject,$description,$sender,$reciever);
				if($status=='1'){
				  echo "Successful";
				}
				else if($status=='-1'){
				  echo "ERROR.Please try again";		
				}	
			}else{
				$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
				$this->load->view('masthead',$data);						
				$this->load->view('home',$data);						
			}
		}else{
			$this->load->view('masthead');					
			$this->load->view('prelogin');							
		}
	}
	public function reject_request()
	{
		if($this->session->userdata('session_uemail')){
			if(($this->session->userdata('session_urole')== 'staff' || $this->session->userdata('session_urole')== 'warden' || $this->session->userdata('session_urole')== 'dosa')){
				$request_id = $this->security->xss_clean($this->input->post('request_id'));
				$status = $this->request_model->reject_request($request_id);
				if($status=='1'){
				  echo "Successful";
				}
				else if($status=='-1'){
				  echo "Error.Please try again";		
				}	
			}else{
				$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
				$this->load->view('masthead',$data);						
				$this->load->view('home',$data);						
			}
		}else{
			$this->load->view('masthead');					
			$this->load->view('prelogin');							
		}
	}
	public function approve_request()
	{
		if($this->session->userdata('session_uemail')){
			if(($this->session->userdata('session_urole')== 'staff' || $this->session->userdata('session_urole')== 'warden' || $this->session->userdata('session_urole')== 'dosa')){
				$request_id = $this->security->xss_clean($this->input->post('request_id'));
				$status = $this->request_model->approve_request($request_id);
				if($status=='1'){
				  echo "Successful";
				}
				else if($status=='-1'){
				  echo "Error.Please try again";		
				}	
			}else{
				$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
				$this->load->view('masthead',$data);						
				$this->load->view('home',$data);						
			}
		}else{
			$this->load->view('masthead');					
			$this->load->view('prelogin');							
		}
	}

	public function index()
	{
	}
}
?>
