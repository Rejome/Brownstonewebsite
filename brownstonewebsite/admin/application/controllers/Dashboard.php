<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct(){
    	parent::__construct();
    	$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('process');
		$this->load->model('View');
		if(null !== $this->session->userdata('access')){
			$this->load->view('dashboard.php');
		}else{
			redirect('admin', 'refresh');
		}
		ob_start();
    }

	public function index(){
		
	}
}
