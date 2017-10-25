<?php
/* /**
 * Plugin Name:   Example Widget Plugin
 * Plugin URI:    https://jonpenland.com
 * Description:   Adds an example widget that displays the site title and tagline in a widget area.
 * Version:       1.0
 * Author:        Jon Penland
 * Author URI:    https://www.jonpenland.com
 */

class mvp_widget_skills extends WP_Widget {

  	// Set up the widget name and description.
  	public function __construct() {
    	$widget_options = array( 'classname' => 'mvp_skills_widget', 'description' => 'Displaying skill bars.' );
    	parent::__construct( 'mvp_skills_widget', 'MVP Skills', $widget_options );
  	}

  	// Create the widget output.
  	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
		$skills = $instance['skills'];
		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];?>
			<ul class="list-unstyled info">
			<?php for($i = 0; $i < count($skills); $i++) { ?>
				<li>
					<i class="fa fa-link"></i><?php echo $skills[$i][0]; ?>
					<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $skills[$i][1]; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $skills[$i][1]; ?>%;">
						<?php echo $skills[$i][1]; ?>%
					</div>
					</div>
				
				</li>
			
			<?php } ?>
			</ul>
		<?php echo $args['after_widget'];
  	}

  	// Create the admin area widget settings form.
 	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
		
		//1. Set empty array for skills
		//2. 
		if (isset($instance['skills'])) $skills = $instance['skills'];
		else {
			$skills = array(
				array('name' => 'php', 'percentage' => '85')
			);
		}
		
		echo 'Dump instance skills:<br/>';
		var_dump($instance['skills']);
		echo 'End dump';
		
		$skills_num = count( $skills );
		///$skills[ $skills_num + 1 ] = '';
		$skills_html = array();
		$skills_counter = 0;?>
	
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
	
		<?php /* $fields = isset ( $instance['fields'] ) ? $instance['fields'] : array();
        $field_num = count( $fields );
        $fields[ $field_num + 1 ] = '';
        $fields_html = array();
        $fields_counter = 0;

        foreach ( $fields as $name => $value )
        {
            $fields_html[] = sprintf(
                '<input type="text" name="%1$s[%2$s]" value="%3$s" class="widefat">',
                $this->get_field_name( 'fields' ),
                $fields_counter,
                esc_attr( $value )
            );
            $fields_counter += 1;
        }

        print 'Fields<br />' . join( '<br />', $fields_html ); */ ?>
	
		<ul class="skills-list">
			<label for=”<?php echo $this->get_field_id('name'); ?>”><?php _e('Name and %'); ?></label>
			<?php echo 'Dump each skills:<br/>';
			foreach ($skills as $skill) {
				$skills_html[] = sprintf(
						'<li style="clear: both;"><input class="widefat skill-name" type="text" name="%1$s[%2$s][]" value="%3$s" class="widefat">
						<input class="widefat skill-percent" type="text" name="%1$s[%2$s][]" value="%4$s" class="widefat">
						<button onclick="jQuery(this).parent().remove();" class="button button-secondary right skill-remove"><span class="dashicons dashicons-no-alt"></span></button></li>',
						$this->get_field_name( 'skills' ),
						$skills_counter,
						esc_attr($skill[0]),
						esc_attr($skill[1])
						
					);
					$skills_counter ++; 
					var_dump($skill); echo '</br>';
				}
				
				//echo 'End Dump each skills:<br/>';
				print 'Fields<br />' . join( '<br />', $skills_html );?>
				
			<?php /* foreach ($skills as $skill) :?>
				<li>
					
					<br>
					<input type="text" class="widefat skill-name" name="<?php echo 'widget-'.$this->id_base.'['.$this->number.'][skill]['.$i.'][name]'; ?>" value="<?php echo esc_attr($skill['name']); ?>" />
					<input type="text" class="widefat skill-percent" placeholder="%" name="<?php echo 'widget-'.$this->id_base.'['.$this->number.'][skill]['.$i.'][percentage]'; ?>" value="<?php echo esc_attr($skill['percentage']); ?>" />
					<button onclick="jQuery(this).parent().remove();" class="button button-secondary right skill-remove"><span class="dashicons dashicons-no-alt"></span></button>
				</li>
			<?php $i++; endforeach; */ ?>
		</ul>
	
		<p>
			<button id="add-skill" class="button button-secondary right"><span class="dashicons dashicons-plus"></span> Add skill</button>
		</p>
	
		<script>
				
				jQuery('button#add-skill').click(function(e) {
					e.preventDefault();
					console.log("event fired");
					var skill = '<li style="clear: both;">';
					//skill += '<label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name and %'); ?></label>';
					//skill += '<br/>';
					skill += '<input type="text" class="widefat skill-name" name="<?php echo $this->get_field_name( 'skills' ); ?>[]" value="" />';
					skill += '<input type="text" class="widefat skill-percent" placeholder="%" name="<?php echo $this->get_field_name( 'skills' )[$skills_counter + 1]; ?>[]" value="0" />';
				
					skill += '<button onclick="jQuery(this).parent().remove();console.log(jQuery(this).parent());" class="button button-secondary right skill-remove"><span class="dashicons dashicons-no-alt"></span></button>';
						skill += '</li>';
					jQuery('ul.skills-list').append(skill);
				});
			
		</script>
		<?php
 	}

  	// Apply settings to the widget instance.
  	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['skills'] = array();
		/*if ( isset ( $new_instance['skills'] ) ) {
			$index = 0;
			foreach ( $new_instance['quotes'] as $value ) {
				if ( '' !== trim( $value_quote ) ) {
					$instance['skills'][ $index ] = array();
					$instance['skills'][ $index ]['name'] = $value;
					$instance['skills'][ $index ]['percentage'] = 'name author';
					$index++;
				}
			}
		} */
	
	  	$instance['skills'] = $new_instance['skills'];

    	return $instance;
  	}

}

register_widget( 'mvp_widget_skills' );
