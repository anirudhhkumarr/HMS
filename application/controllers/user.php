<?php

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('notification_model');
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
