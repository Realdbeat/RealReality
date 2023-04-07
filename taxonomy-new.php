<?php get_header(); ?>

			
	<div class="music-content">

		<?php
        //error_reporting(0);
		$archive_title = '';
		$archive_subtitle = '';
		$archive_description = get_the_archive_description();
        $makeup_title =  single_cat_title( '', false );
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$addressregion	= get_term_meta($term->term_id,'ba_addressregion')[0];				
        $postalcode = get_term_meta($term->term_id,'ba_postalcode')[0];
		$streetaddress = get_term_meta($term->term_id,'ba_streetaddress')[0];
        $colleague = get_term_meta($term->term_id,'ba_colleague')[0];
        $email = get_term_meta($term->term_id,'ba_email')[0];
        $image = get_term_meta($term->term_id,'ba_artist_image')[0]['url'];
        $jobtitle = 'artist';
        $name = get_term_meta($term->term_id,'ba_name')[0];		
        $telephone = get_term_meta($term->term_id,'ba_telephone')[0];
        $url = 'https://www.realvibesnaija.com.ng/artists/'.$term->slug;
		$gen = 'afro pop';
		$bio = get_the_archive_description();
        $musiclist = array();
        $ups = 0;
		
		
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
        $archive_subtitle = __( 'Page', 'realreality' ) . ' ' . $paged . '<span class="sep">/</span>' . $wp_query->max_num_pages;
		$archive_title = get_the_archive_title();
			
		if ( $archive_title || $archive_subtitle || $archive_description ) : ?>
		
		<!--	<div class="archive-header">

				<div class="group archive-header-inner">

					<?php if ( $archive_title ) : ?>
						<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
					<?php endif; ?>
					
					<?php if ( $archive_subtitle ) : ?>
						<p class="archive-subtitle"><?php echo wp_kses_post( $archive_subtitle ); ?></p>
					<?php endif; ?>

				</div>

				<?php if ( $archive_description ) : ?>
					<div class="archive-description"><?php echo wp_kses_post( wpautop( $archive_description ) ); ?></div>
				<?php endif; ?>
				
			</div> .archive-header -->

			<div class="artist-box-contain" data-label="<?php echo  $makeup_title;?>">

<div class="artist-box" data-label="Realdbeat">
<img src="<?php echo  $image;?>" />
<div class="body">
<div class="desc">
<div class="social">
<a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
<a href="#" target="_blank"><i class="fab fa-tiktok"></i></a>
<a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
<a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
</div> 
<div class="divi"><div class="divi-line"></div>Artist social Medias<div class="divi-line"></div></div>
<div class="social">
  <a href="#" target="_blank"><i class="fab fa-shopify"></i></a>
  <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
  <a href="#" target="_blank"><i class="fab fa-apple"></i></a>
  <a href="#" target="_blank"><i class="fab fa-itunes"></i></a>
  <a href="#" target="_blank"><i class="fab fa-soundcloud"></i></a>
  </div>  
<div class="divi"><div class="divi-line"></div>Streem And Buy Music<div class="divi-line"></div></div>


</div>

</div>
<div class="foot"></div>
</div>
</div>





						
		<?php endif; ?>





<script>
(function(){
	var data = {
	    "@context": "http://schema.org",
	    "@type": "MusicGroup",
	    "@id": "<?php echo $url ?>",
	    "name": "<?php echo $name ?>",
		"alternateName": "<?php echo $name ?>",
		"description": "<?php echo $bio ?>",
	    "logo": {
	        "@type": "ImageObject",
	        "url": "<?php echo $image ?>"
	    },
	    "image": {
	        "@type": "ImageObject",
	        "url": "<?php echo $image ?>"
	    },
	    "url": "<?php echo $url ?>",
	    "genre": [
	        "<?php echo $gen ?>",
	        "<?php echo $gen ?>"
	    ],
	    "sameAs": [
	        "https://www.facebook.com/<?php echo $name ?>",
	        "https://twitter.com/<?php echo $name ?>",
	        "https://instagram.com/<?php echo $name ?>",
	        "https://www.youtube.com/<?php echo $name ?>",
	        "https://soundcloud.com/<?php echo $name ?>",
	        "https://plus.google.com/<?php echo $name ?>"
	    ],
	    "member": [
	        {
	            "@type": "OrganizationRole",
	            "member": {
	                "@type": "Person",
	                "name": "Artist",
					"alternateName": "<?php echo $name ?>",
					"givenName": "<?php echo $name ?>",
	                "sameAs": "<?php echo $url ?>"
	            },
	            "roleName": [
	                "guitar",
	                "lead vocals",
	                "drums",
	                "bass",
	                "keyboards",
	                "violin"
	            ]
	        }
	    ]
	};
	var script = document.createElement('script');
	script.type = 'application/ld+json';
	script.innerHTML = JSON.stringify( data );
	document.getElementsByTagName('head')[0].appendChild(script);
})(document);

