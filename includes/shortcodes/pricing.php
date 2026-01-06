<?php
	add_shortcode('wraper', 'wraper_handler');
	add_shortcode('pricing', 'pricing_handler');
	
	function wraper_handler($atts, $content=null, $code="") {


		$return =  '<div class="full-pricelist do-load anim-flybottom">';
			$return.=	do_shortcode($content);
		$return.=  '</div>';


		return $return;
	}	
	function pricing_handler($atts, $content=null, $code="") {
		extract(shortcode_atts(array('featured' => null,'list' => null,'target' => null,'url' => null,'title' => null,'subtitle' => null,'price' => null,'period' => null,'btntext' => null,), $atts) );

		/* Target */
		if(!isset($target) || $target=="blank") {
			$target="_blank";
		} else {
			$target="_self";
		}	
		/* featured */
		if($featured=="yes") {
			$featured=" featured";
		} else {
			$featured=false;
		}	

		$list = explode(";", $list);

		$return = '<div class="pricing_box'.$featured.'">';
			$return.= '<div class="header">';
			if($title) {
				$return.= '<div class="title">'.$title.'</div>';		
			}
			if($subtitle) {
				$return.= '<div class="info">'.$subtitle.'</div>';		
			}
		$return.= '</div>';
		$return.= '<div class="body">';
			$return.= '<div class="price">'.$price.' <span>'.$period.'</span></div>';
				$return.= '<ul>';
					foreach ($list as $value) {
						$return.= '<li>'.stripslashes($value).'</li>';
					} 
				$return.= '</ul>';
			$return.= '</div>';
			if($btntext && $url) {
				$return.= '<div class="footer">';
					$return.= '<a href="'.esc_url($url).'" target="'.$target.'" class="btn">'.esc_html($btntext).'</a>';
				$return.= '</div>';
			}
		$return.= '</div>';

	return $return;
	}
	
?>