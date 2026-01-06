<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_header();
	wp_reset_postdata();

	if (df_is_template_active("template-contact.php")) {
		$contactPages = df_get_page("contact");
		if($contactPages[0]) {
			$contactUrl = get_page_link($contactPages[0]);
		}
	} else {
		$contactUrl = false;
	}


    $args=array(
        'posts_per_page' => 9,
        'order' => 'DESC',
        'cat' => $cat,
        'orderby'   => 'meta_value_num',
        'meta_key'  => "_".THEME_NAME.'_post_views_count',
        'post_type'=> 'post',
        'ignore_sticky_posts' => true
    );

    $the_query = new WP_Query($args);
    $counter = 1;
    $totalCount = $the_query->post_count;
?>
            <!-- ======== SECTION ======== -->
            <section id="page_wrapper">
                <div class="container">
                    <div class="row">
                        <!-- ======== MAIN CONTENT ======== -->
                        <div class="col col_12_of_12 main_content">
                            <div id="page_title">
                                <h1><?php esc_html_e("Error 404",THEME_NAME);?></h1>
                            </div>
                            <?php df_breadcrumbs();?>
                            <!-- ======== SINGLE ARTICLE ======== -->
                            <article class="single_post">
                                <div class="post_content">
                                    <div class="page_404">
                                        <div class="title_404"><?php esc_html_e("404",THEME_NAME);?></div>
                                        <h4><?php esc_html_e("Something went terribly wrong...",THEME_NAME);?></h4>
                                        <p><?php esc_html_e("But don't worry, it can happen to the best of us - and it just happen to you!",THEME_NAME);?><br>
                                        <?php esc_html_e("You can search something else or read this text one more time.",THEME_NAME);?></p>
                                        <form method="get" action="<?php echo esc_url(home_url());?>">
                                            <input type="text" placeholder="<?php esc_attr_e("Type and press enter...", THEME_NAME);?>" name="s" id="s"/>
                                        </form>
                                    </div>
                                </div>
                            </article>
                            <!-- ======== SIMILAR ARTICLES ======== -->
                            <!-- ======== BLOCK TITLE ======== -->
                            <div class="block_title">
                                <h2><?php esc_html_e("Popular posts",THEME_NAME);?></h2>
                            </div>
                            <div class="row">
                                <div class="col col_4_of_12">
                                    <!-- ======== MEDIUM ARTICLE LIST ======== -->
                                    <div class="medium_article_list">
                                        <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                            <div class="item">
                                                <?php $image = get_post_thumb($the_query->post->ID,0,0);  ?>
                                                <?php if($image['show']!=false) { ?>
                                                    <div class="item_header">
                                                        <a href="<?php the_permalink();?>">
                                                            <?php echo df_image_html($the_query->post->ID,100,100);?>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                                <div class="item_wrapper">
                                                    <div class="item_content">
                                                        <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                                                    </div>

                                                    <div class="content_meta">
                                                        <?php if(df_option_compare("postDate","postDate", $the_query->post->ID)==true) {  ?>
                                                            <span class="date"><?php the_time(get_option('date_format'));?></span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php if($counter%3==0 && $counter!=$totalCount) { ?>
                                    </div>
                                </div>
                                <div class="col col_4_of_12">
                                    <!-- ======== MEDIUM ARTICLE LIST ======== -->
                                    <div class="medium_article_list">
                                        <?php } ?>


                                        <?php $counter++; ?>
                                        <?php endwhile; else: ?>
                                            <p><?php  esc_html_e( 'No posts where found' , THEME_NAME);?></p>
                                        <?php endif; ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

<?php get_footer(); ?>