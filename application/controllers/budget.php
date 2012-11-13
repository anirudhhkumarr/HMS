<?php

class budget extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('budget_model');
		$this->load->model('user_model');
		$this->load->model('notification_model');
	}
	public function view($page='view_recieved_budgets',$budget_id=False){
		if($this->session->userdata('session_uemail')){
			$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
			if($budget_id){
				$data['budget'] = $this->budget_model->get_budget($budget_id);
				if(sizeof($data['budget'])!= 0){
					if(($page=='modify_budget') && (($this->session->userdata('session_urole')=='hec' && $this->session->userdata('session_uemail')!= $data['budget']['budget_recipient']) || $this->session->userdata('session_urole')=='warden')){
						$this->load->view('masthead',$data);			
						$this->load->view($page,$data);
					}else if($this->session->userdata('session_uemail') == $data['budget']['budget_recipient'] || $this->session->userdata('session_urole')=='warden' || $this->session->userdata('session_urole')=='hec'){
						$this->load->view('masthead',$data);			
						$this->load->view('budget',$data);
					}else{
						$this->load->view('masthead',$data);			
						$this->load->view('home');									
					}
				}else{
					$this->load->view('masthead',$data);			
					$this->load->view('home');									
				}
			}elseif($page=='propose_budget' &&($this->session->userdata('session_urole')=='hec' || $this->session->userdata('session_urole')=='warden')){
					$this->load->view('masthead',$data);					
					$this->load->view($page,$data);									
				}
			else{
				if($page == 'view_proposed_budgets' && ($this->session->userdata('session_urole')=='hec' || $this->session->userdata('session_urole')=='warden'))
				{
					$data['budgets'] = $this->budget_model->get_proposed_budgets();			
				}else{					
					$data['budgets'] = $this->budget_model->get_recieved_budgets($this->session->userdata('session_uemail'));			
				}
				$this->load->view('masthead',$data);						
				$this->load->view('view_budgets',$data);
			}
		}else{
			$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
			$this->load->view('masthead',$data);					
			$this->load->view('prelogin');					
		}
	}	
	
	public function propose_budget()
	{
		$sender = $this->security->xss_clean($this->session->userdata('session_uemail'));
		$recipient = $this->security->xss_clean($this->input->post('budget_recipient'));
		$subject = $this->security->xss_clean($this->input->post('budget_subject'));
		$description = $this->security->xss_clean($this->input->post('budget_description'));
		$amount = $this->security->xss_clean($this->input->post('budget_amount'));		
		if (!($sender||$recipient||$subject||$description||$amount)){
			echo '0';
		}else{
			$status=$this->budget_model->propose_budget($sender,$recipient,$subject,$description,$amount);
			if($status=='1'){
				$this->notification_model->set_notification($recipient,'budget');
				echo "Successful";
			}else if($status=='2'){
				echo "Person to budget doesn't exist";
			}else{
				echo "Error.Please try again";
			}
		}
	}
	public function modify_budget()
	{
		$sender = $this->security->xss_clean($this->session->userdata('session_uemail'));
		$id = $this->security->xss_clean($this->input->post('budget_id'));
		$recipient = $this->security->xss_clean($this->input->post('budget_recipient'));
		$subject = $this->security->xss_clean($this->input->post('budget_subject'));
		$description = $this->security->xss_clean($this->input->post('budget_description'));
		$amount = $this->security->xss_clean($this->input->post('budget_amount'));		
		if (!($id||$sender||$recipient||$subject||$description||$amount)){
			echo '0';
		}else{
			$status=$this->budget_model->modify_budget($id,$sender,$recipient,$subject,$description,$amount);
			if($status=='1'){
				$this->notification_model->set_notification($recipient,'budget');
				echo "Successful";
			}else if($status=='2'){
				echo "Person to budget doesn't exist";
			}else{
				echo "Error.Please try again";
			}
		}
	}
	public function approve_budget()
	{
		$budget_id=$this->security->xss_clean($this->input->post('budget_id'));
		$status = $this->budget_model->approve_budget($budget_id);
		if ($status == 1){
			echo 'Successful';
		}
		else{
			echo 'Error. Please try again';
		}
	}
	public function delete_budget()
	{
		$budget_id=$this->security->xss_clean($this->input->post('budget_id'));
		$status = $this->budget_model->delete_budget($budget_id);
	    if ($status == 1){
			echo 'Successful';
		}
		else{
			echo 'Error. Please try again';
		}
	  
    }
	public function index()
	{
	}
}
?>
