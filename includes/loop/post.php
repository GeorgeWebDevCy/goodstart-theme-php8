<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	//counter
	$count = 1;
	if(is_category()) {
		$blogStyle = df_get_custom_option( get_cat_id( single_cat_title("",false) ), 'blogStyle', false );
		$sidebar = df_get_custom_option( get_cat_id( single_cat_title("",false) ), 'sidebar_select', false );
	} elseif(is_tax()){
		$blogStyle = df_get_custom_option( get_queried_object()->term_id, 'blogStyle', false );
		$sidebar = df_get_custom_option( get_queried_object()->term_id, 'sidebar_select', false );
	} else {
		$blogStyle = get_post_meta ( DF_page_ID(), "_".THEME_NAME."_blogStyle", true ); 	
		$sidebar = get_post_meta( DF_page_ID(), "_".THEME_NAME.'_sidebar_select', true );
	}

	if(!$blogStyle) {
		$blogStyle = 1;
	}


	if (have_posts()) : while (have_posts()) : the_post();


		$image = get_post_thumb($post->ID,0,0);


		

		switch ($blogStyle) {
			case '1':
				if($sidebar=="off") {
					$layout = "col_4_of_12";
				} else {
					$layout = "col_6_of_12";
				}
				if($sidebar=="off") {
					$postsInRow = 3;	
				} else {
					$postsInRow = 2;
				}
				$class = "article_list_big";
				break;
			case '2':
				$layout = false;
				$class = "item";
				$postsInRow = false;
				break;
			case '3':
				$layout = false;
				$class = "item";
				$postsInRow = false;
				break;
			case '4':
				$layout = false;
				$class = "item_content";
				$postsInRow = false;
				break;
			default:
				$layout = false;
				$class = "item";
				if($sidebar=="off") {
					$postsInRow = 3;	
				} else {
					$postsInRow = 2;
				}
				break;
		}

		if($image['show']==false) {
			$class .= " no-image";
		}

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
		

		$audio = get_post_meta( $post->ID, "_".THEME_NAME."_audio", true );
		$slider = get_post_meta ( $post->ID,  THEME_NAME."_gallery_images", true ); 	
	    $ratingsAverage = df_avarage_rating( $post->ID); 
