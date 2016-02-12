<?php

class View extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}

	public function load($inner){
		$array = json_decode(json_encode((array)simplexml_load_file("xml/".$inner.".xml")),1);
		return $array;
	}

}

?>