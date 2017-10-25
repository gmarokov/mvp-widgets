<?php
/**
 * Extend Recent Posts Widget 
 *
 * Adds different formatting to the default WordPress Recent Posts Widget
 */

class mvp_widget_recent_blogs extends WP_Widget_Recent_Posts {
	
	// Set up the widget name and description.
	public function __construct() {
		$widget_options = array( 'classname' => 'mvp_recent_posts_widget', 'description' => 'Recent posts widget.' );
	 	parent::__construct( 'mvp_recent_posts_widget', 'MVP Recent posts', $widget_options );
	}
	   
	function widget($args, $instance) {
	
		extract( $args );
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
				
		if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = 10;
					
		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if( $r->have_posts() ) :
			
			echo $before_widget;
			if( $title ) echo $before_title . $title . $after_title; ?>
			<ul>
				<?php while( $r->have_posts() ) : $r->the_post(); ?>				
				<li><?php the_time( 'F d'); ?> - <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
			</ul>
			 
			<?php
			echo $after_widget;
		
		wp_reset_postdata();
		
		endif;
	}
}
  
unregister_widget('WP_Widget_Recent_Posts');
register_widget('mvp_widget_recent_blogs');
