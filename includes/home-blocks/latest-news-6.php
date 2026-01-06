<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $DF_builder = new DF_home_builder; 
    //get block data
    $data = $DF_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]); 
?>
    <?php if($title) { ?>
        <!-- ======== BLOCK TITLE ======== -->
        <div class="block_title">
            <h2> <?php echo esc_html($title);?></h2>
            <?php if($link) { ?>
                <a href="<?php echo esc_url($link);?>" class="view_all"><?php esc_html_e("View all", THEME_NAME);?> <i class="fa fa-folder-open"></i></a>
            <?php } ?>
        </div>
    <?php } ?>
    <?php if ($my_query->have_posts()) : $my_query->the_post(); ?>
        <?php 
            $DF_builder->set_double($my_query->post->ID);
            $image = get_post_thumb($my_query->post->ID,750,450);
            $imageL = get_post_thumb($my_query->post->ID,0,0);
            $ratingsAverage = df_avarage_rating( $my_query->post->ID);

            //categories
            $categories = get_the_category($my_query->post->ID);
            $catCount = count($categories);
            //select a random category id
            $id = rand(0,$catCount-1);
            if(isset($categories[$id]->term_id)) {
                $titleColor = df_title_color($categories[$id]->term_id, "category", false); 
            } else {
                $titleColor = df_get_option(THEME_NAME."_pageColorScheme");
            }
            $audio = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_audio", true );
            $slider = get_post_meta ( $my_query->post->ID, THEME_NAME."_gallery_images", true );  
        ?>
            <!-- ======== ARTICLE LIST BIG 1 ======== -->
            <div class="article_list_big_1">
                <div class="thumb_wrapper">
                    <?php if(df_option_compare("postDate","postDate", $my_query->post->ID)==true) {  ?>
                        <div class="big_calendar_box">
                            <div class="date"><?php the_time('d');?></div>
                            <div class="month"><?php the_time('M');?></div>
                        </div>
                    <?php } ?>
                    <div class="gradient_shadow"></div>
                    <?php get_template_part(THEME_LOOP."image"); ?>

                    <div class="meta_wrapper">
                        <?php if($ratingsAverage) { ?>
                            <div class="star-rating" title="<?php echo floatval($ratingsAverage[1]);?> <?php esc_html_e("out of 5", THEME_NAME);?>">
                                <span style="width: <?php echo floatval($ratingsAverage[0]);?>%"><?php echo floatval($ratingsAverage[1]);?> <?php esc_html_e("out of 5", THEME_NAME);?></span>
                            </div>
                        <?php } ?>
                        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                        <div class="content_meta">
                            <?php 
                                if(count(get_the_category($my_query->post->ID))>=1 && df_option_compare("postCategory","postCategory", $my_query->post->ID)==true) {
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
                    </div>
                </div>
                <div class="content_wrapper">
                    <?php 
                        add_filter('excerpt_length', 'df_new_excerpt_length_30');
                        the_excerpt();
                        remove_filter('excerpt_length', 'df_new_excerpt_length_30');
                    ?>
                </div>
            </div>
    <?php endif; ?>
    <!-- ======== SMALL ARTICLE LIST ======== -->
    <div class="small_article_list">
        <!-- Post -->
        <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
            <?php 
                $DF_builder->set_double($my_query->post->ID);
                $image = get_post_thumb($my_query->post->ID,0,0);

                //categories
                $categories = get_the_category($my_query->post->ID);
                $catCount = count($categories);
                //select a random category id
                $id = rand(0,$catCount-1);
                if(isset($categories[$id]->term_id)) {
                    $titleColor = df_title_color($categories[$id]->term_id, "category", false); 
                } else {
                    $titleColor = df_get_option(THEME_NAME."_pageColorScheme");
                }

                $audio = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_audio", true );
            ?>
                <div class="item">
                    <?php if($image['show']!=false) { ?>
                        <div class="item_header">
                            <a href="<?php the_permalink();?>">
                                <?php echo df_image_html($my_query->post->ID,80,60);?>
                            </a>
                        </div>
                    <?php } ?>
                    <div class="item_wrapper">
                        <div class="item_content">
                            <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                        </div>
                        <div class="content_meta">
                            <?php 
                                if(count(get_the_category($my_query->post->ID))>=1 && df_option_compare("postCategory","postCategory", $my_query->post->ID)==true) {
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
                    </div>
                </div>
        <?php endwhile; endif; ?>
        <?php if($link) { ?>
            <div class="item">
                <a href="<?php echo esc_url($link);?>" class="btn"><?php esc_html_e("Show all posts" , THEME_NAME);?></a>
            </div>
        <?php } ?>
    </div>
