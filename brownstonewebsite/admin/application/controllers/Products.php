<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('process');
		$this->load->model('View');
		$access = $this->session->userdata('access');
		$products = $access['products'];
		if(null !== $this->session->userdata('access') && $products == 1){

		}else{
			redirect('admin', 'refresh');
		}
		ob_start();
	}

	public function index(){
		$inner[0] = 'types';
		$inner[1] = 'industries';
		$inner[2] = 'suppliers';
		$inner[3] = 'products';
		$array = $this->process->OpenXML($inner);
		$this->load->view('products.php', $array);
	}	

	public function viewdocs(){
		$this->load->view('viewdocs.php');
	}


	public function addProduct(){
		$id = $this->input->post('id');

		if(!isset($id)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$result = $this->process->uploadImage($this->input->post('id'), "uploads/products/", "userfile");
			$result1 = $this->process->uploadFile($this->input->post('id'), "uploads/products/attachments/".$this->input->post('id'), "1-userfile");

			if($result!=1||$result1!=1||$this->form_validation->run() == TRUE){
				if($result!=1){
					echo '<script>alert("'.$result.'");</script>';
					redirect('Products', 'refresh');
				}if($result1!=1){
					echo '<script>alert("'.$result1.'");</script>';
					redirect('Products', 'refresh');
				}
			}else{
				$findustries = $this->input->post('industries');
				for($x=0; $x<sizeof($findustries); $x++){
					$industries['industry'][$x]['id'] = $findustries[$x];
				}

				$types['type']['id'] = $this->input->post('types');
				$suppliers = $this->input->post('supplier');

				if($this->input->post('w')=='201'){
					$this->process->imageCrop($this->input->post('x'),$this->input->post('w'),$this->input->post('h'),
												$this->input->post('y'),$this->input->post('scale'),$this->input->post('angle'),
												$this->input->post('id'),"uploads/products/");
				}
				$sale = $this->input->post('sale');
				$stock = $this->input->post('stock');
				$saveThis = 
				array( 
					'product' => 
					array(
						'id' => $this->input->post('id'),
						'img' => $this->input->post('id'),
						'name' => $this->input->post('name'),
						'types' => $types,
						'description' => $this->input->post('description'),
						'supplier' => $suppliers, 
						'industries' => $industries,
						'sale' => (!empty($sale) ? $this->input->post('sale') : "N/A"),
						'stock' => (!empty($stock) ? $this->input->post('stock') : "N/A")
						)
					);

				$inner[0] = 'products';
				$array = $this->process->OpenXML($inner);
				$this->process->addRows($saveThis, "products", "product", $array, 'products');
				$access = $this->session->userdata('access');
				$this->process->activityLog('products',$this->input->post('id'),$access['username'].': added product',date('Y/m/d h:i:s a', time()));
			}
		}
		redirect('Products', 'refresh');
	}

	public function editProduct(){
		$id = $this->input->post('eid');

		if(!isset($id)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$result = $this->process->uploadImageEdit($this->input->post('eid'), "uploads/products/", "userfile1");

			if($result!=1&&$this->form_validation->run() == FALSE){
				echo '<script>alert("'.$result.'");</script>';
				redirect('Settings', 'refresh');
			}else{
				$eindustries = $this->input->post('eindustries');
				for($x=0; $x<sizeof($eindustries); $x++){
					$industries['industry'][$x]['id'] = $eindustries[$x];
				}

				$types['type']['id'] = $this->input->post('etypes');
				$suppliers = $this->input->post('esuppliers');

				if($this->input->post('w')=='201'){
					$this->process->imageCrop($this->input->post('x'),$this->input->post('w'),$this->input->post('h'),
												$this->input->post('y'),$this->input->post('scale'),$this->input->post('angle'),
												$this->input->post('eid'),"uploads/products/");
				}
				$sale = $this->input->post('esale');
				$stock = $this->input->post('estock');
				//Append newly added types on XML
				$saveThis = array(
					'id' => $this->input->post('eid'),
					'img' => $this->input->post('eid'),
					'name' => $this->input->post('ename'),
					'types' => $types,
					'description' => $this->input->post('edescription'),
					'supplier' => $suppliers, 
					'industries' => $industries,
					'sale' => (!empty($sale) ? $this->input->post('esale') : "N/A"),
					'stock' => (!empty($stock) ? $this->input->post('estock') : "N/A")
					);

				$inner[0] = 'products';
				$array = $this->process->OpenXML($inner);
				$id = $this->process->findIndex($array['products']['product'],$this->input->post('eid'));
				$this->process->editRows($saveThis, $array, $id, "products", "product", 'products');
				$access = $this->session->userdata('access');
				$this->process->activityLog('products',$this->input->post('eid'),$access['username'].': edited product',date('Y/m/d h:i:s a', time()));
			}
		}
		redirect('Products', 'refresh');
	}

	public function deleteProduct(){
		$dpid = $this->input->post('dpid');

		if(!isset($dpid)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$inner[0] = 'products';
			$array = $this->process->OpenXML($inner);

			$id = $this->process->findIndex($array['products']['product'],$this->input->post('dpid'));

			$this->process->deleteRow($array, "products", "product", $id, 'products');		
			//check product if affected (pass in the dtid to check)
			//$this->Delete->updateProduct($this->input->post('dpid'));
			$files = glob("uploads/products/attachments/".$this->input->post('dpid').'/*'); // get all file names
			foreach($files as $file){ // iterate files
			  if(is_file($file))
			    unlink($file); // delete file
			}
			rmdir("uploads/products/attachments/".$this->input->post('dpid'));
			$access = $this->session->userdata('access');
			$this->process->activityLog('products',$this->input->post('dpid'),$access['username'].': deleted product',date('Y/m/d h:i:s a', time()));
		}
		redirect('Products', 'refresh');
	}

	public function editAttachments(){
		$dp_id2 = $this->input->post('dp_id2');

		if(!isset($dp_id2)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
		}else{
			$result1 = $this->process->uploadFileEdit($this->input->post('dp_id2'), "uploads/products/attachments/".$this->input->post('dp_id2'), "1-userfile");
		
			if($result1!=1||$this->form_validation->run() == TRUE){
				if($result1!=1){
					echo '<script>alert("'.$result1.'");</script>';
					redirect('Products', 'refresh');
				}
			}else{
				$access = $this->session->userdata('access');
				$this->process->activityLog('products',$this->input->post('dp_id2'),$access['username'].': edited product attachments',date('Y/m/d h:i:s a', time()));
				echo '<script>alert("Upload successful");</script>';
			}
		}
		redirect('Products', 'refresh');
	}

	public function deleteAttachments(){
		$p_id = $this->input->post('p_id');

		if(!isset($p_id)){
			$err_session = array('err_session' => 'Error');
			$this->session->set_userdata($err_session);
			redirect('Products', 'refresh');
		}else{
			unlink("uploads/products/attachments/".$this->input->post('p_id')."/".$this->input->post('map'));
			$access = $this->session->userdata('access');
			$this->process->activityLog('products',$this->input->post('p_id'),$access['username'].': deleted product attachments',date('Y/m/d h:i:s a', time()));
			$this->load->view('viewdocs.php');
		}
		
	}

}
