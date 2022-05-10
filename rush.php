<?php
/**
 * Template Name: Paginated list of terms for a custom taxonomy
 *
 */

// Edit:
$taxonomy = 'prints_cat';
$number   = 3; // number of terms to display per page

// Setup:
$page         = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$offset       = ( $page > 0 ) ?  $number * ( $page - 1 ) : 1;
$totalterms   = wp_count_terms( $taxonomy, array( 'hide_empty' => TRUE ) ); 
$totalpages   = ceil( $totalterms / $number );

// Debug:
// printf( 'taxonomy: %s - number: %s - page: %s - offset: %s - totalterms %s - totalpages: %s' , $taxonomy, $number, $page, $offset, $totalterms, $totalpages );

// Here I list all the available paramters to get_terms():
$args = array(
    'orderby'       => 'name', 
    'order'         => 'ASC',
    'hide_empty'    => true, 
    'exclude'       => array(), 
    'exclude_tree'  => array(), 
    'include'       => array(),
    'number'        => $number, 
    'fields'        => 'all', 
    'slug'          => '', 
    'parent'         => '',
    'hierarchical'  => true, 
    'child_of'      => 0, 
    'get'           => '', 
    'name__like'    => '',
    'pad_counts'    => false, 
    'offset'        => $offset, 
    'search'        => '', 
    'cache_domain'  => 'core'
); 

$terms = get_terms( $taxonomy, $args );

foreach ( $terms as $term )
{
    printf( '<div class="cat-preview"><h2><a href="%s">%s</a></h2></div>',
            get_term_link($term->slug, 'country'),
            $term->name,
            $term->name 
        );
}

// Show custom page navigation
printf( '<nav class="pagination">%s</nav>', 
            custom_page_navi( $totalpages, $page, 3, 0 ) 
          );