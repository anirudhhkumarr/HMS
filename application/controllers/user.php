<?php

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('notification_model');
	}
	public function view($page='home'){
		if($this->session->userdata('session_uemail')){
			$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
			$this->load->view('masthead',$data);
			$this->load->view($page);		
		}else{
			$this->load->view('masthead');
			$this->load->view('prelogin');				
		}
	}
	public function login()
	{
		$username = $this->security->xss_clean($this->input->post('username'));
		$password = $this->security->xss_clean($this->input->post('password'));
		$status = $this->user_model->check_login($username,$password);
		if($status=='1'){
		
		  echo "Successful";
		}
		else if($status=='-1'){
		  echo "Invalid authentication";		
		}
	}
	public function update_personal_info()
	{
		$update_uphoneno = $this->security->xss_clean($this->input->post('update_uphoneno'));
		$update_ulocaladdr = $this->security->xss_clean($this->input->post('update_ulocaladdr'));
		$update_uemail = $this->security->xss_clean($this->input->post('update_uemail'));
		$status = $this->user_model->update_personal_info($update_uphoneno,$update_ulocaladdr,$update_uemail);
		if($status=='1'){
		  echo "Successful";
		}
		else if($status=='-1'){
		  echo "Error";		
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), "refresh");
	}
	public function index()
	{
		show_404();
	}
}
?>
