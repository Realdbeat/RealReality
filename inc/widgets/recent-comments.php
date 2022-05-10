<?php 

if ( ! class_exists( 'Rowling_Recent_Comments' ) ) : 
	class Rowling_Recent_Comments extends WP_Widget {

		function __construct() {
			parent::__construct( 'Rowling_Recent_Comments', __( 'Recent Comments', 'rowling' ), array( 
				'classname' 	=> 'Rowling_Recent_Comments', 
				'description' 	=> __( 'Displays recent comments with user avatars.', 'rowling' ) 
			) );
		}
		
		function widget( $args, $instance ) {
		
			// Outputs the content of the widget
			extract( $args ); // Make before_widget, etc available.
			
			$widget_title = isset( $instance['widget_title'] ) ? apply_filters( 'widget_title', $instance['widget_title'] ) : '';
			$number_of_comments = ! empty( $instance['number_of_comments'] ) ? $instance['number_of_comments'] : 5;
			
			echo $before_widget;

			if ( $widget_title ) {
				echo $before_title . $widget_title . $after_title;
			}
			
			?>
			
			<ul class="rowling-widget-list reset-list-style">
				
				<?php
				
				// The query
				$comments_query = new WP_Comment_Query();
				$comments = $comments_query->query( array(
					'number'	=> $number_of_comments,
					'orderby'	=> 'date',
					'status'	=> 'approve',
				) );
				
				// Comment loop
				if ( $comments ) :
					foreach ( $comments as $comment ) : 
					
						?>
					
						<li>
							
							<a href="<?php the_permalink( $comment->comment_post_ID ); ?>#comment-<?php echo $comment->comment_ID; ?>" class="group">
								
								<div class="post-icon">
									<?php echo get_avatar( $comment->comment_author_email, $size = '100' ); ?>
								</div>
								
								<div class="inner">
									<p class="title"><span><?php comment_author( $comment->comment_ID ); ?></span></p>
									<p class="excerpt">"<?php echo esc_html( rowling_get_comment_excerpt( $comment->comment_ID, 13 ) ); ?>"</p>
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
			$instance['number_of_comments'] = intval( $new_instance['number_of_comments'] ) ?: 5;
		
			// Update and save the widget
			return $instance;
			
		}
		
		function form( $instance ) {
			
			// Set defaults
			if ( ! isset( $instance['widget_title'] ) ) $instance['widget_title'] = '';
			if ( empty( $instance['number_of_comments'] ) ) $instance['number_of_comments'] = 5;

			?>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>"><?php  _e( 'Title', 'rowling' ); ?>:
				<input id="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_title' ) ); ?>" type="text" class="widefat" value="<?php echo esc_attr( $instance['widget_title'] ); ?>" /></label>
			</p>
							
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number_of_comments' ) ); ?>"><?php _e( 'Number of comments to display', 'rowling' ); ?>:
				<input id="<?php echo esc_attr( $this->get_field_id( 'number_of_comments' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_comments' ) ); ?>" type="text" class="widefat" value="<?php echo esc_attr( $instance['number_of_comments'] ); ?>" /></label>
				<small>(<?php _e( 'Defaults to 5 if empty', 'rowling' ); ?>)</small>
			</p>
					
			<?php
		}

	}
endif;
