<?php
 
/*********************************************************************************
Widget
*********************************************************************************/
class Tamina_WP_Widget extends WP_Widget {
	
	//widget constructor function
	function __construct() {
		$widget_options = array (
			'classname' => 'Tamina_WP_Widget',
			'description' => 'Displays Tamina as a social button or a frame.'
		);
		parent::__construct( 'Tamina_WP_Widget', 'Tamina', $widget_options );
	}
	
	//function to output the widget form
	function form( $instance ) {
		$url = ! empty( $instance['tamina_url'] ) ? $instance['tamina_url'] : '';
		$mode = ! empty( $instance['tamina_mode'] ) ? $instance['tamina_mode'] : '';
	?>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'tamina_url'); ?>">url:</label>
		<input class="widefat" type="text" placeholder="URL" id="<?php echo $this->get_field_id( 'tamina_url' ); ?>" name="<?php echo $this->get_field_name( 'tamina_url' ); ?>" value="<?php echo esc_attr( $url ); ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'tamina_mode'); ?>">Mode:</label>
		<input class="widefat" type="text" placeholder="mode: 'popup' or 'iframe' " id="<?php echo $this->get_field_id( 'tamina_mode' ); ?>" name="<?php echo $this->get_field_name( 'tamina_mode' ); ?>" value="<?php echo esc_attr( $mode ); ?>" />
	</p>
	
	<?php }
	
	//function to define the data saved by the widget
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['tamina_url'] = strip_tags( $new_instance['tamina_url'] );
		$instance['tamina_mode'] = strip_tags( $new_instance['tamina_mode'] );
		return $instance;
	}
	
	//function to display the widget in the site
	function widget( $args, $instance ) {
		
		//define variables
		$url = apply_filters( 'widget_title', $instance['tamina_url'] );

		//output code
		echo $args['before_widget'];
		
		echo $this->write_content($instance);

		echo $args['after_widget'];
	}

	function write_content($instance) {

		$url = $instance['tamina_url'];
		$mode = $instance['tamina_mode'];
		$width = $instance['tamina_width'];
		$height = $instance['tamina_height'];
		if (!isset($url) || empty($url)) {
			$url = 'emotions';
		}

		$params = [ 'url' => $url ];
		$params['width'] = '100%';
		$params['height'] = '100%';
		$params['mode'] = 'iframe';
		if (isset($mode) && !empty($mode)) {
			$params['mode'] = $mode;
		}
		if (isset($width) && !empty($width)) {
			$params['width'] = $width;
		}
		if (isset($height) && !empty($height)) {
			$params['height'] = $height;
		}

		$params = json_encode($params, JSON_FORCE_OBJECT);

		$ret = "<div id='tamina_id'></div><script type='text/javascript'>function initTamina() {
			var tamina = new Tamina( ". $params ." );
		}</script>";

		return $ret;
	}

}

function tamina_widget_init() {
	register_widget( 'Tamina_WP_Widget' );
}

add_action( 'widgets_init', 'tamina_widget_init' );

?>