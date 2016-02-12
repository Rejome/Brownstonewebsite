<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {
	
	private $data=array();
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->data['base_url'] = base_url();
		$this->load->model('View');
	}

	public function index() {
		$this->data['content'] = $this->load->view('brownstone/contact.php', $this->data, true);

		$this->data['pageTitle'] = "Contact Us";
		$this->data['active'] = "contact";
		$this->load->view('template', $this->data);
	}

	public function getData($category = null) {
		if($category == 'suppliers') {
			$c_data = $this->View->loadSuppliers();
			$c_index = 'supplier';
		} elseif($category == 'types') {
			$c_data = $this->View->loadTypes();
			$c_index = 'type';
		} elseif($category == 'industries') {
			$c_data = $this->View->loadIndustries();
			$c_index = 'industry';
		} elseif($category == 'products') {
			$c_data = $this->View->loadProducts();
			$c_index = 'product';
		}

		if(!isset($c_data[$c_index][0])){
			$temp = $c_data;
			$c_data = array();
			$c_data[$c_index][0] = $temp[$c_index];
		}

		$orderedC = array();
		$cAll = array();
		foreach($c_data[$c_index] as $cat) {
			$cAll[$cat['id']] = $cat;
			if(isset($cat['short'])) {
				$orderedC[$cat['id']] =  $cat['short'];
			} elseif(isset($cat['title'])) {
				$orderedC[$cat['id']] =  $cat['title'];
			} elseif(isset($cat['name'])) {
				$orderedC[$cat['id']] =  $cat['name'];
			}
		}
		asort($orderedC);

		return array('categoryAll' => $cAll, 'orderedCategory' => $orderedC);
	}
	
	public function inquire($category = null, $categoryId = null) {
		$this->data['supplierList'] = $this->getData('suppliers');
		$this->data['productList'] = $this->getData('products');
		$this->data['typeList'] = $this->getData('types');
		$this->data['industryList'] = $this->getData('industries');

		$this->data['category'] = $category;
		$this->data['categoryId'] = $categoryId;

		$this->data['content'] = $this->load->view('brownstone/contact.php', $this->data, true);

		$this->data['pageTitle'] = "Contact Us";
		$this->data['active'] = "contact";
		$this->load->view('template', $this->data);
	}
	
	public function inquire2($data = null) {
		if($data != null) {
			$this->data['type66'] = $data;
		}

		$this->data['content'] = $this->load->view('brownstone/contact.php', $this->data, true);

		$this->data['pageTitle'] = "Contact Us";
		$this->data['active'] = "contact";
		$this->load->view('template', $this->data);
	}
	
	public function thanks($data=null) {
		if(isset($_POST['author'])) {
				$config = Array(		
			    'protocol' => 'smtp',
			    'smtp_host' => 'ssl://smtp.googlemail.com',
			    'smtp_port' => 465,
			    'smtp_user' => 'brownstone.website@gmail.com',
			    'smtp_pass' => 'brownstone2013',
			    'smtp_timeout' => '4',
			    'mailtype'  => 'text', 
			    'charset'   => 'iso-8859-1'
			);
	 
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			
			$this->email->from('brownstone.website@gmail.com', 'Website');
			//$this->email->to('rguevarra@brownstone-asiatech.com');
			$this->email->to('sales@brownstone-asiatech.com');
			$this->email->cc('batinc@pldtdsl.net,aebate@brownstone-asiatech.com');
			$this->email->subject("Inquiry of Company: ".$_POST['subject']);
			$this->email->message($_POST['author']." \n ".$_POST['mobile']." \n ".$_POST['email']." \n \n \n \n".$_POST['message']);
			$result = $this->email->send();

			$this->data['content'] = $this->load->view('brownstone/thanks.php', $this->data, true);

			$this->data['pageTitle'] = "Thank you";
			$this->data['active'] = "contact";
			$this->load->view('template', $this->data);

			/*
			$this->email->from('rguevarra@brownstone-asiatech.com', 'Website');
			$this->email->to('rguevarra@brownstone-asiatech.com');
			$this->email->cc('');
			$this->email->bcc('');
			$this->email->subject($_POST['subject']);
			$this->email->message("From: ".$_POST['author']." \n Email:".$_POST['email']." \n ".$_POST['editor1']);
			$this->email->send();
			
			echo $this->email->print_debugger();& */
		}
	}
}