<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_postdata();
	
	$width = 1024;
	$height = 614;
	$image = get_post_thumb($post->ID,0,0); 
	$votes = get_post_meta( $post->ID, "_".THEME_NAME."_total_votes", true );
	$video = get_post_meta( $post->ID, "_".THEME_NAME."_video_code", true );
	$slider = get_post_meta( $post->ID, THEME_NAME."_gallery_images", true );
	$audio = get_post_meta( $post->ID, "_".THEME_NAME."_audio", true );
	$parallax = get_post_meta( $post->ID, "_".THEME_NAME."_parallax", true );
	if(!$votes) {
		$votes = 0;
	}
	if(isset($_COOKIE[THEME_NAME.'_rating_'.$post->ID])) {
		$voteCookie = $_COOKIE[THEME_NAME.'_rating_'.$post->ID];	
	} else {
		$voteCookie = null;
	}
	
	if((df_option_compare('show_single_thumb','show_single_thumb',$post->ID)==true) && !(function_exists('is_cart') && is_cart()) && !(function_exists('is_checkout') && is_checkout()) && !(function_exists("is_bbpress") && is_bbpress()) && !is_attachment() && $parallax!="yes") {
?>
    <!-- ======== ARTICLE FEATURED ======== -->
    <div class="post_featured">
	    <?php if(!$video && !$slider && !$audio) { ?>
	        <?php if(df_option_compare('imagePopUp','imagePopUp',$post->ID)==true) { ?> 
	        	<a href="<?php echo esc_url($image['src']);?>" class="magnificPopupImage" title="<?php esc_attr_e(get_the_title());?>">
	        <?php } ?>
	        	<?php echo df_image_html($post->ID,$width,$height); ?>
	        <?php if(df_option_compare('imagePopUp','imagePopUp',$post->ID)==true) { ?> 
	       		</a>
	        <?php } ?>
        <?php 
    		} elseif($video && !$slider && !$audio) { 
    			echo balanceTags($video);
        	} else if(!$video && $slider && !$audio) {
        ?>
            <!-- Content item_slider -->
            <div class="item_slider">
            	<?php
            		$imageIDs = explode(",",$slider);
            		foreach($imageIDs as $sliderImage) {
            			if($sliderImage) {
            				$file = wp_get_attachment_url($sliderImage);
            				$image = get_post_thumb(false, $width, $height, false, $file);
            				$imageL = get_post_thumb(false, 0, 0, false, $file);

            	?>
                    <div>
				        <?php if(df_option_compare('imagePopUp','imagePopUp',$post->ID)==true) { ?> 
				        	<a href="<?php echo esc_url($imageL['src']);?>"  class="magnificPopupImage" title="<?php the_title_attribute(); ?>">
				        <?php } ?>	
                            <img src="<?php echo esc_url($image['src']);?>" alt="<?php the_title_attribute(); ?>">
				        <?php if(df_option_compare('imagePopUp','imagePopUp',$post->ID)==true) { ?> 
				       		</a>
				        <?php } ?>
                    </div>

				        	

            	<?php
            			}
            		}


            	?>
            </div><!-- End Content slider -->
        <?php
        	} elseif(!$video && !$slider && $audio) {
        		echo balanceTags($audio);
        	}
        ?>
    </div>
    <!-- End Media -->
<?php } ?>
