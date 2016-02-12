<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Sales extends CI_Controller {
	
	private $data=array();
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->data['base_url'] = base_url();
		$this->load->model('View');
	}

	/*public function index($data = null, $data2 = null, $data3 = null) {
		$this->types();
	}*/
	
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

	public function suppliers($supplierId = null, $typeId = null) {
		$this->data['supplierList'] = $this->getData('suppliers');
		$this->data['productList'] = $this->getData('products');

		$this->data['browseBy'] = "Suppliers";
		if($supplierId != null) {
			$this->data['supplierId'] = $supplierId;
			$this->types('supplier', $typeId);
		} else { 
			$this->data['product_content'] = $this->load->view('brownstone/sales/suppliers.php', $this->data, true);
		}
		
		$this->product();
	}
	
	/*public function industries($industryId = null, $typeId = null) {
		$this->data['industryList'] = $this->getData('industries');

		$this->data['browseBy'] = "Industries";
		if($industryId != null) {
			$this->data['industryId'] = $industryId;
			$this->data['supplierList'] = $this->getData('suppliers');
			$this->types('industry', $typeId);
		} else {
			$this->data['product_content'] = $this->load->view('brownstone/products/industries.php', $this->data, true);
		}

		$this->product();
	}*/
	
	public function types($category = null, $typeId = null) {
		$this->data['typeList'] = $this->getData('types');

		if($category == null || $category == 'list') {
			$this->data['browseBy'] = 'Types';
		}
		if($typeId != null) {
			$this->data['typeId'] = $typeId;
			$this->data['product_content'] = $this->load->view('brownstone/sales/productSelected.php', $this->data, true);
		} else {
			$this->data['product_content'] = $this->load->view('brownstone/sales/products.php', $this->data, true);
		}

		
		if ($category == null && $category != 'list') {
			$this->product();
		}

	}
	
	/*public function all($data2=null) {
		$this->data['by']="productAll";
		$this->data['productsSideList']=$this->load->view('brownstone/products/byProducts/productsSideList', $this->data, true);
		$this->data['product_content']=$this->load->view('brownstone/products/byProducts/allProducts', $this->data, true);
		$this->data['browseBy']="type";
		$this->product();
	}*/
	
	public function product() {
		$this->data['content'] = $this->load->view('brownstone/sale.php', $this->data, true);

		$this->data['pageTitle'] = "Products";
		$this->data['active'] = "sale";
		$this->load->view('template', $this->data);
	}
	
}