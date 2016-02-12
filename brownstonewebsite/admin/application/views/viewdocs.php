<?php
$this->load->helper('directory');
if(isset($_GET['p_id'])){
	extract($_GET);
	//delete($p_id,$documents);
	echo "<script>window.close();</script>";

}else if(isset($_POST['p_id'])){
	$map = directory_map($_POST['path'].''.$_POST['p_id']);

	$target_dir = $_POST['path'].''.$_POST['p_id'];

	if(is_dir($target_dir)){

		echo '<div id="myDiv"><table class="table table-striped table-bordered table-hover">
		<thead>
		<th>Name</th>
		<th>action</th>
		
		</thead>
		<tbody>';
		for($x = 0; $x < sizeof($map); $x++){
			echo "<tr style='width:40px'>";
			echo "<td><a href='#' onclick=\"window.open('".$_POST['path']."".$_POST['p_id']."/".$map[$x]."','newwindow');\">".$map[$x]."</a></td>";
			echo "<td><a href='#' id='".$_POST['path']."".$_POST['p_id']."/".$map[$x]."' onclick='deleteAttachments(this.id)'>X</a></td>";
			echo "</tr>";
		}
		echo '</tbody>
		</table>';
	}else{

		echo '<table class="table table-striped table-bordered table-hover">
		<thead>
		<th>Name</th>
		<th>action</th>
		</thead>
		<tbody>';

		echo "<tr style='width:40px'>";
		echo "<td></td>";
		echo "<td></td>";
		echo "</tr>";

		echo '</tbody>
		</table></div>';
	}

}

?>
