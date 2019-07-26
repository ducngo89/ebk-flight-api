<?php require_once( ABSPATH . '/wp-content/plugins/ebk-flights/ebk_widget_flight/core/controls/flight_search_result.code.php' );?>
<style>
	.flight_search_widget .form-group{
		display:block;
		overflow:auto;
	}
</style>

<script>
	session_api_key='<?php echo $session_api_key; ?>';
</script>

<script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<span>Chuyến đi từ: <?php echo $search_box_from_city_name;?> đến <?php echo $search_box_to_city_name;?></span> (<?php echo $search_box_depart_date;?>)

<form name='search_result' method='post' action='/wordpress/dat-cho/?session_id=<?php echo $session_id; ?>'>
	<table id="depart-result" class="display flight-list" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Hãng</th>
                <th>Giờ đi</th>
                <th>Giờ đến</th>
				<th>Hạng vé</th>
                <th>Giá</th>
                <th>Chọn</th>
            </tr>
        </thead>
    </table>
	
	<span>Chuyến về từ: <?php echo $search_box_to_city_name;?> đến <?php echo $search_box_from_city_name;?></span> (<?php echo $search_box_return_date;?>)

	<table id="return-result" class="display flight-list" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Hãng</th>
                <th>Giờ đi</th>
                <th>Giờ đến</th>
				<th>Hạng vé</th>
                <th>Giá</th>
                <th>Chọn</th>
            </tr>
        </thead>
    </table>
	
	<input type='submit' value='Đặt chỗ' name='select_ticket'>
</form>

<div id="flight-info">
</div>

