<?php

/**
 * Widget displaying text area about me. 
 *
 * This class defines all code necessary to display and manage the widget.
 *
 * @since      0.1
 * @package    Mvp_Widgets
 * @subpackage Mvp_Widgets/includes
 * @author     Georgi Marokov <georgi.marokov@gmail.com>
 */

class mvp_widget_about_me extends WP_Widget {

  	// Set up the widget name and description.
  	public function __construct() {
   		$widget_options = array( 
			'classname' => 'mvp-about-me-widget', 
			'description' => 'About me text widget.' 
		);
		
    	parent::__construct( 'mvp_about_me_widget', 'MVP About me', $widget_options );
  	}

  	// Create the widget output.
  	public function widget( $args, $instance ) {
    	$title = apply_filters( 'widget_title', $instance[ 'title' ] );
    	$paragraph = $instance['paragraph'];

    	echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; ?>
    	<p><?php if ( $paragraph ) {echo $paragraph;} ?></p>
    	<?php echo $args['after_widget'];
  	}

  
  	// Create the admin area widget settings form.
 	public function form( $instance ) {
    	$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
		$paragraph = esc_attr($instance['paragraph']);?>
	
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for=”<?php echo $this->get_field_id('paragraph'); ?>”><?php _e('Text'); ?></label>
			<br>
			<textarea class="widefat" rows="10" name="<?php echo $this->get_field_name('paragraph'); ?>" id="<?php echo $this->get_field_id('paragraph'); ?>"><?php echo $paragraph; ?></textarea>
		</p>
		<?php
  	}


  	// Apply settings to the widget instance.
  	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['paragraph'] = $new_instance['paragraph'];

		return $instance;
  	}

}

register_widget( 'mvp_widget_about_me' );

