<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('process');
		$this->load->model('View');
		$access = $this->session->userdata('access');
		if(null !== $this->session->userdata('access') && $access['news'] == 1){

		}else{
			redirect('admin', 'refresh');
		}
		ob_start();
	}

	public function index(){
		//fetch from model
		$inner[0] = 'newsevents';
		$inner[1] = 'suppliers';
		$array = $this->process->OpenXML($inner);
		$this->load->view('news.php', $array);		
	}

	public function viewdocs(){
		$this->load->view('viewdocs.php');
	}

	public function addNews(){
		$id = $this->input->post('id');

		if(!isset($id)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$result = $this->process->uploadImage($this->input->post('id'), "uploads/newsevents/", "userfile");
			$result1 = $this->process->uploadFile($this->input->post('id'), "uploads/newsevents/readmore/".$this->input->post('id'), "1-userfile");

			if($result!=1||$result1!=1||$this->form_validation->run() == TRUE){
				if($result!=1){
					echo '<script>alert("'.$result.'");</script>';
					redirect('News', 'refresh');
				}if($result1!=1){
					echo '<script>alert("'.$result1.'");</script>';
					redirect('News', 'refresh');
				}
			}else{
				if($this->input->post('w')=='201'){
					$this->process->imageCrop($this->input->post('x'),$this->input->post('w'),$this->input->post('h'),
						$this->input->post('y'),$this->input->post('scale'),$this->input->post('angle'),
						$this->input->post('id'),"uploads/newsevents/");
				}

				//Append newly added types on XML
				$date = explode(" - ", $this->input->post('date-range-picker'));
				$featuring = array('id' => $this->input->post('featuring'));

				$saveThis = 
				array('newsevent' => 
					array(
						'id' => $this->input->post('id'),
						'img' => $this->input->post('id'),
						'title' => $this->input->post('title', TRUE),
						'type' => $this->input->post('type'),
						'from' => $date[0],
						'to' => $date[1],
						'location' => $this->input->post('location', TRUE),
						'description' => $this->input->post('description', TRUE),
						'readmore' => $this->input->post('id')) 
					);

				$inner[0] = 'newsevents';
				$array = $this->process->OpenXML($inner);
				$this->process->addRows($saveThis, "newsevents", "newsevent", $array, 'news');
				$access = $this->session->userdata('access');
				$this->process->activityLog('news',$this->input->post('id'),$access['username'].': added news',date('Y/m/d h:i:s a', time()));
			}
		}
		redirect('News', 'refresh');
	}

	public function editNews(){
		$nid = $this->input->post('nid');

		if(!isset($nid)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{

			$result = $this->process->uploadImageEdit($this->input->post('nid'), "uploads/newsevents/", "userfile1");

			if($result!=1||$this->form_validation->run() == TRUE){
				$err_session = array('err_session' => 'Upload error');
				$this->session->set_userdata($err_session);
			}else{
				if($this->input->post('w')=='201'){
					$this->process->imageCrop($this->input->post('x'),$this->input->post('w'),$this->input->post('h'),
						$this->input->post('y'),$this->input->post('scale'),$this->input->post('angle'),
						$this->input->post('nid'),"uploads/newsevents/");
				}
				
				//Append newly added types on XML
				$date = explode(" - ", $this->input->post('date-range-picker-1'));
				$featuring = array('id' => $this->input->post('efeaturing'));
				$saveThis = 
					array(
						'id' => $this->input->post('nid'),
						'img' => $this->input->post('nid'),
						'title' => $this->input->post('ntitle', TRUE),
						'type' => $this->input->post('ntype'),
						'from' => $date[0],
						'to' => $date[1],
						'location' => $this->input->post('nlocation', TRUE),
						'description' => $this->input->post('ndescription', TRUE),
						'readmore' => $this->input->post('nid')
					);

				$inner[0] = 'newsevents';
				$array = $this->process->OpenXML($inner);
				$id = $this->process->findIndex($array['newsevents']['newsevent'],$this->input->post('nid'));
				$this->process->editRows($saveThis, $array, $id, "newsevents", "newsevent", 'news');
				$access = $this->session->userdata('access');
				$this->process->activityLog('news',$this->input->post('nid'),$access['username'].': edited news',date('Y/m/d h:i:s a', time()));
			}
		}
		redirect('News', 'refresh');
	}

	public function deleteNews(){
		$dnid = $this->input->post('dnid');
		if(!isset($dnid)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$inner[0] = 'newsevents';
			$session = $this->process->OpenXML($inner);

			$id = $this->process->findIndex($session['newsevents']['newsevent'],$this->input->post('dnid'));

			$this->process->deleteRow($session, "newsevents", "newsevent", $id, 'news');		
			//check product if affected (pass in the dtid to check)
			$this->Delete->updateProduct($this->input->post('dnid'));
			$files = glob('uploads/newsevents/readmore/'.$this->input->post('dnid').'/*'); // get all file names
			foreach($files as $file){ // iterate files
			  if(is_file($file))
			    unlink($file); // delete file
			}
			rmdir('uploads/newsevents/readmore/'.$this->input->post('dnid'));
			$access = $this->session->userdata('access');
			$this->process->activityLog('news',$this->input->post('dnid'),$access['username'].': deleted news',date('Y/m/d h:i:s a', time()));
		}
		redirect('News', 'refresh');
	}

	public function editAttachments(){
		$dp_id2 = $this->input->post('dp_id2');

		if(!isset($dp_id2)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$result1 = $this->process->uploadFileEdit($this->input->post('dp_id2'), "uploads/newsevents/readmore/".$this->input->post('dp_id2'), "1-userfile");
			if($result1!=1||$this->form_validation->run() == TRUE){
				if($result!=1){
					$err_session = array('err_session' => 'Upload error');
					$this->session->set_userdata($err_session);
				}if($result1!=1){
					$err_session = array('err_session' => 'Attachment upload error');
					$this->session->set_userdata($err_session);
				}
			}else{
				$access = $this->session->userdata('access');
				$this->process->activityLog('news',$this->input->post('dp_id2'),$access['username'].': edited news attachments',date('Y/m/d h:i:s a', time()));
				echo '<script>alert("Upload successful");</script>';
			}
		}
		redirect('News', 'refresh');
	}

	public function deleteAttachments(){
		$p_id = $this->input->post('p_id');

		if(!isset($p_id)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
			redirect('News', 'refresh');
		}else{
			if(file_exists("uploads/newsevents/readmore/".$this->input->post('p_id')."/".$this->input->post('map'))){
				unlink("uploads/newsevents/readmore/".$this->input->post('p_id')."/".$this->input->post('map'));
				$access = $this->session->userdata('access');
				$this->process->activityLog('news',$this->input->post('p_id'),$access['username'].': deleted news attachments',date('Y/m/d h:i:s a', time()));
				$this->load->view('viewdocs.php');
			}else{
				$err_session = array('err_session' => 'No file exists');
				$this->session->set_userdata($err_session);
			}
		}
	}
}


