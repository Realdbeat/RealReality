<?php get_header(); ?>
<div class="wrapper section-inner group">
<div class="content">
												        
		<?php 
		if ( have_posts() ) : while ( have_posts() ) : the_post(); 
				?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'single single-post group' ); ?>>
	<div class="post-header">
	 <?php   the_title( '<h1 class="post-title">', '</h1>' ); ?>
	</div><!-- .post-header -->
	 <?php  customSetPostViews(get_the_ID());  ?> 
		 <figure class="post-image">
			 <?php  the_post_thumbnail( 'post-image' );
                 $image_caption = get_the_post_thumbnail_caption( $post->ID );
				 if ( $image_caption ) : ?>
				 <div class="post-image-caption"><span class="fa fw fa-camera"></span><?php echo wpautop( $image_caption ); ?></div>
				 <?php endif; ?>
		 </figure><!-- .post-image --> 
		 <div class="post-content entry-content">
			 <?php  the_content();
			       showshares();
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
					
	 </article><!-- .post -->
				
	 <?php  endwhile;  endif;  ?>
	
	</div><!-- .content -->
	
</div><!-- .wrapper -->
		
<?php get_footer(); ?>