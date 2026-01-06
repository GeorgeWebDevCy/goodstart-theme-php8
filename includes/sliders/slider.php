<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_postdata();

	//main slider
	$mainSliderCat = get_post_meta ( DF_page_id(), "_".THEME_NAME."_main_slider", true ); 
	$postCount = get_post_meta ( DF_page_id(), "_".THEME_NAME."_post_count", true ); 
	$bgType = get_post_meta ( DF_page_id(), "_".THEME_NAME."_slider_bgType", true ); 
	$color = get_post_meta ( DF_page_id(), "_".THEME_NAME."_slider_color", true ); 
	$image = get_post_meta ( DF_page_id(), "_".THEME_NAME."_slider_image", true ); 

	if($bgType == "color") {
		$sytle = ' style = "background-color: #'.esc_attr($color).'"';
	} else if ($bgType == "image") {
		$sytle = ' style = "background-image:url('.esc_url($image).')"';
	} else {
		$sytle = false;
	}

	//slide counter
	$counter = 1;
	$totalCounter = 0;
	if(is_array($mainSliderCat) && !empty($mainSliderCat)) { 
		$args=array(
			'category__in' => $mainSliderCat,
			'showposts' => intval($postCount),
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

			<!-- ======== MAIN SLIDER ======== -->
			<div id="main_slider_container"<?php echo stripslashes($sytle);?>>
	            <div class="container">
	                <div class="main_content_slider">
			        	<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			        		<?php 
			        			$image = get_post_thumb($the_query->post->ID,1024,488,THEME_NAME.'_homepage_image');  

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
		                    <div class="item">
		                        <a href="<?php the_permalink();?>">
		                        	<img src="<?php echo esc_url($image['src']);?>" alt="<?php esc_attr_e(get_the_title());?>">
		                        </a>
		                        <div class="meta_wrapper">
		                            <h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
		                            <div class="content_meta">
										<?php if(df_option_compare('postDate','postDate',$the_query->post->ID)==true) { ?>
											<span class="date"><?php the_time(get_option('date_format'));?></span>
										<?php } ?>
				                        <?php if(df_option_compare("postAuthor","postAuthor", $the_query->post->ID)==true) { ?>
				                            <span class="author">
				                            	<?php echo the_author_posts_link();?>
				                            </span>
				                        <?php } ?>
										<?php 
											if(count(get_the_category($the_query->post->ID))>=1 && df_option_compare("postCategory","postCategory", $the_query->post->ID)==true) {
										?>
											<span class="category">
												<?php echo esc_html(get_cat_name($categories[$id]->term_id));?>
											</span>
										<?php } ?>
										<?php if(df_option_compare("postComments","postComments", $the_query->post->ID)==true && comments_open()) { ?>
											<span class="comments">
												<a href="<?php the_permalink();?>#comment"><?php comments_number(esc_html__('0 Comments', THEME_NAME), esc_html__('1 Comment', THEME_NAME), esc_html__('% Comments', THEME_NAME)); ?></a>
											</span>
										<?php } ?>
				                        <?php if(df_option_compare("postViews","postViews", $the_query->post->ID)==true) { ?>
				                        	<span class="views"><?php echo DF_getPostViews($the_query->post->ID);?></span>
				                        <?php } ?>
		                            </div>
		                        </div>
		                        <div class="gradient_shadow"></div>
		                    </div>

						<?php endwhile; else: ?>
							<p><?php  esc_html_e('No posts where found, please edit a post and set it as main slider post.', THEME_NAME); ?></p>
						<?php endif; ?>
	                </div>
	            </div>
            </div>

	<?php } ?>
<?php wp_reset_postdata();  ?>