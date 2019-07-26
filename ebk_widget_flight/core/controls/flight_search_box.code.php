<?php
	
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
    }
	
	if(!isset($_SESSION['search_box_type_way'])){
		$_SESSION['search_box_type_way'] = 'oneway';
	}
	
	if(!isset($_SESSION['search_box_from_city_name'])){
		$_SESSION['search_box_from_city_name'] = 'Hồ Chí Minh';
	}
	
	if(!isset($_SESSION['search_box_from_city_code'])){
		$_SESSION['search_box_from_city_code'] = 'SGN';
	}
	
	if(!isset($_SESSION['search_box_to_city_name'])){
		$_SESSION['search_box_to_city_name'] = 'Hà Nội';
	}
	
	if(!isset($_SESSION['search_box_to_city_code'])){
		$_SESSION['search_box_to_city_code'] = 'HAN';
	}
	
	if(!isset($_SESSION['search_box_depart_date'])){
		$_SESSION['search_box_depart_date'] = date("d/m/Y");
	}
	
	if(!isset($_SESSION['search_box_return_date'])){
		$_SESSION['search_box_return_date'] = date("d/m/Y");
	}
	
	if(!isset($_SESSION['search_box_adult_num'])){
		$_SESSION['search_box_adult_num'] = 1;
	}
	
	if(!isset($_SESSION['search_box_child_num'])){
		$_SESSION['search_box_child_num'] = 0;
	}
	
	if(!isset($_SESSION['search_box_infant_num'])){
		$_SESSION['search_box_infant_num'] = 0;
	}
	
	$search_box_type_way = $_SESSION['search_box_type_way'];
	$search_box_from_city_name = $_SESSION['search_box_from_city_name'] ;
	$search_box_from_city_code = $_SESSION['search_box_from_city_code'] ;
	$search_box_to_city_name = $_SESSION['search_box_to_city_name'] ;
	$search_box_to_city_code = $_SESSION['search_box_to_city_code'];
	$search_box_depart_date = $_SESSION['search_box_depart_date'];
	$search_box_return_date = $_SESSION['search_box_return_date'];
	$search_box_adult_num = $_SESSION['search_box_adult_num'];
	$search_box_child_num = $_SESSION['search_box_child_num'];
	$search_box_infant_num = $_SESSION['search_box_infant_num'];
	
?>