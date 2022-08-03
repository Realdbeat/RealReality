
<div class="chips_artiste">
<?php  $terms = wp_list_pluck( get_the_terms( get_the_ID(), 'artiste' ), 'name');
 $td =  get_the_terms( get_the_ID(), 'artiste' );
  foreach( $td as $term ) {
    $images =  get_term_meta($term->term_id,'ba_artist_image')[0]['url'];
    echo '<a href="/artiste/'.str_replace(' ', '-', $term->term_name).'"><div class="artchips"><div class="chipicon">'.substr($term, 0, 1).'</div>'.$term->term_name.'</div>'.$images.'</a>';
    print_r($td);
  }
  ?>
  </div>