<script>
	from_city_code= '<?php echo $search_box_from_city_code;?>';
	to_city_code= '<?php echo $search_box_to_city_code;?>';
	$(document).ready(function() {
		$('#depart-result').DataTable( {
			language: {
					"loadingRecords": "<img class='loading' src='http://thegioivere.net/Content/style2.0/images/ajax_loader_red_128.gif'/><div class='text-search'>Vui l&#242;ng chờ trong gi&#226;y l&#225;t ...</div>"
			},
			"ajax": {
				"url": "/wordpress/wp-content/plugins/ebk-flights/ebk_widget_flight/core/controls/flight_ajax_search_result.php?get_ticket=<?php echo $session_id; ?>",
				"dataSrc": function ( json ) {
					data_return = json.data;
					return json.data;
				}
			  },
			"columns": [
				{ 	
				    data:function (data, type, row ) {
						return render_firm(data);
					}
				},
				{ 
					"data": function ( data, type, row ) {
						return render_time(data.StartDate,data.FromCityCode);
					} 
				},
				{ 
					"data": function ( data, type, row ) {
						return render_time(data.EndDate,data.ToCityCode);
					} 
				},
				{ 
					"data": function ( data, type, row ) {
						return render_flight_class(data);
					} 
				},
				{ 
					"data": function ( data, type, row ) {
						return render_price(data);
					} 
				},
				{ 
					"data": function ( data, type, row ) {
						return render_select_button_depart(data);
					} 
				}
			],
			order: [[ 4, 'asc' ]],
			paging: false,
			info: false,
			ordering: true,
			initComplete: function () {
				//Delete return tickets
				//$("'."+to_city_code+from_city_code+"'").delete();
				
				$( "#depart-result ."+to_city_code+from_city_code ).each(function( index ) {
				  $(this).parent().parent().remove();
				});

				//
				$('#depart-result tr').click(function(){
					$(this).find('input[type=radio]').prop('checked', true);
					ticket_id = $(this).find('input[type=radio]').val().split('_')[0];
					ticket_class = $(this).find('input[type=radio]').val().split('_')[1];
					select_depart(ticket_id,ticket_class);
				});
				bind_return();
			}
		} );
	} );
	
	function bind_return(){
		//debugger;
		$('#return-result').DataTable( {
			language: {
					"loadingRecords": "<img class='loading' src='http://thegioivere.net/Content/style2.0/images/ajax_loader_red_128.gif'/><div class='text-search'>Vui l&#242;ng chờ trong gi&#226;y l&#225;t ...</div>"
			},
			"ajax": {
				"url": "/wordpress/wp-content/plugins/ebk-flights/ebk_widget_flight/core/controls/flight_ajax_search_result.php?get_hello=1",
				"dataSrc": function ( json ) {
				  return data_return;
				}
			  },
			"columns": [
				{ 	
				    data:function (data, type, row ) {
						return render_firm(data);
					}
				},
				{ 
					"data": function ( data, type, row ) {
						return render_time(data.StartDate,data.FromCityCode);
					} 
				},
				{ 
					"data": function ( data, type, row ) {
						return render_time(data.EndDate,data.ToCityCode);
					} 
				},
				{ 
					"data": function ( data, type, row ) {
						return render_flight_class(data);
					} 
				},
				{ 
					"data": function ( data, type, row ) {
						return render_price(data);
					} 
				},
				{ 
					"data": function ( data, type, row ) {
						return render_select_button_return(data);
					} 
				}
			],
			order: [[ 4, 'asc' ]],
			paging: false,
			info: false,
			ordering: true,
			initComplete: function () {
				
				$( "#return-result ."+from_city_code+to_city_code ).each(function( index ) {
					  $(this).parent().parent().remove();
					});
					
				$('#return-result tr').click(function(){
					
					$(this).find('input[type=radio]').prop('checked', true);
					ticket_id = $(this).find('input[type=radio]').val().split('_')[0];
					ticket_class = $(this).find('input[type=radio]').val().split('_')[1];
					select_return(ticket_id,ticket_class);
				});
			}
		} );
	}
	
	function select_depart(ticket_id,ticket_class){
		var jqxhr = $.ajax("/wordpress/wp-content/plugins/ebk-flights/ebk_widget_flight/core/controls/flight_ajax_search_result.php?select_depart=1&ticket_id="+ticket_id+"&ticket_class="+ticket_class+"&session_id=<?php echo $session_id; ?>")
          .done(function (data) {
              update_summary('<?php echo $session_id; ?>');
          })
          .fail(function () {
              alert('Chọn vé chiều đi thất bại!');
          })
          .always(function () {
              //isLoadCondition = false;
          });
		
	}
	
	function select_return(){
		
		var jqxhr = $.ajax("/wordpress/wp-content/plugins/ebk-flights/ebk_widget_flight/core/controls/flight_ajax_search_result.php?select_return=1&ticket_id="+ticket_id+"&ticket_class="+ticket_class+"&session_id=<?php echo $session_id; ?>")
          .done(function (data) {
              update_summary('<?php echo $session_id; ?>');
          })
          .fail(function () {
              alert('Chọn vé chiều đi thất bại!');
          })
          .always(function () {
              //isLoadCondition = false;
          });
	}
	
	var data_return = null;
	function render_firm(data){
		
		return '<img class="'+data['FromCityCode']+data['ToCityCode']+'" src="http://thegioivere.net/content/images/logo/'+data['FirmImage']+'" alt="'+data['FirmImage']+'"><br>'+data['PlanInfoCollection'][0].PlanName;
	}
	
	function render_flight_class(data){
		return data['PriceCollection'][0]['TicketClass'];
	}
	
	function render_time(data, sts) {
		var data = data.substring(6, data.length - 5);
		var d = new Date(data * 1000);
		var hh = d.getHours();
		var mm = d.getMinutes();
		return (sts+ '<br>') + ('<b class="f-time">' + (hh < 10 ? '0' + hh : hh) + ':' + (mm < 10 ? '0' + mm : mm) + '</b>');
	}
	
	function render_price(data) {
		return '<b class="price-color">' + addCommas(data['PriceCollection'][0]['AdultTotalPrice']) + '</b> <b>VND</b>';
	}
	
	function addCommas(str) {
		var parts = (str + "").split("."),
				main = parts[0],
				len = main.length,
				output = "",
				i = len - 1;

		while (i >= 0) {
			output = main.charAt(i) + output;
			if ((len - i) % 3 === 0 && i > 0) {
				output = "," + output;
			}
			--i;
		}
		// put decimal part back
		if (parts.length > 1) {
			output += "." + parts[1];
		}
		return output;
	}
	
	function render_select_button_depart(data){
		//\''+data['firm_id']+\'','\'+data['PriceCollection'][0]['TicketClass']+"'
		return '<a href="javascript:void(0)" onclick="loadCondition(\''+data['FirmID']+'\',\''+data['PriceCollection'][0]['TicketClass']+'\')">[+] Chi tiết</a><input name="ticket_depart_selected"  value="'+data['TicketID']+'_'+data['PriceCollection'][0]['TicketClass']+'" type="radio"/>';
	}
	
	function render_select_button_return(data){
		//\''+data['firm_id']+\'','\'+data['PriceCollection'][0]['TicketClass']+"'
		return '<a href="javascript:void(0)" onclick="loadCondition(\''+data['FirmID']+'\',\''+data['PriceCollection'][0]['TicketClass']+'\')">[+] Chi tiết</a><input name="ticket_depart_return"  value="'+data['TicketID']+'_'+data['PriceCollection'][0]['TicketClass']+'" type="radio"/>';
	}
	
	function loadCondition(firm_id,ticket_class) {
		
        $("#flight-info").dialog({
            resizable: false,
            height: 700,
            width: 700
        });
        //loading
        $('#flight-info').html("Loading...");
        var jqxhr = $.ajax("/wordpress/wp-content/plugins/ebk-flights/ebk_widget_flight/core/controls/flight_ajax_condition.php?get_condition=true&firm_id=" + firm_id+"&ticket_class="+ticket_class)
          .done(function (data) {
              $('#flight-info').html(data);
          })
          .fail(function () {
              $('#flight-info').html("Request error");
          })
          .always(function () {
              isLoadCondition = false;
          });
    }


</script>