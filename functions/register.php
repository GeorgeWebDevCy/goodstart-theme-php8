<?php

$homepage = get_option( 'show_on_front');
if( $homepage == "page" ) {
	$meta = get_post_custom_values("_wp_page_template",get_option( 'page_on_front'));
	if($homepage == "page" && $meta[0] == "template-homepage.php") {$has_homepage=true;} else {$has_homepage=false;}
}
	
	
function register_my_menus() {
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array( 
				'top-menu' => esc_html__( 'Top Menu', THEME_NAME ),
				'main-menu' => esc_html__( 'Main Menu', THEME_NAME ),
			)
		);
	}	
}


function different_register_sidebar($name, $id, $description){
	register_sidebar(array('name'=>$name,
		'id' => $id,
		'description' => $description,
		'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget_title"><h4>',
        'after_title' => '</h4></div>'
	));
}



/* -------------------------------------------------------------------------*
 * 							DEFAULT SIDEBARS								*
 * -------------------------------------------------------------------------*/
$stickySidebar = df_get_option ( THEME_NAME."_sticky_sidebar" );
$different_sidebars=array();
$different_sidebars[] = array('name'=>esc_html__('Default Sidebar', THEME_NAME), 'id'=>'default','description' => esc_html__('The default page sidebar.', THEME_NAME));
$different_sidebars[] = array('name'=>esc_html__('Footer Widgets', THEME_NAME), 'id'=>'df_footer', 'description' => esc_html__('Supports up to 3 widgets', THEME_NAME));	

if(function_exists('is_woocommerce')) {
	$different_sidebars[] = array('name'=>'Woocommerce', 'id'=>'df_woocommerce', 'description' => esc_html__('Woocommerce Page Sidebar', THEME_NAME));	
}
if(function_exists("is_bbpress")) {
	$different_sidebars[] = array('name'=>'bbPress', 'id'=>'df_bbpress', 'description' => esc_html__('bbPress Page Sidebar', THEME_NAME));
}
if(function_exists("is_buddypress")) {
	$different_sidebars[] = array('name'=>'BuddyPress', 'id'=>'df_buddypress', 'description' => esc_html__('BuddyPress Page Sidebar', THEME_NAME));	
}
if($stickySidebar=="on") {
	//$different_sidebars[] = array('name'=>'Sticky Sidebar', 'id'=>'sicky_sidebar', 'description' => esc_html__('Sticky sidebar under the main sidebar, that will stay fixed while you scroll down the page', THEME_NAME));	
}


$sidebar_strings = df_get_option(THEME_NAME.'_sidebar_names');
$generated_sidebars = explode("|*|", $sidebar_strings);
array_pop($generated_sidebars);
$different_generated_sidebars=array();
	
foreach($generated_sidebars as $sidebar) {
	$different_sidebars[]=array('name'=>$sidebar, 'id'=>convert_to_class($sidebar), 'description'=>$sidebar);
	$different_generated_sidebars[]=array('name'=>$sidebar, 'id'=>convert_to_class($sidebar), 'description'=>$sidebar);
}
 
 /* -------------------------------------------------------------------------*
 * 							REGISTER ALL SIDEBARS
 * -------------------------------------------------------------------------*/

if (function_exists('register_sidebar')) {
	
	//register the sidebars
	foreach($different_sidebars as $sidebar){
		different_register_sidebar($sidebar['name'], $sidebar['id'], $sidebar['description']);
	}
	
}

add_action('init', 'register_my_menus' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'custom-header' ) ;
add_theme_support( 'custom-background' ) ;

?>