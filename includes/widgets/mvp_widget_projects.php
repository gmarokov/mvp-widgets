<?php

/**
 * Widget for displaying project entries in custom post type 'projects'.
 *
 * This class defines all code necessary to display and manage the widget.
 *
 * @since      0.1
 * @package    Mvp_Widgets
 * @subpackage Mvp_Widgets/includes
 * @author     Georgi Marokov <georgi.marokov@gmail.com>
 */

class mvp_widget_projects extends WP_Widget {

  	// Set up the widget name and description.
  	public function __construct() {
    	$widget_options = array( 
			'classname' => 'mvp_projects_widget', 
			'description' => 'Displaying your projects items.'
		);

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
			$output = '<ul class="vertical-list">';
			while ( $query->have_posts() ) {
				$query->the_post(); 				
				$output .= '<li>';
				$output .= '<h3><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>';
				$output .= '<p><span>'. get_the_time( 'l, F jS, Y' ) . '</span></p>';

				if ( has_post_thumbnail() ) {
					$output .= '<a href="'.get_permalink().'"><img src="'.get_the_post_thumbnail_url($post->ID, 'full').'"></img></a>';
				}

				$output .= '<p>'. get_the_excerpt() .'</p>';
				$output .= '<span class="pull-left">'. get_the_category_list(", ") . '</span>';
				$output .= '<div class="clearfix"></div>';
				$output .= '</li>';
			}
			
			wp_reset_postdata();
			$output .= "</ul>";
			//TODO: View more only if posts available
			$output .= '<a class="btn btn-primary" href="/projects">View more</a>';
			echo $output;
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