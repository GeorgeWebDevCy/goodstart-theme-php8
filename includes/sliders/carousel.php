<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_postdata();

	//main slider
	$mainSliderCat = get_post_meta ( DF_page_id(), "_".THEME_NAME."_main_slider", true ); 
	$postCount = get_post_meta ( DF_page_id(), "_".THEME_NAME."_post_count", true ); 
	$bgType = get_post_meta ( DF_page_id(), "_".THEME_NAME."_carousel_bgType", true ); 
	$color = get_post_meta ( DF_page_id(), "_".THEME_NAME."_carousel_color", true ); 
	$image = get_post_meta ( DF_page_id(), "_".THEME_NAME."_carousel_image", true ); 

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
<!-- ======== FEATURED CAROUSEL ======== -->
            <div class="featured_carousel owl-carousel light"<?php echo stripslashes($sytle);?>>
		        	<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		        		<?php  
		        			$imageL = get_post_thumb($the_query->post->ID,0,0);  

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
		                <!-- ======== ITEM ======== -->
		                <div class="item">
		                    <div class="article_list_big_1">
		                        <div class="thumb_wrapper">
		                            <div class="gradient_shadow"></div>
								    <a <?php if(df_option_compare('imagePopUp','imagePopUp',$the_query->post->ID)==true) { ?>href="<?php echo esc_url($imageL['src']);?>" class="magnificPopupImage"<?php } else { ?>href="<?php the_permalink();?>"<?php } ?> title="<?php the_title();?>">
								        <?php echo df_image_html($the_query->post->ID,750,450);?>
								    </a>
		                            <div class="meta_wrapper">
	                                	<?php if($ratingsAverage) { ?>
		                                    <div class="star-rating" title="<?php echo floatval($ratingsAverage[1]);?> <?php esc_html_e("of 5", THEME_NAME);?>">
		                                        <span style="width: <?php echo floatval($ratingsAverage[0]);?>%"><?php echo floatval($ratingsAverage[1]);?> <?php esc_html_e("of 5", THEME_NAME);?></span>
		                                    </div>
	                                    <?php } ?>
		                                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		                                <div class="content_meta">
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
					                        <?php if(df_option_compare("postAuthor","postAuthor", $the_query->post->ID)==true) { ?>
					                            <span class="author">
					                            	<?php echo the_author_posts_link();?>
					                            </span>
					                        <?php } ?>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>

					<?php endwhile; else: ?>
						<p><?php  esc_html_e('No posts where found, please edit a post and set it as main slider post.', THEME_NAME); ?></p>
					<?php endif; ?>
            </div>
	<?php } ?>
<?php wp_reset_postdata();  ?>