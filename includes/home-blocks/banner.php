<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $DF_builder = new DF_home_builder; 
    //get block data
    $data = $DF_builder->get_data(); 
    //extract array data
    extract($data[0]); 

    $contactID = df_get_page('contact', false);
   
?>
<div class="content_banner">
	<div class="banner">
		<?php echo do_shortcode(df_html_output($code));?>
	</div>
</div>
