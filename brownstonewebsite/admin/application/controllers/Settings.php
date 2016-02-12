<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('process');
		$this->load->model('View');
		$access = $this->session->userdata('access');
		if(null !== $this->session->userdata('access') && $access['settings'] == 1){

		}else{
			redirect('admin', 'refresh');
		}
		ob_start();
	}

	public function index(){
		
			$inner[0] = 'types';
			$inner[1] = 'industries';
			$inner[2] = 'suppliers';
			$array = $this->process->OpenXML($inner);
			$this->load->view('settings.php', $array);
		
	}

	public function destroysession(){
		$this->session->sess_destroy();
		redirect('Settings', 'refresh');
	}

	public function addType(){
		$tid = $this->input->post('tid');

		if(!isset($tid)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$result =  $this->process->uploadImage($this->input->post('tid'), "uploads/types/", "userfile");

			if($result!=1&&$this->form_validation->run() == FALSE){
				$err_session = array('err_session' => 'Upload error');
				$this->session->set_userdata($err_session);
			}else{
				if($this->input->post('w')=='201'){
					$this->process->imageCrop($this->input->post('x'),$this->input->post('w'),$this->input->post('h'),
												$this->input->post('y'),$this->input->post('scale'),$this->input->post('angle'),
												$this->input->post('tid'),"uploads/types/");
				}
				$saveThis = 
				array('type' => 
					array(
						'id' => $this->input->post('tid'),
						'img' => $this->input->post('tid'),
						'name' => $this->input->post('tname', TRUE),
						'short' => $this->input->post('tshort', TRUE)) 
					);
				$inner[0] = 'types';
				$array = $this->process->OpenXML($inner);
				$this->process->addRows($saveThis, "types", "type", $array, 'settings');
				$access = $this->session->userdata('access');
				$this->process->activityLog('types',$this->input->post('tid'),$access['username'].': added types',date('Y/m/d h:i:s a', time()));
			}
		}
		redirect('Settings', 'refresh');
	}

	public function addIndustry(){
		$iid = $this->input->post('iid');

		if(!isset($iid)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$result = $this->process->uploadImage($this->input->post('iid'), "uploads/industries/", "userfile2");

			if($result!=1&&$this->form_validation->run() == FALSE){
				$err_session = array('err_session' => 'Upload error');
				$this->session->set_userdata($err_session);
			}else{
				if($this->input->post('w')=='201'){
					$this->process->imageCrop($this->input->post('x'),$this->input->post('w'),$this->input->post('h'),
												$this->input->post('y'),$this->input->post('scale'),$this->input->post('angle'),
												$this->input->post('iid'),"uploads/industries/");
				}
				//Append newly added types on XML
				$saveThis =
				array('industry' => 
					array(
						'id' => $this->input->post('iid'),
						'title' => $this->input->post('ititle', TRUE),
						'img' => $this->input->post('iid')
						)
					);

				$inner[0] = 'industries';
				$array = $this->process->OpenXML($inner);
				$this->process->addRows($saveThis, "industries", "industry", $array, 'settings');
				$access = $this->session->userdata('access');
				$this->process->activityLog('industries',$this->input->post('iid'),$access['username'].': added industries',date('Y/m/d h:i:s a', time()));
			}
		}
		redirect('Settings', 'refresh');
	}

	public function addSupplier(){
		$sid = $this->input->post('sid');

		if(!isset($sid)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$result = $this->process->uploadImage($this->input->post('sid'), "uploads/suppliers/", "userfile5");

			if($result!=1&&$this->form_validation->run() == FALSE){
				$err_session = array('err_session' => 'Upload error');
				$this->session->set_userdata($err_session);
			}else{
				if($this->input->post('w')=='161'){
					$this->process->imageCrop($this->input->post('x'),$this->input->post('w'),$this->input->post('h'),
												$this->input->post('y'),$this->input->post('scale'),$this->input->post('angle'),
												$this->input->post('sid'),"uploads/suppliers/");
				}
				
				$saveThis = 
				array('supplier' => 
					array(
						'id' => $this->input->post('sid'),
						'title' => $this->input->post('stitle', TRUE),
						'site' => $this->input->post('ssite', TRUE),
						'img' => $this->input->post('sid')
						)
					);

				$inner[0] = 'suppliers';
				$array = $this->process->OpenXML($inner);
				$this->process->addRows($saveThis, "suppliers", "supplier", $array, 'settings');
				$access = $this->session->userdata('access');
				$this->process->activityLog('supplier',$this->input->post('sid'),$access['username'].': added suppliers',date('Y/m/d h:i:s a', time()));
			}
		}
		redirect('Settings', 'refresh');
	}

	public function editType(){
		$etid = $this->input->post('etid');

		if(!isset($etid)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$result = $this->process->uploadImageEdit($this->input->post('etid'), "uploads/types/", "userfile1");

			if($result!=1&&$this->form_validation->run() == FALSE){
				$err_session = array('err_session' => 'Upload error');
				$this->session->set_userdata($err_session);
			}else{

				if($this->input->post('w')=='201'){
					$this->process->imageCrop($this->input->post('x'),$this->input->post('w'),$this->input->post('h'),
												$this->input->post('y'),$this->input->post('scale'),$this->input->post('angle'),
												$this->input->post('etid'),"uploads/types/");
				}

				//Append newly added types on XML
				$saveThis = array(
					'id' => $this->input->post('etid'),
					'img' => $this->input->post('etid'),
					'name' => $this->input->post('etname', TRUE),
					'short' => $this->input->post('etshort', TRUE)
					);

				$inner[0] = 'types';
				$session = $this->process->OpenXML($inner);
				$id = $this->process->findIndex($session['types']['type'],$this->input->post('etid'));
				$this->process->editRows($saveThis, $session, $id, "types", "type", 'settings');
				$access = $this->session->userdata('access');
				$this->process->activityLog('types',$this->input->post('etid'),$access['username'].': edited types',date('Y/m/d h:i:s a', time()));
			}
		}
		redirect('Settings', 'refresh');
	}

	public function editIndustry(){
		$eiid = $this->input->post('eiid');

		if(!isset($eiid)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$result = $this->process->uploadImageEdit($this->input->post('eiid'), "uploads/industries/", "userfile3");
		
			if($result!=1&&$this->form_validation->run() == FALSE){
				$err_session = array('err_session' => 'Upload error');
					$this->session->set_userdata($err_session);
			}else{

				if($this->input->post('w')=='201'){
					$this->process->imageCrop($this->input->post('x'),$this->input->post('w'),$this->input->post('h'),
												$this->input->post('y'),$this->input->post('scale'),$this->input->post('angle'),
												$this->input->post('eiid'),"uploads/industries/");
				}

				//Append newly added types on XML
				$saveThis = array(
					'id' => $this->input->post('eiid'),
					'title' => $this->input->post('eititle', TRUE),
					'img' => $this->input->post('eiid')
					);

				$inner[0] = 'industries';
				$session = $this->process->OpenXML($inner);
				$id = $this->process->findIndex($session['industries']['industry'],$this->input->post('eiid'));
				$this->process->editRows($saveThis, $session, $id, "industries", "industry", 'settings');
				$access = $this->session->userdata('access');
				$this->process->activityLog('industries',$this->input->post('eiid'),$access['username'].': edited industry',date('Y/m/d h:i:s a', time()));
			}
		}
		redirect('Settings', 'refresh');
	}

	public function editSupplier(){
		$esid = $this->input->post('esid');

		if(!isset($esid)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$result = $this->process->uploadImageEdit($this->input->post('esid'), "uploads/suppliers/", "userfile6");

			if($result!=1&&$this->form_validation->run() == FALSE){
				$err_session = array('err_session' => 'Upload error');
				$this->session->set_userdata($err_session);
			}else{
				if($this->input->post('w')=='161'){
					$this->process->imageCrop($this->input->post('x'),$this->input->post('w'),$this->input->post('h'),
												$this->input->post('y'),$this->input->post('scale'),$this->input->post('angle'),
												$this->input->post('esid'),"uploads/suppliers/");
				}
				//Append newly added types on XML
				$saveThis = array(
					'id' => $this->input->post('esid'),
					'title' => $this->input->post('estitle', TRUE),
					'site' => $this->input->post('essite', TRUE),
					'img' => $this->input->post('esid')
					);

				$inner[0] = 'suppliers';
				$session = $this->process->OpenXML($inner);
				$id = $this->process->findIndex($session['suppliers']['supplier'],$this->input->post('esid'));
				$this->process->editRows($saveThis, $session, $id, "suppliers", "supplier", 'settings');
				$access = $this->session->userdata('access');
				$this->process->activityLog('suppliers',$this->input->post('esid'),$access['username'].': edited suppliers',date('Y/m/d h:i:s a', time()));
			}
		}
		redirect('Settings', 'refresh');
	}

	public function deleteType(){
		$dtid = $this->input->post('dtid');

		if(!isset($dtid)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$inner[0] = 'types';
			$session = $this->process->OpenXML($inner);

			$id = $this->process->findIndex($session['types']['type'],$this->input->post('dtid'));
			
			$this->process->deleteRow($session, "types", "type", $id, 'settings');		
			//check product if affected (pass in the dtid to check)
			$this->process->updateProduct($this->input->post('dtid'),"Types");
			$access = $this->session->userdata('access');
			$this->process->activityLog('types',$this->input->post('dtid'),$access['username'].': deleted type',date('Y/m/d h:i:s a', time()));
		}
		redirect('Settings', 'refresh');
	}

	public function deleteIndustry(){
		$diid = $this->input->post('diid');

		if(!isset($diid)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$inner[0] = 'industries';
			$session = $this->process->OpenXML($inner);

			$id = $this->process->findIndex($session['industries']['industry'],$this->input->post('diid'));

			$this->process->deleteRow($session, "industries", "industry", $id, 'settings');
			//check product if affected (pass in the dtid to check)
			$this->process->updateProduct($this->input->post('diid'),"Industries");
			$access = $this->session->userdata('access');
			$this->process->activityLog('industries',$this->input->post('diid'),$access['username'].': deleted industry',date('Y/m/d h:i:s a', time()));
		}
		//redirect('Settings', 'refresh');
	}

	public function deleteSupplier(){
		$dsid = $this->input->post('dsid');

		if(!isset($dsid)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$inner[0] = 'suppliers';
			$session = $this->process->OpenXML($inner);

			$id = $this->process->findIndex($session['suppliers']['supplier'],$this->input->post('dsid'));

			$this->process->deleteRow($session, "suppliers", "supplier", $id, 'settings');
			//check product if affected (pass in the dtid to check)
			$this->process->updateProduct($this->input->post('dsid'),"Suppliers");
			$access = $this->session->userdata('access');
			$this->process->activityLog('supplier',$this->input->post('dsid'),$access['username'].': deleted supplier',date('Y/m/d h:i:s a', time()));
		}
		redirect('Settings', 'refresh');
	}
}
