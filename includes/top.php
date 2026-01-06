<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


	$page_layout = df_get_option(THEME_NAME."_page_layout");

	//logo settings
	$logo = df_get_option(THEME_NAME.'_logo');	
	// search
	$search = df_get_option(THEME_NAME.'_search');	
	//woocommerce cart
	$cart = df_get_option(THEME_NAME.'_cart');	


	//top banner	
	$topBanner = df_get_option(THEME_NAME."_top_banner");
	$topBannerCode = df_get_option(THEME_NAME."_top_banner_code");

	//fixed menu
	$stickyMenu = df_get_option(THEME_NAME."_stickyMenu");

	$weatherSet = df_get_option(THEME_NAME."_weather");

	$locationType = df_get_option(THEME_NAME."_weather_location_type");
	if($locationType == "custom") {
		$weather = DF_weather_forecast(str_replace(' ', '+', df_get_option(THEME_NAME."_weather_city")));
	} else {
		$weather = DF_weather_forecast($_SERVER['REMOTE_ADDR']);
	}

	//logo wrapper
	$subCount = df_get_option(THEME_NAME."_subcount");
	if(!$subCount) { $subCount = 6; }


	//header style 
	$headerStyle = df_get_option(THEME_NAME."_headerStyle");
	if(!$headerStyle) $headerStyle = 1;
?>
			
    <!-- ======== WRAPPER ======== -->
    <div id="wrapper" class="<?php echo esc_attr($page_layout=="boxed" ? " boxed" : 'wide'); ?>">

        <!-- ======== HEADER ======== -->
        <header id="header" class="style_<?php echo intval($headerStyle);?>"> 	

            <!-- ======== META ======== -->
            <div class="header_meta <?php esc_attr_e(df_get_option(THEME_NAME."_topMenu"));?>">
            	<div class="container">
                    <?php
						if ( function_exists( 'register_nav_menus' )) {
							$walker = new DF_Walker_Top;
							$args = array(
								//'container' => 'nav',
								//'container_class' => 'top-menu',
								'theme_location' => 'top-menu',
								'menu_class'      => 'menu',
								'items_wrap' => '<ul class="%2$s" rel="'.esc_html__("Top Menu", THEME_NAME).'">%3$s</ul>',
								'depth' => 3,
								'walker' => $walker,
								"echo" => false
							);

							if(has_nav_menu('top-menu')) {
					?>
						<!-- ======== BUTTON FOR MOBILE MENU ======== -->
                   		<a class="open_menu_mobile"><i class="fa fa-bars"></i></a>
						<!-- ======== NAVIGATION ======== -->
	                    <nav class="top_navigation">
	                        <?php echo wp_nav_menu($args); ?>
	                    </nav>
	                    <!-- End Top menu -->
					<?php
							}		

						}
					?>
					<?php
						if($search=="on") {
					?>	
	                    <div class="search_block">
	                        <form  method="get" action="<?php echo esc_url(home_url());?>" >
	                            <input type="search" placeholder="<?php esc_attr_e("Type and press enter...", THEME_NAME);?>" name="s" id="s">
	                            <i class="fa fa-search"></i>
	                        </form>
	                    </div>
		            <?php } ?>
                </div>
            </div>
            <!-- ======== BODY ======== -->
            <div class="header_body <?php esc_attr_e(df_get_option(THEME_NAME."_topHeader"));?>">
                <div class="container">
					<?php if($logo) { ?>
	                    <div class="logo_brand">
	                        <a href="<?php echo esc_url(home_url()); ?>">
	                        	<img src="<?php echo esc_url($logo);?>" alt="<?php bloginfo('name'); ?>" />
	                        </a>
	                    </div>
					<?php } else { ?>
						<div class="logo_brand">
	                        <h1><a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e(get_bloginfo('name'));?></a></h1>
					    	<?php if(get_bloginfo('description')) { ?>
					    		<h2><?php esc_html_e(bloginfo('description'));?></h2>
					    	<?php } ?>
	                    </div>
					<?php } ?>
					<?php if($topBanner=="on") { ?>
				        <!-- ======== BANNER ======== -->
				        <div class="banner">
				            <?php echo stripslashes($topBannerCode);?>
				        </div>
			        <?php } ?>
                </div>
            </div>

			<!-- ======== MENU ======== -->
            <div class="<?php if($stickyMenu=="on") { ?>sticky_menu <?php } ?>header_menu <?php esc_attr_e(df_get_option(THEME_NAME."_mainMenu"));?>">
                <div class="container">
                    <!-- ======== BUTTON FOR MOBILE MENU ======== -->
                    <a class="open_menu_mobile"><i class="fa fa-bars"></i></a>
                    <!-- ======== MENU ======== -->
                    <nav class="site_navigation">
                    	<?php
							if ( function_exists( 'register_nav_menus' )) {
								$walker = new DF_Walker;
								$args = array(
									'container' => '',
									'theme_location' => 'main-menu',
									'menu_class'      => 'menu',
									'items_wrap' => '<ul class="%2$s" rel="'.esc_html__("Main Menu", THEME_NAME).'">%3$s</ul>',
									'depth' => 3,
									"echo" => false,
									'walker' => $walker
								);
											
											
								if(has_nav_menu('main-menu')) {
									echo wp_nav_menu($args);		
								} else {
									echo "<ul class=\"menu\"><li class=\"navi-none\"><a href=\"".esc_url(admin_url("nav-menus.php")) ."\">Please set up ".THEME_FULL_NAME." menu!</a></li></ul>";
								}		

							}

                    	?>
                    </nav>
                </div>
                <div class="header_border"></div>
            </div>
        </header>
        <!-- End Header -->

<?php wp_reset_postdata(); ?>
