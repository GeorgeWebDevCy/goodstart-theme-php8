<?php wp_reset_postdata(); ?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
		<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();

					the_content();
				} // end while
			} // end if
		?>
<?php get_template_part(THEME_LOOP."loop-end"); ?>
