<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    wp_reset_postdata();

    //previous/next post data
    $next_post = get_next_post();
    $prev_post = get_previous_post();
?>        
<?php if(df_option_compare('postControls','postControls',$post->ID)==true) { ?>
    <!-- ======== CONTROLS ======== -->
    <div class="post_controls">
        <?php if(isset($prev_post->post_title)) { ?>
            <div class="prev_post">
                <span><?php esc_html_e("Previous post" , THEME_NAME);?></span>
                <a href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>"><?php echo esc_html($prev_post->post_title); ?></a>
            </div>
        <?php } ?>
        <div class="post_separator"></div>
        <?php if(isset($next_post->post_title)) { ?>
            <div class="next_post">
                <span><?php esc_html_e("Next post" , THEME_NAME);?></span>
                <a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>"><?php echo esc_html($next_post->post_title); ?></a>
            </div>
        <?php } ?>
    </div>
<?php } ?>