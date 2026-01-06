<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_latest_comments");'));

class DF_latest_comments extends WP_Widget {
	function DF_latest_comments() {
		 parent::__construct (false, $name = THEME_FULL_NAME.esc_html__(" Latest Comments", THEME_NAME));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => esc_html__("Recent Comments", THEME_NAME),
			'subtitle' => "",
			'count' => '3',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = esc_attr($instance['title']);
		$count = esc_attr($instance['count']);
        ?>
            <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

			<p><label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e( 'Comment count:' , THEME_NAME );?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($count); ?>" /></label></p>

		
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
		$count = $instance['count'];
		$title = $instance['title'];

	
		if(!$count) $count = 4;
		$widget_id = $args['widget_id'];
		

?>		
	<?php echo balanceTags($before_widget); ?>
		<?php 
			if($title) { 
				echo balanceTags($before_title);
				echo esc_html($title);
				echo balanceTags($after_title);
			}
		?>
		<div class="widget_latest_comments">
			<?php 
				$args =	array(
					'status' => 'approve', 
					'order' => 'DESC',
					'number' => $count
				);	
								
				$comments = get_comments($args);
				$totalCount = count($comments);
				$counter = 1;
							
				foreach($comments as $comment) {
					if($comment->user_id && $comment->user_id!="0") {
						$authorName = get_the_author_meta('display_name',$comment->user_id );
					} else {
						$authorName = $comment->comment_author;
					}	

			 ?>	
                <div class="item">
                    <div class="item_header">
                        <img src="<?php echo esc_url(df_get_avatar_url(get_avatar( $comment, 50)));?>" alt="<?php echo esc_attr($authorName); ?>">
                    </div>
                    <div class="item_wrapper">
                        <div class="author">
                        	<a href="<?php echo esc_url(get_comment_link($comment));?>">
                        		<?php echo esc_html($authorName); ?>
                        	</a> <span><?php esc_html_e("says:", THEME_NAME);?></span></div>
                        <div class="comment"><?php echo df_WordLimiter(get_comment_excerpt($comment->comment_ID),10);?></div>
                    </div>
                </div>
			<?php } ?>

		</div>

	<?php echo balanceTags($after_widget); ?>
		
	
      <?php
	}
}
?>