<?php 
	require_once( ABSPATH . '/wp-content/plugins/ebk-flights/ebk_widget_flight/core/api/flightapi.php' );
	$session_id = $_REQUEST['session_id'];
	$booking_result = $_SESSION[$session_id . 'booking_result'];
	//var_dump($booking_result);
	
	
	/*Save Booking*/
	require_once( ABSPATH . '/wp-content/plugins/ebk-flights/ebk_widget_flight/core/models/bk_objects.php' );
	
	$BookingInfo = $_SESSION[$session_id . 'BookingInfo'];
	
	$bk_booking = new  bk_booking();
	
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
	
	$i_total_passenger = $search_box_adult_num + $search_box_child_num + $search_box_infant_num;
	
	$tickets = $_SESSION[$session_id . 'tickets'];
	
	$ticket_depart_id = $_SESSION[$session_id . 'ticket_depart_id'];
	$ticket_depart_class = $_SESSION[$session_id . 'ticket_depart_class'];
	
	$ticket_return_id = $_SESSION[$session_id . 'ticket_return_id'];
	$ticket_return_class = $_SESSION[$session_id . 'ticket_return_class'];
	
	//echo '$ticket_depart_id: '. $ticket_depart_id;
	
	//echo json_encode($tickets);
	
	foreach($tickets['data'] as $t) {
		//echo $t['TicketID'];
		if($t->TicketID==$ticket_depart_id){
			$ticket_depart = $t;
		}
		if($t->TicketID==$ticket_return_id){
			$ticket_return = $t;
		}
	}
	
	
	//$bk_booking->booking_id; 
	$bk_booking->from_city_code = $search_box_from_city_code;
	$bk_booking->from_city_name = $search_box_from_city_name;
	$bk_booking->to_city_code = $search_box_to_city_code;
	$bk_booking->to_city_name = $search_box_to_city_name;
	
	$date_temp = str_replace('/Date(','',$ticket_depart->StartDate);
	$date_temp = str_replace(')/','',$date_temp);
	$bk_booking->depart_date = date('Y-m-d H:i:s', $date_temp/1000);
	
	if(isset($ticket_return)){
		$date_temp = str_replace('/Date(','',$ticket_return->StartDate);
		$date_temp = str_replace(')/','',$date_temp);
		$bk_booking->return_date = date('Y-m-d H:i:s', $date_temp/1000);
	}
	
	$bk_booking->adult = $search_box_adult_num;
	$bk_booking->child = $search_box_child_num;
	$bk_booking->infant = $search_box_infant_num;
	
	$bk_booking->booking_type = isset($bk_booking->return_date) ? 2 : 1;
	$bk_booking->user_id = 1; 
	$bk_booking->contact_name = $BookingInfo['ContactFirstName'] .' '.$BookingInfo['ContactLastName']; 
	$bk_booking->contact_phone = $BookingInfo['ContactPhone']; 
	$bk_booking->contact_address = $BookingInfo['ContactAddress'];  
	$bk_booking->contact_email = $BookingInfo['ContactEmail']; 
	$bk_booking->booking_note = $BookingInfo['ContactNote']; 
	$bk_booking->pnr = $booking_result->PNR;
	//$bk_booking->vat_no; 
	//$bk_booking->vat_name; 
	//$bk_booking->vat_phone; 
	//$bk_booking->vat_address; 
	$bk_booking->total_passenger = $i_total_passenger; 
	$bk_booking->price_total=1; 
	$bk_booking->price_before = $booking_result->GrossPrice; 
	$bk_booking->price_discount = 0; 
	$bk_booking->booking_ip = $_SERVER['REMOTE_ADDR']; 
	$date_temp = str_replace('/Date(','',$booking_result->HoldToDate);
	$date_temp = str_replace(')/','',$date_temp);
	
	$bk_booking->expired_date = date('Y-m-d H:i:s', $date_temp/1000);
	$bk_booking->booking_status = $booking_result->BookingStatus;
	//$bk_booking->booking_status =date('Date(\\','',str_replace($booking_result->BookingStatus.replace()));
	$bk_booking->created_date = date("Y-m-d H:i:s"); 
	//$bk_booking->expired_date = $booking_result->HoldToDate; 
	//$bk_booking->payment_status; 
	//$bk_booking->payment_type; 
	//$bk_booking->payment_detail; 
	$bk_booking->booking_key = $_SESSION[$session_id . 'session_api_key']; 
	$bk_booking->is_deleted=false; 
	$bk_booking->is_confirm=false; 
	//$bk_booking->confirm_date; 
	//$bk_booking->confirm_user;
	
	//var_dump( $BookingInfo);
	global $wpdb;
	
	//$wpdb->query('START TRANSACTION');
	
	//$wpdb->insert( 'ebk_bk_booking', (array)$bk_booking );
	//$bk_booking->booking_id = //$wpdb->insert_id;
	
	$bk_segment_depart = new bk_segment();
	$bk_segment_depart->booking_id = $bk_booking->booking_id;
	//$bk_segment_depart->segment_id;
	$bk_segment_depart->segment_type=1; 
	$bk_segment_depart->from_city_code = $search_box_from_city_code;
	$bk_segment_depart->from_city_name = $search_box_from_city_name;
	$bk_segment_depart->to_city_code = $search_box_to_city_code;
	$bk_segment_depart->to_city_name = $search_box_to_city_name;
	$bk_segment_depart->pnr = $bk_booking->pnr;
	
	$date_temp = str_replace('/Date(','',$ticket_depart->StartDate);
	$date_temp = str_replace(')/','',$date_temp);
	$bk_segment_depart->start_date = date('Y-m-d H:i:s', $date_temp/1000);
	
	$date_temp = str_replace('/Date(','',$ticket_depart->EndDate);
	$date_temp = str_replace(')/','',$date_temp);
	$bk_segment_depart->end_date = date('Y-m-d H:i:s', $date_temp/1000);
	
	
	
	foreach($ticket_depart->PriceCollection as $p){
		
		if($p->TicketClass == $ticket_depart_class){
			//var_dump($p);
			$bk_segment_depart->price = $p->AdultTotalPrice;
			$bk_segment_depart->price_before = $p->AdultPriceNet;
			
			$bk_segment_depart->price_child = $p->ChildTotalPrice;
			$bk_segment_depart->price_child_before = $p->ChildPriceNet;
			
			$bk_segment_depart->price_infant = $p->BabyTotalPrice;
			$bk_segment_depart->price_infant_before = $p->BabyPriceNet;
		}
	}
	
	$bk_segment_depart->flight_time = $ticket_depart->DuringTime;
	
	$bk_segment_depart->trans_sit = $ticket_depart->Transit;
	
	//$wpdb->insert( 'ebk_bk_segment', (array)$bk_segment_depart );
	//$bk_segment_depart->segment_id = //$wpdb->insert_id;
	
	
	//Segment return 
	
	if(isset($ticket_return)){
		$bk_segment_return = new bk_segment();
		$bk_segment_return->booking_id = $bk_booking->booking_id;
		//$bk_segment_return->segment_id;
		$bk_segment_return->segment_type=2; 
		$bk_segment_return->to_city_code = $search_box_from_city_code;
		$bk_segment_return->to_city_name = $search_box_from_city_name;
		$bk_segment_return->from_city_code = $search_box_to_city_code;
		$bk_segment_return->from_city_name = $search_box_to_city_name;
		$bk_segment_return->pnr = $bk_booking->pnr;
		
		$date_temp = str_replace('/Date(','',$ticket_return->StartDate);
		$date_temp = str_replace(')/','',$date_temp);
		$bk_segment_return->start_date = date('Y-m-d H:i:s', $date_temp/1000);
		
		$date_temp = str_replace('/Date(','',$ticket_return->EndDate);
		$date_temp = str_replace(')/','',$date_temp);
		$bk_segment_return->end_date = date('Y-m-d H:i:s', $date_temp/1000);
		
		
		
		foreach($ticket_return->PriceCollection as $p){
			
			if($p->TicketClass == $ticket_return_class){
				//var_dump($p);
				$bk_segment_return->price = $p->AdultTotalPrice;
				$bk_segment_return->price_before = $p->AdultPriceNet;
				
				$bk_segment_return->price_child = $p->ChildTotalPrice;
				$bk_segment_return->price_child_before = $p->ChildPriceNet;
				
				$bk_segment_return->price_infant = $p->BabyTotalPrice;
				$bk_segment_return->price_infant_before = $p->BabyPriceNet;
			}
		}
		
		$bk_segment_return->flight_time = $ticket_return->DuringTime;
		
		$bk_segment_return->trans_sit = $ticket_return->Transit;
		
		//$wpdb->insert( 'ebk_bk_segment', (array)$bk_segment_return );
		//$bk_segment_return->segment_id = //$wpdb->insert_id;
	}
	
	//Add depart flights
	
	$bk_flight = new bk_flight();
	$bk_flight->segment_id = $bk_segment_depart->segment_id;
	//$wpdb->insert( 'ebk_bk_flight', (array)$bk_flight );
	
	var_dump($ticket_depart);
	
	//End add depart flights
	
	
	/* Passengers*/
	$Passengers = $_SESSION[$session_id . 'Passengers'] ;
	
	$passenger_list = array();
	
	foreach ($Passengers as $value){
		$bk_passenger = new bk_passenger();
			
		$bk_passenger->booking_id = $bk_booking->booking_id;
		$bk_passenger->first_name = $value['FirstName'];
		$bk_passenger->last_name = $value['LastName'];
		$bk_passenger->sex = $value['Sex'];
		$date_temp = str_replace('/Date(','',$value['Birthday']);
		$date_temp = str_replace(')/','',$date_temp);
		$bk_passenger->birthday = date('Y-m-d', $date_temp/1000);
		$bk_passenger->passenger_type = $value['PassengerType'];
		//$bk_passenger->passport_no = $value['Passport'];
		//$bk_passenger->passport_contry_id = $value['PassportCountry'];
		//$bk_passenger->passport_country_name = $value['Nationality'];
		//$bk_passenger->nationnality_id = $value['Nationality'];
		
		//$wpdb->insert( 'ebk_bk_passenger', (array)$bk_passenger );
		//$bk_passenger->passenger_id = //$wpdb->insert_id;
		array_push($passenger_list,$bk_passenger);
	}
    
	/* End Passengers*/
	//foreach($passenger_list as $p){
	//	foreach($){
			
	//	}
	//}
	$bk_booking_detail = new bk_booking_detail();
	
	$bk_booking_detail->booking_id = $bk_booking->booking_id;
	//$wpdb->insert( 'ebk_bk_booking_detail', (array)$bk_booking_detail );
	

	
	//if($result1) {
		//$wpdb->query('COMMIT'); // if you come here then well done
	//}
	
	/*End Save Booking*/
	
	$data = array('session_id'=>$session_id,'ticket_depart'=>$ticket_depart
	,'ticket_return'=>$ticket_return,'booking_info'=>$booking_result,'passengers'=>$Passengers);
	flight_save_booking($data);
	
?>