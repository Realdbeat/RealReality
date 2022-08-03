<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>

	<?php $post_format = get_post_format() ? get_post_format() : 'standard'; 
	$music_art = get_the_term_list( $post->ID, 'artiste', 'Music By ', ' &nbsp Ft. &nbsp','' ); 
	$p_img = ( get_the_post_thumbnail_url() == false ) ? get_field('muisc_image') : get_the_post_thumbnail_url();
	 $p_img = (empty($p_img)) ? No_img : $p_img; ?>

	<?php if ( ( $post_format == 'gallery' ) && ! post_password_required() ) : ?>
	     <figure class="post-image">
			<?php if ( is_sticky() ) : ?>
				<a class="sticky-tag" href="<?php the_permalink(); ?>">
					<span class="fa fw fa-star"></span>
					<span class="screen-reader-text"><?php _e( 'Sticky post', 'rowling' ); ?></span>
				</a>
			<?php endif; ?>

			<?php if ( $post_format == 'gallery' ) : ?>
				<?php rowling_flexslider( 'post-image-thumb' ); ?>
			<?php elseif ( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>">
				<img src="<?php echo $p_img ?>"/>
			</a>
			<?php endif; ?>
		</figure><!-- .post-image -->
			
	<?php endif; ?>
        <figure class="post-image">
			<a href="<?php the_permalink(); ?>"><img src="<?php echo $p_img ?>"/></a>
	    </figure>	
	<?php getPostViews(get_the_ID()); ?>
	
	<header class="post-header">
							
		<?php if ( has_category() ) : ?>
			<p class="post-categories"><?php the_category( ', ' ); ?></p>
		<?php endif; ?>
		<?php if ( get_post_type() == 'music' ) :  ?>
		<p class="post-categories"><?php echo $music_art ?></p>
		<?php endif; ?>
		<?php if ( get_the_title() ) : ?>
		    <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); 
			?></a></h2>
		<?php endif; ?>
		
		<div class="post-meta">
			<a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a> 
			<?php 
			if ( comments_open() ) {
				echo " &mdash; ";
				comments_popup_link( __( '0 Comments<li class="fa fa-comments"></li>', 'rowling' ), __( '1 Comment<li class="fa fa-comments"></li>', 'rowling' ), __( '% Comments<li class="fa fa-comments"></li>' , 'rowling' ) );
			} 
			?>
		</div>
		
	</header><!-- .post-header -->
						
</article><!-- .post -->