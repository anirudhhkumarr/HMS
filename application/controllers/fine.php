<?php

class Fine extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('fine_model');
		$this->load->model('user_model');
		$this->load->model('notification_model');
	}
	public function view($page='view_recieved_fines',$fine_id=False){
		if($this->session->userdata('session_uemail')){
			$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
			if($fine_id){
				$data['fine'] = $this->fine_model->get_fine($fine_id);
				if(sizeof($data['fine'])!= 0){
					if(($page=='modify_fine') && (($this->session->userdata('session_urole')=='hec' && $this->session->userdata('session_uemail')!= $data['fine']['fine_recipient']) || $this->session->userdata('session_urole')=='warden')){
						$this->load->view('masthead',$data);			
						$this->load->view($page,$data);
					}else if($this->session->userdata('session_uemail') == $data['fine']['fine_recipient'] || $this->session->userdata('session_urole')=='warden' || $this->session->userdata('session_urole')=='hec'){
						$this->load->view('masthead',$data);			
						$this->load->view('fine',$data);
					}else{
						$this->load->view('masthead',$data);			
						$this->load->view('home');									
					}
				}else{
					$this->load->view('masthead',$data);			
					$this->load->view('home');									
				}
			}elseif($page=='propose_fine' &&($this->session->userdata('session_urole')=='hec' || $this->session->userdata('session_urole')=='warden')){
					$this->load->view('masthead',$data);					
					$this->load->view($page,$data);									
				}
			else{
				if($page == 'view_proposed_fines' && ($this->session->userdata('session_urole')=='hec' || $this->session->userdata('session_urole')=='warden'))
				{
					$data['fines'] = $this->fine_model->get_proposed_fines();			
				}else{					
					$data['fines'] = $this->fine_model->get_recieved_fines($this->session->userdata('session_uemail'));			
				}
				$this->load->view('masthead',$data);						
				$this->load->view('view_fines',$data);
			}
		}else{
			$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
			$this->load->view('masthead',$data);					
			$this->load->view('prelogin');					
		}
	}	
	
	public function propose_fine()
	{
		$sender = $this->security->xss_clean($this->session->userdata('session_uemail'));
		$recipient = $this->security->xss_clean($this->input->post('fine_recipient'));
		$subject = $this->security->xss_clean($this->input->post('fine_subject'));
		$description = $this->security->xss_clean($this->input->post('fine_description'));
		$amount = $this->security->xss_clean($this->input->post('fine_amount'));		
		if (!($sender||$recipient||$subject||$description||$amount)){
			echo '0';
		}else{
			$status=$this->fine_model->propose_fine($sender,$recipient,$subject,$description,$amount);
			if($status=='1'){
				$this->notification_model->set_notification($recipient,'fine');
				echo "Successful";
			}else if($status=='2'){
				echo "Person to fine doesn't exist";
			}else{
				echo "Error.Please try again";
			}
		}
	}
	public function modify_fine()
	{
		$sender = $this->security->xss_clean($this->session->userdata('session_uemail'));
		$id = $this->security->xss_clean($this->input->post('fine_id'));
		$recipient = $this->security->xss_clean($this->input->post('fine_recipient'));
		$subject = $this->security->xss_clean($this->input->post('fine_subject'));
		$description = $this->security->xss_clean($this->input->post('fine_description'));
		$amount = $this->security->xss_clean($this->input->post('fine_amount'));		
		if (!($id||$sender||$recipient||$subject||$description||$amount)){
			echo '0';
		}else{
			$status=$this->fine_model->modify_fine($id,$sender,$recipient,$subject,$description,$amount);
			if($status=='1'){
				$this->notification_model->set_notification($recipient,'fine');
				echo "Successful";
			}else if($status=='2'){
				echo "Person to fine doesn't exist";
			}else{
				echo "Error.Please try again";
			}
		}
	}
	public function approve_fine()
	{
		$fine_id=$this->security->xss_clean($this->input->post('fine_id'));
		$status = $this->fine_model->approve_fine($fine_id);
		if ($status == 1){
			echo 'Successful';
		}
		else{
			echo 'Error. Please try again';
		}
	}
	public function delete_fine()
	{
		$fine_id=$this->security->xss_clean($this->input->post('fine_id'));
		$status = $this->fine_model->delete_fine($fine_id);
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
