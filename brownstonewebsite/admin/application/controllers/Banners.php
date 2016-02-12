<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends CI_Controller {
	
	public function __construct(){
    	parent::__construct();
    	$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('process');
		$this->load->model('View');
		$access = $this->session->userdata('access');
		if(null !== $this->session->userdata('access') &&  $access['banners'] == 1){
		
		}else{
			redirect('admin', 'refresh');
		}
		ob_start();
    }

	public function index(){
		$inner[0] = 'banners';
		$array = $this->process->OpenXML($inner);
		$this->load->view('banners.php', $array);		
	}

	public function AddBanner(){
		
		$id = $this->input->post('id');
		
		if(!isset($id)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$result = $this->process->uploadImage($this->input->post('id'), "uploads/banners/", "userfile", "banners");
			if($result!=1||$this->form_validation->run() == TRUE){
				$err_session = array('err_session' => 'Upload Error');
				$this->session->set_userdata($err_session);
			}else{
				if($this->input->post('w')=='1001'){
					$this->process->imageCrop($this->input->post('x'),$this->input->post('w'),$this->input->post('h'),
						$this->input->post('y'),$this->input->post('scale'),$this->input->post('angle'),
						$this->input->post('id'),"uploads/banners/");
				}
				//Append newly added types on XML
				$saveThis = 
				array('banner' => 
					array(
						'id' => $this->input->post('id'),
						'img' => $this->input->post('id'),
						'cid' => $this->input->post('cid'),
						'banner' => $this->input->post('banner'),
						'category' => $this->input->post('category'),
					)	
				);
				$inner[0] = 'banners';
				$array = $this->process->OpenXML($inner);
				$this->process->addRows($saveThis, "banners", "banner", $array, 'banners');
				$access = $this->session->userdata('access');
				$this->process->activityLog('banners',$this->input->post('id'),$access['username'].': added banner',date('Y/m/d h:i:s a', time()));
			}
		}
		redirect('Banners', 'refresh');
	}

	public function editBanner(){
		
		$id = $this->input->post('eid');

		if(!isset($id)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$result = $this->process->uploadImageEdit($this->input->post('eid'), "uploads/banners/", "userfile1");
			if($result!=1&&$this->form_validation->run() == FALSE){
				$err_session = array('err_session' => 'Upload Error');
				$this->session->set_userdata($err_session);
			}else{

				if($this->input->post('w')=='1001'){
					$this->process->imageCrop($this->input->post('x'),$this->input->post('w'),$this->input->post('h'),
						$this->input->post('y'),$this->input->post('scale'),$this->input->post('angle'),
						$this->input->post('eid'),"uploads/banners/");
				}
				//Append newly added types on XML
				$saveThis = 
					array(
						'id' => $this->input->post('eid'),
						'img' => $this->input->post('eid'),
						'cid' => $this->input->post('ecid'),
						'banner' => $this->input->post('ebanner'),
						'category' => $this->input->post('ecategory'),
					
				);

				$inner[0] = 'banners';
				$array = $this->process->OpenXML($inner);
				$id = $this->process->findIndex($array['banners']['banner'],$this->input->post('eid'));
				$this->process->editRows($saveThis, $array, $id, "banners", "banner", "banners");
				$access = $this->session->userdata('access');
				$this->process->activityLog('banners',$this->input->post('eid'),$access['username'].': edited banner',date('Y/m/d h:i:s a', time()));
			}
		}
		redirect('Banners', 'refresh');
	}

	public function deleteBanner(){
		$idx = $this->input->post('ddid');

		if(!isset($idx)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$inner[0] = 'banners';
			$array = $this->process->OpenXML($inner);

			
			$id = $this->process->findIndex($array['banners']['banner'],$this->input->post('ddid'));

			$this->process->deleteRow($array, "banners", "banner", $id, 'banners');		
			//check product if affected (pass in the dtid to check)
			//$this->process->updateProduct($this->input->post('ddid'));
			$access = $this->session->userdata('access');
			$this->process->activityLog('banners',$this->input->post('ddid'),$access['username'].': deleted banner',date('Y/m/d h:i:s a', time()));
		}
		redirect('Banners', 'refresh');
	}

	public function bannerdocs(){
		$this->load->view('bannerdocs.php');
	}

	public function bannerdocsedit(){
		$this->load->view('bannerdocsedit.php');
	}
}
