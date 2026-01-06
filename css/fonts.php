<?php
	function df_custom_fonts() { 

		//fonts
		$google_font_1 = df_get_option(THEME_NAME."_google_font_1");


		if(df_get_option(THEME_NAME."_scriptLoad") == "on") {
			echo "<style>";	
		} 
?>

/*------------------------------------------------------------------
    Body
-------------------------------------------------------------------*/
body {
    font-family: "<?php echo esc_html($google_font_1);?>", sans-serif;
}



<?php
		if(df_get_option(THEME_NAME."_scriptLoad") == "on") {
			echo "</style>";	
		} 
	}

	if(df_get_option(THEME_NAME."_scriptLoad") != "on") {
		df_custom_fonts();	
	} 

?>