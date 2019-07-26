<?php require_once( ABSPATH . '/wp-content/plugins/ebk-flights/ebk_widget_flight/core/controls/flight_book.code.php' ); ?>

<form id="flight-book-form">
	<div id="flight-book">
		<div id="passenger-list">
			<h2>Thông tin hành khách</h2>
			<?php 
			/* Danh sách hành khách người lớn */
				for($i=0;$i<$search_box_adult_num;$i++){
				?>
				<div id="passengers-<?php echo $i; ?>">
					<input type="hidden" name="passengers-<?php echo $i; ?>-type" value="1">
					<div>
						Người lớn:
					</div>
					Quý danh: 
					<select name="passengers-<?php echo $i; ?>-Sex">
						<option value="M">Nam</option>
						<option value="F">Nữ</option>
					</select>
					<br>
					Họ: <input name="passengers-<?php echo $i; ?>-LastName">
					<br>
					Tên đệm và tên: <input  name="passengers-<?php echo $i; ?>-FirstName">
					<br>
					Hành lý chiều đi:
					<select name="passengers-<?php echo $i; ?>-BagDepart">
					<?php 
						foreach( $bages as $b){
							if($b->BagForWays==1){
					?>
						<option value="<?php echo $b->BagValue; ?>-<?php echo $b->BagPrice; ?>"><?php echo $b->BagValue; ?> Kg (<?php echo $b->BagPrice; ?> VND)</option>
							<?php }} ?>
					</select>
					
					<br>
					Hành lý chiều về:
					<select name="passengers-<?php echo $i; ?>-BagReturn">
					<?php 
						foreach( $bages as $b){
							if($b->BagForWays==2){
					?>
						<option value="<?php echo $b->BagValue; ?>-<?php echo $b->BagPrice; ?>"><?php echo $b->BagValue; ?> Kg (<?php echo $b->BagPrice; ?> VND)</option>
							<?php }} ?>
					</select>
				</div>
				<?php
				}
			/*--Danh sách hành khách người lớn */
			?>
			 
			 <?php 
			/* Danh sách hành khách trẻ em */
				for($i=$search_box_adult_num;$i<$search_box_child_num+$search_box_adult_num;$i++){
				?>
				<div id="passengers-<?php echo $i; ?>">
					<input type="hidden" name="passengers-<?php echo $i; ?>-type" value="2">
					<div>
						Trẻ em:
					</div>
					Quý danh: 
					<select name="passengers-<?php echo $i; ?>-Sex">
						<option value="M">Nam</option>
						<option value="F">Nữ</option>
					</select>
					<br>
					Họ: <input name="passengers-<?php echo $i; ?>-LastName">
					<br>
					Tên đệm và tên: <input  name="passengers-<?php echo $i; ?>-FirstName">
					<br>
					Hành lý chiều đi:
					<select name="passengers-<?php echo $i; ?>-BagDepart">
					<?php 
						foreach( $bages as $b){
							if($b->BagForWays==1){
					?>
						<option value="<?php echo $b->BagValue; ?>-<?php echo $b->BagPrice; ?>"><?php echo $b->BagValue; ?> Kg (<?php echo $b->BagPrice; ?> VND)</option>
							<?php }} ?>
					</select>
					
					<br>
					Hành lý chiều về:
					<select name="passengers-<?php echo $i; ?>-BagReturn">
					<?php 
						foreach( $bages as $b){
							if($b->BagForWays==2){
					?>
						<option value="<?php echo $b->BagValue; ?>-<?php echo $b->BagPrice; ?>"><?php echo $b->BagValue; ?> Kg (<?php echo $b->BagPrice; ?> VND)</option>
							<?php }} ?>
					</select>
				</div>
				<?php
				}
			/*--Danh sách hành khách trẻ em */
			?>
			
			 <?php 
			/* Danh sách hành khách sơ sinh */
				for($i=$search_box_adult_num+$search_box_child_num;$i<$search_box_child_num+$search_box_adult_num+$search_box_infant_num;$i++){
				?>
				<div id="passengers-<?php echo $i; ?>">
					<input type="hidden" name="passengers-<?php echo $i; ?>-type" value="3">
					<div>
						Sơ sinh:
					</div>
					Quý danh: 
					<select name="passengers-<?php echo $i; ?>-Sex">
						<option value="M">Nam</option>
						<option value="F">Nữ</option>
					</select>
					<br>
					Họ: <input name="passengers-<?php echo $i; ?>-LastName">
					<br>
					Tên đệm và tên: <input  name="passengers-<?php echo $i; ?>-FirstName">
					<br>
					Hành lý chiều đi:
					<select name="passengers-<?php echo $i; ?>-BagDepart">
					<?php 
						foreach( $bages as $b){
							if($b->BagForWays==1){
					?>
						<option value="<?php echo $b->BagValue; ?>-<?php echo $b->BagPrice; ?>"><?php echo $b->BagValue; ?> Kg (<?php echo $b->BagPrice; ?> VND)</option>
							<?php }} ?>
					</select>
					
					<br>
					Hành lý chiều về:
					<select name="passengers-<?php echo $i; ?>-BagReturn">
					<?php 
						foreach( $bages as $b){
							if($b->BagForWays==2){
					?>
						<option value="<?php echo $b->BagValue; ?>-<?php echo $b->BagPrice; ?>"><?php echo $b->BagValue; ?> Kg (<?php echo $b->BagPrice; ?> VND)</option>
							<?php }} ?>
					</select>
				</div>
				<?php
				}
			/*--Danh sách hành khách sơ sinh */
			?>
			 
		</div>
		
		<div id="booking-contact">
			<h2>Thông tin liên hệ</h2>
			Quý danh:<select name="contact-Sex">
						<option value="M">Nam</option>
						<option value="F">Nữ</option>
					</select>
					<br>
			Họ: <input name="contact-LastName"><br>
			Tên và tên đệm: <input name="contact-FirstName"><br>
			Số điện thoại: <input name="contact-Phone"><br>
			Email: <input name="contact-Email"><br>
			Địa chỉ: <input name="contact-Address"><br>
			Ghi chú: <input name="contact-Note"><br>
		</div>
		<input name="bookingnow" type="hidden" value="Đặt chỗ">
		<input type="submit" value="Đặt chỗ">
	</div>
</form>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script>
   
	// this is the id of the form
	$("#flight-book-form").submit(function(e) {

		var url = "/wordpress/wp-content/plugins/ebk-flights/ebk_widget_flight/core/controls/flight_ajax_search_result.php?session_id=<?php echo $session_id;?>"; // the script where you handle the form input.

		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#flight-book-form").serialize(), // serializes the form's elements.
			   success: function(data)
			   {
				   if(data=='ok'){
					   window.location.href='/wordpress/ket-qua-book-ve/?session_id=<?php echo $session_id;?>'
				   }else{
						alert(data); // show response from the php script.
				   }
			   }
			 });

		e.preventDefault(); // avoid to execute the actual submit of the form.
	});
</script>