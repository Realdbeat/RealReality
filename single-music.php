<?php get_header(); ?>

<div class="wrapper section-inner group">
	
 <div class="content">
												        
		<?php  if ( have_posts() ) : while ( have_posts() ) :   the_post(); 
   /**Add Count Post View Number */
   $music = get_music(get_the_ID());
   customSetPostViews(get_the_ID());
   
       ?>
		
  <article id="mmo post-<?php the_ID(); ?>" <?php post_class( 'single single-post group' ); ?>>
	<div class="post-header"><!-- .post-header -->
	 <?php   the_title( '<h1 class="post-title">', '</h1>' );
	      $commentcounts = 'Comments Closed!';	
			if ( is_single() ) : 
                $author_id = get_the_author_meta( 'ID' );
				$author_posts_url = get_author_posts_url( $author_id ); ?>
			 <div class="post-meta"><!-- .post-meta -->
                <span class="resp"><?php _e( 'Posted', 'realreality' ); ?></span> <span class="post-meta-author"><?php _e( 'by', 'realreality' ); ?> <a href="<?php echo esc_url( $author_posts_url ); ?>"><?php the_author_meta( 'display_name' ); ?></a></span><span class="post-meta-date"><?php _e( 'on', 'realreality' ); ?> <a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span><?php getPostViews($post->ID); echo " Views";  edit_post_link(__( 'Edit', 'realreality' ), ' &mdash; ' ); ?>
								<?php if ( comments_open() && ! post_password_required() ) : ?>
									<span class="post-comments">
									<?php  echo  '<span class="fa fw fa-comment"></span>'; 
                                    comments_popup_link('0','1', '%'); 
                                    echo   '<span class="resp"> ' . __( 'Comment', 'realreality') . '</span>';
                           ?> 
						</span> <?php endif; ?> 
			 </div><!--End .post-meta --> <?php endif; ?>
			 
	 </div><!--End .post-header -->


		<figure class="post-image"> 
			<a href="<?php the_permalink(); ?>">
			<img src="<?php echo $music['cover']; ?>"/>
		 </a>
		 <div class="music-metas">
		 <?php the_title( '<span class="metas-item"><i class="fa fa-compact-disc"></i>', '</span>' ); ?>
	     <span class="metas-item"><i class="fa fa-microphone-alt"></i><?php echo $music['arts']; ?></span>
		 <span class="metas-item"><i class="fa fa-download"></i></i><?php echo $music['download']; ?></span>
		 <span class="metas-item"><i class="fas fa-heart"></i><?php gettotallikes($post->ID);?></span>
		 <span class="metas-item"><i class="fa fw fa-comment"></i><?php comments_popup_link('0','1', '%') ?></span>
		 </div>
		 <div class="vote">
		 <i class="react" id="love" Onclick="addlikes(this.id,'<?php echo $post->ID ?>')"><img src="<?php echo THEME_URL.'/assets/fb icon/love.png' ?>"/><p><?php getlikes($post->ID,"love") ?></p></i>
		 <i class="react" id="wow" Onclick="addlikes(this.id,'<?php echo $post->ID ?>')"><img src="<?php echo THEME_URL.'/assets/fb icon/wow.png' ?>"/><p><?php getlikes($post->ID,"wow") ?></p></i>
		 <i class="react" id="sad" Onclick="addlikes(this.id,'<?php echo $post->ID ?>')"><img src="<?php echo THEME_URL.'/assets/fb icon/sad.png' ?>"/><p><?php getlikes($post->ID,"sad") ?></p></i>
		</div>
	    </figure><!-- .post-image -->
		<?php if ( is_single() && has_term( '', 'artiste' ) ) :  get_p_terms(get_the_ID(),"artiste","ARTISTe"); endif; ?>
 <?php	if ( is_single() ) { realreality_related_posts(); } ?>	
									
   <div class="post-inner">	
   <div class="post-content entry-content">
						
							<?php 
							
							the_content();
					?>
    <!--	style="background: url('<?php //echo get_field('music_peak_url'); ?>')  no-repeat; filter:invert(100%);" -->

	<?php	//myArray = explode(',', myArray);		?>

    <div class="audio-wapper">
    <div class="music-info">
    <img class="music-cover" src="<?php echo $music['cover']; ?>"/>
    <div class="audio-infomata">
    <div class="audio-name"><?php  echo $music['name']; ?> || Realdbeat @2022</div>
    <div class="audio-art"><?php echo $music['arts']; ?></div>
	<div class="audio-gern"><?php echo $music['genre']; ?></div>
    <div class="audio-matamic">
        <span class="matamic mice-download"><?php echo $music['download']; ?></span>
        <span class="matamic mice-comment"><?php comments_popup_link('0','1', '%'); ?></span>
    </div>
    </div> 
    </div>
    <div class="audio"  id="progress0" >
        <div  class="progressbar" id="progressbar0"></div>
       <img src="<?php echo $music['peak']; ?>" />  </div>
     <div class="buttons">
            <span class="play-btn btn" id="playb0">
               <i class="fas fa-play"></i>
               <i class="fas fa-pause"></i>
           </span>
           <span class="stop-btn btn" id="stop-btn0">
               <i class="fas fa-stop"></i>
           </span>
       
           <span class="volume-btn btn">
               <i class="fas fa-volume-up"></i>
               <i class="fas fa-volume-mute"></i>
           </span>
       
           <input type="range" min="0" max="100" step="0.1" value="0.5" class="volume-slider"/>
           <span class="space"></span>
           <span class="mice download"><i class="fas fa-download"></i><a href="<?php echo $music['link']; ?>"> Download</a></span>
     </div>
     <audio id="clipid0">
     <source src="<?php echo $music['link']; ?>" type="audio/mpeg"></source>
     </audio>
    </div>

					
