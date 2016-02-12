<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Process{
	
	public function addRows($arr, $inner, $outer, $session, $categ){
		$CI =& get_instance();
		$CI->load->model('Add');

		if(sizeof($session[$inner][$outer])==0){
			$session[$inner][$outer] = $arr[$outer];
		}else{
			array_push($session[$inner], $arr);
		}

		$CI->Add->addRows($inner, $categ, $session);
		$this->Handlers();
		//echo '<script>alert("You have successfully updated this record!");</script>';
	}

	public function editRows($arr, $session, $index, $inner, $outer, $categ){
		$CI =& get_instance();
		$CI->load->model('Edit');

		if(isset($session[$inner][$outer][$index])){
			$session[$inner][$outer][$index] = $arr;
		}else{
			$session[$inner][$outer] = $arr;
		}

		$CI->Edit->editRows($inner, $categ, $session);
		$this->Handlers();
		//echo '<script>alert("You Have Successfully updated this Record!");</script>';
	}

	public function deleteRow($session, $inner, $outer, $index, $categ){
		$CI =& get_instance();
		$CI->load->model('Delete');

		if(isset($session[$inner][$outer][$index])){
			if(isset($session[$inner][$outer][$index]['img'])){
				unlink('uploads/'.$inner.'/'.$session[$inner][$outer][$index]['img'].'.jpg');
			}
			unset($session[$inner][$outer][$index]);
			$session[$inner][$outer] = array_values($session[$inner][$outer]);
		}else{
			if(isset($session[$inner][$outer]['img'])){
				unlink('uploads/'.$inner.'/'.$session[$inner][$outer]['img'].'.jpg');
			}
			unset($session[$inner][$outer]);
			$session[$inner][$outer] = '';
		}

		$CI->Delete->deleteRows($inner, $categ, $session);
		$this->Handlers();
		//echo '<script>alert("You Have Successfully updated this Record!");</script>';
	}

	public function findIndex($arr, $input){
		if(isset($arr[0]['id'])){
			for($x = 0; $x < sizeof($arr); $x++){
				if($arr[$x]['id']==$input){
					return $x;
				}
			}
		}else{
			return 0;
		}
	}

	public function findUser($arr, $input){
		if(isset($arr[0]['name'])){
			for($x = 0; $x < sizeof($arr); $x++){
				if($arr[$x]['name']==$input){
					return $x;
				}
			}
			return -1;
		}else{
			return -1;
		}
	}

	public function uploadImage($id, $path, $name){
		//$config = array();
		if (empty($_FILES[$name]['name'])) {
			copy($path."-1.jpg",$path."".$id.".jpg");
			return 1;
		}else{
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'jpg|png|gif';
			$config['overwrite'] = TRUE;
			$config['file_name'] = $id;

			return $this->do_upload($name, $config);
		}
	}

	public function uploadImageEdit($id, $path, $name){
		//$config = array();
		if (empty($_FILES[$name]['name'])) {
			return 1;
		}else{
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'jpg|png|gif';
			$config['overwrite'] = TRUE;
			$config['file_name'] = $id;

			return $this->do_upload($name, $config);
		}
	}

	public function uploadFile($id, $path, $name){
		if (empty($_FILES[$name]['name'])) {
			return "No";
		}else{
			$files = $_FILES;

			if (!is_dir($path)) {
				mkdir($path, 0777, TRUE);
			}

    		$cpt = count ( $_FILES [$name] ['name'] );	
    		$cnt = 0;
    		$cnt2 = $cpt;
    		for($i = 0; $i < $cpt; $i ++) {
    			if($files [$name] ['size'] [$i]==0){
    				$cnt2--;
    			}else{
    				$_FILES [$name] ['name'] = $files [$name] ['name'] [$i];
			        $_FILES [$name] ['type'] = $files [$name] ['type'] [$i];
			        $_FILES [$name] ['tmp_name'] = $files [$name] ['tmp_name'] [$i];
			        $_FILES [$name] ['error'] = $files [$name] ['error'] [$i];
			        $_FILES [$name] ['size'] = $files [$name] ['size'] [$i];
			        
			        $config['upload_path'] = $path;
					$config['allowed_types'] = '*';
					$config['overwrite'] = FALSE;
					//$config['file_name'] = $i;
			        
			        $cnt += $this->do_upload($name, $config);
    			}				
			}
			if($cnt==$cnt2){
				return 1;
			}else{
				return "Upload failed";
			}
		}
	}

	public function uploadFileEdit($id, $path, $name){
		if (empty($_FILES[$name]['name'])) {
			return "No";
		}else{
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';
			$config['overwrite'] = FALSE;
			//$config['file_name'] = $filename;

			return $this->do_upload($name, $config);
		}
	}

	public function do_upload($name, $config){
		$CI =& get_instance();
		
		$CI->load->library('upload');

		$CI->upload->initialize($config);

		if ( ! $CI->upload->do_upload($name)){
			return $CI->upload->display_errors();
		}else{
			return 1;
		}
	}

	public function imageCrop($x,$w,$h,$y,$ratio,$rotation,$id,$path){
		$nimg = imagecreatetruecolor($w,$h);

		if(file_exists($path."".$id.".jpg")){
			$im_src = imagecreatefromjpeg($path."".$id.".jpg");
		}else if(file_exists($path."".$id.".png")){
			$im_src = imagecreatefrompng($path."".$id.".png");
		}else if(file_exists($path."".$id.".gif")){
			$im_src = imagecreatefromgif($path."".$id.".gif");
		}

		imagealphablending( $im_src, false );
		imagesavealpha( $im_src, true );

		$im_src = imagerotate($im_src, $rotation * -1, 0);
		imagecopyresampled($nimg, $im_src, 0, 0, ceil($x/$ratio), ceil($y/$ratio), $w, $h, $w/$ratio, $h/$ratio);
		imagejpeg($nimg,$path."".$id.".jpg",100);
	}

	public function updateProduct($id,$check){
		$CI =& get_instance();
		$CI->load->model('View');
		$CI->load->model('Delete');
		$inner[0] = 'products';
		$products = $this->OpenXML($inner);
		$products = $products['products'];
		if($check=="Types"){
			foreach ($products['product'] as $key => $value) {
				for($y=0; $y < sizeof($value['types']['type']); $y++){
					if(empty($value['types']['type'][$y])){
						if($value['types']['type']['id']==$id){
							$products['product'][$key]['types']['type']['id'] = '';
						}
					}else{						
						if($value['types']['type'][$y]['id'] == $id){
							$products['product'][$key]['types']['type'][$y]['id'] = '';
						}
					}
				}
			}
		}else if($check=="Industries"){
			foreach ($products['product'] as $key => $value) {
				for($y=0; $y < sizeof($value['industries']['industry']); $y++){
					if(empty($value['industries']['industry'][$y])){
						if($value['industries']['industry']['id']==$id){
							unset($products['product'][$key]['industries']);
							$products['product'][$key]['industries']['industry'] = array_values($products['product'][$key]['industries']['industry']);
						}
					}else{						
						if($value['industries']['industry'][$y]['id'] == $id){
							unset($products['product'][$key]['industries']['industry'][$y]);
							$products['product'][$key]['industries']['industry'] = array_values($products['product'][$key]['industries']['industry']);
						}
						
					}
				}
			}
		}else if($check=="Suppliers"){
			foreach ($products['product'] as $key => $value) {
				if($value['supplier']==$id){
					$products['product'][$key]['supplier'] = '';
				}
			}
		}
		$products = array('products' => $products );
		$CI->Delete->deleteRows("products", "", $products);
	}

	public function ActivityLog($category,$cid,$activity,$date){
		$CI =& get_instance();
		$CI->load->model('View');
		$inner[0] = 'histories';
		$logs = $this->OpenXML($inner);
		$saveThis = array('history' =>
			array(
			'category' => $category,
			'cid' => $cid,
			'activity' => $activity,
			'date' => $date)
		);

		$this->addRows($saveThis,'histories','history',$logs,'');
	}

	public function OpenXML($inner){
		$CI =& get_instance();
		$CI->load->model('View');
		for($x=0; $x<sizeof($inner); $x++){
			$arrayname[$inner[$x]] = $CI->View->load($inner[$x]);
		}
		return $arrayname;
	}

	public function Handlers(){
		$CI =& get_instance();
		$CI->load->library('session');
		$err_session = array('handler' => "You have successfully updated this record!");
		$CI->session->set_userdata($err_session);
	}
}
