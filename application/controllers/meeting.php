<?php

class Meeting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('meeting_model');
		$this->load->model('user_model');
		$this->load->model('notification_model');
	}
	public function view($page='view_recevied_meetings',$meeting_id=False){
		if($this->session->userdata('session_uemail')){
			$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
			if($meeting_id){
				$data['meeting'] = $this->meeting_model->get_meeting($meeting_id);
				if(sizeof($data['meeting'])!= 0){
					if(($page=='modify_meeting') && (($this->session->userdata('session_urole')=='hec' && $this->session->userdata('session_uemail')== $data['meeting']['meeting_proposer']) || $this->session->userdata('session_urole')=='warden')){
						$this->load->view('masthead',$data);			
						$this->load->view($page,$data);
					}else if($this->session->userdata('session_urole')=='warden' || $this->session->userdata('session_urole')=='hec'){
						$this->load->view('masthead',$data);			
						$this->load->view('meeting',$data);
					}else{
						$this->load->view('masthead',$data);			
						$this->load->view('home');									
					}
				}else{
					$this->load->view('masthead',$data);			
					$this->load->view('home');									
				}
			}elseif($page=='propose_meeting' &&($this->session->userdata('session_urole')=='hec' || $this->session->userdata('session_urole')=='warden')){
					$this->load->view('masthead',$data);					
					$this->load->view($page,$data);									
				}
			else{
				if($page == 'view_proposed_meetings' && ($this->session->userdata('session_urole')=='hec' || $this->session->userdata('session_urole')=='warden'))
				{
					$data['meetings'] = $this->meeting_model->get_proposed_meetings();			
				}else{					
					$data['meetings'] = $this->meeting_model->get_recieved_meetings($this->session->userdata('session_uemail'));			
				}
				$this->load->view('masthead',$data);						
				$this->load->view('view_meetings',$data);
			}
		}else{
			$data['notifications']=$this->notification_model->get_notifications($this->session->userdata('session_uemail'));
			$this->load->view('masthead',$data);					
			$this->load->view('prelogin');					
		}
	}	
	
	public function propose_meeting()
	{
		$proposer = $this->security->xss_clean($this->session->userdata('session_uemail'));
		$subject = $this->security->xss_clean($this->input->post('meeting_subject'));
		$description = $this->security->xss_clean($this->input->post('meeting_description'));
		$type = $this->security->xss_clean($this->input->post('meeting_type'));		
		$date = $this->security->xss_clean($this->input->post('meeting_date'));				
		if (!($type||$subject||$description||$proposer||$date)){
			echo '0';
		}else{
			$status=$this->meeting_model->propose_meeting($proposer,$subject,$description,$type,$date);
			if($status=='1'){
				//$this->notification_model->set_notification($type,'meeting');
				echo "Successful";
			}else if($status=='2'){
				echo "Person to meet doesn't exist";
			}else{
				echo "Error.Please try again";
			}
		}
	}
	public function modify_meeting()
	{
		$proposer = $this->security->xss_clean($this->session->userdata('session_uemail'));
		$id = $this->security->xss_clean($this->input->post('meeting_id'));
		$subject = $this->security->xss_clean($this->input->post('meeting_subject'));
		$description = $this->security->xss_clean($this->input->post('meeting_description'));
		$type = $this->security->xss_clean($this->input->post('meeting_type'));		
		$date = $this->security->xss_clean($this->input->post('meeting_date'));				
		if (!($id||$proposer||$subject||$description||$type)){
			echo '0';
		}else{
			$status=$this->meeting_model->modify_meeting($id,$proposer,$subject,$description,$type,$date);
			if($status=='1'){
				//$this->notification_model->set_notification($recipient,'meeting');
				echo "Successful";
			}else if($status=='2'){
				echo "Person to meet doesn't exist";
			}else{
				echo "Error.Please try again";
			}
		}
	}
	public function approve_meeting()
	{
		$meeting_id=$this->security->xss_clean($this->input->post('meeting_id'));
		$status = $this->meeting_model->approve_meeting($meeting_id);
		if ($status == 1){
			echo 'Successful';
		}
		else{
			echo 'Error. Please try again';
		}
	}
	public function delete_meeting()
	{
		$meeting_id=$this->security->xss_clean($this->input->post('meeting_id'));
		$status = $this->meeting_model->delete_meeting($meeting_id);
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
