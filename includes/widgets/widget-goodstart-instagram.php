<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_instagram");'));

class DF_instagram extends WP_Widget {
	function DF_instagram() {
		 parent::__construct (false, $name = THEME_FULL_NAME.' Instagram');	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => 'Instagram',
			'user_id' => '',
			'access_token' => '',
			'count' => '4',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	
		$title = esc_attr($instance['title']);
		$user_id = esc_attr($instance['user_id']);
		$access_token = esc_attr($instance['access_token']);
		$count = esc_attr($instance['count']);
		

        ?>
            <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
            <p><strong>*</strong>	<a href="https://instagram.com/developer/register/" target="_blank"><?php esc_html_e( 'Click here to get your access token and user id' , THEME_NAME ); ?></a></p>
            <p><label for="<?php echo esc_attr($this->get_field_id('user_id')); ?>"><?php esc_html_e( 'User ID:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('user_id')); ?>" name="<?php echo esc_attr($this->get_field_name('user_id')); ?>" type="text" value="<?php echo esc_attr($user_id); ?>" /></label></p>
            <p><label for="<?php echo esc_attr($this->get_field_id('access_token')); ?>"><?php esc_html_e( 'Access Token:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('access_token')); ?>" name="<?php echo esc_attr($this->get_field_name('access_token')); ?>" type="text" value="<?php echo esc_attr($access_token); ?>" /></label></p>
            <p><label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e( 'Image Count:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($count); ?>" /></label></p>
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['subtitle'] = strip_tags($new_instance['subtitle']);
		$instance['user_id'] = strip_tags($new_instance['user_id']);
		$instance['access_token'] = strip_tags($new_instance['access_token']);
		$instance['count'] = strip_tags($new_instance['count']);
		
		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$subtitle = $instance['subtitle'];
		$user_id = $instance['user_id'];
		$access_token = $instance['access_token'];
		$count = $instance['count'];

		$cacheResults = get_transient('df_instagram_'.$user_id.'_'.$count);
		$cacheToken = get_transient('df_instagram_token');

		if($cacheResults!=false && $cacheToken == $access_token) {
			$result = $cacheResults;
		} else {
			$url = "https://api.instagram.com/v1/users/".$user_id."/media/recent/?access_token=".$access_token."&count=".$count;
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		    $result = curl_exec($ch);
		    curl_close($ch); 
		  	
		  	if(!isset($result->meta->error_message)) {
		  		set_transient('df_instagram_'.$user_id.'_'.$count, $result, 30 );
		  		set_transient('df_instagram_token', $access_token, 30 );
		  	}
	  	}

	  	$result = json_decode($result);
?>
		<?php echo balanceTags($before_widget); ?>
			<?php 
				if($title) { 
					echo balanceTags($before_title);
					echo esc_html($title);
					echo balanceTags($after_title);
				}
			?>
			<div class="df-instagram-widget">
				<?php if(!isset($result->meta->error_message) && is_array($result->data)) { ?>
					<?php foreach ($result->data as $post) { ?>
						<a href="<?php echo esc_url($post->link);?>" class="image-hover" target="_blank">
							<img src="<?php echo esc_url($post->images->thumbnail->url);?>" alt="<?php echo esc_attr($post->caption->text);?>" />
						</a>
					<?php } ?>
				<?php } elseif(isset($result->meta->error_message)) {
					echo esc_html($result->meta->error_message);
				} else {
					esc_html_e("Please check your widget settings!", THEME_NAME);
				} ?>
			</div>
	<?php echo balanceTags($after_widget); ?>
        <?php
	}
}
?>