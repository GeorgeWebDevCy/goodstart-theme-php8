<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_postdata();
    $post_type = get_post_type();

    //sidebars
    $sidebar = get_post_meta ( DF_page_ID(), "_".THEME_NAME."_sidebar_select", true ); 
    $sidebarPosition = get_post_meta ( DF_page_ID(), "_".THEME_NAME."_sidebar_position", true ); 

    if(is_category()) {
        $catID = get_cat_id( single_cat_title("",false) );
        //sidebars
        $sidebar = df_get_custom_option ( $catID, "sidebar_select", false ); 
        $sidebarPosition = df_get_custom_option ( $catID, "sidebar_position", false ); 
    } elseif(is_tax()){
        $sidebar = df_get_custom_option ( get_queried_object()->term_id, "sidebar_select", false );
        $sidebarPosition = df_get_custom_option ( get_queried_object()->term_id, "sidebar_position", false );
    }

    if(is_search()) {
        $sidebar = "default";
        $sidebarPosition = "right";
    }

    if ( $sidebar=='') {
        $sidebar='default';
    }   

    //default main sidebar position
    $defPosition = df_get_option(THEME_NAME."_sidebar_position");
    if (($sidebarPosition == '' && $defPosition != "custom") || ($sidebarPosition != '' && $defPosition != "custom")) {
        $sidebarPosition = $defPosition;
    } else if ((!$sidebarPosition && $defPosition == "custom") || ($sidebarPosition == '' && $defPosition == "custom")) {
        $sidebarPosition = "right";
    }

    $image = get_post_thumb($post->ID,2508,1194); 
    $parallax = get_post_meta( $post->ID, "_".THEME_NAME."_parallax", true );

    $headerType = get_post_meta ( DF_page_ID(), "_".THEME_NAME."_headerType", true ); 
?>
    <?php if($parallax=="yes" && $image['show']!=false && df_get_option(THEME_NAME."_show_first_thumb") == "on" && get_option('page_for_posts')!=DF_page_ID()) { ?>
        <!-- ======== PARALLAX CONTAINER ======== -->
        <div class="parallax_container">
            <div class="gradient_shadow"></div>
            <div class="parallax_element" data-velocity="-.15" style="background-image: url(<?php echo esc_url($image['src']);?>)"></div>
            <div class="parallax_header">
                <?php get_template_part(THEME_SINGLE."post-title"); ?>
                <div class="content_meta">
                    <?php if(df_option_compare('postDate','postDate',$post->ID)==true) { ?>
                        <span class="date"><?php the_time(get_option('date_format'));?></span>
                    <?php } ?>
                    <?php if(df_option_compare("postAuthor","postAuthor", $post->ID)==true) { ?>
                        <span class="author">
                            <?php echo the_author_posts_link();?>
                        </span>
                    <?php } ?>
                    <span class="category"><?php the_category(', '); ?></span>
                    <?php if(df_option_compare("postComments","postComments", $post->ID)==true && comments_open()) { ?>
                        <span class="comments"><?php comments_number(esc_html__('0 Comments', THEME_NAME), esc_html__('1 Comment', THEME_NAME), esc_html__('% Comments', THEME_NAME)); ?></span>
                    <?php } ?>
                    <?php if(df_option_compare("postViews","postViews", $post->ID)==true) { ?>
                        <span class="views"><?php echo DF_getPostViews($post->ID);?></span>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php 
        if($headerType && $headerType!="off" && is_page_template('template-homepage.php')) {
            get_template_part(THEME_SLIDERS.esc_html($headerType));
        }
    ?>

    <?php get_template_part(THEME_SLIDERS."breaking-news"); ?>
        <!-- ======== SECTION ======== -->
        <section id="page_wrapper">
            <div class="container">
                 <?php 
                    if(!is_page_template('template-homepage.php')) {
                ?>
                <div class="row">
                        <?php
                                if($sidebar!="off" && $sidebarPosition == "left") {
                                    get_template_part(THEME_INCLUDES."sidebar");
                                } 
                        ?>

                    <!-- ======== MAIN CONTENT ======== -->
                    <div class="col <?php if($sidebar!="off") { ?>col_8_of_12<?php } else { ?>col_12_of_12<?php } ?> main_content">
                <?php } ?>
                    <?php
                        if((is_page() || ( class_exists( 'Woocommerce' ) && is_woocommerce() )) && !is_page_template('template-homepage.php')) {
                            get_template_part(THEME_SINGLE."page-title");
                        }
                    ?>
                    <?php 
                        if(df_get_option(THEME_NAME."_breadcrumb")=="on" || (df_get_option(THEME_NAME."_breadcrumb")=="on" && df_page_id()==get_option('page_for_posts'))) {
                            wp_reset_postdata();
                            if( ( class_exists( 'Woocommerce' ) && is_woocommerce() ) || ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) ) {
                                woocommerce_breadcrumb(array(
                                    'wrap_before' => '<ul class="breadcrumb">',
                                    'wrap_after' => '</ul>',
                                    'before' => '<li>',
                                    'after' => '</li>',
                                    'delimiter' => ''
                                ));
                            } else if( class_exists( 'bbPress' ) && is_bbpress() ) {
                                remove_filter ('bbp_no_breadcrumb', 'bm_bbp_no_breadcrumb');
                                bbp_breadcrumb( array ( 'before' => '<ul class="breadcrumb">', 'after' => '</ul>', 'sep' => ' ', 'crumb_before' => '<li>', 'crumb_after' => '</li>', 'home_text' => __('Home', 'Avada')) );
                                add_filter ('bbp_no_breadcrumb', 'bm_bbp_no_breadcrumb');
                            } else if(!is_page_template('template-homepage.php'))  {
                                df_breadcrumbs();
                            }
                        }

                    ?>

					<?php wp_reset_postdata();  ?>