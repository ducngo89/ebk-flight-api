<?php
	if( !session_id() ){
		session_start();
	}
	require_once('../../core/api/flightapi.php' );
	//C:\xampp\htdocs\wordpress\wp-content\plugins\ebk-flights\ebk_widget_flight\core\api\flightapi.php
	if (isset($_REQUEST['get_ticket'])) {
		$session_id = $_REQUEST['get_ticket'];
		
		$session_api_key=$_SESSION[$session_id . 'session_api_key'];
		$data['data'] = flight_api_get_ticket($session_api_key);
		
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		$_SESSION[$session_id . 'tickets'] = $data;
		echo json_encode($data);
	}
	
	if (isset($_REQUEST['get_hello'])){
		echo json_encode('hello');
	}
	
	if (isset($_REQUEST['select_depart'])){
		$session_id = $_REQUEST['session_id'];
		$ticket_id = $_REQUEST['ticket_id'];
		$ticket_class = $_REQUEST['ticket_class'];
		
		$_SESSION[$session_id . 'ticket_depart_id'] = $ticket_id;
		$_SESSION[$session_id . 'ticket_depart_class'] = $ticket_class;
		
		echo json_encode('hello');
	}
	
	if (isset($_REQUEST['select_return'])){
		$session_id = $_REQUEST['session_id'];
		$ticket_id = $_REQUEST['ticket_id'];
		$ticket_class = $_REQUEST['ticket_class'];
		
		$_SESSION[$session_id . 'ticket_return_id'] = $ticket_id;
		$_SESSION[$session_id . 'ticket_return_class'] = $ticket_class;
		
		echo json_encode('hello');
	}
	
	if (isset($_REQUEST['bookingnow'])){
		
		$session_id = $_REQUEST['session_id'];
		$session_api_key = $_SESSION[$session_id . 'session_api_key'];
		$search_box_adult_num = $_SESSION[$session_id . 'search_box_adult_num'];
		$search_box_child_num = $_SESSION[$session_id . 'search_box_child_num'];
		$search_box_infant_num = $_SESSION[$session_id . 'search_box_infant_num'];
		
		$i_total_passenger = $search_box_adult_num + $search_box_child_num + $search_box_infant_num;
	
		$Passengers=array();
		for($i=0;$i<$i_total_passenger;$i++){
			$Passenger1=array(
				'FirstName' => $_REQUEST["passengers-$i-FirstName"],
				'LastName' => $_REQUEST["passengers-$i-LastName"],
				'PassengerType'=>$_REQUEST["passengers-$i-type"],//1: người lớn, 2: Trẻ em, 3: Em bé (Em bé 1 dc đi kém người lớn 1,... )
				'Birthday'=>'/Date(815472787982)/',
				'DepartBagValue' => explode('-',$_REQUEST["passengers-$i-BagDepart"])[0],//Hanh ly chieu di
				'ReturnBagValue' => explode('-',$_REQUEST["passengers-$i-BagReturn"])[0],//Hanh ly chieu ve
				'DepartBagPrice' => explode('-',$_REQUEST["passengers-$i-BagDepart"])[1],//Hanh ly chieu di
				'ReturnBagPrice' => explode('-',$_REQUEST["passengers-$i-BagReturn"])[1],//Hanh ly chieu ve
				'Sex' => $_REQUEST["passengers-$i-Sex"],
				'Passport' => null,
				'PassportCountry' => null,
				'Nationality' => null,
				'PassportExpiry' => null
			);
			array_push($Passengers,$Passenger1);
		}
		
		$BookingInfo=array(
			'ContactFirstName' =>  $_REQUEST["contact-FirstName"],
			'ContactLastName' => $_REQUEST["contact-LastName"],
			'ContactPhone' => $_REQUEST["contact-Phone"],
			'ContactAddress' => $_REQUEST["contact-Address"],
			'ContactEmail' => $_REQUEST["contact-Email"],
			'ContactNote' => $_REQUEST["contact-Note"]
		);
		
		$_SESSION[$session_id . 'BookingInfo'] = $BookingInfo;
		$_SESSION[$session_id . 'Passengers'] = $Passengers;
		$_SESSION[$session_id . 'session_api_key'] = $session_api_key;
		
		$isBookingOK = flight_api_init_booking($session_api_key,$Passengers,$BookingInfo);
		$booking_result = flight_api_get_booking_result($session_api_key);
		
		$_SESSION[$session_id . 'booking_result'] = $booking_result;
		echo 'ok';
	}
	
?>