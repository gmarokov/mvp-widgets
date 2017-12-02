<?php

/**
 * Widget displaying field for contacts. 
 *
 * This class defines all code necessary to display and manage the widget.
 *
 * @since      0.1
 * @package    Mvp_Widgets
 * @subpackage Mvp_Widgets/includes
 * @author     Georgi Marokov <georgi.marokov@gmail.com>
 */

class mvp_widget_contact_me extends WP_Widget {

  	// Set up the widget name and description.
  	public function __construct() {
   		$widget_options = array( 
			'classname' => 'mvp-contact-me-widget', 
			'description' => 'Contact me widget.' 
		);
		
    	parent::__construct( 'mvp_contact_me_widget', 'MVP Contact me', $widget_options );
  	}

  	// Create the widget output.
  	public function widget( $args, $instance ) {
    	$title = apply_filters( 'widget_title', $instance[ 'title' ] );
        $phone = $instance['phone'];
        $email = $instance['email'];
        $address = $instance['address'];

    	echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];

    	if ( $phone ) { 
            echo '<p><span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-phone fa-stack-1x"></i>
                </span><span class="contancts-content"><a href="tel:'.$phone.'">'.$phone.'</a></span></p>'; 
        }

        if ( $email ) { 
            echo '<p><span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-envelope-open-o fa-stack-1x"></i>
                </span><span class="contancts-content"><a href="mailto:'.$email.'?Subject=Greetings" target="_top">'.$email.'</a></span></p>'; 
        }

        if ( $address ) { 
            echo '<p><span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-map-marker fa-stack-1x"></i>
                </span><span class="contancts-content"><a href="https://maps.google.com/?q='.$address.'" target="_blank">'.$address.'</a></span></p>'; 
        }

    	echo $args['after_widget'];
  	}

  
  	// Create the admin area widget settings form.
 	public function form( $instance ) {
    	$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
        $phone = esc_attr($instance['phone']); 
        $email = esc_attr($instance['email']); 
        $address = esc_attr($instance['address']); 
        
        ?>
	
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for=”<?php echo $this->get_field_id('phone'); ?>”><?php _e('Phone'); ?></label>
			<br>
			<input type="number" class="widefat" name="<?php echo $this->get_field_name('phone'); ?>" id="<?php echo $this->get_field_id('phone'); ?>" value="<?php echo $phone; ?>" />
		</p>
        <p>
			<label for=”<?php echo $this->get_field_id('email'); ?>”><?php _e('Email'); ?></label>
			<br>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('email'); ?>" id="<?php echo $this->get_field_id('email'); ?>" value="<?php echo $email; ?>" />
		</p>
        <p>
			<label for=”<?php echo $this->get_field_id('address'); ?>”><?php _e('Address'); ?></label>
			<br>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('address'); ?>" id="<?php echo $this->get_field_id('address'); ?>" value="<?php echo $address; ?>" />
		</p>
        
		<?php
  	}


  	// Apply settings to the widget instance.
  	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['phone'] = strip_tags($new_instance['phone']);
        $instance['email'] = strip_tags($new_instance['email']);
        $instance['address'] = strip_tags($new_instance['address']);
        
		return $instance;
  	}

}

register_widget( 'mvp_widget_contact_me' );

