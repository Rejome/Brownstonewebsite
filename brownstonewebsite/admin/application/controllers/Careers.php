<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Careers extends CI_Controller {
	
	public function __construct(){
    	parent::__construct();
    	$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('process');
		$this->load->model('View');
		$access = $this->session->userdata('access');
		if(null !== $this->session->userdata('access') && $access['careers'] == 1){

		}else{
			redirect('admin', 'refresh');
		}
		ob_start();
    }

	public function index(){
		$inner[0] = 'careers';
		$inner[1] = 'suppliers';
		$array = $this->process->OpenXML($inner);
		$this->load->view('careers.php', $array);
	}

	public function addCareer(){
		//Append newly added types on XML
		$cid = $this->input->post('cid');
			
		if(!isset($cid)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			if($this->form_validation->run() == TRUE){
				$err_session = array('err_session' => 'Jerome error');
				$this->session->set_userdata($err_session);
			}else{
				$saveThis = 
				array( 'career' =>
					array(
						'id' => $this->input->post('cid'),
						'title' => $this->input->post('ctitle', TRUE),
						'description' => $this->input->post('cqualifications', TRUE),
						'link' => $this->input->post('clink', TRUE)
					)
				);
				$inner[0] = 'careers';
				$array = $this->process->OpenXML($inner);
				$this->process->addRows($saveThis, "careers", "career", $array, 'careers');
				$access = $this->session->userdata('access');
				$this->process->activityLog('careers',$this->input->post('cid'),$access['username'].': added career',date('Y/m/d h:i:s a', time()));
			}
		}
		redirect('Careers', 'refresh');
	}

	public function editCareer(){

		$ecid = $this->input->post('ecid');

		if(!isset($ecid)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$careers = $this->session->userdata('careers');
			$index = $this->process->findIndex($careers['careers']['career'],$this->input->post('ecid'));

			if($this->form_validation->run() == TRUE){
				$err_session = array('err_session' => 'Jerome error');
				$this->session->set_userdata($err_session);
			}else{
				//Append newly added types on XML
				$saveThis = array(
					'id' => $this->input->post('ecid'),
					'title' => $this->input->post('ectitle', TRUE),
					'description' => $this->input->post('ecqualifications', TRUE),
					'link' => $this->input->post('eclink', TRUE)
				);

				$inner[0] = 'careers';
				$array = $this->process->OpenXML($inner);
				$id = $this->process->findIndex($array['careers']['career'],$this->input->post('ecid'));
				$this->process->editRows($saveThis, $array, $id, "careers", "career", 'careers');
				$access = $this->session->userdata('access');
				$this->process->activityLog('careers',$this->input->post('ecid'),$access['username'].': edit career',date('Y/m/d h:i:s a', time()));
			}
		}
		redirect('Careers', 'refresh');
	}

	public function deleteCareer(){
		$dcid = $this->input->post('dcid');

		if(!isset($dcid)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$inner[0] = 'careers';
			$session = $this->process->OpenXML($inner);

			$id = $this->process->findIndex($session['careers']['career'],$this->input->post('dcid'));

			$this->process->deleteRow($session, "careers", "career", $id, 'careers');
			//check product if affected (pass in the dtid to check)
			$this->Delete->updateProduct($this->input->post('dcid'));
			$access = $this->session->userdata('access');
			$this->process->activityLog('careers',$this->input->post('dcid'),$access['username'].': deleted career',date('Y/m/d h:i:s a', time()));
		}
		
		redirect('Careers', 'refresh');
	}

	public function destroysession(){
		$this->session->sess_destroy();
	}
}
