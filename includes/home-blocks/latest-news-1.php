<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $DF_builder = new DF_home_builder; 
    //get block data
    $data = $DF_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]); 
    $i = 1;
    $count = 1;
?>
    <!-- ======== BLOCK WITH TABS ======== -->
    <div class="block_with_tabs">
        <?php if(is_array($cat)) { ?>
            <!-- ======== BLOCK TITLE ======== -->
            <div class="block_title">
                <ul>
                    <?php foreach($cat as $catID) { ?>
                        <li><a href="#tab-x<?php echo intval($i);?>"><?php echo esc_html(get_cat_name($catID));?></a></li>
                    <?php $i++; ?>
                    <?php } ?>
                </ul>
            </div>
        <?php } elseif($title) { ?>
            <div class="block_title">
                <h2><?php echo esc_html($title);?></h2>
                <?php if($link) { ?>
                    <a href="<?php echo esc_url($link);?>" class="view_all"><?php esc_html_e("View all", THEME_NAME);?> <i class="fa fa-folder-open"></i></a>
                <?php } ?>
            </div>
        <?php } ?>
        <?php $i = 1; ?>
        <?php if(is_array($cat)) { ?>
            <?php foreach($cat as $c) { ?>
                <?php $category = get_category($c); ?>
                <!-- ======== BLOCK TABS ======== -->
                <div id="tab-x<?php echo intval($i);?>">
                    <div class="row">
                        <?php
                            unset($args['category__in']);
                            $args['cat'] = $c;
                            $my_query = new WP_Query($args);
                        ?>
                        <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
                            <?php
                                $DF_builder->set_double($my_query->post->ID);
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

                                $width = 750;
                                $height = 450;
                                $imageL = get_post_thumb($my_query->post->ID,0,0); 
                                $audio = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_audio", true );
                                $slider = get_post_meta ( $my_query->post->ID, THEME_NAME."_gallery_images", true );  

                            ?>
                            <div class="col col_6_of_12">
                                <!-- ======== ARTICLE LIST BIG ======== -->
                                <div class="article_list_big<?php echo ($imageL['show']==false) ? " no-image" : false ;?>">
                                    <?php if($imageL['show']!=false || ($audio || $slider)) { ?>
                                        <div class="thumb_wrapper">
                                            <div class="gradient_shadow"></div>
                                            <?php get_template_part(THEME_LOOP."image"); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="content_wrapper">
                                        <?php if(df_option_compare("postDate","postDate", $my_query->post->ID)==true) {  ?>
                                            <div class="big_calendar_box">
                                                <div class="date"><?php the_time('d');?></div>
                                                <div class="month"><?php the_time('M');?></div>
                                            </div>
                                        <?php } ?>
                                        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                        <?php if($ratingsAverage) { ?>
                                            <div class="star-rating" title="<?php echo floatval($ratingsAverage[1]);?> <?php esc_html_e("out of 5", THEME_NAME);?>">
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
                                    <div class="footer_wrapper">
                                        <a href="<?php the_permalink();?>" class="btn"><?php esc_html_e("Read more", THEME_NAME);?></a>

                                    </div>
                                </div>
                            </div>
                        <?php if($count%2==0 && $count!=$my_query->post_count) { ?>
                        </div>
                        <!-- Row -->
                        <div class="row">
                        <?php } ?>
                        <?php $count++; ?>
                        <?php endwhile; endif; ?>
                    </div>
                </div>
                <?php $i++; ?>
            <?php } ?>
        <?php } else { ?>
            <div class="row">
                <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <?php
                        $DF_builder->set_double($my_query->post->ID);
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

                        $width = 750;
                        $height = 450;
                        $imageL = get_post_thumb($my_query->post->ID,0,0); 
                        $audio = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_audio", true );
                        $slider = get_post_meta ( $my_query->post->ID, THEME_NAME."_gallery_images", true );  
                    ?>
                    <div class="col col_6_of_12">
                        <!-- ======== ARTICLE LIST BIG ======== -->
                        <div class="article_list_big<?php echo ($imageL['show']==false) ? " no-image" : false ;?>">
                            <?php if($imageL['show']!=false || ($audio || $slider)) { ?>
                                <div class="thumb_wrapper">
                                    <div class="gradient_shadow"></div>
                                    <?php get_template_part(THEME_LOOP."image"); ?>
                                </div>
                            <?php } ?>
                            <div class="content_wrapper">
                                <?php if(df_option_compare("postDate","postDate", $my_query->post->ID)==true) {  ?>
                                    <div class="big_calendar_box">
                                        <div class="date"><?php the_time('d');?></div>
                                        <div class="month"><?php the_time('M');?></div>
                                    </div>
                                <?php } ?>
                                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                <?php if($ratingsAverage) { ?>
                                    <div class="star-rating" title="<?php echo floatval($ratingsAverage[1]);?> <?php esc_html_e("out of 5", THEME_NAME);?>">
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
                            <div class="footer_wrapper">
                                <a href="<?php the_permalink();?>" class="btn"><?php esc_html_e("Read more", THEME_NAME);?></a>

                            </div>
                        </div>
                    </div>
                <?php if($count%2==0 && $count!=$my_query->post_count) { ?>
                </div>
                <!-- Row -->
                <div class="row">
                <?php } ?>
                <?php $count++; ?>
                <?php endwhile; endif; ?>
            </div>
        <?php } ?>
    </div>