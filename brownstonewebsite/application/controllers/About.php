<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {
	
	private $data=array();
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->data['base_url'] = base_url();
	}

	public function index() {
		$this->data['content'] = $this->load->view('brownstone/about.php', $this->data, true);

		$this->data['pageTitle'] = "About";
		$this->data['active'] = "about";
		$this->load->view('template', $this->data);
	}
	
}