<?php
function df_breadcrumbs() {
 	wp_reset_postdata();
	$delimiter = '';
	$name = __('Home', THEME_NAME); //text for the 'Home' link
	$currentBefore = '<li>';
	$currentAfter = '</li>';

  if ( !is_home() && !is_front_page() || is_paged() || (DF_page_id() == get_option('page_for_posts'))) {
 
		$breadcrumbs='<ul class="breadcrumb">';

		global $post;
		$home = get_home_url();
		$breadcrumbs.='<li><a href="' . $home . '">' . $name . '</a></li>' . $delimiter . ' ';
 
    if ( is_category() ) {
		global $wp_query;
		$cat_obj = $wp_query->get_queried_object();
		$thisCat = $cat_obj->term_id;
		$thisCat = get_category($thisCat);
		$parentCat = get_category($thisCat->parent);
		if ($thisCat->parent != 0) $breadcrumbs.="<li>".(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '))."</li>";
		$breadcrumbs.="<li>".single_cat_title('', false)."</li>";
 
    }
    if ( is_day() ) {
		$breadcrumbs.='<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>' . $delimiter . ' ';
		$breadcrumbs.='<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li>' . $delimiter . ' ';
		$breadcrumbs.=$currentBefore . get_the_time('d') . $currentAfter;
 
    }

    if ( is_month() ) {
		$breadcrumbs.='<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>' . $delimiter . ' ';
		$breadcrumbs.=$currentBefore . get_the_time('F') . $currentAfter;
 
    }

    if ( is_year() ) {
		$breadcrumbs.=$currentBefore . get_the_time('Y') . $currentAfter;
 
    }

    if ( is_single() ) {
		if(get_the_category()) {
			$cat = get_the_category(); $cat = $cat[0];
		} else {
			$cat = false;
		}
		$pageType = get_query_var( 'post_type' );
		$terms = get_terms( $pageType.'-cat', 'orderby=count&hide_empty=0' );
		if($cat) {
			$categorys = explode("|",get_category_parents($cat, TRUE, '|' . $delimiter . ''),-1); 
			foreach($categorys as $category) $breadcrumbs.="<li>".$category."</li>";
		} elseif (!$cat && is_array($terms)) {
			if(isset($terms[0]->slug)) {
				$breadcrumbs.="<li><a href=".get_term_link( $terms[0]->slug, $pageType."-cat" ).">".$terms[0]->name."</a></li>".$delimiter;
			}
		}
		$breadcrumbs.=$currentBefore;
		$breadcrumbs.=get_the_title();
		$breadcrumbs.=$currentAfter;
 
    }

    if ( is_page() && !$post->post_parent ) {
		$breadcrumbs.=$currentBefore;
		$breadcrumbs.=get_the_title();
		$breadcrumbs.=$currentAfter;
 
    }

    if ( is_page() && $post->post_parent ) {
		$parent_id = $post->post_parent;
		$breadcrumbsA = array();
		while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbsA[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
			$parent_id  = $page->post_parent;
		}
		$breadcrumbsA = array_reverse($breadcrumbsA);
		foreach ($breadcrumbsA as $crumb) {
			$breadcrumbs.= $crumb . '' . $delimiter . '';
		}
		$breadcrumbs.=$currentBefore;
		$breadcrumbs.=get_the_title();
		$breadcrumbs.=$currentAfter;
 
    }
    if ( is_search() ) {
		$breadcrumbs.=$currentBefore . get_search_query() . $currentAfter;
    }
    if ( is_tag() ) {
		$breadcrumbs.=$currentBefore.single_tag_title().$currentAfter;
    }
    if ( is_author() ) {
		global $author;
		$userdata = get_userdata($author);
		$breadcrumbs.=$currentBefore . $userdata->display_name . $currentAfter;
    }
    if ( is_404() ) {
		$breadcrumbs.=$currentBefore . 'Error 404' . $currentAfter;
    }
    if( DF_page_id() == get_option('page_for_posts')) {
		$breadcrumbs.=$currentBefore .get_the_title(DF_page_id()). $currentAfter;
	}
	if (is_tax()) {
		$breadcrumbs.=$currentBefore;
		global $wp_query;
		$term =	$wp_query->queried_object;
		$breadcrumbs.=$term->name;
      	$breadcrumbs.=$currentAfter;
	}
 	
    if ( get_query_var('paged') ) {
		if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $breadcrumbs.= ' (';
		$breadcrumbs.=$currentBefore.esc_html__('Page', THEME_NAME) . ' '.get_query_var('paged'). $currentAfter;
		if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $breadcrumbs.= ')';
    }
 
    $breadcrumbs.='</ul>';

    echo balanceTags($breadcrumbs, false);
 
  }
   
}
?>