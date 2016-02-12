<?php

class Delete extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('View');
		$this->load->library('session');
	}

	public function deleteRows($inner, $page, $session){
		require_once('XmlDomConstruct.php');
		$this->dom = new XmlDomConstruct('1.0', 'utf-8');
		$this->dom->fromMixed(array($inner => $session[$inner]));
		$this->dom->preserveWhiteSpace = false;
		$this->dom->formatOutput = true;
		$this->dom->save("xml/".$inner.".xml");
	}

	public function updateProduct($dtid){

	}

}





?>