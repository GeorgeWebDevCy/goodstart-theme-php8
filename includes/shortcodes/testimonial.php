<?php
	add_shortcode('testimonial', 'testimonial_handler');
	
	function testimonial_handler($atts, $content=null, $code="") {
	
		extract(shortcode_atts(array('name' => null,'subtitle' => null,'url' => null,'type' => null,), $atts) );

		
		$image = get_post_thumb(false, 60, 60, false, $url);
		$blog_url = get_template_directory_uri();
			$return =  '		
				<div class="testimonial_default '.$type.'">
					'.wpautop($content).'
                    <footer>';
            if($url) {
				$return.=  '<img class="avatar" src="'.esc_url($image['src']).'" alt="'.$name.'">';        	
            }


            $return.=  '<div class="author">';
            	if($name) {
            		$return.=  '<div class="name">'.$name.'</div>';
            	}
            	if($subtitle) {
            		$return.=  '<div class="title">'.$subtitle.'</div>';
            	}
            $return.=  '</div>'; 
            $return.=  '</footer>';
        $return.=  '</div>'; 



		return $return;
	}
?>