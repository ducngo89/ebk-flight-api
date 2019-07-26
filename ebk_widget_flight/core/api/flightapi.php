<?php
// First, include Requests
//include('./library/Requests.php');
require_once( 'library/Requests.php' );

// Next, make sure Requests can load internal classes
Requests::register_autoloader();

// Now let's make a request!

function Call($command_name,$array_data) {
	//curl_setopt($ch, CURLOPT_TIMEOUT,500); // 500 seconds
	$api_address = 'http://sandbox.ebksoft.com/sandbox/';
	//$api_address = 'http://flight.ebksoft.com/flight/';
    //$data = array('authen_key' => $api_key, 'ip_address' => 'value2');
	$response = Requests::post($api_address.$command_name, array(),'data='. json_encode ($array_data));
	//_e( json_encode ($array_data));
	if($response){
		//echo '<br>Send command: '.$command_name.'<br>';}
		//var_dump( json_decode($response->body));
		return json_decode($response->body);
	}
	return null;
}

function flight_api_init($authen_key){
	$res = Call('initapi',array('authen_key' => $authen_key, 'ip_address' => $_SERVER['REMOTE_ADDR']));
	//$res = Call('initapi',array('authen_key' => $api_key, 'ip_address' => '::1'));
	//2. Save session_key to session or any where to re-use
	$session_key=$res->data->session_key;
	return $session_key;
}

function flight_api_get_condition($firm_id,$ticket_class){
	$data_tickets = array('firm_id'=>$firm_id,'ticket_class'=>$ticket_class);
	//echo '<br/> 4. Get ticket <br/>';
	$res = Call('GetTicketCondition',$data_tickets);
	return $res->data;
}

function flight_api_search_request($session_key,$from_city_code,$to_city_code,$depart_date,$return_date,$adult_num,$child_num,$infant_num){
	
	$t = DateTime::createFromFormat('d/m/Y', $depart_date);
	
	if(isset($return_date))
		$t1 = DateTime::createFromFormat('d/m/Y', $return_date);
	
	$search_info = array(	'FromCityCode' => $from_city_code, 
							'ToCityCode' => $to_city_code,
							'DepartDate' => '/Date('.date_timestamp_get($t).'000)/',//datetime format of javascript
							'ReturnDate' => isset($return_date) ? '/Date('.date_timestamp_get($t1).'000)/':'',//datetime format of javascript
							'AdultNum' => $adult_num,
							'ChildNum' => $child_num,
							'InfantNum' => $infant_num
							);
	$data_search = array('session_key'=>$session_key,'search_info'=>$search_info);
	$res = Call('search',$data_search);
	return $res->data;
}

function flight_api_get_ticket($session_key){
	$data_tickets = array('session_key'=>$session_key);
	$res = Call('getticket',$data_tickets);
	return $res->data;
}

function flight_api_select_ticket($session_key,$ticket_depart,$ticket_return){
	$select=array('session_key'=>$session_key,'ticket_depart'=>$ticket_depart,"ticket_return"=>$ticket_return);
	$res=Call('selectticket',$select);
	return $res->data;
}

function flight_api_get_bag($session_key){
	$databag=array('session_key'=>$session_key);
	$res=Call('getbag',$databag);
	return $res->data;
}

function flight_api_init_booking($session_key,$Passengers,$Booking){
	$dataPassenger=array('session_key'=>$session_key,'passengers'=>$Passengers,'booking'=>$Booking);
	$res=Call('addpassengers',$dataPassenger);
	$dataBooking=array('session_key'=>$session_key);
	$res=Call('booking',$dataBooking);
	return $res->data;
}

function flight_api_get_booking_result($session_key){
	$dataResult=array('session_key'=>$session_key);
	$res=Call('bookingresult',$dataResult);
	return $res->data;
}

function flight_save_booking($json){
	$response = Requests::post('http://local.canhdieuviet.net:8573/Services/ajax.asmx/ImportBooking', array(),'strKeyword='.json_encode ($json));
	//_e( json_encode ($array_data));
	if($response){
		//echo '<br>Send command: '.$command_name.'<br>';}
		//var_dump( json_decode($response->body));
		return $response->body;
	}
	return null;
}

