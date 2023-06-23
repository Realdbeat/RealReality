<?php get_header(); ?>

 <div class="wrapper section-inner group">
 <div class="content">
 <?php  if ( have_posts() ) :  while ( have_posts() ) :   the_post(); 
   /**Add Count Post View Number */
   customSetPostViews(get_the_ID());
   //the_post_thumbnail( 'post-image' );
   $afcdata = get_mmos(get_the_ID()); 
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
			 <?php if ( is_single() && has_term( '', 'mmotype' ) ) :  get_p_terms(get_the_ID(),"mmotype","MMos TAGs"); endif; ?>
	 </div><!--End .post-header -->


		<figure class="post-image"> 
			<a href="<?php the_permalink(); ?>">
			<img src="<?php echo $afcdata["site_img"] ?>"/>
		 </a>
		 <div class="mmo-metas">
		 <?php the_title( '<span class="metas-item"><i class="fa fa-compact-disc"></i>~', '</span>' ); ?>
	     <span class="metas-item"><i class="fa fa-star"></i>Ratings~ <?php for ($k = 0 ; $k < $afcdata["rating"]; $k++){ echo '<span class="fa fa-star checked"></span>'; }?></span>
		 <span class="metas-item"><?php getPostViews($post->ID); ?> ~Views</span>
		 <span class="metas-item"><i class="fas fa-heart"></i><?php gettotallikes($post->ID);?> ~Reactions</span>
		 <span class="metas-item"><i class="fa fw fa-comment"></i> <?php echo comments_popup_link('0','1', '%'); echo "~Comments!"; ?></span>
		 </div>
		<!-- MMos Votes --> 
		 <div class="vote">
		 <i class="react" id="love" Onclick="addlikes(this.id,'<?php echo $post->ID ?>')"><img src="<?php echo THEME_URL.'/assets/fb icon/love.png' ?>"/><p><?php getlikes($post->ID,"love") ?></p></i>
		 <i class="react" id="wow" Onclick="addlikes(this.id,'<?php echo $post->ID ?>')"><img src="<?php echo THEME_URL.'/assets/fb icon/wow.png' ?>"/><p><?php getlikes($post->ID,"wow") ?></p></i>
		 <i class="react" id="sad" Onclick="addlikes(this.id,'<?php echo $post->ID ?>')"><img src="<?php echo THEME_URL.'/assets/fb icon/sad.png' ?>"/><p><?php getlikes($post->ID,"sad") ?></p></i>
		</div><!--End MMos Votes --> 
	    </figure><!-- .post-image -->

 <?php	if ( is_single() ) { realreality_related_posts(); } ?>	
									
   <div class="post-inner">	
   <div class="post-content entry-content">
	<?php  the_content(); ?>
	<?php showshares(); ?>	
	<?php		
		wp_link_pages(array(
			'before' => '<p class="page-links"><span class="title">' . __( 'Pages:', 'realreality' ) . '</span>',
			 'after' => '</p>',
			 'link_before' => '<span>',
			 'link_after' => '</span>',
			 'separator' => '',
			 'pagelink'=> '%',
			 'echo' => 1 )); 
							
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