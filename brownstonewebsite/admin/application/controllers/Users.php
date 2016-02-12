<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('process');
		$this->load->model('View');
		$access = $this->session->userdata('access');
		if(null !== $this->session->userdata('access') && $access['users'] == 'admin'){

		}else{
			redirect('admin', 'refresh');
		}
		ob_start();
	}

	public function index(){
		$inner[0] = 'logins';
		$inner[1] = 'histories';
		$array = $this->process->OpenXML($inner);
		$this->load->view('users.php', $array);
	}

	public function addUsers(){
		$username = $this->input->post('username', TRUE);

		if(!isset($username)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			if($this->input->post('password') == $this->input->post('cpassword')){
				$result = 0;
			}else{
				$result = 1;
			}
			$inner[0] = 'logins';
			$array = $this->process->OpenXML($inner);
			$id = $this->process->findUser($array['logins']['login'],$this->input->post('username'));
			if($id!=-1){
				echo "Duplicate username";
				redirect('Users', 'refresh');
			}

			if($result==1||$this->form_validation->run() == TRUE){
				echo '<script>alert("Validation Error");</script>';
				redirect('Users', 'refresh');
			}else{
				if($this->input->post('level') == 'admin'){
					$access = 127;
				}else{	
					$access = array_sum($this->input->post('access'));
				}
				$saveThis = 
				array( 
					'login' => 
					array(
						'name' => $this->input->post('username', TRUE),
						'password' => md5($this->input->post('password')),
						'level' => $this->input->post('level'),
						'access' => $access
						)
					);
				$this->process->addRows($saveThis, "logins", "login", $array, 'logins');
			}
		}
		redirect('Users', 'refresh');
	}

	public function editUsers(){
		$eusername = $this->input->post('eusername');

		if(!isset($eusername)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$inner[0] = 'logins';
			$array = $this->process->OpenXML($inner);
			$id = $this->process->findUser($array['logins']['login'],$this->input->post('eusername'));

			if($this->input->post('epassword') == $this->input->post('ecpassword')){
				$epassword = $this->input->post('epassword');
				if(empty($epassword)){
					$password = $array['logins']['login'][$id]['password'];
				}else{
					$password = md5($epassword);
				}
				$result = 0;
			}else{
				$result = 1;
			}

			if($result==1&&$this->form_validation->run() == TRUE){
				echo '<script>alert("Validation Error");</script>';
				redirect('Settings', 'refresh');
			}else{
				if($this->input->post('elevel') == 'admin'){
					$access = 127;
				}else{	
					$access = array_sum($this->input->post('eaccess'));
				}
				$saveThis = array( 
					'name' => $this->input->post('eusername'),
					'password' => $password,
					'level' => $this->input->post('elevel'),
					'access' => $access
					);

				$this->process->editRows($saveThis, $array, $id, "logins", "login", 'logins');
			}
		}
		redirect('Users', 'refresh');
	}

	public function deleteUser(){
		$duid = $this->input->post('duid');

		if(!isset($duid)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$inner[0] = 'logins';
			$array = $this->process->OpenXML($inner);

			$id = $this->process->findUser($array['logins']['login'],$this->input->post('duid'));

			$this->process->deleteRow($array, "logins", "login", $id, 'logins');		
			//check product if affected (pass in the dtid to check)
			//$this->Delete->updateProduct($this->input->post('dpid'));
		}
		redirect('Users', 'refresh');
	}
}

?>