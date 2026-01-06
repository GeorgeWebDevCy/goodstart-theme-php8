<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_postdata();

	if(is_category()) {
		$blogStyle = df_get_custom_option( get_cat_id( single_cat_title("",false) ), 'blogStyle', false );
	} elseif(is_tax()){
		$blogStyle = df_get_custom_option( get_queried_object()->term_id, 'blogStyle', false );
	} else {
		$blogStyle = get_post_meta ( DF_page_ID(), "_".THEME_NAME."_blogStyle", true ); 	
	}

	switch ($blogStyle) {
		case '1':
			$class = "row";
			break;
		case '2':
			$class = "article_list small";
			break;
		case '3':
			$class = "article_list standard";
			break;
		case '4':
			$class = "timeline_list";
			break;
		default:
			$class = "row";
			break;
	}
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<?php
		if(is_author()) {
			get_template_part(THEME_SINGLE."about-author");
		}
	?>
        <!-- Row -->
        <div class="<?php echo esc_attr($class);?>">
			<?php get_template_part(THEME_LOOP."post"); ?>
		</div>
	<?php customized_nav_btns($paged, $wp_query->max_num_pages); ?>
<?php get_template_part(THEME_LOOP."loop-end"); ?>
