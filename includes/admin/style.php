<?php
global $different_themes_managment;
$differentThemes_slider_options= array(
 array(
	"type" => "navigation",
	"name" => esc_html__("Style Settings", THEME_NAME),
	"slug" => "custom-styling"
),

array(
	"type" => "tab",
	"slug"=>'custom-styling'
),

array(
	"type" => "sub_navigation",
	"subname"=>array(
		array("slug"=>"font_style", "name"=>esc_html__("Font Style", THEME_NAME)),
		array("slug"=>"page_colors", "name"=>esc_html__("Page Colors/Style", THEME_NAME)),
		array("slug"=>"page_layout", "name"=>esc_html__("Layout", THEME_NAME))
		)
),

/* ------------------------------------------------------------------------*
 * PAGE FONT SETTINGS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'font_style'
),

array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Fonts",THEME_NAME)
),

array(
	"type" => "google_font_select",
	"title" => esc_html__("Body Font:",THEME_NAME),
	"id" => $different_themes_managment->themeslug."_google_font_1",
	"sort" => "alpha",
	"info" => esc_html__("Font previews You Can find here: <a href='http://www.google.com/webfonts' target='_blank'>Google Fonts</a>",THEME_NAME),
	"default_font" => array('font' => "Titillium Web", 'txt' => "(default)")
),


array(
	"type" => "close"

),



array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Font Character Sets", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => esc_html__("Cyrillic Extended (cyrillic-ext):", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_font_cyrillic_ex"
),
array(
	"type" => "checkbox",
	"title" => esc_html__("Cyrillic (cyrillic):", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_font_cyrillic"
),
array(
	"type" => "checkbox",
	"title" => esc_html__("Greek Extended (greek-ext):", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_font_greek_ex"
),
array(
	"type" => "checkbox",
	"title" => esc_html__("Greek (greek):", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_font_greek"
),
array(
	"type" => "checkbox",
	"title" => esc_html__("Vietnamese (vietnamese):", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_font_vietnamese"
),
array(
	"type" => "checkbox",
	"title" => esc_html__("Latin Extended (latin-ext):", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_font_latin_ex"
),

array(
	"type" => "close",

),
array(
	"type" => "save",
	"title" => esc_html__("Save Changes",THEME_NAME)
),
   
array(
	"type" => "closesubtab"
),
/* ------------------------------------------------------------------------*
 * PAGE COLORS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'page_colors'
),
/*
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Default Category/News page Color", THEME_NAME)
),

array( 
	"type" => "color", 
	"id" => $different_themes_managment->themeslug."_default_cat_color", 
	"title" => esc_html__("Color:", THEME_NAME),
	"std" => "f85050",
),

array(
	"type" => "close"
),
*/
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Colors", THEME_NAME)
),

