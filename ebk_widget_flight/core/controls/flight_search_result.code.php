<?php
require_once( ABSPATH . '/wp-content/plugins/ebk-flights/ebk_widget_flight/core/api/flightapi.php' );
	
if (isset($_REQUEST['search_box_submit'])) {
	// collect value of input field
	$session_id = $_REQUEST['session_id'];
	$_SESSION[$session_id . 'search_box_type_way'] = $_REQUEST['search_box_type_way'];
	$_SESSION[$session_id . 'search_box_from_city_name'] = $_REQUEST['search_box_from_city_name'];
	$_SESSION[$session_id . 'search_box_from_city_code'] = $_REQUEST['search_box_from_city_code'];
	$_SESSION[$session_id . 'search_box_to_city_name'] = $_REQUEST['search_box_to_city_name'];
	$_SESSION[$session_id . 'search_box_to_city_code'] = $_REQUEST['search_box_to_city_code'];
	$_SESSION[$session_id . 'search_box_depart_date'] = $_REQUEST['search_box_depart_date'];
	$_SESSION[$session_id . 'search_box_return_date'] = $_REQUEST['search_box_return_date'];
	$_SESSION[$session_id . 'search_box_adult_num'] = $_REQUEST['search_box_adult_num'];
	$_SESSION[$session_id . 'search_box_child_num'] = $_REQUEST['search_box_child_num'];
	$_SESSION[$session_id . 'search_box_infant_num'] = $_REQUEST['search_box_infant_num'];
	
	//Last search
	$_SESSION['search_box_type_way'] = $_REQUEST['search_box_type_way'];
	$_SESSION['search_box_from_city_name'] = $_REQUEST['search_box_from_city_name'];
	$_SESSION['search_box_from_city_code'] = $_REQUEST['search_box_from_city_code'];
	$_SESSION['search_box_to_city_name'] = $_REQUEST['search_box_to_city_name'];
	$_SESSION['search_box_to_city_code'] = $_REQUEST['search_box_to_city_code'];
	$_SESSION['search_box_depart_date'] = $_REQUEST['search_box_depart_date'];
	$_SESSION['search_box_return_date'] = $_REQUEST['search_box_return_date'];
	$_SESSION['search_box_adult_num'] = $_REQUEST['search_box_adult_num'];
	$_SESSION['search_box_child_num'] = $_REQUEST['search_box_child_num'];
	$_SESSION['search_box_infant_num'] = $_REQUEST['search_box_infant_num'];
	
	// collect value of input field
	
	$search_box_type_way = $_SESSION[$session_id . 'search_box_type_way'] ;
	$search_box_from_city_name = $_SESSION[$session_id . 'search_box_from_city_name'] ;
	$search_box_from_city_code = $_SESSION[$session_id . 'search_box_from_city_code'] ;
	$search_box_to_city_name = $_SESSION[$session_id . 'search_box_to_city_name'] ;
	$search_box_to_city_code = $_SESSION[$session_id . 'search_box_to_city_code'] ;
	$search_box_depart_date = $_SESSION[$session_id . 'search_box_depart_date'] ;
	$search_box_return_date = $_SESSION[$session_id . 'search_box_return_date'] ;
	$search_box_adult_num = $_SESSION[$session_id . 'search_box_adult_num'] ;
	$search_box_child_num = $_SESSION[$session_id . 'search_box_child_num'] ;
	$search_box_infant_num = $_SESSION[$session_id . 'search_box_infant_num'] ;
	
	//Save api session into session
	$session_api_key = flight_api_init('canhdieuvietnet');

	if(isset($session_api_key)){
		
		$_SESSION[$session_id . 'session_api_key'] = $session_api_key;
		//Send request search ticket
		if($search_box_type_way =='oneway'){
			$search_box_return_date = null;
		}
		flight_api_search_request($session_api_key,$search_box_from_city_code,$search_box_to_city_code,$search_box_depart_date,$search_box_return_date
			,$search_box_adult_num,$search_box_child_num,$search_box_infant_num);
		//Get tickets
	}
	
}


?>