function demo(){
	//1. Init session_key
	echo '1. <br/>';
	$res = Call('initapi',array('authen_key' => $api_key, 'ip_address' => '113.161.92.72'));
	//$res = Call('iniapi',array('authen_key' => $api_key, 'ip_address' => '::1'));
	//2. Save session_key to session or any where to re-use
	$session_key=$res->data->session_key;
	echo '<br/> 2. <br/>';
	//3. Create search request
	//{"session_key":"394bf97b-1441-4113-8552-2b5fbbc6706a","search_info":{"FromCityCode":"SGN","ToCityCode":"HAN","DepartDate":"\/Date(1447174800000)\/","ReturnDate":"\/Date(1448038800000)\/","AdultNum":1,"ChildNum":0,"InfantNum":0}}
	/*
			/// Mã viết tắt sân bay đi
			public string FromCityCode { get; set; }
			/// Mã viết tắt sân bay đến
			public string ToCityCode { get; set; }
			/// Ngày khởi hành
			public DateTime DepartDate { get; set; }
			/// Ngày về nếu có
			public DateTime? ReturnDate { get; set; }
			/// Số lượng người lớn
			public int AdultNum { get; set; }
			/// Số lượng trẻ em
			public int ChildNum { get; set; }
			/// Số lượng sơ sinh
			public int InfantNum { get; set; }
	*/

	$search_info = array(	'FromCityCode' => 'SGN', 
							'ToCityCode' => 'HAN',
							'DepartDate' => '/Date(1447174800000)/',//datetime format of javascript
							'ReturnDate' => '/Date(1448038800000)/',//datetime format of javascript
							'AdultNum' => '1',
							'ChildNum' => '0',
							'InfantNum' => '0'
							);
	$data_search = array('session_key'=>$session_key,'search_info'=>$search_info);
	echo '<br/> 3.	GET TICKET <br/>';
	$res = Call('search',$data_search);
	//4. Get tickets result
	//{"session_key":"9c8d87f6-e889-4fd8-98c3-aa260f1a5496","firm_id":"3"}
	$data_tickets = array('session_key'=>$session_key,'firm_id'=>'');
	echo '<br/> 4. Get ticket <br/>';
	$res = Call('getticket',$data_tickets);

	//5. SELECT
	//$condition_tickets=array('session_key'=>$session_key,'firm_id'=>'3',"ticket_class"=>"starter");
	echo '<br/> 5. SELECT	<br/>';
	$select=array('session_key'=>$session_key,'ticket_depart'=>'VJ23_Eco',"ticket_return"=>"VJ25_Eco");
	$res=Call('selectticket',$select);

	//6 get bag
	echo '<br/> 6. Get Bag<br/>';
	$databag=array('session_key'=>$session_key);
	$res=Call('getbag',$databag);
	// Hàm này dùng để lam j? sao ko thấy hàm đăng kí thông số hành lý.
	//7	passenger
	echo '<br/> 7.  PASSENGER<br/>';
	$Passenger1=array(
				'FirstName' => 'Manh Ung',
				'LastName' => 'Nguyen',
				'PassengerType'=>'1',//1: người lớn, 2: Trẻ em, 3: Em bé (Em bé 1 dc đi kém người lớn 1,... )
				'Birthday'=>'/Date(815472787982)/',
				'DepartBagValue' => '15',//Hanh ly chieu di
				'ReturnBagValue' => '25',//Hanh ly chieu ve
				'Sex' => 'M',
				'Passport' => null,
				'PassportCountry' => null,
				'Nationality' => null,
				'PassportExpiry' => null
				);
	$Passengers=array($Passenger1);//Mình thấy bên hãng ngta yêu cầu cái vụ 1 người lớn kèm 1 em bé ấy
	$Booking=array(
		'ContactFirstName' => 'Minh Duc',
		'ContactLastName' => 'Ngo',
		'ContactPhone' => '0901834589',
		'ContactAddress' => 'hcm',
		'ContactEmail' => 'mhungtcb@gmail.com'
		);
	$dataPassenger=array('session_key'=>$session_key,'passengers'=>$Passengers,'booking'=>$Booking);
	//{"session_key":"34eda1fc-d20e-47f0-a09f-b33e8fe618c9","booking":{"BookingID":0,"ContactFirstName":"hien minh","ContactLastName":"dang","ContactPhone":"0909652362","ContactAddress":"hcm","ContactEmail":"dang@gmail.com","IsVAT":false,"VatCompanyName":null,"VatCompanyNo":null,"VatCompanyAddress":null,"BookingStatus":0,"PNR":null,"FlightInfo":null,"TotalPrice":0,"GrossPrice":0,"HoldToDate":"\/Date(-62135596800000)\/","City":null,"Country":null,"Province":null,"Meassage":null},
	//"passengers":[{"FirstName":"hien minh","LastName":"dang","PassengerType":1,"Birthday":"\/Date(815472787982)\/","DepartBagID":0,"DepartBagValue":0,"ReturnBagID":0,"ReturnBagValue":0,"DepartSeatID":0,"ReturnSeatID":0,"DepartInsureanceID":0,"ReturnInsureanceID":0,"DepartMealID":0,"ReturnMealID":0,"Sex":"M","Passport":null,"PassportCountry":null,"Nationality":null,"PassportExpiry":null}]}
	$res=Call('addpassengers',$dataPassenger);
	//8 booking
	echo '<br/> 8.  BOOKING<br/>';
	$dataBooking=array('session_key'=>$session_key);
	$res=Call('booking',$dataBooking);
	//9 getresult
	echo '<br/> 9. GET RESULT<br/>';
	$dataResult=array('session_key'=>$session_key);
	$res=Call('bookingresult',$dataResult);
}
?>