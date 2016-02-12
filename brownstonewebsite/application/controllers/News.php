<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
	
	private $data=array();
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->data['base_url'] = base_url();
		$this->load->model('View');
	}
	
	public function all($data=null, $data2 = null) {
		$this->data['active'] = "news";
		$this->data['page'] = "news";

		if(!empty($data)) {
			$this->data['scrollyes'] = "";
		}
		
		$this->data['newsPage'] = 'news';
		$this->data['selectedDate'] = $data;
		$this->data['newsEvents'] = $this->View->loadNews();
		$this->data['eventList'] = $this->load->view('brownstone/news/eventList', $this->data,true);
		$this->data['event'] = $this->load->view('brownstone/news/eventAll', $this->data, true);
		
		$this->data['content'] = $this->load->view('brownstone/news.php', $this->data, true);

		$this->data['pageTitle'] = "News and Events";
		$this->data['active'] = "news";
		$this->load->view('template', $this->data);
	}
	
}