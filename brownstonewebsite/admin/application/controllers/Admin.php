<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct(){
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->model('View');
    	$this->load->library('session');
    	$this->load->library('process');
    	ob_start();
    }

	public function index(){
		if(null !== $this->session->userdata('access')){
			$this->load->view('dashboard');
		}else{
			$this->load->view('admin');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('admin', 'refresh');
	}

	public function login(){
		$inner[0] = 'logins';
		$array = $this->process->OpenXML($inner);
		$array = $array['logins'];
		$username = $this->input->post('username');
		$password = $this->input->post('password');	
		
		//$password = md5($password);
		if(!empty($username)&&!empty($password)){
			for($x=0; $x<sizeof($array['login']); $x++){
				if($username==$array['login'][$x]['name']&&md5($password)==$array['login'][$x]['password']){
					$access = array(
						'banners' => 0,
						'products' => 0,
						'news' => 0,
						'careers' => 0,
						'settings' => 0,
						'types' => 0,
						'suppliers' => 0,
						'industries' => 0,
						'users' => $array['login'][$x]['level'],
						'username' => $username
					);
					//sessions
					

					$key = $array['login'][$x]['access'];
					if($key>=16){
						$access['settings'] = 1;
					}

					if($key>=64){
						$key-=64;
						$access['industries'] = 1;
					}
					if($key>=32){
						$key-=32;
						$access['suppliers'] = 1;
					}
					if($key>=16){
						$key-=16;
						$access['types'] = 1;
					}
					if($key>=8){
						$key-=8;
						$access['careers'] = 1;
					}
					if($key>=4){
						$key-=4;
						$access['news'] = 1;
					}
					if($key>=2){
						$key-=2;
						$access['products'] = 1;
					}
					if($key>=1){
						$key-=1;
						$access['banners'] = 1;
					}

					$session = array('access' => $access);
					$this->session->set_userdata($session);
					redirect('dashboard');
				}
			}
			$result = array(
				"error" => "Invalid username and password"
			);
			$this->load->view('admin', $result);
		}else{
			$result = array(
				"error" => "Empty Field"
				);
			$this->load->view('admin', $result);
		}
	}
}
