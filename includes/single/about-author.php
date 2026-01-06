<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_postdata();
	
	// author id
	$user_ID = get_the_author_meta('ID');

	//social
	$twitter = get_user_meta($user_ID, 'twitter', true);
	$facebook = get_user_meta($user_ID, 'facebook', true);
	$google = get_user_meta($user_ID, 'google', true);
	$youtube = get_user_meta($user_ID, 'youtube', true);
	$dribbble = get_user_meta($user_ID, 'dribbble', true);


	$user_post_count = count_user_posts( $user_ID );

?>


<?php if(df_option_compare('aboutPostAuthor','aboutPostAuthor',$post->ID)==true) { ?>
    <!-- ======== AUTHOR BOX ======== -->
    <div class="author_box">
		<?php if(df_get_avatar_url(get_avatar( get_the_author_meta('user_email',$user_ID), 100))) { ?>
	    	<img src="<?php echo esc_url(df_get_avatar_url(get_avatar( get_the_author_meta('user_email',$user_ID), 100)));?>" class="avatar" alt="<?php echo esc_attr(get_the_author_meta('display_name',$user_ID)); ?>">
	    <?php } ?>
        
        <div class="info">
            <div class="author_name">
                <a href="<?php $user_info = get_userdata($user_ID); echo esc_url(get_author_posts_url($user_ID, $user_info->user_nicename )); ?>">
                	<?php echo esc_html(get_the_author_meta('display_name',$user_ID)); ?>
                </a>
            </div>
            <?php if(get_the_author_meta('url',$user_ID)) { ?>
	            <div class="author_url">
	                <a href="<?php echo esc_url(get_the_author_meta('url',$user_ID));?>" target="_blank"><?php echo esc_url(get_the_author_meta('url',$user_ID));?></a>
	            </div>
            <?php } ?>
            <div class="author_info">
                <p><span class='vcard author'><span class='fn'><?php echo esc_html(get_the_author_meta('description')); ?></span></span></p>
            </div>
            <div class="author_social">
	            <?php if($facebook) { ?><a href="<?php echo esc_url($facebook);?>"><i class="fa fa-facebook"></i></a><?php } ?>
	            <?php if($twitter) { ?><a href="<?php echo esc_url($twitter);?>"><i class="fa fa-twitter"></i></a><?php } ?>
	            <?php if($dribbble) { ?><a href="<?php echo esc_url($dribbble);?>"><i class="fa fa-dribbble"></i></a><?php } ?>
	            <?php if($youtube) { ?><a href="<?php echo esc_url($youtube);?>"><i class="fa fa-youtube"></i></a><?php } ?>
	            <?php if($google) { ?><a href="<?php echo esc_url($google);?>"><i class="fa fa-google-plus"></i></a><?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php wp_reset_postdata(); ?>


