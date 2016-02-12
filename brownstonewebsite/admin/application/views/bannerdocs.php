<?php
$this->load->model('View');

if($_POST['category']=='Products'){
	$inner[0] = 'products';
	$products = $this->process->OpenXML($inner);
	$products = $products['products'];
	echo "<select id='myDiv' name='cid'>";
	foreach ($products['product'] as $key => $value) {
		echo "<option value='".$value['id']."'>".$value['name']."</option>";
	}
	echo "</select>";
}else if($_POST['category']=='Types'){
	$inner[0] = 'types';
	$types = $this->process->OpenXML($inner);
	$types = $types['types'];
	echo "<select id='myDiv' name='cid'>";
	foreach ($types['type'] as $key => $value) {
		echo "<option value='".$value['id']."'>".$value['name']."</option>";
	}
	echo "</select>";
}else if($_POST['category']=='Suppliers'){
	$inner[0] = 'suppliers';
	$suppliers = $this->process->OpenXML($inner);
	$suppliers = $suppliers['suppliers'];
	echo "<select id='myDiv' name='cid'>";
	foreach ($suppliers['supplier'] as $key => $value) {
		echo "<option value='".$value['id']."'>".$value['title']."</option>";
	}
	echo "</select>";
}else if($_POST['category']=='News and Events'){
	$inner[0] = 'newsevents';
	$newsevents = $this->process->OpenXML($inner);
	$newsevents = $newsevents['newsevents'];
	echo "<select id='myDiv' name='cid'>";
	foreach ($newsevents['newsevent'] as $key => $value) {
		echo "<option value='".$value['id']."'>".$value['title']."</option>";
	}
	echo "</select>";
}else if($_POST['category']=='Industries'){
	$inner[0] = 'industries';
	$industries = $this->process->OpenXML($inner);
	$industries = $industries['industries'];
	echo "<select id='myDiv' name='cid'>";
	foreach ($industries['industry'] as $key => $value) {
		echo "<option value='".$value['id']."'>".$value['title']."</option>";
	}
	echo "</select>";
}else if($_POST['category']=='Career'){
	$inner[0] = 'careers';
	$careers = $this->process->OpenXML($inner);
	$careers = $careers['careers'];
	echo "<select id='myDiv' name='cid'>";
	foreach ($careers['career'] as $key => $value) {
		echo "<option value='".$value['id']."'>".$value['title']."</option>";
	}
	echo "</select>";
}else if($_POST['category']=='Banner'){
	echo "<div id='myDiv'>";
	echo "<input type='text' name='cid' value='all' readonly>";
	echo "</div>";
}


?>
