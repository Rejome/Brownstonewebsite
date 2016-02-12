<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/jquery.gritter.css" />
<?php
$this->load->library('session');
$err_session = $this->session->userdata('err_session');
if(isset($err_session)){
	?>
	<input id="gritter-light" checked="" type="checkbox" class="ace ace-switch ace-switch-5 hidden" />
	<script src="<?php echo $this->config->base_url(); ?>assets/js/jquery.gritter.js"></script>

		<script type="text/javascript">
			jQuery(function($) {
			
				$('#gritter-without-image').ready(function(){
					$.gritter.add({
						// (string | mandatory) the heading of the notification
						title: '<center><?=$err_session?></center>',
						// (string | mandatory) the text inside the notification
						text: '<center>Change a few things up and try submitting again.</center>',
						class_name: 'gritter-error' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
				$("#gritter-remove").on(ace.click_event, function(){
					$.gritter.removeAll();
					return false;
				});
	
				$(document).one('ajaxloadstart.page', function(e) {
					$.gritter.removeAll();
					$('.modal').modal('hide');
				});
			
			});
		</script>

	<?php
	$this->session->unset_userdata('err_session');
}
?>

<?php
$handler = $this->session->userdata('handler');
if(isset($handler)){
	?>
	<input id="gritter-light" checked="" type="checkbox" class="ace ace-switch ace-switch-5 hidden" />
	<script src="<?php echo $this->config->base_url(); ?>assets/js/jquery.gritter.js"></script>

		<script type="text/javascript">
			jQuery(function($) {
			
				$('#gritter-without-image').ready(function(){
					$.gritter.add({
						// (string | mandatory) the heading of the notification
						title: '<center>Successful</center>',
						// (string | mandatory) the text inside the notification
						text: '<center><?=$handler?></center>',
						class_name: 'gritter-info' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
				$("#gritter-remove").on(ace.click_event, function(){
					$.gritter.removeAll();
					return false;
				});
	
				$(document).one('ajaxloadstart.page', function(e) {
					$.gritter.removeAll();
					$('.modal').modal('hide');
				});
			
			});
		</script>
	<?php
	$this->session->unset_userdata('handler');
}
?>

