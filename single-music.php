<?php get_header(); ?>

<div class="wrapper section-inner group">
	
	<div class="content">
												        
		<?php 
		if ( have_posts() ) : 
			while ( have_posts() ) : 
			
				the_post(); 
				?>
		
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'single single-post group' ); ?>>
					
					<div class="post-header">
											
						<?php if ( is_single() && has_category() ) : ?>
							<p class="post-categories"><?php the_category( ', ' );?> >> <?php
echo get_the_term_list( $post->ID, 'artist', 'ARTIST >> ', '', '', '' );	?></p>
							<?php 
						endif;
						

						
						the_title( '<h1 class="post-title">', '</h1>' );
						
						if ( is_single() ) : 

							$author_id = get_the_author_meta( 'ID' );
							$author_posts_url = get_author_posts_url( $author_id );
							
							?>
						
							<div class="post-meta">

								<span class="resp"><?php _e( 'Posted', 'rowling' ); ?></span> <span class="post-meta-author"><?php _e( 'by', 'rowling' ); ?> <a href="<?php echo esc_url( $author_posts_url ); ?>"><?php the_author_meta( 'display_name' ); ?></a></span> <span class="post-meta-date"><?php _e( 'on', 'rowling' ); ?> <a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span> <?php edit_post_link(__( 'Edit', 'rowling' ), ' &mdash; ' ); ?>

								<?php if ( comments_open() && ! post_password_required() ) : ?>
									<span class="post-comments">
										<?php 
										comments_popup_link(
											'<span class="fa fw fa-comment"></span>0<span class="resp"> ' . __( 'Comments', 'rowling' ) . '</span>', 
											'<span class="fa fw fa-comment"></span>1<span class="resp"> ' . __( 'Comment', 'rowling' ) . '</span>', 
											'<span class="fa fw fa-comment"></span>%<span class="resp"> ' . __( 'Comments', 'rowling' ) . '</span>'
										); 
										?>
									</span>
								<?php endif; ?>

							</div><!-- .post-meta -->

						<?php endif; ?>
						
					</div><!-- .post-header -->
<?php 
$music_art = get_the_term_list( $post->ID, 'artiste', '', ' &nbsp Ft. &nbsp','' ); 
if(empty($music_art)){ $music_art = 'Unknow Artiste'; }

?>


		<figure class="post-image">
		<?php the_post_thumbnail( 'post-image' );?>
		<?php if ( get_the_post_thumbnail_url() == false ) :  ?>
			<a href="<?php the_permalink(); ?>"><img src="https://www.realdbeat.com/wp-content/uploads/2022/02/R-D.png"/></a>	
	    <?php endif; ?>
		<div class="music-metas">
		<?php the_title( '<span class="metas-item"><i class="fa fa-compact-disc"></i>', '</span>' ); ?>
	    <span class="metas-item"><i class="fa fa-microphone-alt"></i><?php echo $music_art?></span>
		<span class="metas-item"><i class="fa fa-download"></i></i>0</span>
		<span class="metas-item"><i class="fas fa-heart"></i>0</span>
		<span class="metas-item"><i class="fas fa-heart-broken"></i>0</span>
		</div>
	    </figure><!-- .post-image -->
							
						<?php
					
					if ( is_single() ) {
						rowling_related_posts();
					}

					?>
							
					<div class="post-inner">
		
						<div class="post-content entry-content">
						
							<?php 
							
							the_content();
							
							wp_link_pages( array(
								'before'           => '<p class="page-links"><span class="title">' . __( 'Pages:', 'rowling' ) . '</span>',
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
							<?php rowling_related_posts(); ?>
						
						<?php endif; ?>
										
					</div><!-- .post-inner -->
					
				</article><!-- .post -->
				
				<?php 
				
				comments_template( '', true );
			
			endwhile; 
		endif; 
		?>
	
	</div><!-- .content -->
	<?php get_sidebar(); ?>
	
</div><!-- .wrapper -->
		
<?php get_footer(); ?>