<div class="music_stores">
	<div class="music_icon nv">
	<i class="fa-brands fa-itunes"></i>
	<p>On Apple</p>	
	</div>
	
	<div class="music_icon av">
	<i class="fa-brands fa-spotify"></i>
	<p>On Spotify</p>
	</div>

	<div class="music_icon av">
	<i class="fa-brands fa-youtube"></i>
	<p>On Youtube</p>
	</div>

	<div class="music_icon av">
	<i class="fa-brands fa-deezer"></i>
	<p>On Deezer</p>
	</div>

	<div class="music_icon av">
	<i class="fa-brands fa-google-play"></i>
	<p>On GooglePlay</p>
	</div>

	<div class="music_icon av">
	<i class="fa-brands fa-amazon"></i>
	<p>On Amazon</p>
	</div>

	<div class="music_icon av">
	<i class="fa-brands fa-soundcloud"></i>
	<p>On SoundCloud</p>
	</div>

	<div class="music_icon av">
	<i class="deeicon icon-boomplay"></i>
	<p>On boomplay</p>
	</div>
	
	<div class="music_icon nv">
	<i class="deeicon icon-Grove"></i>
	<p>On Grove</p>
	</div>

	<div class="music_icon nv">
	<i class="deeicon icon-Shazam"></i>
	<p>On Shazam</p>
	</div>
	
	<div class="music_icon av">
	<i class="deeicon icon-tidal"></i>
	<p>On Tidal</p>
	</div>


</div>
<?php showshares(); ?>



					<?php		
							wp_link_pages( array(
								'before'           => '<p class="page-links"><span class="title">' . __( 'Pages:', 'realreality' ) . '</span>',
								'after'            => '</p>',
								'link_before'      => '<span>',
								'link_after'       => '</span>',
								'separator'        => '',
								'pagelink'         => '%',
								'echo'             => 1
							) ); 
							
							?>
						
   </div><!-- .post-content -->
 
						<?php if ( is_single() ) : ?>

							<?php the_tags( '<div class="post-tags">', '', '</div>' ); ?>
							
							<div class="post-author">
								
								<a class="avatar" href="<?php echo $author_posts_url; ?>">
									<?php echo get_avatar( $author_id, 100 ); ?>
								</a>
								
								<h4 class="title"><a href="<?php echo $author_posts_url; ?>"><?php the_author_meta( 'display_name' ); ?></a></h4>

								<?php

								$author_description = get_the_author_meta( 'description' );

								if ( $author_description ) : ?>

									<div class="post-author-description">
										<?php echo wpautop( $author_description ); ?>
									</div><!-- .post-author-description -->

								<?php endif; ?>

							</div><!-- .post-author --> 
							<?php realreality_related_posts(); ?>



						<?php endif; ?>
										
  </div><!-- .post-inner -->
					
</article><!-- .post -->
<div class="comment_wapper">			
				<?php 
				
				comments_template( '', true );
			
			endwhile; 
		endif; 
		?>
</div>		
 </div><!-- .content -->

	
</div><!-- .wrapper -->
		
<?php get_footer(); ?>