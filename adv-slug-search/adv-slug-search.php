<?php
/**
  Plugin Name: Slug Search
  Plugin URI: https://author.test.com/
  Description: Search by slug for the different post types
  Author: xxomfgxx
  License: GPLv2+
  Version: 1.0
  Author URI: https://author.test.com/
**/

add_filter( 'posts_search', 'adv_search_by_slug', 500, 2 );   
  
function adv_search_by_slug( $where, $wp_query ) {  
	global $wpdb;

    if ( is_admin()  ){       
        $search_value = trim( $wp_query->query_vars['s'] );
    
        if(strpos($search_value,'slug:')!==false){
            $search_value = str_replace('slug:','',$search_value);
            $slug_like = '%' . $wpdb->esc_like( $search_value ) . '%';
            $where = $wpdb->prepare( " AND {$wpdb->posts}.post_name LIKE %s ", $slug_like );
        }	  
  }
    
  return $where;
}