<?php get_header(); 
global $wpdb;
?>
<div class="wrapper section-inner group">
			
	<div class="artiste-content">
<?php
$def_img = get_template_directory_uri()."/assets/img/art.jpg";
$taxonomy = 'artiste';
$number   = 4; // number of terms to display per page

// Setup:
$page         = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$offset       = ( $page > 0 ) ?  $number * ( $page - 1 ) : 1;
$totalterms   = wp_count_terms( $taxonomy, array( 'hide_empty' => FALSE ) ); 
$totalpages   = ceil( $totalterms / $number );
$args = array(
    'orderby'       => 'name', 
    'order'         => 'ASC',
    'hide_empty'    => false, 
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


// create a comma separated string of category ids
// used for SQL `WHERE IN ()`
$category_ids = implode(',', array_map(function($cat) {
  return $cat->term_id;
}, $terms));

$query = "SELECT SUM(p.comment_count) AS count, t.name FROM wp_posts p
JOIN wp_term_relationships tr ON tr.object_id = p.ID
JOIN wp_term_taxonomy tt ON tt.term_taxonomy_id = tr.term_taxonomy_id
JOIN wp_terms t ON t.term_id = tt.term_id
WHERE t.term_id in ($category_ids)
AND p.post_status = 'publish'
GROUP BY t.term_id";
$categories = $wpdb->get_results($query);






 foreach ($terms as $term){

			//error_reporting(0);
			$archive_title = $term->name;
			$archive_subtitle = $term->description;

			$addressregion	= isset(get_term_meta($term->term_id,'ba_addressregion')[0]) ? get_term_meta($term->term_id,'ba_addressregion')[0]	: "null";

			$postalcode = isset(get_term_meta($term->term_id,'ba_postalcode')[0]) ? get_term_meta($term->term_id,'ba_postalcode')[0] : "null";
            
            $musiccount = isset($term->count) ? $term->count." Musics" : "0 Musics";

			$streetaddress = isset(get_term_meta($term->term_id,'ba_street_address')[0]) ? get_term_meta($term->term_id,'ba_street_address')[0] : "null";

			$colleague = isset(get_term_meta($term->term_id,'ba_colleague')[0]) ? get_term_meta($term->term_id,'ba_colleague')[0] : "null";

			$email = isset(get_term_meta($term->term_id,'ba_email')[0]) ? get_term_meta($term->term_id,'ba_email')[0] : "null";


			$image = isset(get_term_meta($term->term_id,'ba_artist_image')[0]['url']) ? get_term_meta($term->term_id,'ba_artist_image')[0]['url'] : $def_img ;

			$name = isset(get_term_meta($term->term_id,'ba_name')[0]) ? get_term_meta($term->term_id,'ba_name')[0] : "null";

			$telephone = isset(get_term_meta($term->term_id,'ba_telephone')[0]) ? get_term_meta($term->term_id,'ba_telephone')[0] : "null";

			$url =  get_bloginfo("url")."/".$taxonomy."/".$term->slug;
			$gen = 'afro pop';
			$bio = null;
            $comment_counts = "N/A";

          $keyToLookFor = $term->name;
          $foundField = array_filter($categories, function($field) use($keyToLookFor){
          return $field -> name === $keyToLookFor; });

          if(!empty($foundField)){
          $ke = array_keys($foundField);
          $ke = $ke[0];
          $comment_counts = $foundField[$ke]->count;
          }

?>	


<div class="a_box_outter">
<div class="a_buy">
     <a href="#" target="_blank"><i class="fab fa-shopify"></i></a>
     <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
     <a href="#" target="_blank"><i class="fab fa-apple"></i></a>
     <a href="#" target="_blank"><i class="fab fa-itunes"></i></a>
     <a href="#" target="_blank"><i class="fab fa-soundcloud"></i></a>
</div><div class="a_box">
<img src="<?php echo  $image;?>" />
<div class="a_box_inner">
	<h2><a href="<?php echo esc_url( $url ); ?>"> <?php echo  $archive_title;?></a></h2>
	<p> <?php echo  $archive_subtitle; ?></p>
	<div class="item"><i class="fa fa-comment"></i><?php echo $comment_counts ?> </div>
	<div class="item"><i class="fa fa-download"></i>0</div>
    <div class="item"><i class="fa fa-music"></i><?php echo $musiccount ?></div>
</div>
</div>
<div class="item-soc">
    <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
    <a href="#" target="_blank"><i class="fab fa-tiktok"></i></a>
    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>   
</div>


<?php
//end of lope items		
		}

?>
		
</div><!-- .content -->
	
	</div><!-- .wrapper.section-inner -->


<div class="archive-nav">
<?php
// Show custom page navigation
printf( '<li class="number">%s</li>', custom_page_navi($totalpages, $page, 3, 0 ) ); 
?>
</div>
<?php get_footer(); ?>