(function(){
	var data = {
  "@context": "http://schema.org",
  "@type": "Person",
  "name": "<?php echo $name ?>",
  "alternateName": "<?php echo $name ?>",
  "description": "<?php echo $bio ?>",
   	    
  "url": "<?php echo $url?>",
  "sameAs": [
    "https://www.facebook.com/<?php echo $name ?>",
	"https://twitter.com/<?php echo $name ?>",
	"https://instagram.com/<?php echo $name ?>",
	"https://www.youtube.com/<?php echo $name ?>",
	"https://soundcloud.com/<?php echo $name ?>",
	"https://plus.google.com/<?php echo $name ?>"
  ]
};
	var script = document.createElement('script');
	script.type = 'application/ld+json';
	script.innerHTML = JSON.stringify( data );
	document.getElementsByTagName('head')[0].appendChild(script);
})(document);
</script>
																							                    
		<?php if ( have_posts() ) : ?>
<div class="musics-lists">				
<?php while ( have_posts() ) : the_post(); 
$ups = $ups+1;
$postme = get_post();
$ti = $postme->post_title;
$pimg = get_the_post_thumbnail_url($postme->ID);
$noimg = get_template_directory_uri() . '/assets/img/noimage.jpg';
$images = empty($image) ? $noimg : $image;
$pimg = empty($pimg) ? $images : $pimg;
$urld = get_permalink($postme->ID);
 $sdata = array(
 "@type"=>"MusicRecording",
 "@id"=>$url,
 "position"=>$ups,
 "duration"=>"PT4M28S",
 "name"=>$ti,
 "url"=> $urld );
array_push($musiclist,$sdata);	
?>


<div class="music-contain">
<div class="musics">
<img src="<?php echo $pimg;?>" />
<div class="music-desc">
 <h2><marquee behavior="scroll" direction="left" scrollamount="2"><?php echo $ti;?></marquee></h2>
 <h4><?php echo  $makeup_title;?></h4>
 <div class="slider_container">
  <div class="current-time" id="current-time1">00:00</div>
  <input type="range" min="1" max="100" value="0" class="seek_slider"  id="seek_slider1" onchange="seekTo()">
  <div class="total-duration" id="total-duration1">00:00</div>
</div>
 <div class="player">
  <i class="fa fa-step-backward"></i>
  <div class="playpause-track" id="playpause-track1" onclick='playpauseTrack({ sc: "1", path: "Fireboy_DML_&_D_Smoke_-_Champ_(Audio)(256k).mp3" })'>
    <i class="fa fa-play-circle"></i>
    </div> 
   <i class="fa fa-step-forward"></i>
  </div>
</div>
<div class="volume">
<i class="fa fa-music"></i>
<i class="fa fa-volume-up"></i>
<input type="range" min="1" max="100" value="99" class="volume_slider"  id="volume_slider1" onchange="setVolume()">
<i class="fa fa-volume-down"></i>
</div>
</div>
<a class="download">download now</a>
<a class="info" href="<?php echo $urld;?>" target="_blank" ><i class="fa fa-info"></i></a>
</div>


<?php		endwhile;  ?>
<script>
(function(){
	var data = {
	    "@context": "http://schema.org",
	    "@type": "MusicAlbum",
	    "@id": "<?php echo $url; ?>",
	    "byArtist": {
	        "@type": "MusicGroup",
	        "name": "<?php echo $name; ?>",
			"alternateName": "<?php echo $name; ?>",
	        "@id": "<?php echo $url; ?>",
	        "url": "<?php echo $url; ?>"
	    },
	    "genre": [
	        "Progressive Metal",
	        "Metal"
	    ],
	    "image": "<?php echo $image; ?>",
	    "name": "<?php echo $name; ?> Album",
	    "numTracks": "10",
	    "track": <?php echo json_encode($musiclist); ?>,
	    "url": "<?php echo $url; ?>"
	};
	var script = document.createElement('script');
	script.type = 'application/ld+json';
	script.innerHTML = JSON.stringify( data );
	document.getElementsByTagName('head')[0].appendChild(script);
})(document);
</script>
</div>				
<!-- .posts -->
		
			<?php
			
			get_template_part( 'pagination' );
		
		elseif ( is_search() ) : 

			?>

			<article class="post single single-post">
			
				<div class="post-inner">
			
					<div class="post-content entry-content">
					
						<p><?php _e( 'No results. Try again, would you kindly?', 'realreality' ); ?></p>
						
						<?php get_search_form(); ?>
					
					</div><!-- .post-content -->
				
				</div><!-- .post-inner -->
				
			</article><!-- .post -->

		<?php endif; ?>
		
	</div><!-- .content -->
	              	        
<?php get_footer(); ?>