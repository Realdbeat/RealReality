		</main><!-- #site-content -->

		<footer class="credits">
					
			<div class="section-inner">
				
				<a href="#" class="to-the-top">
					<div class="fa fw fa-angle-up"></div>
					<span class="screen-reader-text"><?php _e( 'To the top', 'rowling' ); ?></span>
				</a>
				
				<p class="copyright">&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo wp_kses_post( get_bloginfo( 'title' ) ); ?></a></p>
				
				<p class="attribution"><?php printf( __( 'Theme by %s', 'rowling' ), '<a href="https://www.andersnoren.se">Realdbeat Inc.</a>' ); ?></p>
				
			</div><!-- .section-inner -->
			
		</footer><!-- .credits -->

		<?php wp_footer(); ?>

	</body>
	
</html>