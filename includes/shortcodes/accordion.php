<?php
	add_shortcode('accordion', 'accordion_handler');
	add_shortcode('acc', 'acc_handler');


	function accordion_handler($atts, $content=null, $code="") {
		extract(shortcode_atts(array('style' => null,), $atts) );
        $return =  '<div class="accordion_group '.$style.'">';
       	 	$return.=  do_shortcode($content);
        $return.=  '</div>';

		return $return;
	}

	function acc_handler($atts, $content=null, $code="") {
		extract(shortcode_atts(array('title' => null,), $atts) );


		$return='
			
				<div class="accordion_title">'.$title.'</div>
				<div class="accordion_panel">
					'.do_shortcode(wpautop($content)).'
				</div>
			
			';
		return $return;

	}
?>
