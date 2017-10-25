<?php
/* /**
 * Plugin Name:   Example Widget Plugin
 * Plugin URI:    https://jonpenland.com
 * Description:   Adds an example widget that displays the site title and tagline in a widget area.
 * Version:       1.0
 * Author:        Jon Penland
 * Author URI:    https://www.jonpenland.com
 */

class mvp_widget_projects extends WP_Widget {

  	// Set up the widget name and description.
  	public function __construct() {
    	$widget_options = array( 'classname' => 'mvp_projects_widget', 'description' => 'Displaying your projects items.' );
    	parent::__construct( 'mvp_projects_widget', 'MVP Projects', $widget_options );
  	}

  	// Create the widget output.
  	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
		$numberOfPosts = $instance['numberOfPosts'];

		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; 
		
		$query = new WP_Query(array( 
			'post_type' => 'mvp_projects', 
			'posts_per_page' => $numberOfPosts ? $numberOfPosts : 10 
		)); 
		
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				echo '<li>' . get_the_title( $query->post->ID ) . '</li>';
			}
			wp_reset_postdata();
		}
		echo $args['after_widget'];
  	}
  
  	// Create the admin area widget settings form.
 	 public function form( $instance ) {
    	$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
	 	 $numberOfPosts = esc_attr($instance['numberOfPosts']);?>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for=”<?php echo $this->get_field_id('numberOfPosts'); ?>”><?php _e('Number of Projects'); ?></label>
			<br>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('numberOfPosts'); ?>" id="<?php echo $this->get_field_id('numberOfPosts'); ?>" value="<?php echo esc_attr( $numberOfPosts ); ?>" />
		</p>
		<?php
  	}

  	// Apply settings to the widget instance.
  	public function update( $new_instance, $old_instance ) {
   	 	$instance = $old_instance;
    	$instance['title'] = strip_tags($new_instance['title']);
	  	$instance['numberOfPosts'] = strip_tags($new_instance['numberOfPosts']);
	
    	return $instance;
  	}
}

register_widget( 'mvp_widget_projects' );