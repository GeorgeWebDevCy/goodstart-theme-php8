<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $DF_builder = new DF_home_builder; 
    //get block data
    $data = $DF_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]); 
    $sidebar = get_post_meta( DF_page_ID(), "_".THEME_NAME.'_sidebar_select', true );
    $counter = 1;
    $closed = true;
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
    <!-- ======== TIMELINE LIST ======== -->
    <div class="timeline_list">
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
            ?>
            <?php if($closed==true) { ?>
                <!-- ======== POST ======== -->
                <div class="item">
                    <div class="item_date">
                        <div class="date"><?php the_time('d');?></div>
                        <div class="month"><?php the_time('M');?></div>
                    </div>
                <?php $closed = false; ?>
            <?php } ?>
                    <div class="item_content">
                        <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                        <div class="content_meta">
                            <?php if(df_option_compare("postDate","postDate", $my_query->post->ID)==true) {  ?>
                                <span class="date"><a href="<?php the_permalink();?>"><?php the_time("H:i");?></a></span>
                            <?php } ?>
                            <?php 
                                if(count(get_the_category($my_query->post->ID))>=1 && df_option_compare("postCategory","postCategory", $my_query->post->ID)==true) {
                            ?>
                                <span class="category">
                                    <a href="<?php echo esc_url(get_category_link($categories[$id]->term_id));?>">
                                        <?php echo esc_html(get_cat_name($categories[$id]->term_id));?>
                                    </a>
                                </span>
                            <?php } ?>
                            <?php if(df_option_compare("postAuthor","postAuthor", $my_query->post->ID)==true) { ?>
                                <span class="author">
                                    <?php echo the_author_posts_link();?>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                     
            <?php if(($my_query->post_count == $counter) || (get_the_time("dmY") != get_the_time("dmY", $my_query->posts[ $my_query->current_post + 1 ]->ID))) { ?> 
                </div>
                <?php $closed = true; ?>
            <?php } ?>

           

        <?php $counter++; ?>
        <?php endwhile; endif; ?>
    </div><!-- End Layout post 1 -->