<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


	if(df_option_compare('similar_posts','similar_posts',$post->ID)==true &&  !is_attachment() && get_post_type() == "post") {
	
		wp_reset_postdata();

		$categories = get_the_category($post->ID);
	    $catCount = count($categories);
	    //select a random category id
	    $id = rand(0,$catCount-1);
	    //cat id
	    $catId = $categories[$id]->term_id;
	    $count = df_get_option(THEME_NAME.'_similar_post_count');
	    if(!$count) $count = 3;

		if ($categories) {
			$category_ids = array();
			foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

			$args=array(
				'category__in' => $category_ids,
				'post__not_in' => array($post->ID),
				'showposts'=> 3,
				'ignore_sticky_posts'=>1,
				'orderby' => 'rand'
			);

			$my_query = new wp_query($args);
			$postCount = $my_query->post_count;
			$counter = 1;
?>
<!-- ======== RELATED ARTICLES ======== -->
<div class="related_articles">
    <div class="block_title">
        <h2><?php esc_html_e("Related articles", THEME_NAME);?></h2>
    </div>
    <div class="row">
		<?php
			wp_reset_postdata();
			if( $my_query->have_posts() ) {
				while ($my_query->have_posts()) {
					$my_query->the_post();

					//categories
					$categories = get_the_category($my_query->post->ID);
				    $catCount = count($categories);
				    //select a random category id
				    $id = rand(0,$catCount-1);
					$titleColor = df_title_color($categories[$id]->term_id, "category", false);


					$image = get_post_thumb($post->ID,0,0); 
		?>
		    <div class="item">
		        <div class="item_header">
		        	<?php if($image['show']==true) { ?>
			            <a href="<?php the_permalink();?>">
			                <?php echo df_image_html($my_query->post->ID,750,450);?>
			            </a>
		            <?php } ?>
		        </div>
		        <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
		        <div class="content_meta">
				<?php 
					if(count(get_the_category($my_query->post->ID))>=1 && df_option_compare("postCategory","postCategory", $my_query->post->ID)==true) {

				?>
		            <span class="category">
		            	<a href="<?php echo esc_url(get_category_link($categories[$id]->term_id));?>"><?php echo esc_html(get_cat_name($categories[$id]->term_id));?></a>
		            </span>
				<?php } ?>

		        </div>
		    </div>
            <?php if($counter%3==0 && $counter!=$my_query->post_count) { ?>
                </div>
                <div class="row">
            <?php } ?>
    	<?php $counter++; ?>
		<?php
				}
			} else { 
				esc_html_e('Sorry, no posts were found.' , THEME_NAME ); 
			}
		?>
	</div>
</div>

	<?php } ?>
<?php } ?>

<?php wp_reset_postdata();  ?>
