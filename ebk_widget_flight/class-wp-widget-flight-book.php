<?php
/// Creating the widget 
class WP_Widget_FlightBook extends WP_Widget {

function __construct() {
	parent::__construct(
	// Base ID of your widget
	'widget_flight_book', 

	// Widget name will appear in UI
	__('Flight Book', 'wpb_widget_book'), 

	// Widget description
	array( 'description' => __( 'Flight Book control', 'wpb_widget_book' ), ) 
	);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
	$title = apply_filters( 'widget_title', $instance['title'] );
	// before and after widget arguments are defined by themes
	echo $args['before_widget'];
	if ( ! empty( $title ) )
	echo $args['before_title'] . $title . $args['after_title'];

	// This is where you run the code and display the output
	echo $args['after_widget'];
	//C:\xampp\htdocs\wordpress\wp-includes\widgets\ebk_widgets\ebk_widget_flight_book
	require_once( ABSPATH . '/wp-content/plugins/ebk-flights/ebk_widget_flight/core/controls/flight_book.php' );
}
		
// Widget Backend 
public function form( $instance ) {
	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	}
	else {
		$title = __( 'Form đặt chỗ', 'wpb_widget_book' );
	}
	// Widget admin form
	?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	return $instance;
	}
} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget_book() {
	register_widget( 'WP_Widget_FlightBook' );
}
add_action( 'widgets_init', 'wpb_load_widget_book' );