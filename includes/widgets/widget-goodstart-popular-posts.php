<?php
add_action('widgets_init', function() {
	register_widget('DF_popular_posts');
});

class DF_popular_posts extends WP_Widget {
	function __construct() {
		 parent::__construct (false, $name = THEME_FULL_NAME.' '.esc_html__("Popular Posts", THEME_NAME));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => esc_html__("Popular Posts", THEME_NAME),
			'count' => '3',
			'cat' => '',
			'images' => 'show',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = $instance['title'];
		$cat = $instance['cat'];
		$count = $instance['count'];
		$images = $instance['images'];
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
			<p><label for="<?php echo esc_attr($this->get_field_id('images')); ?>"><?php esc_html_e( 'Images:' , THEME_NAME );?>
			<select name="<?php echo esc_attr($this->get_field_name('images')); ?>" style="width: 100%; clear: both; margin: 0;">
				<option value="show" <?php if("show"==$images)  {echo 'selected="selected"';} ?>><?php esc_html_e("Show", THEME_NAME);?></option>
				<option value="hide" <?php if("hide"==$images)  {echo 'selected="selected"';} ?>><?php esc_html_e("Hide", THEME_NAME);?></option>
			</select>
			
			</label></p>
			<p><label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e( 'Post count:' , THEME_NAME );?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($count); ?>" /></label></p>

		
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cat'] = strip_tags($new_instance['cat']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['images'] = strip_tags($new_instance['images']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$count = $instance['count'];
		$cat = $instance['cat'];
		$images = $instance['images'];

		$args=array(
			'posts_per_page' => $count,
			'order' => 'DESC',
			'cat' => $cat,
			'orderby'	=> 'meta_value_num',
			'meta_key'	=> "_".THEME_NAME.'_post_views_count',
			'post_type'=> 'post',
			'ignore_sticky_posts' => true
		);



		$the_query = new WP_Query($args);
		$counter = 1;
		
		$totalCount = $the_query->found_posts;
		
		$blogID = get_option('page_for_posts');
		
		if($cat) {
			$link = get_category_link( $cat );
		} else {
			$link = get_page_link($blogID);
		}

?>		
	<?php echo balanceTags($before_widget); ?>
		<?php 
			if($title) { 
				echo balanceTags($before_title);
				echo esc_html($title);
				echo balanceTags($after_title);
			}
		?>
		<div class="widget_latest_posts">
			<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
			<?php
				$image = get_post_thumb($the_query->post->ID,0,0); 

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
			?>
                    <div class="item<?php if($image['show']==false && $images=="hide") { ?> no-image<?php } ?>">
                    	<?php if($image['show']!=false && $images!="hide") { ?>
	                        <div class="item_header">
	                            <a href="<?php the_permalink();?>">
	                            	<?php echo df_image_html($the_query->post->ID,80,60);?>
	                            </a>
	                        </div>
                        <?php } ?>
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


			<?php endwhile; else: ?>
				<p><?php  esc_html_e( 'No posts where found' , THEME_NAME);?></p>
			<?php endif; ?>
		</div>

	<?php echo balanceTags($after_widget); ?>
    <?php
	}
}
?>
