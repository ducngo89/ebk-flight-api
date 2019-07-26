<?php
	require_once('../../core/api/flightapi.php' );
	//C:\xampp\htdocs\wordpress\wp-content\plugins\ebk-flights\ebk_widget_flight\core\api\flightapi.php
	if (isset($_REQUEST['get_condition'])) {
		$firm_id = $_REQUEST['firm_id'];
		$ticket_class = $_REQUEST['ticket_class'];
		$data = flight_api_get_condition($firm_id,$ticket_class);
?>
<table>
	<?php 
		foreach($data as &$row){
			echo "<tr><td>$row->ConditionTypeName</td><td>$row->ConditionAttributeName</td><td>$row->ConditionValue</td></tr>";
		}
	?>
<table>
	<?php }?>