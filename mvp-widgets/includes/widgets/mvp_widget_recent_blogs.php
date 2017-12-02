<?php

/**
 * Widget for displaying recent blog posts.
 *
 * This is an extension of WP's built in widget for recent posts. 
 *
 * @since      0.1
 * @package    Mvp_Widgets
 * @subpackage Mvp_Widgets/includes
 * @author     Georgi Marokov <georgi.marokov@gmail.com>
 */

class mvp_widget_recent_blogs extends WP_Widget_Recent_Posts {
	
	// Set up the widget name and description.
	public function __construct() {
		$widget_options = array( 
			'classname' => 'mvp_recent_posts_widget', 
			'description' => 'Recent posts widget.' 
		);	
		
	 	parent::__construct( 'mvp_recent_posts_widget', 'MVP Recent posts', $widget_options );
	}
	   
	function widget($args, $instance) {
	
		extract( $args );
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
				
		if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = 10;
		
		echo $before_widget . $before_title . $title . $after_title; 
		
		$query = new WP_Query( 
			apply_filters( 
				'widget_posts_args', 
				array( 
					'posts_per_page' => $number, 
					'no_found_rows' => true, 
					'post_status' => 'publish', 
					'ignore_sticky_posts' => true 
				) 
			)
		);
		
		if( $query->have_posts() ) {
			$output = '<ul class="vertical-list">';
			
			while( $query->have_posts() ) {
				$query->the_post(); 				
				$output .= '<li>';
				$output .= '<h3><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>';
				$output .= '<p><span>'. get_the_time( 'l, F jS, Y' ) . '</span></p>';

				if ( has_post_thumbnail() ) {
					$output .= '<a href="'.get_permalink().'"><img src="'.get_the_post_thumbnail_url($post->ID, 'full').'"></img></a>';
				}

				$output .= '<p>'. get_excerpt(70) .'</p>'; // TODO heavy dependency from theme's function 
				$output .= '<span class="pull-left">'. get_the_category_list(", ") . '</span>';
				$output .= '<div class="clearfix"></div>';
				$output .= '</li>';
			}

			wp_reset_postdata();
			$output .= "</ul>";
			echo $output;
		}

		echo $after_widget;
	}
}
  
unregister_widget('WP_Widget_Recent_Posts');
register_widget('mvp_widget_recent_blogs');
