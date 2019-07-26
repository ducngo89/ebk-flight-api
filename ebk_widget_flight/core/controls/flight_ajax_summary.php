<?php 
	if( !session_id() ){
		session_start();
	}
	if(isset($_REQUEST['session_id'])){
		$session_id = $_REQUEST['session_id'];
		if(isset($_SESSION[$session_id . 'ticket_depart_id'])){
			echo $_SESSION[$session_id . 'ticket_depart_id'];
			echo $_SESSION[$session_id . 'ticket_depart_class'];
		}
		if(isset($_SESSION[$session_id . 'ticket_return_id'])){
			echo $_SESSION[$session_id . 'ticket_return_id'];
			echo $_SESSION[$session_id . 'ticket_return_class'];
		}
	}
?>