<div id="flight-summary">Hello world!</div>

<script>
	function update_summary(session_id){
        //loading
        //$('#flight-summary').html("Loading...");
        var jqxhr = $.ajax("/wordpress/wp-content/plugins/ebk-flights/ebk_widget_flight/core/controls/flight_ajax_summary.php?session_id="+session_id)
          .done(function (data) {
              $('#flight-summary').html(data);
          })
          .fail(function () {
              $('#flight-summary').html("Request error");
          })
          .always(function () {
              isLoadCondition = false;
          });
	}
</script>