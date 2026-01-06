<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_postdata();
	$post_type = get_post_type();
	if(is_category()) {
		//custom colors
		$catId = get_cat_id( single_cat_title("",false) );
		$titleColor = df_title_color($catId, "category", false);
	} else {
		//custom colors
		$titleColor = df_title_color(DF_page_id(),"page", false);
	}
?>					

<?php if (df_option_compare('show_single_title','show_single_title',$post->ID)==true) { ?>
    <!-- ======== PAGE TITLE ======== -->
    <div id="page_title">
        <h1><?php df_page_title(); ?></h1>
    </div>
<?php } ?>