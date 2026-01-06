<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_postdata();
	$post_type = get_post_type();
    if((!is_category() && $post_type=="post" && df_get_option(THEME_NAME."_breaking_news_post") == "on" && DF_page_id() != get_option('page_for_posts')) || 
        (!is_category() && df_get_option(THEME_NAME."_breaking_news_page") == "on" && is_page() && !is_page_template('template-homepage.php') && DF_page_id() != get_option('page_for_posts')) ||
        (!is_category() && df_get_option(THEME_NAME."_breaking_news_blog") == "on" && DF_page_id() == get_option('page_for_posts')) ||
        (!is_category() && df_get_option(THEME_NAME."_breaking_news_home") == "on" && is_page_template('template-homepage.php')) ||
        (is_category() && df_get_custom_option( get_cat_id( single_cat_title("",false) ), 'breaking_slider', false ) != "slider_off")) { 

		//braking slider		
		$breakingSlider = df_get_option(THEME_NAME.'_breaking_slider');
	

?>
		<?php
			if(is_category()) {
				$catId = get_cat_id( single_cat_title("",false) );
				$category_in = $catId;
			} else {
				$category_in = $breakingSlider;
			}

			$args=array(
				'category__in' => $category_in,
				'posts_per_page' => 6,
				'order'	=> 'DESC',
				'orderby'	=> 'date',
				'meta_key'	=> "_".THEME_NAME.'_breaking_post',
				'meta_value'	=> 'on',
				'post_type'	=> 'post',
				'ignore_sticky_posts'	=> true,
				'post_status '	=> 'publish'
			);
			$the_query = new WP_Query($args);
		?>
	            <!-- ======== BREAKING NEWS ======== -->
	            <div class="breaking_news <?php esc_attr_e(df_get_option(THEME_NAME."_breakingSlider"));?>">
	                <div class="container">
	                    <div class="breaking_title"><?php _e("Διαβαστε ακομα", THEME_NAME);?></div>
	                    <div class="breaking_block">
							<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
	                        <div class="item">
			                	<?php if(df_option_compare("postDate","postDate", $the_query->post->ID)==true) {  ?>
				                    <span class="date"><?php the_time(get_option('date_format'));?></span>
				                <?php } ?>
	                            <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
	                        </div>
							<?php endwhile; else: ?>
								<div class="item"><h4><a href="#"><?php  esc_html_e( 'No posts where found' , THEME_NAME);?></a></h4></div>
							<?php endif; ?>
	                    </div>
	                </div>
	            </div>
<?php wp_reset_postdata();  ?>
	<?php } ?>