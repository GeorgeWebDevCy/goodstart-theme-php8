<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_postdata();

	//post tags
	$posttags = get_the_tags();
	$posttags = is_array($posttags) ? $posttags : array();
	$tagCount = count($posttags);

	$categories = get_the_category();
	$categories = is_array($categories) ? $categories : array();
	$catCount = count($categories);
?>
	<?php if (($posttags && df_option_compare('post_tag_single','post_tag',$post->ID)==true)) { ?>
        <!-- ======== SOURCE TAGS ======== -->
        <div class="source_tag">
        	<!--
            <div class="content">
                <span>Source</span><a href="#">Google</a>
            </div>
        -->
            <?php if ($posttags && df_option_compare('post_tag_single','post_tag',$post->ID)==true) { ?>
	            <div class="content">
	                <span><?php esc_html_e('Tags', THEME_NAME);?></span>
					<?php	
						$i = 1;
						foreach($posttags as $tag) {
							echo '<a href="'.esc_url(get_tag_link($tag->term_id)).'">'.$tag->name . '</a>';
							if($tagCount!=$i) { echo ", "; }
							$i++;
						}
					?>
	            </div>
            <?php } ?>
        </div>
	<?php } ?>
