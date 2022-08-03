<?php get_header(); ?>

<?php
// The Query
$args = array(  
	'post_type' => 'music',
    'meta_key' => 'post_views_count',
    'orderby' => 'meta_value', 
    'posts_per_page' => 5
		);

		

$loop = new WP_Query( $args ); 


// The Loop
if ( $loop->have_posts() ) { ?>
<h2 class="slidetopic">Top Porpolar Weekly Music!</h2>
<div class="flexslider">

	<ul class="slides">
 <?php while ( $loop->have_posts() ) { $loop->the_post(); ?>
	<?php $s_img = (get_the_post_thumbnail_url() == false ) ? get_field('muisc_image') : get_the_post_thumbnail_url();
	 $s_img = (empty($s_img)) ? No_img : $s_img; ?>
	<li data-thumb="<?php echo $s_img ?>">
	<a href="<?php echo the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">
	<div class="sbox">
	<img src="<?php echo $s_img ?>" alt="">
	<div class="sboxinner">
	<?php getPostViews(get_the_ID()); ?>
	   <h2 class="title"><?php echo get_the_title();?></h2>
	   <p class="sub"><?php echo get_the_excerpt();?></p> 
	 </div>
	</div> </a>
   </li>

<?php } ?>
	</ul>
</div>
<?php } else {
    // no posts found
}
/* Restore original Post Data */
wp_reset_postdata();


?>



<div class="wrapper section-inner group">

	


	<div class="content">

	


<?php

		$archive_title = '';
		$archive_subtitle = '';
		$archive_description = get_the_archive_description();
		
        add_filter('get_the_archive_title', function ($title) {
				return preg_replace('/^\w+: /', '', $title);
			}); 

		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		if ( $paged > 1 || is_archive() || is_search() ) {

			if ( is_search() ) {
				$archive_title = sprintf( __( 'Search results: "%s"', 'rowling' ), get_search_query() );
			} else {
				$archive_title = get_the_archive_title();
			}

			

			$archive_subtitle = __( 'Page', 'rowling' ) . ' ' . $paged . '<span class="sep">/</span>' . $wp_query->max_num_pages;

		}
			
		if ( $archive_title || $archive_subtitle || $archive_description ) : ?>
		
			<div class="archive-header">

				<div class="group archive-header-inner">

				
					<?php if ( $archive_title ) : ?>
						<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
					<?php endif;?>
					
					<?php if ( $archive_subtitle ) : ?>
						<p class="archive-subtitle"><?php echo wp_kses_post( $archive_subtitle ); ?></p>
					<?php endif; ?>

				</div><!-- .group -->

				<?php if ( $archive_description ) : ?>
					<div class="archive-description"><?php echo wp_kses_post( wpautop( $archive_description ) ); ?></div>
				<?php endif; ?>
				
			</div><!-- .archive-header -->
						
		<?php endif; ?>
																							                    
		<?php if ( have_posts() ) : ?>
		
			<div class="posts" id="posts">
					
				<?php 
				while ( have_posts() ) : the_post(); 
		    	
		    		get_template_part( 'content', get_post_format() );
		    			        		            
				endwhile; 
				?>
	        	                    			
			</div><!-- .posts -->
		
			<?php
			get_template_part( 'pagination' );
		
		elseif ( is_search() ) : 

			?>

			<article class="post single single-post">
			
				<div class="post-inner">
			
					<div class="post-content entry-content">
					
						<p><?php _e( 'No results. Try again, would you kindly?', 'rowling' ); ?></p>
						
						<?php get_search_form(); ?>
					
					</div><!-- .post-content -->
				
				</div><!-- .post-inner -->
				
			</article><!-- .post -->

		<?php endif; ?>
		
	</div><!-- .content -->
	
</div><!-- .wrapper.section-inner -->
	              	        
<?php get_footer(); ?>