array( 
	"type" => "color", 
	"id" => $different_themes_managment->themeslug."_color_1", 
	"title" => esc_html__("Colors
    (links, logo first letter, post meta icon, video list title, title
    icon, block tabs active, blockquotes, service box first letter,
    controls single post):", THEME_NAME),
	"std" => "349dc9",
),
array( 
	"type" => "color", 
	"id" => $different_themes_managment->themeslug."_color_2", 
	"title" => esc_html__("Background colors
    (button, inputs[buttons],site navigation current, sub menu,
    calendar box, background color, video item label, review label
    mobile menu toggle, tags, calendar links, review posts widget,
    breaking news title, pricing box header, accordion background,
    review lines, shop product label onsale):", THEME_NAME),
	"std" => "349dc9",
),
array( 
	"type" => "color", 
	"id" => $different_themes_managment->themeslug."_color_3", 
	"title" => esc_html__("Border
    (header, block title, widget title, blockquotes):", THEME_NAME),
	"std" => "349dc9",
),

array(
	"type" => "close"
),
array(
	"type" => "row",

),
array(
	"type" => "title",
	"title" => esc_html__("Top Menu Background",THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_topMenu",
	"radio" => array(
		array("title" => esc_html__("Light:",THEME_NAME), "value" => "light"),
		array("title" => esc_html__("Dark:",THEME_NAME), "value" => "dark"),
	),
	"std" => "dark"
),

array(
	"type" => "title",
	"title" => esc_html__("Main Header Background",THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_topHeader",
	"radio" => array(
		array("title" => esc_html__("Light:",THEME_NAME), "value" => "light"),
		array("title" => esc_html__("Dark:",THEME_NAME), "value" => "dark"),
	),
	"std" => "light"
),
array(
	"type" => "title",
	"title" => esc_html__("Main Menu Background",THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_mainMenu",
	"radio" => array(
		array("title" => esc_html__("Light:",THEME_NAME), "value" => "light"),
		array("title" => esc_html__("Dark:",THEME_NAME), "value" => "dark"),
	),
	"std" => "dark"
),

array(
	"type" => "title",
	"title" => esc_html__("Breaking nNews Slider Background",THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_breakingSlider",
	"radio" => array(
		array("title" => esc_html__("Light:",THEME_NAME), "value" => "light"),
		array("title" => esc_html__("Dark:",THEME_NAME), "value" => "dark"),
	),
	"std" => "dark"
),


array(
	"type" => "close"
),

array(
	"type" => "row",

),
array(
	"type" => "title",
	"title" => esc_html__("Body Backgrounds (only boxed view)",THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_body_bg_type",
	"radio" => array(
		array("title" => esc_html__("Pattern:",THEME_NAME), "value" => "pattern"),
		array("title" => esc_html__("Custom Image:",THEME_NAME), "value" => "image"),
		array("title" => esc_html__("Color:",THEME_NAME), "value" => "color"),
	),
	"std" => "pattern"
),

array(
	"type" => "select",
	"title" => esc_html__("Patterns ",THEME_NAME),
	"id" => $different_themes_managment->themeslug."_body_pattern",
	"options"=>array(
		array("slug"=>"patt2", "name"=>esc_html__("Texture 1",THEME_NAME)), 
		array("slug"=>"patt3", "name"=>esc_html__("Texture 2",THEME_NAME)), 
		array("slug"=>"patt4", "name"=>esc_html__("Texture 3",THEME_NAME)), 
		array("slug"=>"patt5", "name"=>esc_html__("Texture 4",THEME_NAME)), 
		array("slug"=>"patt6", "name"=>esc_html__("Texture 5",THEME_NAME)), 
		array("slug"=>"patt7", "name"=>esc_html__("Texture 6",THEME_NAME)), 
		array("slug"=>"patt8", "name"=>esc_html__("Texture 7",THEME_NAME)), 
		array("slug"=>"patt9", "name"=>esc_html__("Texture 8",THEME_NAME)), 
		array("slug"=>"patt10", "name"=>esc_html__("Texture 9",THEME_NAME)), 
	),
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_body_bg_type", "value" => "pattern")
	)
),

array(
	"type" => "color",
	"title" => esc_html__("Body Background Color:",THEME_NAME),
	"id" => $different_themes_managment->themeslug."_body_color",
	"std" => "f1f1f1",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_body_bg_type", "value" => "color")
	)
),

array(
	"type" => "upload",
	"title" => esc_html__("Body Background Image:",THEME_NAME),
	"id" => $different_themes_managment->themeslug."_body_image",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_body_bg_type", "value" => "image")
	)
),

array(
	"type" => "input",
	"title" => esc_html__("Background Image Url:",THEME_NAME),
	"id" => $different_themes_managment->themeslug."_body_image_url",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_body_bg_type", "value" => "image")
	)
),
array(
	"type" => "title",
	"title" => esc_html__("Image Repeat",THEME_NAME),
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_body_bg_type", "value" => "image")
	)
),
array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_body_image_repeat",
	"radio" => array(
		array("title" => esc_html__("Repeat X:",THEME_NAME), "value" => "repeat-x"),
		array("title" => esc_html__("Repeat Y:",THEME_NAME), "value" => "repeat-y"),
		array("title" => esc_html__("Repeat X and Y:",THEME_NAME), "value" => "repeat"),
		array("title" => esc_html__("Off:",THEME_NAME), "value" => "no-repeat"),
	),
	"std" => "no-repeat",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_body_bg_type", "value" => "image")
	)
),
array(
	"type" => "close",

),

array(
	"type" => "save",
	"title" => esc_html__("Save Changes", THEME_NAME),
),
   
array(
	"type" => "closesubtab"
),
/* ------------------------------------------------------------------------*
 * PAGE LAYOUT
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'page_layout'
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Menu", THEME_NAME),
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_stickyMenu",
	"radio" => array(
		array("title" => esc_html__("Sticky:", THEME_NAME), "value" => "on"),
		array("title" => esc_html__("Fixed:", THEME_NAME), "value" => "off"),
	),
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Header Style", THEME_NAME),
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_headerStyle",
	"radio" => array(
		array("title" => esc_html__("Default:", THEME_NAME), "value" => "1"),
		array("title" => esc_html__("Centered:", THEME_NAME), "value" => "2"),
	),
),

array(
	"type" => "close"
),
/*
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Enable Responsive", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => esc_html__("Enable", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_responsive"
),

array(
	"type" => "close"
),
*/

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Page Layout", THEME_NAME),
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_page_layout",
	"radio" => array(
		array("title" => esc_html__("Boxed:", THEME_NAME), "value" => "boxed"),
		array("title" => esc_html__("Wide:", THEME_NAME), "value" => "wide"),
	),
),

array(
	"type" => "close"
),


array(
	"type" => "save",
	"title" => esc_html__("Save Changes", THEME_NAME)
),
   
array(
	"type" => "closesubtab"
),

array(
	"type" => "closetab"
)
 
);

$different_themes_managment->add_options($differentThemes_slider_options);
?>