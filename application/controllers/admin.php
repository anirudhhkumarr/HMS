<?php

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}
	public function view($page=False){
		$this->load->view('masthead');
		if($page&&$this->session->userdata('session_urole')=='admin'){
			$this->load->view($page);
		}elseif($this->session->userdata('session_uemail')){
			$this->load->view('home');		
		}else{
			$this->load->view('prelogin');				
		}
	}
	public function create_role()
	{		
		if($this->session->userdata('session_urole')=='admin'){
			$email= $this->security->xss_clean($this->input->post('email'));
			$role= $this->security->xss_clean($this->input->post('role'));
			$status = $this->admin_model->create_role($email,$role);
			if($status=='1'){    
			  echo "Successfull";
			}
			else {
			  echo $status;		
			}
		}elseif($this->session->userdata('session_uemail')){
			$this->load->view('masthead');
			$this->load->view('home');		
		}else{
			$this->load->view('masthead');	
			$this->load->view('prelogin');				
		}
	}
	public function change_role()
	{		
		if($this->session->userdata('session_urole')=='admin'){
			$email= $this->security->xss_clean($this->input->post('email'));
			$role= $this->security->xss_clean($this->input->post('role'));
			
			$status = $this->admin_model->change_role($email,$role);
			if($status=='1'){    
			  echo "Successfull";
			}
			else {
			  echo $status;		
			}
		}elseif($this->session->userdata('session_uemail')){
			$this->load->view('masthead');
			$this->load->view('home');		
		}else{
			$this->load->view('masthead');	
			$this->load->view('prelogin');				
		}		
	}
	public function index()
	{
		$this->view();
	}
}
?>
