<?php 
class Pages extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('notification_model');
	}
	 
	 
	public function view($page="home"){
		if($page == 'home'){
			$this->home();
		}else{
			$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
			$this->load->view('masthead',$data);	  			
			$this->load->view($page);	  
		}
	}
	public function home(){
	  $data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
	  $this->load->view('masthead',$data);	  	
	  if($this->session->userdata('session_uname') != ''){
	      $this->load->view('home');	    
	    }else{
	      $this->load->view('prelogin');
	    }
	}
	public function index()
	{
	  $this->home();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
