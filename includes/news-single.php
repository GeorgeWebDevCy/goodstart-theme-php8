<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_postdata();

	$video = get_post_meta( $post->ID, "_".THEME_NAME."_video_code", true );
	$slider = get_post_meta( $post->ID, THEME_NAME."_gallery_images", true );
	$audio = get_post_meta( $post->ID, "_".THEME_NAME."_audio", true );
	$image = get_post_thumb($post->ID,0,0); 
	$votes = get_post_meta( $post->ID, "_".THEME_NAME."_total_votes", true );
	$parallax = get_post_meta( $post->ID, "_".THEME_NAME."_parallax", true );

?>

	<?php get_template_part(THEME_LOOP."loop-start"); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php $ratingsAverage = df_avarage_rating( $post->ID); ?>
            <!-- Post -->
            <article <?php post_class('single_post'); ?>>
            	<?php if($parallax!="yes") { ?>
	            	<header class="post_header">
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
	                    	<?php 
								if(count(get_the_category($post->ID))>=1 && df_option_compare("postCategory","postCategory", $post->ID)==true) {
							?>
	                        	<span class="category"><?php the_category(', '); ?></span>
	                        <?php } ?>
	                        <?php if(df_option_compare("postComments","postComments", $post->ID)==true && comments_open()) { ?>
	                       		<span class="comments"><?php comments_number(esc_html__('0 Comments', THEME_NAME), esc_html__('1 Comment', THEME_NAME), esc_html__('% Comments', THEME_NAME)); ?></span>
	                        <?php } ?>
	                        <?php if(df_option_compare("postViews","postViews", $post->ID)==true) { ?>
	                        	<span class="views"><?php echo DF_getPostViews($post->ID);?></span>
	                        <?php } ?>
	                    </div>
	                </header>
	            <?php } ?>
				<?php get_template_part(THEME_SINGLE."image");?>


				<div class="post_content">
					<?php wp_reset_postdata();?>		
					<?php
						add_filter('the_content', 'BigFirstChar');	
						the_content();
					?>	
					<?php 
						$args = array(
							'before'           => '<div class="post-pages"><p>' . esc_html__('Pages:', THEME_NAME),
							'after'            => '</p></div>',
							'link_before'      => '',
							'link_after'       => '',
							'next_or_number'   => 'number',
							'nextpagelink'     => esc_html__('Next page', THEME_NAME),
							'previouspagelink' => esc_html__('Previous page', THEME_NAME),
							'pagelink'         => '%',
							'echo'             => 1
						);

						wp_link_pages($args); 
					?>
				</div>
                <!-- ======== ARTICLE FOOTER ======== -->
                <footer class="post_footer">
					<?php get_template_part(THEME_SINGLE."post-tags-categories"); ?>	
					<?php get_template_part(THEME_SINGLE."post-share"); ?>	
					<?php get_template_part(THEME_SINGLE."post-nav"); ?>
					<?php get_template_part(THEME_SINGLE."post-ratings"); ?>
				</footer>
				<?php get_template_part(THEME_SINGLE."about-author"); ?>
				<?php get_template_part(THEME_SINGLE."post-related"); ?>
				
			</article>
			<?php endwhile; else: ?>
				<p><?php  esc_html_e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
			<?php if ( comments_open() ) : ?>
				<?php comments_template(); // Get comments.php template ?>
			<?php endif; ?>
	<?php get_template_part(THEME_LOOP."loop-end"); ?>