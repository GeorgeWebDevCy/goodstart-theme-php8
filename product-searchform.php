<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

		<form class="search_form" role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/'  ) ); ?>">

			<input class="search_field" type="text" value="<?php echo esc_attr(get_search_query()); ?>" name="s" id="s" placeholder="<?php esc_attr_e( 'Search for products', THEME_NAME ); ?>" />
			
			<input type="hidden" name="post_type" value="product" />
		</form>
