<?php
add_action('widgets_init', function() {
	register_widget('DF_reviews');
});

class DF_reviews extends WP_Widget {
	function __construct() {
		 parent::__construct (false, $name = THEME_FULL_NAME.' '.esc_html__("Reviews", THEME_NAME));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => esc_html__("Reviews", THEME_NAME),
			'subtitle' => '',
			'count' => '3',
			'cat' => '',
			'type' => 'latest',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = $instance['title'];
		$subtitle = $instance['subtitle'];
		$cat = $instance['cat'];
		$count = $instance['count'];
		$type = $instance['type'];

        ?>
            <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			<p><label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e( 'Category:' , THEME_NAME );?>
			<?php
			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 1,
				'hierarchical'             => 1,
				'taxonomy'                 => 'category');
				$args = get_categories( $args ); 
			?> 	
			<select name="<?php echo esc_attr($this->get_field_name('cat')); ?>" style="width: 100%; clear: both; margin: 0;">
				<option value=""><?php esc_html_e("Latest News", THEME_NAME);?></option>
				<?php foreach($args as $ar) { ?>
					<option value="<?php echo esc_attr($ar->term_id); ?>" <?php if($ar->term_id==$cat)  {echo 'selected="selected"';} ?>><?php echo esc_html($ar->cat_name); ?></option>
				<?php } ?>
			</select>
			
			</label></p>
			<p><label for="<?php echo esc_attr($this->get_field_id('type')); ?>"><?php esc_html_e( 'Type:' , THEME_NAME );?>
				<select name="<?php echo esc_attr($this->get_field_name('type')); ?>" style="width: 100%; clear: both; margin: 0;">
					<option value="latest" <?php if($type=="latest")  {echo 'selected="selected"';} ?>><?php esc_html_e("Latest Reviews", THEME_NAME);?></option>
					<option value="top" <?php if($type=="top")  {echo 'selected="selected"';} ?>><?php esc_html_e("Top Reviews", THEME_NAME);?></option>
				</select>
			
			</label></p>
			<p><label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e( 'Post count:' , THEME_NAME );?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($count); ?>" /></label></p>

		
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['subtitle'] = strip_tags($new_instance['subtitle']);
		$instance['cat'] = strip_tags($new_instance['cat']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['type'] = strip_tags($new_instance['type']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $subtitle = apply_filters('widget_title', $instance['subtitle']);
		$count = $instance['count'];
		$cat = $instance['cat'];
		$type = $instance['type'];

		if($type=="top") {
			$args = array(
				'post_type' => "post",
				'cat' => $cat,
				'showposts' => $count,
				'ignore_sticky_posts' => "1",
				'order' => 'DESC',
				'orderby'	=> 'meta_value_num',
				'meta_key'	=> "_".THEME_NAME.'_ratings_average'
			);
		} else {
			$args = array(
				'post_type' => "post",
				'cat' => $cat,
				'order' => 'DESC',
				'showposts' => $count,
				'ignore_sticky_posts' => "1",
				'meta_query' => array(
				    array(
				        'key' => "_".THEME_NAME.'_ratings_average',
				        'value'   => '0',
				        'compare' => '>='
				    )
				)
			);	
		}


		$the_query = new WP_Query($args);
		$counter = 1;
		
		$totalCount = $the_query->found_posts;
		
		$blogID = get_option('page_for_posts');
		

		$postDate = get_option(THEME_NAME."_post_date");
		$postComments = get_option(THEME_NAME."_post_comment");
?>		
	<?php echo balanceTags($before_widget); ?>
		<?php 
			if($title) { 
				echo balanceTags($before_title);
				echo esc_html($title);
				echo balanceTags($after_title);
			}
		?>

		<div class="widget_review_posts">
			<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<?php
					$avarageRate = df_avarage_rating($the_query->post->ID);
						if($avarageRate) {
							//categories
							$categories = get_the_category($the_query->post->ID);
						    $catCount = count($categories);
						    //select a random category id
						    $id = rand(0,$catCount-1);
						    if(isset($categories[$id]->term_id)) {
								$titleColor = df_title_color($categories[$id]->term_id, "category", false);	
						    } else {
						    	$titleColor = df_get_option(THEME_NAME."_pageColorScheme");
						    }

							if($avarageRate>=4.75) {
								$rateText = esc_html__("Excellent",THEME_NAME);
							} else if($avarageRate<4.75 && $avarageRate>=3.75) {
								$rateText = esc_html__("Good",THEME_NAME);
							} else if($avarageRate<3.75 && $avarageRate>=2.75) {
								$rateText = esc_html__("Average",THEME_NAME);
							} else if($avarageRate<2.75 && $avarageRate>=1.75) {
								$rateText = esc_html__("Fair",THEME_NAME);
							} else if($avarageRate<1.75 && $avarageRate>=0.75) {
								$rateText = esc_html__("Poor",THEME_NAME);
							} else if($avarageRate<0.75) {
								$rateText = esc_html__("Very Poor",THEME_NAME);
							}

				?>

	                    <div class="item">
	                        <div class="item_header">
	                            <div class="rate_box">
	                                <div class="image"><?php echo df_image_html($the_query->post->ID,90,67);?></div>
	                                <div class="info">
	                                    <div class="score"><?php echo floatval($avarageRate[1]);?></div>
	                                    <div class="summary"><?php echo esc_html($rateText);?></div>
	                                </div>
	                            </div>
	                            <div class="rate_stars">
	                                <div class="star-rating" title="<?php echo esc_attr($avarageRate[1]);?><?php esc_html_e(" out of 5", THEME_NAME);?>">
	                                    <span style="width: <?php echo floatval($avarageRate[0]);?>%"><?php echo esc_attr($avarageRate[1]);?><?php esc_html_e(" out of 5", THEME_NAME);?></span>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="item_wrapper">
	                            <div class="item_content">
	                                <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
	                            </div>
	                            <div class="content_meta">
									<?php 
										if(count(get_the_category($the_query->post->ID))>=1 && df_option_compare("postCategory","postCategory", $the_query->post->ID)==true) {
									?>
										<span class="category">
											<a href="<?php echo esc_url(get_category_link($categories[$id]->term_id));?>">
												<?php echo esc_html(get_cat_name($categories[$id]->term_id));?>
											</a>
										</span>
									<?php } ?>
									<?php if(df_option_compare("postComments","postComments", $the_query->post->ID)==true && comments_open()) { ?>
										<span class="comments"><a href="<?php the_permalink();?>#comment"><?php comments_number(esc_html__('0 Comments', THEME_NAME), esc_html__('1 Comment', THEME_NAME), esc_html__('% Comments', THEME_NAME)); ?></a></span>
									<?php } ?>
	                            </div>
	                        </div>
	                    </div>

                    <?php } ?>
					<?php endwhile; else: ?>
						<p><?php esc_html_e( 'No posts where found' , THEME_NAME);?></p>
				<?php endif; ?>
			</div>
	<?php echo balanceTags($after_widget); ?>
		
	
      <?php
	}
}
?>
