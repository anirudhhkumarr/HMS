<?php

class Complain extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('complain_model');
		$this->load->model('user_model');
	}
	public function register_complain()
	{
	
	}
	public function act_on_complain()
	{
	}
	public function index()
	{
	}
}
?>