?>



	<?php if($blogStyle=="1") { ?>
        <div class="col <?php echo esc_attr($layout);?>">
            <!-- ======== ARTICLE ======== -->
            <div <?php post_class($class); ?> id="post-<?php the_ID(); ?>">
            	<?php if($image['show']!=false || ($audio || $slider)) { ?>
	                <div class="thumb_wrapper">
	                    <div class="gradient_shadow"></div>
	                    <?php get_template_part(THEME_LOOP."image"); ?>
	                </div>
	            <?php } ?>
                <div class="content_wrapper">
                	<?php if(df_option_compare("postDate","postDate", $post->ID)==true) {  ?>
	                    <div class="big_calendar_box">
	                        <div class="date"><?php the_time('d');?></div>
	                        <div class="month"><?php the_time('M');?></div>
	                    </div>
	                <?php } ?>
                    <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <?php if($ratingsAverage) { ?>
	                    <div class="star-rating" title="<?php esc_html_e("Rated", THEME_NAME);?> <?php echo floatval($ratingsAverage[1]);?> <?php esc_html_e("out of 5", THEME_NAME);?>">
	                        <span style="width: <?php echo floatval($ratingsAverage[0]);?>%"><?php echo floatval($ratingsAverage[1]);?> <?php esc_html_e("out of 5", THEME_NAME);?></span>
	                    </div>
                    <?php } ?>
					<?php  
						add_filter('excerpt_length', 'df_new_excerpt_length_20');
						the_excerpt();
						remove_filter('excerpt_length', 'df_new_excerpt_length_20');
					?>
                </div>
                <div class="content_meta">
					<?php 
						if(count(get_the_category($post->ID))>=1 && df_option_compare("postCategory","postCategory", $post->ID)==true) {
					?>
						<span class="category">
							<a href="<?php echo esc_url(get_category_link($categories[$id]->term_id));?>">
								<?php echo esc_html(get_cat_name($categories[$id]->term_id));?>
							</a>
						</span>
					<?php } ?>
					<?php if(df_option_compare("postComments","postComments", $post->ID)==true && comments_open()) { ?>
						<span class="comments"><a href="<?php the_permalink();?>#comment"><?php comments_number(esc_html__('0 Comments', THEME_NAME), esc_html__('1 Comment', THEME_NAME), esc_html__('% Comments', THEME_NAME)); ?></a></span>
					<?php } ?>
                </div>
                <div class="footer_wrapper">
                    <a href="<?php the_permalink();?>" class="btn"><?php esc_html_e("Read more", THEME_NAME);?></a>

                </div>
            </div>
        </div>

    <?php } elseif($blogStyle=="2" || $blogStyle=="3") { ?>
        <!-- ======== GALLERY POST ======== -->
        <div <?php post_class($class); ?> id="post-<?php the_ID(); ?>">
            <div class="item_header">
            	<?php if($image['show']!=false || ($audio || $slider)) { ?>
	                <div class="thumb_wrapper">
	                    <div class="gradient_shadow"></div>
	                    <?php get_template_part(THEME_LOOP."image"); ?>
	                </div>
	            <?php } ?>
            </div>
            <div class="item_wrapper">
                <div class="item_content">
                    <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
					<?php  
						add_filter('excerpt_length', 'df_new_excerpt_length_20');
						the_excerpt();
						remove_filter('excerpt_length', 'df_new_excerpt_length_20');
					?>
                </div>
                <div class="content_meta">
					<?php 
						if(count(get_the_category($post->ID))>=1 && df_option_compare("postCategory","postCategory", $post->ID)==true) {
					?>
						<span class="category">
							<a href="<?php echo esc_url(get_category_link($categories[$id]->term_id));?>">
								<?php echo esc_html(get_cat_name($categories[$id]->term_id));?>
							</a>
						</span>
					<?php } ?>
                	<?php if(df_option_compare("postDate","postDate", $post->ID)==true) {  ?>
	                    <span class="date"><?php the_time(get_option('date_format'));?></span>
	                <?php } ?>
					<?php if(df_option_compare("postComments","postComments", $post->ID)==true && comments_open()) { ?>
						<span class="comments"><a href="<?php the_permalink();?>#comment"><?php comments_number(esc_html__('0 Comments', THEME_NAME), esc_html__('1 Comment', THEME_NAME), esc_html__('% Comments', THEME_NAME)); ?></a></span>
					<?php } ?>
                    <?php if($blogStyle=="3" && df_option_compare("postAuthor","postAuthor", $post->ID)==true) { ?>
                        <span class="author">
                        	<?php echo the_author_posts_link();?>
                        </span>
                    <?php } ?>
                </div>
                <div class="footer_wrapper">
                    <a href="<?php the_permalink();?>" class="btn"><?php esc_html_e("Read more", THEME_NAME);?></a>

                </div>
            </div>
        </div>
    <?php } else if($blogStyle == "4" ) { ?>

            <?php 
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

                if(!isset($closed)) {
                	$closed = true;
                }
            ?>
            <?php if($closed==true) { ?>
                <!-- ======== POST ======== -->
                <div class="item">
                    <div class="item_date">
                        <div class="date"><?php the_time('d');?></div>
                        <div class="month"><?php the_time('M');?></div>
                    </div>
                <?php $closed = false; ?>
            <?php } ?>
                    <div <?php post_class($class); ?>>
                        <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                        <div class="content_meta">
                            <?php if(df_option_compare("postDate","postDate", $post->ID)==true) {  ?>
                                <span class="date"><a href="<?php the_permalink();?>"><?php the_time("H:i");?></a></span>
                            <?php } ?>
                            <?php 
                                if(count(get_the_category($post->ID))>=1 && df_option_compare("postCategory","postCategory", $post->ID)==true) {
                            ?>
                                <span class="category">
                                    <a href="<?php echo esc_url(get_category_link($categories[$id]->term_id));?>">
                                        <?php echo esc_html(get_cat_name($categories[$id]->term_id));?>
                                    </a>
                                </span>
                            <?php } ?>
                            <?php if(df_option_compare("postAuthor","postAuthor", $post->ID)==true) { ?>
                                <span class="author">
                                    <?php echo the_author_posts_link();?>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                    
            <?php if(($wp_query->post_count == $count) || (get_the_time("dmY") != get_the_time("dmY", $wp_query->posts[ $wp_query->current_post + 1 ]->ID))) { ?>   
                </div>
                <?php 
                	$closed = true; 
                ?>
            <?php } ?>
      
          

    <?php } ?>
<?php if($postsInRow != false && $count%$postsInRow==0 && $count!=$wp_query->post_count) { ?>
</div>
<!-- Row -->
<div class="row">
<?php } ?>
		<?php $count++; ?>
	<?php endwhile; else: ?>
		<?php get_template_part(THEME_LOOP."no-post"); ?>
	<?php endif; ?>