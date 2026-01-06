<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_postdata();

	//main slider
	$mainSliderCat = get_post_meta ( DF_page_id(), "_".THEME_NAME."_main_slider", true ); 

	//slide counter
	$counter = 1;
	$totalCounter = 0;
	if(is_array($mainSliderCat) && !empty($mainSliderCat)) { 
		$args=array(
			'category__in' => $mainSliderCat,
			'showposts' => 1,
			'order'	=> 'DESC',
			'orderby'	=> 'date',
			'meta_key'	=> "_".THEME_NAME.'_main_slider_post',
			'meta_value'	=> 'on',
			'post_type'	=> 'post',
			'ignore_sticky_posts '	=> 1,
			'post_status '	=> 'publish'
		);


		$the_query = new WP_Query($args);
?>
    	<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    		<?php  
    			$image = get_post_thumb($the_query->post->ID,2508,1194);  

    			$ratingsAverage = df_avarage_rating( $the_query->post->ID); 

				//categories
				$categories = get_the_category($post->ID);
			    $catCount = count($categories);
			    //select a random category id
			    $id = rand(0,$catCount-1);
			    if(isset($categories[$id]->term_id)) {
					$titleColor = df_title_color($categories[$id]->term_id, "category", false);	
			    } else {
			    	$titleColor = df_get_option(THEME_NAME."_pageColorScheme");
			    }
    		?>
		        <!-- ======== PARALLAX CONTAINER ======== -->
		        <div class="parallax_container">
		            <div class="gradient_shadow"></div>
		            <div class="parallax_element" data-velocity="-.15" style="background-image: url(<?php echo esc_url($image['src']);?>)"></div>
		            <div class="parallax_header">
		                <h1><?php the_title();?></h1>
		                <div class="content_meta">
		                    <?php if(df_option_compare('postDate','postDate',$the_query->post->ID)==true) { ?>
		                        <span class="date"><?php the_time(get_option('date_format'));?></span>
		                    <?php } ?>
		                    <?php if(df_option_compare("postAuthor","postAuthor", $the_query->post->ID)==true) { ?>
		                        <span class="author">
		                            <?php echo the_author_posts_link();?>
		                        </span>
		                    <?php } ?>
		                    <span class="category"><?php the_category(', '); ?></span>
		                    <?php if(df_option_compare("postComments","postComments", $the_query->post->ID)==true && comments_open()) { ?>
		                        <span class="comments"><?php comments_number(esc_html__('0 Comments', THEME_NAME), esc_html__('1 Comment', THEME_NAME), esc_html__('% Comments', THEME_NAME)); ?></span>
		                    <?php } ?>
		                    <?php if(df_option_compare("postViews","postViews", $the_query->post->ID)==true) { ?>
		                        <span class="views"><?php echo DF_getPostViews($the_query->post->ID);?></span>
		                    <?php } ?>
		                </div>
		            </div>
		        </div>
			<?php endwhile; else: ?>
				<p><?php  esc_html_e('No posts where found, please edit a post and set it as main slider post.', THEME_NAME); ?></p>
			<?php endif; ?>
	<?php } ?>
<?php wp_reset_postdata();  ?>