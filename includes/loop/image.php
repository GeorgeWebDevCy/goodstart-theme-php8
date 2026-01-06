<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	//blog style
	if(is_category()) {
		$blogStyle = df_get_custom_option( get_cat_id( single_cat_title("",false) ), 'blogStyle', false );
	} elseif(is_tax()){
		$blogStyle = df_get_custom_option( get_queried_object()->term_id, 'blogStyle', false );
	} else {
		$blogStyle = get_post_meta ( DF_page_ID(), "_".THEME_NAME."_blogStyle", true ); 	
	}
	if(!$blogStyle) {
		$blogStyle = 1;
	}

	if($blogStyle=="1") {
		$width = 750;
		$height = 450;
	} else if($blogStyle=="2") {
		$width = 750;
		$height = 450;
	} else if($blogStyle=="3") {
		$width = 750;
		$height = 450;
	}  else if($blogStyle=="4") {
		$width = 750;
		$height = 450;
	} else {
		$width = 750;
		$height = 450;
	}


	$image = get_post_thumb($post->ID,$width,$height); 
	$imageL = get_post_thumb($post->ID,0,0); 

	$audio = get_post_meta( $post->ID, "_".THEME_NAME."_audio", true );
	$slider = get_post_meta ( $post->ID, THEME_NAME."_gallery_images", true ); 	

	if(df_get_option(THEME_NAME."_show_first_thumb") == "on" && $image['show']==true && !$audio && !$slider) {
?>
	
    <a <?php if(df_option_compare('imagePopUp','imagePopUp',$post->ID)==true) { ?>href="<?php echo esc_url($imageL['src']);?>" class="magnificPopupImage"<?php } else { ?>href="<?php the_permalink();?>"<?php } ?> title="<?php the_title();?>">
        <?php echo df_image_html($post->ID,$width,$height);?>
    </a>
<?php } else if(df_get_option(THEME_NAME."_show_first_thumb") == "on" && !$audio && $slider) { ?>
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
        </div>
<?php } else if(df_get_option(THEME_NAME."_show_first_thumb") == "on" && $audio && !$slider) {
	echo balanceTags($audio, true);
 } ?>