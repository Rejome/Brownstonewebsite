<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->data['base_url'] = base_url();
		$this->load->model('View');
	}
	
	public function index() {
		$this->data['productList'] = $this->getData('products');
		$this->data['typeList'] = $this->getData('types');
		$this->data['supplierList'] = $this->getData('suppliers');
		$this->data['industryList'] = $this->getData('industries');
		$this->data['newsList'] = $this->getData('news');

		$this->data['newsPage'] = 'home';
		$this->data['newsEvents'] = $this->View->loadNews();
		$this->data['banners'] = $this->View->loadBanner();
		$this->data['eventList'] = $this->load->view('brownstone/news/eventList', $this->data,true);
		$this->data['content'] = $this->load->view('brownstone/index.php', $this->data, true);

		$this->data['pageTitle'] = "Homepage";
		$this->data['active'] = "home";
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
		} elseif($category == 'news') {
			$c_data = $this->View->loadNews();
			$c_index = 'newsevent';
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
}
?>