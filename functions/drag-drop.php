<?php
global $differentThemes_fields;
$differentThemes_general_options= array(



/* ------------------------------------------------------------------------*
 * HOME SETTINGS
 * ------------------------------------------------------------------------*/   

array(
	"type" => "homepage_blocks",
	"title" => esc_html__("Homepage Blocks:", THEME_NAME),
	"id" => $differentThemes_fields->themeslug."_homepage_blocks",
	"blocks" => array(
		array(
			"title" => esc_html__("Latest,Popular or Category News", THEME_NAME),
			"type" => "homepage_news_block",
			"image" => "icon-article.png",
			"description" => esc_html__("Latest news, category news or popular news post listing, with several layouts",THEME_NAME),
			"options" => array(
				array(
					"type" => "select",
					"title" => esc_html__("Block Style:", THEME_NAME),
					"id" => $differentThemes_fields->themeslug."_style",
					"options"=>array(
						array("slug"=>"1", "name"=>esc_html__("With Category Tabs", THEME_NAME)), 
						array("slug"=>"2", "name"=>esc_html__("With Category Tabs (only with tiles and date)", THEME_NAME)), 
						array("slug"=>"3", "name"=>esc_html__("Post List With Images on Right", THEME_NAME)), 
						array("slug"=>"4", "name"=>esc_html__("Timeline", THEME_NAME)), 
						array("slug"=>"5", "name"=>esc_html__("Grid View (2 posts in row)", THEME_NAME)), 
						array("slug"=>"6", "name"=>esc_html__("Post List With First Large Image and Other Small", THEME_NAME)), 
						array("slug"=>"7", "name"=>esc_html__("Post List With Large Images", THEME_NAME)), 
						array("slug"=>"8", "name"=>esc_html__("Post List With Small Images on Left", THEME_NAME)), 
					),
					"home" => "yes"
				),	
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_title", "title" => esc_html__("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $differentThemes_fields->themeslug."_count", "title" => esc_html__("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "select",
					"title" => esc_html__("Block Type:", THEME_NAME),
					"id" => $differentThemes_fields->themeslug."_type",
					"options"=>array(
						array("slug"=>"1", "name"=>esc_html__("Latest News", THEME_NAME)), 
						array("slug"=>"2", "name"=>esc_html__("Popular News", THEME_NAME)), 
					),
					"home" => "yes"
				),
				array(
					"type" => "multiple_select",
					"id" => $differentThemes_fields->themeslug."_cat",
					"taxonomy" => "category",
					"title" => esc_html__("Filter by Categories", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_offset", "title" => esc_html__("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),


			),
		),

		array(
			"title" => esc_html__("Shop", THEME_NAME),
			"type" => "homepage_news_block_2",
			"image" => "icon-shop.png",
			"description" => esc_html__("Shop Items",THEME_NAME),
			"options" => array(
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_title", "title" => esc_html__("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $differentThemes_fields->themeslug."_count", "title" => esc_html__("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $differentThemes_fields->themeslug."_cat",
					"taxonomy" => "product_cat",
					"title" => esc_html__("Set Category", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_offset", "title" => esc_html__("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array(
					"type" => "select",
					"title" => esc_html__("Type:", THEME_NAME),
					"id" => $differentThemes_fields->themeslug."_type",
					"options"=>array(
						array("slug"=>"1", "name"=>esc_html__("Latest", THEME_NAME)), 
						array("slug"=>"2", "name"=>esc_html__("Featured", THEME_NAME)), 
					),
					"home" => "yes"
				),	
				
			),
		),
		array(
			"title" => esc_html__("Videos", THEME_NAME),
			"type" => "homepage_news_block_4",
			"image" => "icon-video.png",
			"description" => esc_html__("Latest/Top Videos.",THEME_NAME),
			"options" => array(
				array(
					"type" => "select",
					"title" => esc_html__("Block Style:", THEME_NAME),
					"id" => $differentThemes_fields->themeslug."_style",
					"options"=>array(
						array("slug"=>"1", "name"=>esc_html__("Default", THEME_NAME)), 
						array("slug"=>"2", "name"=>esc_html__("Video List (light)", THEME_NAME)), 
						array("slug"=>"3", "name"=>esc_html__("Video List (dark)", THEME_NAME)), 
					),
					"home" => "yes"
				),	
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_title", "title" => esc_html__("Title:", THEME_NAME), "home" => "yes" ),
				//array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_count", "title" => esc_html__("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "multiple_select",
					"id" => $differentThemes_fields->themeslug."_cat",
					"taxonomy" => "category",
					"title" => esc_html__("Filter by Categories", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_offset", "title" => esc_html__("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array(
					"type" => "select",
					"title" => esc_html__("Type:", THEME_NAME),
					"id" => $differentThemes_fields->themeslug."_type",
					"options"=>array(
						array("slug"=>"latest", "name"=>esc_html__("Latest Videos", THEME_NAME)), 
						array("slug"=>"top", "name"=>esc_html__("Top Videos", THEME_NAME)), 
					),
					"home" => "yes"
				),
			),
		),
		array(
			"title" => esc_html__("Reviews", THEME_NAME),
			"type" => "homepage_news_block_3",
			"image" => "icon-review.png",
			"description" => esc_html__("Latest/Top reviews.",THEME_NAME),
			"options" => array(

				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_title", "title" => esc_html__("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $differentThemes_fields->themeslug."_count", "title" => esc_html__("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "multiple_select",
					"id" => $differentThemes_fields->themeslug."_cat",
					"taxonomy" => "category",
					"title" => esc_html__("Filter by Categories", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_offset", "title" => esc_html__("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array(
					"type" => "select",
					"title" => esc_html__("Type:", THEME_NAME),
					"id" => $differentThemes_fields->themeslug."_type",
					"options"=>array(
						array("slug"=>"latest", "name"=>esc_html__("Latest Reviews", THEME_NAME)), 
						array("slug"=>"top", "name"=>esc_html__("Top Reviews", THEME_NAME)), 
					),
					"home" => "yes"
				),				

			),
		),
		array(
			"title" => esc_html__("Text Block",THEME_NAME),
			"type" => "text_block",
			"image" => "icon-text.png",
			"description" => esc_html__("Custom Text Block/Shortcodes Block",THEME_NAME),
			"options" => array(
				array( "type" => "textarea", "id" => $differentThemes_fields->themeslug."_text", "title" => esc_html__("Text:",THEME_NAME), "editor" => "yes", "home" => "yes" ),
			),
		),
		array(
			"title" => esc_html__("HTML Code",THEME_NAME),
			"type" => "homepage_html",
			"image" => "icon-html.png",
			"description" => esc_html__("Custom HTML/Shortcodes Block",THEME_NAME),
			"options" => array(
				array( "type" => "textarea", "id" => $differentThemes_fields->themeslug."_html", "title" => esc_html__("Code/Text:",THEME_NAME), "home" => "yes" ),
			),
		),
		array(
			"title" => esc_html__("Banner Block",THEME_NAME),
			"type" => "homepage_banner",
			"image" => "icon-banner.png",
			"description" => esc_html__("Supports HTML,CSS, Javascript and Shortcodes.",THEME_NAME),
			"options" => array(
				array( "type" => "textarea", "id" => $differentThemes_fields->themeslug."_banner", "title" => esc_html__("Code/Text:",THEME_NAME), "home" => "yes","sample" => '<a href="http://themeforest.net/user/different-themes/portfolio?ref=different-themes" target="_blank"><img src="'.esc_url(THEME_IMAGE_URL.'728x90.jpg').'" alt="Banner"></a>', ),
			),
		),

	)
),


 
 );


$differentThemes_fields->add_options($differentThemes_general_options);
?>