<?php

class View extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}

	public function loginview(){
		$array = json_decode(json_encode((array)simplexml_load_file("admin/xml/login.xml")),1); 
		$username = $this->input->post('username');
		$password = $this->input->post('password');	
		if(!empty($username)&&!empty($password)){
			for($x=0; $x<sizeof($array['login']); $x++){
				if($username==$array['login'][$x]['name']){
					if($password==$array['login'][$x]['password']){
						return 0;
					}else{
						return 1;
					}
				}
			}
			return 1;
		}else{
			return 2;
		}
	}

	public function loadTypes(){
		$array = json_decode(json_encode((array)simplexml_load_file("admin/xml/types.xml")),1); 
		return $array;
	}

	public function loadIndustries(){
		$array = json_decode(json_encode((array)simplexml_load_file("admin/xml/industries.xml")),1); 
		return $array;
	}

	public function loadSuppliers(){
		$array = json_decode(json_encode((array)simplexml_load_file("admin/xml/suppliers.xml")),1); 
		return $array;
	}

	public function loadCareers(){
		$array = json_decode(json_encode((array)simplexml_load_file("admin/xml/careers.xml")),1); 
		return $array;
	}

	public function loadNews(){
		$array = json_decode(json_encode((array)simplexml_load_file("admin/xml/newsevents.xml")),1); 
		return $array;
	}

	public function loadBanner(){
		$array = json_decode(json_encode((array)simplexml_load_file("admin/xml/banners.xml")),1); 
		return $array;
	}

	public function loadProducts(){
		$array = json_decode(json_encode((array)simplexml_load_file("admin/xml/products.xml")),1); 
		return $array;
	}

}

?>