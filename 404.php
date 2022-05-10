<?php get_header(); ?>

<div class="wrapper section-inner group">

	<div class="content">
												        
		<article class="post single single-post">
			
			<p class="post-categories"><?php _e( 'Error 404', 'rowling' ); ?></p>
		
			<div class="post-header">
			    <h1 class="post-title"><?php _e( "These are Not the Results You're Looking For", "rowling" ); ?></h1>
			</div><!-- .post-header -->
				
			<div class="post-inner">
				
				<div class="post-content entry-content">
				
					<p><?php _e( "It seems like you have tried to open a page that doesn't exist. It could have been deleted, moved, or it never existed at all. Either way, you're welcome to search for what you are looking for with the form below.", "rowling" ); ?></p>
					
					<p><?php printf(__( 'You can also return to the %1$s home page %2$s and continue your search from there.', 'rowling' ), '<a href="' . esc_url( get_home_url() ) .  '">', '</a>' ); ?></p>
					
					<p><?php get_search_form(); ?></p>
				
				</div><!-- .post-content -->
									
			</div><!-- .post-inner -->
																
		</article><!-- .post -->
									                        		
	</div><!-- .content -->
	
	<?php get_sidebar(); ?>
	
</div><!-- .wrapper.section-inner -->
								
<?php get_footer(); ?>