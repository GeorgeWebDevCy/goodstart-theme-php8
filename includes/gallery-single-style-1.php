<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_header();
	wp_reset_postdata();

	global $query_string;
	$query_vars = explode('&',$query_string);
									
	foreach($query_vars as $key) {
		if(strpos($key,'page=') !== false) {
			$i = substr($key,8,12);
			break;
		}
	}
	
	if(!isset($i)) {
		$i = 1;
	}

	$galleryImages = get_post_meta ( $post->ID, "different_themes_gallery_gallery_images", true ); 
	$imageIDs = explode(",",$galleryImages);
	$count = DF_image_count($post->ID);

	//main image
	$file = wp_get_attachment_url($imageIDs[$i-1]);
	$image = get_post_thumb(false, 916, 0, false, $file);	

	$term_list = wp_get_post_terms($post->ID, DF_POST_GALLERY.'-cat');

	$catCount=0;
	foreach($term_list as $term){
		$catCount++;
	}
	
	$randID = rand(0,$catCount-1);	

	$galID = df_get_page("gallery-1");
	$title = get_the_title($galID[0]);
	$subTitle = get_post_meta( $galID[0], "_".THEME_NAME."_subtitle", true );
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
    <!-- ======== GALLERY SINGLE ======== -->
    <div class="gallery_single">
        <div class="item_slider">
    		<?php 
        		$c=1;
        		foreach($imageIDs as $id) { 
        			if($id) {
            			$file = wp_get_attachment_url($id);
            			$image = get_post_thumb(false, 1900, 0, false, $file);
            			$imageL = get_post_thumb(false, 0, 0, false, $file);
        	?>
	            <div>
	                <a href="<?php echo esc_url($imageL['src']);?>" class="magnificPopupImage" title="<?php echo esc_attr($title); ?>">
	                    <img src="<?php echo esc_url($image['src']);?>" alt="<?php echo esc_attr($title); ?>">
	                </a>
	            </div>
                <?php $c++; ?>
           	 	<?php } ?>
            <?php } ?>
        </div>
        <h3><?php the_title(); ?></h3>
		<?php 
			if (get_the_content() != "") { 				
				add_filter('the_content','df_remove_images');
				add_filter('the_content','df_remove_objects');
				the_content();
			} 
		?>	
	</div>
	<?php if(df_option_compare('similar_posts_gallery','similar_posts', $post->ID)==true) { ?>
    <!-- ======== GALLERY CATEGORY ======== -->
    <div class="block_title">
        <h2><?php esc_html_e("Similar photo gallery",THEME_NAME);?></h2>
    </div>


	<div class="row">
		<?php 
			$categories = get_the_terms($post->ID, DF_POST_GALLERY.'-cat');
			$categoriesNew = array();
			$i=0;
			if(!empty($categories)) {
				foreach ($categories as $category) {
					$categoriesNew[$i]['term_id'] = $category->term_id;
					$categoriesNew[$i]['name'] = $category->name;
					$i++;
				}
				$categories = $categoriesNew;
				if($i==1) {
					$randID = 0;
				} else {
					$randID = rand(0,$i-1);
				}
			} else {
				$randID = 0;
			}


			$counter=1;
			$my_query = new WP_Query( 
				array( 
					'post__not_in' => array($post->ID),
					'post_type' => DF_POST_GALLERY, 
					'showposts' => 4, 
					'tax_query' => array(
						array(
							'taxonomy' => DF_POST_GALLERY.'-cat',
							'field' => 'id',
							'terms' => $categories[$randID]['term_id'],
						)
					),
					'orderby' => 'rand'
				)
			);
			
			if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); 
				$term_list = wp_get_post_terms($my_query->post->ID, DF_POST_GALLERY.'-cat');
				$catCount=0;
				foreach($term_list as $term){
					$catCount++;
				}
				
				$randID = rand(0,$catCount-1);	

				$src = get_post_thumb($my_query->post->ID,353,234);
			?>
			<?php $gallery_style = get_post_meta ( $my_query->post->ID, "_".THEME_NAME."_gallery_style", true ); ?>
		        <!-- Album -->
		        <div class="col col_3_of_12">
		            <div class="article_list_big_1">
		                <div class="thumb_wrapper">
                            <div class="gradient_shadow"></div>
                            <a href="<?php the_permalink();?>"><img src="<?php echo esc_url($src["src"]); ?>" alt="<?php esc_attr(get_the_title());?>" /></a>
                            <div class="meta_wrapper">
                                <div class="content_meta">
                                    <span class="photo"><?php echo esc_html(DF_image_count($my_query->post->ID));?> <?php if(DF_image_count($my_query->post->ID)=="1") { esc_html_e("Photo" , THEME_NAME); } else { esc_html_e("Photos" , THEME_NAME); } ?></span>
                                </div>
                            </div>
		                </div>
                       <div class="content_wrapper">
                            <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			                <?php 
								add_filter('excerpt_length', 'df_new_excerpt_length_10');
								the_excerpt();
							?>
                        </div>
                        <div class="footer_wrapper">
                            <a href="<?php the_permalink();?>" class="btn"><?php esc_html_e("View all photos" , THEME_NAME);?></a>
                        </div>

		            </div>
		        </div><!-- End album -->
        

		<?php $counter++; ?>
		<?php endwhile; ?>
		<?php else : ?>
			<h2 class="title"><?php esc_html_e( 'No galleries were found' , THEME_NAME );?></h2>
		<?php endif; ?>
	</div>


	<?php } ?> 
<?php get_template_part(THEME_LOOP."loop-end"); ?>
<?php get_footer(); ?>