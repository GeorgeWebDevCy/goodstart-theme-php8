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
    <!-- ======== MEDIUM ARTICLE LIST ======== -->
    <div class="medium_article_list">
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
                <div class="item">
                    <?php if($image['show']!=false) { ?>
                        <div class="item_header">
                            <a href="<?php the_permalink();?>">
                                <?php echo df_image_html($my_query->post->ID,100,100);?>
                            </a>
                        </div>
                    <?php } ?>
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
        <?php endwhile; endif; ?>
    </div>