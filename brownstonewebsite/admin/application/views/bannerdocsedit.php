<?php
$this->load->model('View');

if($_POST['category']=='Products'){
	$inner[0] = 'products';
	$products = $this->process->OpenXML($inner);
	$products = $products['products'];
	echo "<select id='emyDiv' name='ecid'>";
	foreach ($products['product'] as $key => $value) {
		if($value['id']==$_POST['cid']){
			echo "<option value='".$value['id']."' selected>".$value['name']."</option>";
		}else{
			echo "<option value='".$value['id']."'>".$value['name']."</option>";
		}
	}
	echo "</select>";
}else if($_POST['category']=='Types'){
	$inner[0] = 'types';
	$types = $this->process->OpenXML($inner);
	$types = $types['types'];
	echo "<select id='emyDiv' name='ecid'>";
	foreach ($types['type'] as $key => $value) {
		if($value['id']==$_POST['cid']){
			echo "<option value='".$value['id']."' selected>".$value['name']."</option>";
		}else{
			echo "<option value='".$value['id']."'>".$value['name']."</option>";
		}
	}
	echo "</select>";
}else if($_POST['category']=='Suppliers'){
	$inner[0] = 'suppliers';
	$suppliers = $this->process->OpenXML($inner);
	$suppliers = $suppliers['suppliers'];
	echo "<select id='emyDiv' name='ecid'>";
	foreach ($suppliers['supplier'] as $key => $value) {
		if($value['id']==$_POST['cid']){
			echo "<option value='".$value['id']."' selected>".$value['title']."</option>";
		}else{
			echo "<option value='".$value['id']."'>".$value['title']."</option>";
		}
	}
	echo "</select>";
}else if($_POST['category']=='News and Events'){
	$inner[0] = 'newsevents';
	$newsevents = $this->process->OpenXML($inner);
	$newsevents = $newsevents['newsevents'];
	echo "<select id='emyDiv' name='ecid'>";
	foreach ($newsevents['newsevent'] as $key => $value) {
		if($value['id']==$_POST['cid']){
			echo "<option value='".$value['id']."' selected>".$value['title']."</option>";
		}else{
			echo "<option value='".$value['id']."'>".$value['title']."</option>";
		}
	}
	echo "</select>";
}else if($_POST['category']=='Industries'){
	$inner[0] = 'industries';
	$industries = $this->process->OpenXML($inner);
	$industries = $industries['industries'];
	echo "<select id='emyDiv' name='ecid'>";
	foreach ($industries['industry'] as $key => $value) {
		if($value['id']==$_POST['cid']){
			echo "<option value='".$value['id']."' selected>".$value['title']."</option>";
		}else{
			echo "<option value='".$value['id']."'>".$value['title']."</option>";
		}
	}
	echo "</select>";
}else if($_POST['category']=='Career'){
	$inner[0] = 'careers';
	$careers = $this->process->OpenXML($inner);
	$careers = $careers['careers'];
	echo "<select id='emyDiv' name='ecid'>";
	foreach ($careers['career'] as $key => $value) {
		if($value['id']==$_POST['cid']){
			echo "<option value='".$value['id']."' selected>".$value['title']."</option>";
		}else{
			echo "<option value='".$value['id']."'>".$value['title']."</option>";
		}
	}
	echo "</select>";
}else if($_POST['category']=='Banner'){
	echo "<div id='emyDiv'>";
	echo "<input type='text' name='ecid' value='all' readonly>";
	echo "</div>";
}


?>
