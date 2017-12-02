<?php

/**
 * Widget displaying GitHub activity for given username 
 *
 * This class defines all code necessary to display and manage the widget.
 *
 * @since      0.1
 * @package    Mvp_Widgets
 * @subpackage Mvp_Widgets/includes
 * @author     Georgi Marokov <georgi.marokov@gmail.com>
 */

class mvp_widget_github extends WP_Widget {

  	// Set up the widget name and description.
  	public function __construct() {
		$widget_options = array( 
			'classname' => 'mvp_github_widget', 
			'description' => 'Displaying repo or user activity.' 
		);

		parent::__construct( 'mvp_github_widget', 'MVP GitHub', $widget_options );
  	}

  	// Create the widget output.
  	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
		$username = $instance['username'];

		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
		do_shortcode('[mvp-github-activity username="'.$username.'"]');
		echo $args['after_widget'];
  	}

  
  	// Create the admin area widget settings form.
  	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
		$username = esc_attr($instance['username']);?>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for=”<?php echo $this->get_field_id('username'); ?>”><?php _e('Github username'); ?></label>
			<br>
			<input type="text" class="widefat"  name="<?php echo $this->get_field_name('username'); ?>" id="<?php echo $this->get_field_id('username'); ?>" value="<?php echo $username; ?>" />
		</p>
		<?php
  }


  	// Apply settings to the widget instance.
  	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);
		
		return $instance;
  	}

}

register_widget( 'mvp_widget_github' );
