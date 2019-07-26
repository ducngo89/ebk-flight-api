<?php
	require_once( ABSPATH . '/wp-content/plugins/ebk-flights/ebk_widget_flight/core/api/flightapi.php' );
	$session_id = $_REQUEST['session_id'];
	$search_box_type_way = $_SESSION[$session_id . 'search_box_type_way'];
	$search_box_from_city_name = $_SESSION[$session_id . 'search_box_from_city_name'];
	$search_box_from_city_code = $_SESSION[$session_id . 'search_box_from_city_code'];
	$search_box_to_city_name = $_SESSION[$session_id . 'search_box_to_city_name'];
	$search_box_to_city_code = $_SESSION[$session_id . 'search_box_to_city_code'];
	$search_box_depart_date = $_SESSION[$session_id . 'search_box_depart_date'];
	$search_box_return_date = $_SESSION[$session_id . 'search_box_return_date'];
	$search_box_adult_num = $_SESSION[$session_id . 'search_box_adult_num'];
	$search_box_child_num = $_SESSION[$session_id . 'search_box_child_num'];
	$search_box_infant_num = $_SESSION[$session_id . 'search_box_infant_num'];

	if(!isset($_SESSION[$session_id . 'select_ticket'])
		|| $_SESSION[$session_id . 'select_ticket'] != $ticket_depart_id.'_'.$ticket_depart_class.$ticket_return_id.'_'.$ticket_return_class){
		if(isset($_SESSION[$session_id . 'ticket_depart_id'])){
			$ticket_depart_id = $_SESSION[$session_id . 'ticket_depart_id'];
			$ticket_depart_class = $_SESSION[$session_id . 'ticket_depart_class'];
		}
		if(isset($_SESSION[$session_id . 'ticket_return_id'])){
			$ticket_return_id = $_SESSION[$session_id . 'ticket_return_id'];
			$ticket_return_class = $_SESSION[$session_id . 'ticket_return_class'];
		}
		$session_api_key = $_SESSION[$session_id . 'session_api_key'];
		
		flight_api_select_ticket($session_api_key,$ticket_depart_id.'_'.$ticket_depart_class,$ticket_return_id.'_'.$ticket_return_class);
		
		$bages = flight_api_get_bag($session_api_key);
		
		$_SESSION[$session_id . 'select_ticket'] = $ticket_depart_id.'_'.$ticket_depart_class.$ticket_return_id.'_'.$ticket_return_class;
		$_SESSION[$session_id . 'select_bages'] = $bages;
		//var_dump($bages);
	}else{
		$bages = $_SESSION[$session_id . 'select_bages'];
	}
	
?>