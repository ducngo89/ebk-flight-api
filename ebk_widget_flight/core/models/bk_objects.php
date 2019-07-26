<?php 

class bk_booking { 
	public $booking_id; 
	public $pnr;
	public $booking_type;
	public $from_city_code;
	public $from_city_name;
	public $to_city_code;
	public $to_city_name;
	public $depart_date;
	public $return_date;
	public $adult;
	public $child;
	public $infant;
	public $user_id; 
	public $contact_name; 
	public $contact_phone; 
	public $contact_address; 
	public $contact_email; 
	public $vat_no; 
	public $vat_name; 
	public $vat_phone; 
	public $vat_address; 
	public $total_passenger; 
	public $price_total; 
	public $price_before; 
	public $price_discount; 
	public $booking_ip; 
	public $booking_note; 
	public $booking_status; 
	public $created_date; 
	public $expired_date; 
	public $payment_status; 
	public $payment_type; 
	public $payment_detail; 
	public $booking_key; 
	public $is_deleted; 
	public $is_confirm; 
	public $confirm_date; 
	public $confirm_user; 
} 

class bk_segment {
	public $segment_id;
	public $segment_type; 
	public $booking_id;
	public $from_city_code;
	public $from_city_name;
	public $to_city_code;
	public $to_city_name;
	public $pnr;
	public $start_date;
	public $end_date;
	public $flight_time;
	public $price;
	public $price_before;
	public $price_child;
	public $price_child_before;
	public $price_infant;
	public $price_infant_before;
	public $trans_sit;
}

class bk_flight {
	public $flight_id;
	public $segment_id;
	public $from_city_code;
	public $from_city_name;
	public $to_city_code;
	public $to_city_name;
	public $start_date;
	public $end_date;
	public $flight_time;
	public $flight_no;
	public $firm_name;
	public $class;
	public $class_name;
}

class bk_passenger{
	public $passenger_id;
	public $booking_id;
	public $first_name;
	public $last_name;
	public $sex;
	public $birthday;
	public $passenger_type;
	public $passport_no;
	public $passport_country_id;
	public $passport_country_name;
	public $nationnality_id;
	public $nationnality_name;
}

class bk_booking_detail{
	public $booking_detail_id;
	public $booking_id;
	public $segment_id;
	public $passenger_id;
	public $price;
	public $bag_value;
	public $bag_price;
}


?>