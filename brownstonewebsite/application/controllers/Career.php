<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Career extends CI_Controller {
	
	private $data=array();
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->data['base_url'] = base_url();
		$this->load->model('View');
	}

	public function index() {
		$this->data['careers'] = $this->View->loadCareers();
		$this->data['content'] = $this->load->view('brownstone/career.php', $this->data, true);

		$this->data['pageTitle'] = "Careers";
		$this->data['active'] = "career";
		$this->load->view('template', $this->data);
	}
	
}