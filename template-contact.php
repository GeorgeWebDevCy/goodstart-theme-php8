<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Template Name: Contact Page
*/	
?>
<?php get_header(); ?>
<?php 
	wp_reset_postdata();
	$mail_to = get_post_meta ( $post->ID, "_".THEME_NAME."_contact_mail", true ); 
	$map = get_post_meta ( $post->ID,  "_".THEME_NAME."_map", true ); 

?>

<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<?php if($mail_to) { ?>
		<?php if (have_posts()) : ?>
	        <!-- ======== SINGLE ARTICLE ======== -->
	        <article class="single_post">
	            <?php if($map) { ?>
	                <div class="post_featured">
	                    <?php echo balanceTags($map, true); ?> 
	                </div>
	            <?php } ?>
				<div class="post_content">
					<?php the_content(); ?>

                    <div class="block_title">
                        <h2><?php esc_html_e("Φορμα Επικοινωνιας", THEME_NAME);?></h2>
                    </div>
				
					<div class="coloralert contact-success-block" style="display:none; background: #68a117;">
						<i class="fa fa-check"></i>
						<p><?php esc_html_e("Great Success:",THEME_NAME);?><br/><?php esc_html_e("Your meesage went through!",THEME_NAME);?></p>
						<a href="#close-alert" class="close-alert"><i class="fa fa-times-circle"></i></a>
					</div>

					<form id="writecomment" name="writecomment" class="contact-form contact_form" action="">

						<input type="hidden"  name="form_type" value="contact" />
						<input type="hidden"  name="post_id" value="<?php echo esc_attr($post->ID);?>" />
					

						<div class="form_group">
							<label for="c_name"><?php esc_html_e("Όνομα", THEME_NAME);?> <span class="required">*</span></label>
							<input type="text" name="u_name" id="contact-name-input" placeholder="<?php esc_attr_e("Όνομα", THEME_NAME);?>" title="<?php esc_attr_e("Nickname", THEME_NAME);?>" />
							<span class="error-msg comment-error" id="contact-name-error" style="display:none;"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<font class="df-error-text"></font></span>
						</div>
						<div class="form_group">
							<label for="c_name"><?php esc_html_e("E-mail", THEME_NAME);?> <span class="required">*</span></label>
							<input type="text" name="email" id="contact-mail-input" placeholder="<?php esc_attr_e("E-mail", THEME_NAME);?>" title="<?php esc_attr_e("E-mail", THEME_NAME);?>" />
							<span class="error-msg comment-error" id="contact-mail-error" style="display:none;"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<font class="df-error-text"></font></span>
						</div>
						<div class="form_group">
							<label for="c_website"><?php esc_html_e("Θέμα", THEME_NAME);?></label>
							<input type="text" placeholder="<?php esc_attr_e("Θέμα", THEME_NAME);?>" name="url" id="contact-url-input" title="<?php esc_attr_e("Website", THEME_NAME);?>" />
						</div>
						<div class="form_group">
							<label for="c_name"><?php esc_html_e("Το μήνυμα σας", THEME_NAME);?> <span class="required">*</span></label>
							<textarea name="message" placeholder="<?php esc_attr_e("Το μήνυμα σας", THEME_NAME);?>" id="contact-message-input"></textarea>
							<span class="error-msg comment-error" id="contact-message-error" style="display:none;"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<font class="df-error-text"></font></span>
						</div>
						<div class="form_group">
							<input name="submit" type="submit" class="btn" id="contact-submit" value="<?php esc_attr_e( 'Αποστολή' , THEME_NAME );?>" />
						</div>
					</form>
				</div>
			</article>
			<?php else: ?>
				<p><?php printf ( esc_html__('Sorry, no posts matched your criteria.' , THEME_NAME )); ?></p>
			<?php endif; ?>
	<?php } else { echo "<span style=\"color:#000; font-size:14pt;\">You need to set up Your contact mail!</span>"; } ?>
<?php get_template_part(THEME_LOOP."loop-end"); ?>
<?php get_footer(); ?>