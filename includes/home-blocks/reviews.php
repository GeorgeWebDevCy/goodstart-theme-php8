<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $DF_builder = new DF_home_builder; 
    //get block data
    $data = $DF_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]); 
    $counter = 1;

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
    <!-- ======== REVIEW LIST ======== -->
    <div class="review_list three">
        <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
            <?php
                $ratings = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_ratings", true );
                $categories = wp_get_post_categories($my_query->post->ID); 
                $ratingsAverage = df_avarage_rating( $my_query->post->ID); 
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
            ?>
                <div class="item">
                    
                    <?php if($image['show']!=false) { ?>
                        <div class="label"><?php echo floatval($ratingsAverage[1]);?> <?php esc_html_e("of 5", THEME_NAME);?></div>
                        <div class="item_header">
                            <a href="<?php the_permalink();?>">
                                <?php echo df_image_html($my_query->post->ID,750,450);?>
                            </a>
                        </div>
                    <?php } ?>
                    <div class="item_wrapper">
                        <div class="item_content">
                            <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                        </div>
                    </div>
                    <div class="item_reviews">
                        <?php 
                            if($ratings) {
                                $totalRate = array();
                                $rating = explode(";", $ratings);
                                foreach($rating as $rate) { 
                                    $ratingValues = explode(":", $rate);
                                    if(isset($ratingValues[1])) {
                                        $ratingPrecentage = (str_replace(",",".",$ratingValues[1]))*20;
                                    }
                                    $totalRate[] = $ratingPrecentage;
                                    if($ratingValues[0]) {

                        ?>
                            <div class="rate_type">
                                <strong><?php echo esc_html($ratingValues[0]);?></strong>
                                <div class="star-rating" title="<?php echo esc_html($ratingValues[1]);?> <?php esc_html_e("out of 5", THEME_NAME);?>">
                                    <span style="width: <?php echo floatval($ratingPrecentage);?>%"><?php echo esc_html($ratingValues[1]);?> <?php esc_html_e("out of 5", THEME_NAME);?></span>
                                </div>
                            </div>
                        <?php 
                                    } 
                                }
                            }
                        ?>
                    </div>
                </div>
                <?php if($counter%3==0 && $counter!=$my_query->post_count) { ?>
                    </div>
                    <div class="review_list three">
                <?php } ?>
        <?php $counter++; ?>
            <?php endwhile; endif; ?>
    </div>
