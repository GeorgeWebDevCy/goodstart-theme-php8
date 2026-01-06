<?php
add_action('widgets_init', function() {
	register_widget('DF_about');
});

class DF_about extends WP_Widget {
	function __construct() {
		 parent::__construct (false, $name = THEME_FULL_NAME.' About',array( 'description' => __( "Widget With Image And Text", THEME_NAME )));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'image' => '',
			'text' => '',
			'title' => '',


		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$image = $instance['image'];
		$text = $instance['text'];
		$title = $instance['title'];

        ?>
        	<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
            <p>
            	<label for="<?php echo esc_attr($this->get_field_id('image')); ?>" style="float:left; width:100%;"><?php esc_html_e( 'Image:' , THEME_NAME ); ?> <input class="widefat df-upload-field" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('image')); ?>" type="text" value="<?php echo esc_attr($image); ?>" /></label>
            	<span id="<?php echo esc_attr($this->get_field_id('image')); ?>_button" class="action df-upload df-upload-button" style="position:relative; display:inline-block; margin: 3px 0 0 -28px;"><?php esc_html_e("Choose File", THEME_NAME);?></span>
            </p>
			<p><label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php  esc_html_e('Text:' , THEME_NAME ); ?> <textarea style="height:200px;" class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo esc_attr($text); ?></textarea></label></p>

        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['image'] = strip_tags($new_instance['image']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $image = $instance['image'];
		$text = $instance['text'];
		$title = $instance['title'];

		
?>		
	<?php echo balanceTags($before_widget); ?>
		<?php 
			if($title) { 
				echo balanceTags($before_title);
				echo esc_html($title);
				echo balanceTags($after_title);
			}
		?>
		<div class="widget_text">
			<div class="textwidget">
				<?php 
					if($image) {
				?>
		            <img src="<?php echo esc_url($image);?>" alt="<?php echo esc_attr($title);?>"/>
		        <?php
		           	} 
	           	?>	
				<?php 
					if($text) {
		            	echo df_html_output(wpautop(stripslashes($text)));
		           	} 
	       		?>
	
			</div>
		</div>
	<?php echo balanceTags($after_widget); ?>
		
	
      <?php
	}
}
?>
