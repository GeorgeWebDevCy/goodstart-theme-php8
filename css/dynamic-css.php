<?php
	if(df_get_option(THEME_NAME."_scriptLoad") != "on") {
		header('Content-type: text/css');	
	} 
	function df_custom_style() {
		//banner settings
		$banner_type = df_get_option ( THEME_NAME."_banner_type" );

		//bg type
		$bg_type = df_get_option ( THEME_NAME."_body_bg_type" );
		$bg_color = df_get_option ( THEME_NAME."_body_color" );
		$bg_image = df_get_option ( THEME_NAME."_body_image" );
		$bg_image_repeat = df_get_option ( THEME_NAME."_body_image_repeat" );
		$bg_texture = df_get_option ( THEME_NAME."_body_pattern" );
		if(!$bg_texture) $bg_texture = "texture-1";
		

		//colors
		$color_1 = df_get_option(THEME_NAME."_color_1");
		$color_2 = df_get_option(THEME_NAME."_color_2");
		$color_3 = df_get_option(THEME_NAME."_color_3");


		if(df_get_option(THEME_NAME."_scriptLoad") == "on") {
			echo "<style>";	
		} 

	
?>

/*------------------------------------------------------------------
    Colors
    (links, logo first letter, post meta icon, video list title, title
    icon, block tabs active, blockquotes, service box first letter,
    controls single post)
-------------------------------------------------------------------*/

a,
.logo_brand h1:first-letter,
.content_meta span:after,
.block_title a.view_all i,
blockquote.alt:before,
.service_box h4:first-letter,
.pricing_box .body ul li i,
footer.post_footer .post_controls .prev_post:hover span,
footer.post_footer .post_controls .next_post:hover span,
.pullquotes {
    color: #<?php echo esc_attr($color_1);?>
}




/*------------------------------------------------------------------
    Background colors
    (button, inputs[buttons],site navigation current, sub menu,
    calendar box, background color, video item label, review label
    mobile menu toggle, tags, calendar links, review posts widget,
    breaking news title, pricing box header, accordion background,
    review lines, shop product label onsale)
-------------------------------------------------------------------*/

button,
nav.site_navigation ul.menu > li:hover > a,
nav.site_navigation ul.menu > li.current-menu-item > a,
.big_calendar_box,
.video_list .item .transition_line,
.video_list_1 .item .transition_line,
.video_list .item .label,
.video_list_1 .item .label,
.review_list .item .label,
.header_menu .open_menu_mobile,
.header_meta .open_menu_mobile,
.tagcloud a,
.widget_calendar tbody a,
.header_border,
.widget_review_posts .item .item_header .rate_stars,
.breaking_news .breaking_title,
.pricing_box .header,
.accordion_group.colored .accordion_title,
.tab_group.colored .ui-tabs-nav li.ui-tabs-active,
.editor_review .review_group .review .review_footer span,
.editor_review .review_summary .item_header,
.price_slider_wrapper .ui-slider-range,
.onsale {
    background-color: #<?php echo esc_attr($color_2);?>
}


/*------------------------------------------------------------------
    Border
    (header, block title, widget title, blockquotes)
-------------------------------------------------------------------*/
.content_wrapper,
.block_title h2,
.widget .widget_title h4,
.block_title .ui-tabs-nav li.ui-tabs-active,
blockquote {
    border-color: #<?php echo esc_attr($color_3);?>
}

/*------------------------------------------------------------------
    Hover
-------------------------------------------------------------------*/

		/* Background Color/Texture/Image */
		body {
			<?php if($bg_type == "color") { ?>
				background: #<?php echo esc_html($bg_color);?>;
			<?php } else if ($bg_type == "pattern") { ?> 
				background: url(<?php echo esc_url(THEME_IMAGE_URL.$bg_texture.'.png');?>);
			<?php } else if ($bg_type == "image") { ?>
				background-image: url(<?php echo esc_url($bg_image);?>);
				<?php if(!$bg_image_repeat || $bg_image_repeat=="no-repeat") { ?>
					background-attachment: fixed;
					background-size: 100%; 
				<?php } elseif($bg_image_repeat) { ?>
					background-repeat: <?php echo esc_html($bg_image_repeat);?>;
				<?php } ?>
			<?php } else { ?>
				background: #<?php echo esc_html($bg_color);?>;
			<?php } ?>

		}

		<?php
			if ( $banner_type == "image" ) {
			//Image Banner
		?>
				#overlay { width:100%; height:100%; position:fixed;  _position:absolute; top:0; left:0; z-index:1001; background-color:#000000; overflow: hidden;  }
				#popup { display: none; position:absolute; width:auto; height:auto; z-index:1002; color: #000; font-family: Tahoma,sans-serif;font-size: 14px; }
				#baner_close { width: 22px; height: 25px; background: url(<?php echo esc_url(get_template_directory_uri().'/images/close.png');?>) 0 0 repeat; text-indent: -5000px; position: absolute; right: -10px; top: -10px; }
		<?php
			} else if ( $banner_type == "text" ) {
			//Text Banner
		?>
				#overlay { width:100%; height:100%; position:fixed;  _position:absolute; top:0; left:0; z-index:1001; background-color:#000000; overflow: hidden;  }
				#popup { display: none; position:absolute; width:auto; height:auto; max-width:700px; z-index:1002; border: 1px solid #000; background: #e5e5e5 url(<?php echo esc_url(get_template_directory_uri().'/images/dotted-bg-6.png');?>) 0 0 repeat; color: #000; font-family: Tahoma,sans-serif;font-size: 14px; line-height: 24px; border: 1px solid #cccccc; -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px; text-shadow: #fff 0 1px 0; }
				#popup center { display: block; padding: 20px 20px 20px 20px; }
				#baner_close { width: 22px; height: 25px; background: url(<?php echo esc_url(get_template_directory_uri().'/images/close.png');?>) 0 0 repeat; text-indent: -5000px; position: absolute; right: -12px; top: -12px; }
		<?php 
			} else if ( $banner_type == "text_image" ) {
			//Image And Text Banner
		?>
				#overlay { width:100%; height:100%; position:fixed;  _position:absolute; top:0; left:0; z-index:1001; background-color:#000000; overflow: hidden;  }
				#popup { display: none; position:absolute; width:auto; z-index:1002; color: #000; font-size: 11px; font-weight: bold; }
				#popup center { padding: 15px 0 0 0; }
				#baner_close { width: 22px; height: 25px; background: url(<?php echo esc_url(get_template_directory_uri().'/images/close.png');?>) 0 0 repeat; text-indent: -5000px; position: absolute; right: -10px; top: -10px; }
		<?php } ?>
	<?php
		if(df_get_option(THEME_NAME."_scriptLoad") == "on") {
			echo "</style>";	
		} 
	?>
<?php } ?>
<?php

	if(df_get_option(THEME_NAME."_scriptLoad") != "on") {
		df_custom_style();	
	} 

?>