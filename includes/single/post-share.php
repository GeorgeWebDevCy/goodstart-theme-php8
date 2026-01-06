<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    //social share icons
    $image = get_post_thumb($post->ID,0,0); 
    $title = htmlspecialchars($post->post_title);
    $subject = htmlspecialchars(get_bloginfo('name')).' : '.$title;
    $body = esc_html__("Check out this article: ", THEME_NAME).$title.' - '.esc_url(get_permalink($post->ID));
?>
<?php if(df_option_compare('share_buttons','share_buttons',$post->ID)) { ?>
    <!-- ======== SHARING ======== -->
    <div class="post_sharing">
        <a href="//www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink());?>" data-url="<?php echo esc_url(get_permalink());?>" class="facebook df-share">
            <div class="share_icon"><i class="fa fa-facebook"></i></div>
            <div class="share_text"><?php esc_html_e("Facebook", THEME_NAME);?></div>
        </a>
        <a data-hashtags="" data-url="<?php echo esc_url(get_permalink());?>" data-via="<?php echo esc_attr(df_get_option(THEME_NAME.'_twitter_name'));?>" data-text="<?php esc_attr_e(get_the_title());?>" href="#" class="twitter df-tweet">
            <div class="share_icon"><i class="fa fa-twitter"></i></div>
            <div class="share_text"><?php esc_html_e("Twitter", THEME_NAME);?></div>
        </a>
        <a href="//plus.google.com/share?url=<?php echo esc_url(get_permalink());?>" class="google df-pluss">
            <div class="share_icon"><i class="fa fa-google-plus"></i></div>
            <div class="share_text"><?php esc_html_e("Google+", THEME_NAME);?></div>
        </a>
        <a href="//pinterest.com/pin/create/button/?url=<?php echo esc_url(get_permalink());?>&media=<?php echo esc_url($image['src']); ?>&description=<?php esc_attr_e(get_the_title()); ?>" data-url="<?php echo esc_url(get_permalink());?>" class="pinterest df-pin">
            <div class="share_icon"><i class="fa fa-pinterest-p"></i></div>
            <div class="share_text"><?php esc_html_e("Pinterest", THEME_NAME);?></div>
        </a>
        <a href="//www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url(get_permalink());?>&title=<?php esc_attr_e(get_the_title());?>" data-url="<?php echo esc_url(get_permalink());?>" class="linkedin df-link">
            <div class="share_icon"><i class="fa fa-linkedin"></i></div>
            <div class="share_text"><?php esc_html_e("LinkedIn", THEME_NAME);?></div>
        </a>
        <a href="mailto:?subject=<?php echo esc_url($subject);?>&body=<?php echo esc_url($body);?>"  target="_blank" class="email">
            <div class="share_icon"><i class="fa fa-envelope"></i></div>
            <div class="share_text"><?php esc_html_e("Email", THEME_NAME);?></div>
        </a>
    </div>

<?php } ?>