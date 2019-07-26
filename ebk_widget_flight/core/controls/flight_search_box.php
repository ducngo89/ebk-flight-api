<?php require_once( ABSPATH . '/wp-content/plugins/ebk-flights/ebk_widget_flight/core/controls/flight_search_box.code.php' ); ?>
<style>
	.flight_search_widget .form-group{
		display:block;
		overflow:auto;
	}
</style>
<form method='post' action='/wordpress/tim-chuyen-bay/?session_id=<?php echo uniqid(); ?>'>
<div class='flight_search_widget'>
	<div class='form-group'>
		<div class='col-md-6'>
			<div class='radio'>
			  <label>
				<input type='radio' <?php echo $search_box_type_way =='oneway'?'checked':'' ?> name='search_box_type_way' value='oneway'>
					Một chiều
			  </label>
			</div>
		</div>
		<div class='col-md-6'>
			<div class='radio'>
			  <label>
				<input type='radio' <?php echo $search_box_type_way !='oneway'?'checked':'' ?> name='search_box_type_way' value='roundtrip'>
					Hai chiều
			  </label>
			</div>
		</div>
	</div>
	<div class='form-group'>
		<div class='col-sm-6 col-xs-12'>
			<label>Điểm đi</label>
			<input type='hidden' name='search_box_from_city_name' value='<?php echo $search_box_from_city_name; ?>'>
			<input type='hidden' name='search_box_from_city_code' value='<?php echo $search_box_from_city_code; ?>'>
			<input type='text' class='form-control' value='<?php echo $search_box_from_city_name; ?> (<?php echo $search_box_from_city_code; ?>)'> 
		</div>
		<div class='col-md-6'>
			<label>Điểm đến</label>
			<input type='hidden' name='search_box_to_city_name' value='<?php echo $search_box_to_city_name; ?>'>
			<input type='hidden' name='search_box_to_city_code' value='<?php echo $search_box_to_city_code; ?>'>
			<input type='text' class='form-control' value='<?php echo $search_box_to_city_name; ?> (<?php echo $search_box_to_city_code; ?>)'> 
		</div>
	</div>
	<div class='form-group'>
		<div class='col-md-6'>
			<label>Ngày đi</label>
			<input type='text' name='search_box_depart_date' class='form-control' value='<?php echo $search_box_depart_date; ?>'> 
		</div>
		<div class='col-md-6' style='display:<?php echo $search_box_type_way =='oneway'?'none':'block' ?>'>
			<label>Ngày về</label>
			<input type='text' name='search_box_return_date' class='form-control' value='<?php echo $search_box_return_date; ?>'> 
		</div>
	</div>
	<div class='form-group'>
		<div class='col-md-4'>
			<label>Người lớn</label>
			<select class='form-control' name='search_box_adult_num'>
				<?php 
					for($i=1;$i<10;$i++){
						if($search_box_adult_num==$i)
							echo "<option selected value='$i'>$i</option>";
						else
							echo "<option value='$i'>$i</option>";
					}
				?>
			</select>
		</div>
		<div class='col-md-4'>
			<label>Trẻ em</label>
			<select class='form-control' name='search_box_child_num'>
				<?php 
					for($i=0;$i<10;$i++){
						if($search_box_child_num==$i)
							echo "<option selected value='$i'>$i</option>";
						else
							echo "<option value='$i'>$i</option>";
					}
				?>
			</select>
		</div>
		<div class='col-md-4'>
			<label>Trẻ em</label>
			<select class='form-control' name='search_box_infant_num'>
				<?php 
					for($i=0;$i<5;$i++){
						if($search_box_infant_num==$i)
							echo "<option selected value='$i'>$i</option>";
						else
							echo "<option value='$i'>$i</option>";
					}
				?>
			</select>
		</div>
	</div>
	<div class='form-group'>
		<div class='col-md-12'>
			<input type='submit' value='search_box_submit' name='search_box_submit' class="btn btn-primary pull-right" value='Tìm chuyến bay' > 
		</div>
	</div>
</div>
</form>