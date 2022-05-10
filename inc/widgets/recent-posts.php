<?php 

if ( ! class_exists( 'Rowling_Recent_Posts' ) ) :
	class Rowling_Recent_Posts extends WP_Widget {

		function __construct() {
			parent::__construct( 'Rowling_Recent_Posts', __( 'Recent Posts', 'rowling' ), array( 
				'classname' 	=> 'Rowling_Recent_Posts', 
				'description' 	=> __( 'Displays recent blog entries.', 'rowling' ) 
			) );
		}
		
		function widget( $args, $instance ) {
		
			// Outputs the content of the widget
			extract( $args ); // Make before_widget, etc available.
			
			$widget_title = isset( $instance['widget_title'] ) ? apply_filters( 'widget_title', $instance['widget_title'] ) : '';
			$number_of_posts = ! empty( $instance['number_of_posts'] ) ? $instance['number_of_posts'] : 5;
			
			echo $before_widget;

			if ( $widget_title ) {
				echo $before_title . $widget_title . $after_title;	
			}
			
			?>
			
			<ul class="rowling-widget-list reset-list-style">
				
				<?php

				$recent_posts = get_posts( array(
					'ignore_sticky_posts' => true,
					'post_status'         => 'publish',
					'posts_per_page'      => $number_of_posts,
				) );
				
				if ( $recent_posts ) :
					foreach ( $recent_posts as $recent_post ) : 
					
						?>
				
						<li>
							<a href="<?php the_permalink( $recent_post->ID ); ?>" class="group">
								<div class="post-icon">
									<?php 
									if ( $post_thumbnail = get_the_post_thumbnail( $recent_post, 'thumbnail' ) ) {
										echo $post_thumbnail;
									} elseif ( get_post_format( $recent_post ) == 'gallery' ) {
										echo '<div class="fa fw fa-camera"></div>';
									} else {
										echo '<div class="fa fw fa-file-alt"></div>';
									}
									?>
								</div>
								<div class="inner">
									<p class="title"><?php echo get_the_title( $recent_post ); ?></p>
									<p class="meta"><?php echo get_the_time( get_option( 'date_format' ), $recent_post ); ?></p>
								</div>
							</a>
						</li>
				
					<?php 
					endforeach;
				endif; 
				?>
		
			</ul>
					
			<?php
			
			echo $after_widget; 

		}
		
		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;
			
			$instance['widget_title'] = strip_tags( $new_instance['widget_title'] );
			$instance['number_of_posts'] = intval( $new_instance['number_of_posts'] ) ?: 5;
		
			//update and save the widget
			return $instance;

		}
		
		function form( $instance ) {
			
			// Set defaults
			if ( ! isset( $instance['widget_title'] ) ) $instance['widget_title'] = '';
			if ( empty( $instance['number_of_posts'] ) ) $instance['number_of_posts'] = 5;

			?>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>"><?php _e( 'Title', 'rowling' ); ?>:
				<input id="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_title' ) ); ?>" type="text" class="widefat" value="<?php echo esc_attr( $instance['widget_title'] ); ?>" /></label>
			</p>
							
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number_of_posts' ) ); ?>"><?php _e( 'Number of posts to display', 'rowling' ); ?>:
				<input id="<?php echo esc_attr( $this->get_field_id( 'number_of_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_posts' ) ); ?>" type="text" class="widefat" value="<?php echo esc_attr( $instance['number_of_posts'] ); ?>" /></label>
				<small>(<?php _e( 'Defaults to 5 if empty', 'rowling' ); ?>)</small>
			</p>
			
			<?php

		}

	}
endif;
