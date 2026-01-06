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
    $counter = 1;
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
                        <div class="col col_6_of_12">
                            <!-- ======== ARTICLE LIST BIG ======== -->
                            <div class="text_article_list">
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

                            ?>

                                    <div class="item<?php echo ($imageL['show']==false) ? " no-image" : false ;?>">
                                        <div class="item_wrapper">
                                            <div class="item_content">
                                                <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                                            </div>
                                            <?php if(df_option_compare("postDate","postDate", $my_query->post->ID)==true) {  ?>
                                                <div class="content_meta">
                                                    <span class="date"><?php the_time(get_option('date_format'));?></span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                        <?php if($counter%($count/2)==0 && $counter!=$my_query->post_count) { ?>
                                </div>
                            </div>

                            <div class="col col_6_of_12">
                                <!-- ======== ARTICLE LIST BIG ======== -->
                                <div class="text_article_list">
                        <?php } ?>
                        <?php $counter++; ?>
                        <?php endwhile; endif; ?>
                            </div>
                        </div>
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

                    ?>
                    <div class="col col_6_of_12">
                        <!-- ======== ARTICLE LIST BIG ======== -->
                        <div class="text_article_list<?php echo ($imageL['show']==false) ? " no-image" : false ;?>">
                            <div class="item">
                                <div class="item_wrapper">
                                    <div class="item_content">
                                        <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                                    </div>
                                    <?php if(df_option_compare("postDate","postDate", $my_query->post->ID)==true) {  ?>
                                        <div class="content_meta">
                                            <span class="date"><?php the_time(get_option('date_format'));?></span>
                                        </div>
                                    <?php } ?>
                                </div>
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