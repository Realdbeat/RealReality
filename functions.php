<?php


/* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */

//define('THEME_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/wp-content/themes/RealReality');
define('THEME_URL', get_template_directory_uri());
define('THEME_PT', get_template_directory());
//No Image THumbnail 
define('No_img', THEME_URL.'/assets/img/noimage.jpg');
define('Wavetemp_img', THEME_URL.'/assets/img/wavetemp.png');
define('Theme_v', "3pi");

if ( ! function_exists( 'realreality_setup' ) ) :
	function realreality_setup() {
		
		// Automatic feed
		add_theme_support( 'automatic-feed-links' );
		
		// Title tag
		add_theme_support( 'title-tag' );
		
		// Add post format support
		add_theme_support( 'post-formats', array( 'gallery' ) );
		
		// Set content-width
		global $content_width;
		if ( ! isset( $content_width ) ) $content_width = 616;

		
		// Post thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size ( 300, 300, true );
		add_image_size( 'post-image', 600, 600 );
		add_image_size( 'post-image-thumb', 400, 250, false );
			
		// Add nav menus
		register_nav_menu( 'primary', __( 'Primary Menu', 'realreality' ) );
		register_nav_menu( 'secondary', __( 'Secondary Menu', 'realreality' ) );
		register_nav_menu( 'social', __( 'Social Menu', 'realreality' ) );

		// Custom logo
		add_theme_support( 'custom-logo', array(
			'height'      => 240,
			'width'       => 320,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'blog-title', 'blog-description' ),
		) );
		
		// Make the theme translation ready
		load_theme_textdomain( 'realreality', get_template_directory() . '/languages' );
		
	}
	add_action( 'after_setup_theme', 'realreality_setup' );
endif;


/* ---------------------------------------------------------------------------------------------
   ENQUEUE JAVASCRIPT
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'realreality_load_javascript_files' ) ) :
	function realreality_load_javascript_files() { 
		$theme_version = wp_get_theme( 'realreality' )->get( 'Version' );
		$theme_version = "3.5yi";
		wp_register_script( 'realreality_flexslider', THEME_URL.'/assets/js/flexslider.js', '2.4.0');	
		wp_register_script( 'realreality_scrollTo', THEME_URL.'/assets/js/jquery.scrollTo-min.js', '2.4.0');
		wp_register_script( 'realreality_doubletap', THEME_URL.'/assets/js/doubletaptogo.js', $theme_version, true );
		wp_register_script( 'realreality_sw', THEME_URL.'/assets/js/sw.js', $theme_version, true ); 
		wp_register_script( 'realreality_realityplayers', THEME_URL.'/assets/js/RealityMp3s.js', $theme_version);
	    wp_deregister_script('realreality_global');
		wp_enqueue_script( 'realreality_global', THEME_URL.'/assets/js/global.js', array( 'jquery', 'realreality_flexslider', 'realreality_doubletap','realreality_realityplayers','realreality_scrollTo'), $theme_version, false );
		$ajax_data = array(
			'url'   => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce('global-nonce' ),
		);
		wp_localize_script('realreality_global','gajax',$ajax_data);
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

	}
	add_action( 'wp_enqueue_scripts', 'realreality_load_javascript_files' );
endif;

/* ---------------------------------------------------------------------------------------------
   ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'realreality_load_style' ) ) :
	function realreality_load_style() {

		if ( is_admin() ) return;
		$dependencies = array();

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google Fonts: on or off', 'realreality' ) ) {

			// Register Google Fonts
			wp_register_style( 'realreality_google_fonts', '//fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic|Merriweather:700,900,400italic' );
			$dependencies[] = 'realreality_google_fonts';

		}

	    wp_register_style( 'realreality_fontawesome', THEME_URL. '/assets/fw/css/all.min.css', array(), '6.0' );

		$dependencies[] = 'realreality_fontawesome';

	    wp_register_style( 'realreality_deeicon', THEME_URL. '/assets/deeicon/css/deeicon.css', array(), '1.0' );

		$dependencies[] = 'realreality_deeicon';

		wp_enqueue_style( 'realreality_style', THEME_URL. '/style.css', $dependencies, Theme_v );

	}
	add_action( 'wp_print_styles', 'realreality_load_style' );
endif;


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'realreality_add_editor_styles' ) ) :
	function realreality_add_editor_styles() {
	// vars
	$theme_version = wp_get_theme( 'realreality' )->get( 'Version' );

		add_editor_style( 'assets/css/realreality-classic-editor-styles.css' ); 

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google Fonts: on or off', 'realreality' ) ) {
			$font_url = '//fonts.googleapis.com/css?family=Lato:400,700,900|Playfair+Display:400,700,400italic';
			add_editor_style( str_replace( ', ', '%2C', $font_url ) );
		}

/**
 * Enqueues JavaScript and CSS for the block editor.
 */

}

add_action( 'init', 'realreality_add_editor_styles' );
endif;



/* ---------------------------------------------------------------------------------------------
   ADD WIDGET AREAS
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'realreality_sidebar_registration' ) ) :
	function realreality_sidebar_registration() {

		register_sidebar( array(
			'name' 			=> __( 'Sidebar', 'realreality' ),
			'id' 			=> 'sidebar',
			'description' 	=> __( 'Widgets in this area will be shown in the sidebar.', 'realreality' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div></div>'
		) );

	}
	add_action( 'widgets_init', 'realreality_sidebar_registration' ); 
endif;


/* ---------------------------------------------------------------------------------------------
   ADD WIDGET AREAS
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'realreality_menu_init' ) ) :
	function realreality_menu_init() {
   /*
   *Add submenu page
   *add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', int $position = null ) */
  wp_enqueue_style( 'Music_Peaks_type_dashcss', THEME_URL.'/assets/form_assets/dashs.css', [],1.6);
  
  add_submenu_page( "edit.php?post_type=music", "Music Wizard", "<div class='musicss dashicons dashicons-image-filter'>Music Wizard</div>", "manage_options", "edit.php?post_type=music&tab=new",'',3); 
	    
	}
  
  add_action('admin_menu', 'realreality_menu_init' );

endif;


/* ---------------------------------------------------------------------------------------------
   INCLUDE REQUIRED FILES
   --------------------------------------------------------------------------------------------- */

// Theme Customizer options.
require get_template_directory() . '/inc/classes/class-realreality-customizer.php';

// Recent Comments widget
require get_template_directory() . '/inc/widgets/recent-comments.php';

// Recent Posts widget
require get_template_directory() . '/inc/widgets/recent-posts.php';


/* ---------------------------------------------------------------------------------------------
   MODIFY WIDGETS
   --------------------------------------------------------------------------------------------- */
 
if ( ! function_exists( 'realreality_unregister_default_widgets' ) ) :
	function realreality_unregister_default_widgets() {

		// Register custom widgets
		register_widget( 'realreality_Recent_Comments' );
		register_widget( 'realreality_Recent_Posts' );

		// Unregister replaced widgets
		unregister_widget( 'WP_Widget_Recent_Comments' );
		unregister_widget( 'WP_Widget_Recent_Posts' );

	}
	add_action( 'widgets_init', 'realreality_unregister_default_widgets', 11 );
endif;


/* ---------------------------------------------------------------------------------------------
   CHECK FOR JAVASCRIPT
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'realreality_html_js_class' ) ) {
	function realreality_html_js_class () {

		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";

	}
	add_action( 'wp_head', 'realreality_html_js_class', 1 );
}


/* ---------------------------------------------------------------------------------------------
   RELATED POSTS FUNCTION
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'realreality_related_posts' ) ) :
	function realreality_related_posts( $number_of_posts = 3 ) { 
		?>
		
		<div class="related-posts">
			
			<p class="related-posts-title"><?php _e( 'Read Next', 'realreality' ); ?> &rarr;</p>
			
			<div class="row">
							
				<?php

				global $post;

				// Base args, used for both the term query and random query
				$base_args = array(
					'ignore_sticky_posts'	=>	true,
					'meta_key'				=>	'_thumbnail_id',
					'posts_per_page'		=>	$number_of_posts,
					'post_status'			=>	'publish',
					'post__not_in'			=>	array( $post->ID ),	
				);

				// Create a query for posts in the same category as the ones for the current post
				$cat_ids = array();

				$categories = get_the_category();

				foreach( $categories as $category ) {
					$cat_ids[] = $category->cat_ID;
				}

				$term_posts_args = array_merge( $base_args, array( 'category__in' => $cat_ids ) );
				
				$related_posts = get_posts( $term_posts_args );

				// No results for the categories? Get random posts instead
				if ( ! $related_posts ) :

					$random_posts_args = array_merge( $base_args, array( 'orderby' => 'rand' ) );

					$related_posts = get_posts( $random_posts_args );

				endif;

				// If either the category query or random query hit pay dirt, output the posts
				if ( $related_posts ) :
					
					foreach( $related_posts as $related_post ) : ?>
				
						<a class="related-post" href="<?php echo get_the_permalink( $related_post->ID ); ?>">
							
							<?php if ( has_post_thumbnail( $related_post->ID ) ) : ?>
								
								<?php echo get_the_post_thumbnail( $related_post->ID, 'post-image-thumb' ) ?>
								
							<?php endif; ?>
							
							<p class="category">
								<?php 
								$category = get_the_category( $related_post->ID ); 
								echo $category[0]->cat_name;
								?>
							</p>
					
							<h3 class="title"><?php echo get_the_title( $related_post->ID ); ?></h3>
								
						</a>
					
						<?php 

					endforeach;
				
				endif;
				
				?>
			
			</div><!-- .row -->

		</div><!-- .related-posts -->
		
		<?php

	}
endif;


/* ---------------------------------------------------------------------------------------------
   ARCHIVE NAVIGATION
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'realreality_archive_navigation' ) ) :
	function realreality_archive_navigation() {

		get_template_part( 'pagination' );

	}
endif;


/* ---------------------------------------------------------------------------------------------
   CUSTOM READ MORE TEXT
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'realreality_modify_read_more_link' ) ) :
	function realreality_modify_read_more_link() {

		return '<p><a class="more-link" href="' . get_permalink() . '">' . __( 'Read More', 'realreality' ) . '</a></p>';

	}
	add_filter( 'the_content_more_link', 'realreality_modify_read_more_link' );
endif;


/* ---------------------------------------------------------------------------------------------
   BODY CLASSES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'realreality_body_classes' ) ) :
	function realreality_body_classes( $classes ) {
	
		// If has post thumbnail
		if ( is_single() && has_post_thumbnail() ){
			$classes[] = 'has-featured-image';
		}
		
		return $classes;

	}
	add_filter( 'body_class', 'realreality_body_classes' );
endif;


/* ---------------------------------------------------------------------------------------------
   GET COMMENT EXCERPT LENGTH
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'realreality_get_comment_excerpt' ) ) :
	function realreality_get_comment_excerpt( $comment_ID = 0, $num_words = 20 ) {

		$comment = get_comment( $comment_ID );
		$comment_text = strip_tags( $comment->comment_content );
		$blah = explode( ' ', $comment_text );

		if ( count( $blah ) > $num_words ) {
			$k = $num_words;
			$use_dotdotdot = 1;
		} else {
			$k = count( $blah );
			$use_dotdotdot = 0;
		}

		$excerpt = '';

		for ( $i = 0; $i < $k; $i++ ) {
			$excerpt .= $blah[$i] . ' ';
		}

		$excerpt .= ( $use_dotdotdot ) ? '...' : '';

		return apply_filters( 'get_comment_excerpt', $excerpt );

	}
endif;


/* ---------------------------------------------------------------------------------------------
   FLEXSLIDER FUNCTION
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'realreality_flexslider' ) ) :
	function realreality_flexslider( $size ) {

		$attachment_parent = is_page() ? $post->ID : get_the_ID();

		$images = get_posts( array(
			'numberposts'    => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_mime_type' => 'image',
			'post_parent'    => $attachment_parent,
			'post_status'    => null,
			'post_type'      => 'attachment',
		) );

		if ( ! $images ) return;
		
		?>
		
		<?php if ( ! is_single() ) : // Make it a link if it's an archive ?>
			<a class="flexslider" href="<?php the_permalink(); ?>">
		<?php else : // ...and just a div if it's a single post ?>
			<div class="flexslider">
		<?php endif; ?>
		
		<ul class="slides reset-list-style">

			<?php foreach ( $images as $image ) :

				$attimg = wp_get_attachment_image( $image->ID, $size ); 

				if ( ! $attimg ) continue;
				
				?>
				
				<li>
					<?php 
					
					echo $attimg;

					if ( ! empty( $image->post_excerpt ) && is_single() ) : ?>
						<p class="post-image-caption"><span class="fa fw fa-camera"></span><?php echo $image->post_excerpt; ?></p>
					<?php endif; ?>
				</li>
				
			<?php endforeach; ?>

		</ul><!-- .slides -->
		
		<?php 
		echo ! is_single() ? '</a>' : '</div>';

	}
endif;


/* ---------------------------------------------------------------------------------------------
   COMMENT FUNCTION
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'realreality_comment' ) ) :
	function realreality_comment( $comment, $args, $depth ) { 

		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		
			<?php __( 'Pingback:', 'realreality' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'realreality' ), '<span class="edit-link">', '</span>' ); ?>
			
		</li>
		<?php
				break;
			default :
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		
			<div id="comment-<?php comment_ID(); ?>" class="comment">
				
				<?php echo get_avatar( $comment, 160 ); ?>
				
				<?php if ( $comment->user_id === $post->post_author ) : ?>
						
					<a class="comment-author-icon" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<div class="fa fw fa-user"></div>
						<span class="screen-reader-text"><?php _e( 'Comment by post author', 'realreality' ); ?></span>
					</a>
				
				<?php endif; ?>
				
				<div class="comment-inner">
				
					<div class="comment-header">
												
						<h4><?php echo get_comment_author_link(); ?></h4>
					
					</div><!-- .comment-header -->
					
					<div class="comment-content post-content entry-content">
				
						<?php comment_text(); ?>
						
					</div><!-- .comment-content -->
					
					<div class="comment-meta group">
						
						<div class="fleft">
							<div class="fa fw fa-clock-o"></div><a class="comment-date-link dee" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php echo get_comment_date( get_option( 'date_format' ) ); ?></a>
							<?php edit_comment_link( __( 'Edit', 'realreality' ), '<div class="fa fw fa-wrench"></div>', '' ); ?>
						</div>
						
						<?php if ( '0' == $comment->comment_approved ) : ?>
					
							<div class="comment-awaiting-moderation fright">
								<div class="fa fw fa-exclamation-circle"></div><?php _e( 'Awaiting moderation', 'realreality' ); ?>
							</div>
							
						<?php else :

							comment_reply_link( array( 
								'reply_text' 	=> __( 'Reply', 'realreality' ),
								'depth'			=> $depth, 
								'max_depth' 	=> $args['max_depth'],
								'before'		=> '<div class="fright"><div class="cf fa fw fa-reply"></div>',
								'after'			=> '</div>'
							) ); 
							
						endif; ?>
						
					</div><!-- .comment-meta -->
									
				</div><!-- .comment-inner -->
											
			</div><!-- .comment-## -->
					
		<?php
			break;
		endswitch;

	}
endif;


/* ---------------------------------------------------------------------------------------------
   SPECIFY BLOCK EDITOR SUPPORT
------------------------------------------------------------------------------------------------ */

if ( ! function_exists( 'realreality_add_block_editor_features' ) ) :
	function realreality_add_block_editor_features() {

		/* Block Editor Features ------------- */

		add_theme_support( 'align-wide' );

		/* Block Editor Palette -------------- */

		$accent_color = get_theme_mod( 'accent_color', '#0093C2' );

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> _x( 'Accent', 'Name of the accent color in the Block Editor palette', 'realreality' ),
				'slug' 	=> 'accent',
				'color' => $accent_color,
			),
			array(
				'name' 	=> _x( 'Black', 'Name of the black color in the Block Editor palette', 'realreality' ),
				'slug' 	=> 'black',
				'color' => '#111',
			),
			array(
				'name' 	=> _x( 'Dark Gray', 'Name of the dark gray color in the Block Editor palette', 'realreality' ),
				'slug' 	=> 'dark-gray',
				'color' => '#333',
			),
			array(
				'name' 	=> _x( 'Medium Gray', 'Name of the medium gray color in the Block Editor palette', 'realreality' ),
				'slug' 	=> 'medium-gray',
				'color' => '#555',
			),
			array(
				'name' 	=> _x( 'Light Gray', 'Name of the light gray color in the Block Editor palette', 'realreality' ),
				'slug' 	=> 'light-gray',
				'color' => '#777',
			),
			array(
				'name' 	=> _x( 'White', 'Name of the white color in the Block Editor palette', 'realreality' ),
				'slug' 	=> 'white',
				'color' => '#fff',
			),
		) );

		/* Block Editor Font Sizes ----------- */

		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' 		=> _x( 'Small', 'Name of the small font size in Block Editor', 'realreality' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the Block Editor.', 'realreality' ),
				'size' 		=> 15,
				'slug' 		=> 'small',
			),
			array(
				'name' 		=> _x( 'Normal', 'Name of the normal font size in Block Editor', 'realreality' ),
				'shortName' => _x( 'N', 'Short name of the normal font size in the Block Editor.', 'realreality' ),
				'size' 		=> 17,
				'slug' 		=> 'normal',
			),
			array(
				'name' 		=> _x( 'Large', 'Name of the large font size in Block Editor', 'realreality' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the Block Editor.', 'realreality' ),
				'size' 		=> 24,
				'slug' 		=> 'large',
			),
			array(
				'name' 		=> _x( 'Larger', 'Name of the larger font size in Block Editor', 'realreality' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the Block Editor.', 'realreality' ),
				'size' 		=> 28,
				'slug' 		=> 'larger',
			),
		) );

	}
	add_action( 'after_setup_theme', 'realreality_add_block_editor_features' );
endif;


/* ---------------------------------------------------------------------------------------------
   BLOCK EDITOR EDITOR STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'realreality_block_editor_styles' ) ) :
	function realreality_block_editor_styles() {

		$theme_version = wp_get_theme( 'realreality' )->get( 'Version' );
		$dependencies = array();

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google Fonts: on or off', 'realreality' ) ) {
			wp_register_style( 'realreality-block-editor-styles-font', '//fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic|Merriweather:700,900,400italic', false, 1.0, 'all' );
			$dependencies[] = 'realreality-block-editor-styles-font';
		}

		// Enqueue the editor styles
		wp_enqueue_style( 'realreality-block-editor-styles', get_theme_file_uri( '/assets/css/realreality-block-editor-styles.css' ), $dependencies, $theme_version, 'all' );

	}
	add_action( 'enqueue_block_editor_assets', 'realreality_block_editor_styles', 1 );
endif;

/* ---------------------------------------------------------------------------------------------
   INCLUDE ALL OTHER POST TYPE FUNCTION
   --------------------------------------------------------------------------------------------- */
if ( ! function_exists( 'include_all_cp' ) ) :
    function include_all_cp( $query ) {
    if ( is_home() && $query->is_main_query() ) {
        $query->set('post_type', array( 'post', 'music', 'video','mmo') );
    }
    }
    add_action('pre_get_posts', 'include_all_cp');
    function exclude_single_posts_archive($query) {
	if ($query->is_archive() && $query->is_main_query()) {
		 $query->set('post__not_in', array(4605));
	 }
    }
    add_action('pre_get_posts', 'exclude_single_posts_archive');

endif;

/* ---------------------------------------------------------------------------------------------
   COUSTOM PAGE NAVI FUNCTION
   --------------------------------------------------------------------------------------------- */
function custom_page_navi( $totalpages=null, $page=null, $end_size=null, $mid_size=null ) {
	$bignum = 999999999;

	if ( $totalpages <= 1 || $page > $totalpages ) return;

	return paginate_links( array(
		'base'          => str_replace( $bignum, '%#%', esc_url( get_pagenum_link( $bignum ) ) ),
		'format'        => '',
		'current'       => max( 1, $page ),
		'total'         => $totalpages,
		'prev_text'     => 'Prev',
		'next_text'     => 'Next',
		'type'          => 'list',
		'show_all'      => false,
		'end_size'      => $end_size,
		'mid_size'      => $mid_size
	) );
}


/* ---------------------------------------------------------------------------------------------
   CUSTOM POSTVIEWS FUNCTIONS
   --------------------------------------------------------------------------------------------- */

function customSetPostViews($postID) {
    $countKey = 'post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '1');
    }else{
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}

function getPostViews($postID) {
 $post_views_count = get_post_meta($postID, 'post_views_count', true );
 // Check if the custom field has a value.
 $counts = ( !empty( $post_views_count ) ) ?  $post_views_count : 0 ; ?>
 <?php if ( get_post_type() == 'music' ) :  ?>
 <span  class="countview"><?php echo $counts; ?><i class="fa fa-headphones-simple"></i></span>
 <span  class="viewtype m"><?php echo get_post_type(); ?><i class="fa fa-music"></i></span>
 <?php endif ?>
 <?php if ( get_post_type() == 'post' ) :  ?>
 <span class="countview"><?php echo $counts; ?><i class="fa fa-eye"></i></span>
 <span  class="viewtype p"><?php echo get_post_type(); ?><i class="fa fa-gem"></i></span>
 <?php endif ?>
 <?php if ( get_post_type() == 'video' ) :  ?>
 <span class="countview"><?php echo $counts; ?><i class="fa fa-eye"></i></span>
 <span  class="viewtype v"><?php echo get_post_type(); ?><i class="fa fa-video"></i></span>
 <?php endif ?>
 <?php if ( get_post_type() == 'mmo' ) :  ?>
 <span class="countview"><i class="fa fa-eye"></i><?php echo $counts; ?></span>
 <span  class="viewtype m"><?php echo get_post_type(); ?><i class="fa fa-mouse-pointer"></i></span>
 <?php endif ?>
 
 <?php
}
/**
 * End Custom PostViews
 */



/* ---------------------------------------------------------------------------------------------
   POST REACTION ELEMENTS FUNCTIONS
   --------------------------------------------------------------------------------------------- */
if ( ! function_exists( 'set_like_func' ) ) :
	function set_like_func() {
		$countKey = (isset($_POST['type'])) ? $_POST['type'] : "love";
		$postIDs = (isset($_POST['postsid'])) ? $_POST['postsid'] : 1;
		$count = get_post_meta($postIDs, $countKey, true);
		if($count==''){
			$count = 0;
			delete_post_meta($postIDs, $countKey);
			add_post_meta($postIDs, $countKey, '1');
			$count = 1;
		}else{
			$count++;
			update_post_meta($postIDs, $countKey, $count);
		} 
		
		wp_send_json_success($count);
		wp_die();
	}
	add_action( 'wp_ajax_nopriv_set_like_func', 'set_like_func' );
	add_action( 'wp_ajax_set_like_func', 'set_like_func' );
	endif;



    function getlikes($postID,$type) {
	$counts = get_post_meta($postID, $type, true );  
	echo $counts = ( !empty( $counts ) ) ?  $counts : 0 ;
 }


    function gettotallikes($postID) {
	$love = get_post_meta($postID, "love", true );  
	$wow = get_post_meta($postID, "wow", true );  
	$sad = get_post_meta($postID, "sad", true );
	$counts = (int)$love + (int)$wow + (int)$sad;
	echo ( !empty( $counts ) ) ?  $counts : "0" ;
 }

add_filter('manage_music_posts_columns', 'bs_table_head');
 function bs_table_head( $defaults ) {
    $defaults['love']  = 'Love';
    $defaults['wow']    = 'Wow';
    $defaults['sad']   = 'Sad';
    return $defaults;
};
add_action( 'manage_music_posts_custom_column', 'bs_table_content', 10, 2 );
 function bs_table_content( $column_name, $post_id ) {
    if ($column_name == 'love') {
	echo get_post_meta( $post_id, 'love', true ); 
    };

    if ($column_name == 'wow') {
	echo get_post_meta( $post_id, 'wow', true ); 
    };

    if ($column_name == 'sad') {
    echo get_post_meta( $post_id, 'sad', true );
    };

}

/**
 * End  Post Reaction Elements
 */



 /* ---------------------------------------------------------------------------------------------
      REGISTER AJAX CALL CREATE PEAKS New Compalete Pack And Water Image Creator 100%
    --------------------------------------------------------------------------------------------- */
   function gdrivegetname(){
   require_once THEME_PT.'/inc/mp_ass/gdrivefilename.php';
   }
   add_action('wp_ajax_gdrivegetname','gdrivegetname' );

   function generatewaves(){
	require_once THEME_PT.'/inc/mp_ass/savewavejs.php';	
   }
   add_action('wp_ajax_generatewaves','generatewaves' );
   add_action('wp_ajax_nopriv_generatewaves','generatewaves' );

   function downloadmp3(){
	require_once THEME_PT.'/inc/mp_ass/remote_dl.php';
   }
   add_action('wp_ajax_downloadmp3','downloadmp3' );

   function uploadimgs(){
	require_once THEME_PT.'/inc/mp_ass/upload_media.php';	
   }
   add_action('wp_ajax_uploadimgs','uploadimgs' );

   function replaceimgs(){
	require_once THEME_PT.'/inc/mp_ass/cwimg.php';	
   }
   add_action('wp_ajax_replaceimgs','replaceimgs' );

   function showapi(){
	return get_option('gdrive_api') ? get_option('gdrive_api') :"No api code or null";
   }


   function addwizmusic(){
	require_once THEME_PT.'/inc/mp_ass/addwizmusic.php';	
   }
   add_action('wp_ajax_addwizmusic','addwizmusic' );




/* ---------------------------------------------------------------------------------------------
  MUSIC PAGE EDITIING SCRIPTS AND FUNTIONS
   --------------------------------------------------------------------------------------------- */


function musicload_admin_scripts($hook) {
	
		/**
		* Enqueues JavaScript and CSS for the block editor.
		*/
        
        $theme_version = wp_get_theme( 'realreality' )->get( 'Version' );
	    $theme_version = "1.4ui";

		wp_enqueue_script('realreality_formjs', THEME_URL.'/assets/form_assets/js/form.js', ['jquery',], $theme_version);
		wp_enqueue_style( 'realreality_fontawesome',THEME_URL. '/assets/fw/css/all.min.css', [ ], '6.0' );
		wp_enqueue_style( 'Music_Peaks_type_css2', THEME_URL.'/assets/form_assets/form.css', [], $theme_version); 
		wp_enqueue_script('Music_Peaks_watermaker', THEME_URL.'/assets/mp_ass/js/watermark.min.js',['jquery',],$theme_version, true );
		 wp_enqueue_script('Music_Peaks_Wavesurfar', THEME_URL.'/assets/mp_ass/js/wavesurfer.js',['jquery',],$theme_version, true ); 
		 wp_enqueue_script('Music_Peaks_stepbar', THEME_URL.'/assets/mp_ass/js/stepbar.js',['jquery'],$theme_version, true );
		  wp_enqueue_style( 'Music_Peaks_type_css', THEME_URL.'/assets/mp_ass/css/editor.css', [],$theme_version );
		  wp_enqueue_script('Music_Peaks', THEME_URL.'/assets/mp_ass/js/Peakwave.js',[ 'Music_Peaks_Wavesurfar','jquery','Music_Peaks_watermaker','Music_Peaks_stepbar',],$theme_version, true ); 
		  wp_localize_script('Music_Peaks','peaksAjax', array('url' => admin_url('admin-ajax.php')));
		  wp_localize_script( 'Music_Peaks', 'm_waterlogo', get_custom_logo_url());	 
		  wp_enqueue_media();
		if(is_admin() && $hook == 'post-new.php' || $hook == 'post.php') { 
			wp_localize_script( 'Music_Peaks', 'jsadmin',"admin"); 
		}elseif(is_admin() && $_GET['tab'] == "new"){
			wp_localize_script( 'Music_Peaks', 'jsadmin', "wiz"); 
		}else{ wp_localize_script( 'Music_Peaks', 'jsadmin', "wiz"); };
		  ?>
     <div class="loading_pin"><div class="loadinner"><div class="loadtext">
	  <h2 class="loadtexth"></h2>
	  <p class="loadtextm"></p>
	  <div id="e1"></div>
      <!----Start Peak Display---->	
	  <div class="peaksmain">
       <div id="musicimg" width="100%" height="50px"></div>
       <div class="imagecom" id="imagecom"> <img src="" alt="" class="doneimg" id="doneimg"/> <i class="fa-solid fa-check"></i></div>
	  </div></div> 
      <!---End Peak Display----->	
	   </div> </div> </div>	
	   <div class="loading_pinc">
       <div class="circle_loder"><div class="circle_inner"></div></div>
       <div class="ctext" id="ctext">Now Loading Functions</div>
       </div>	  
       <?php		  
} 

function admin_music_wiz(){

	   if (isset($_GET['tab'])) :
		if ($_GET['tab'] == "new") :
			do_action('musicload_admin_scripts');
		require_once( get_template_directory().'/AddMusics.php' );
		endif;
	   endif; 
	}
	add_action( 'admin_enqueue_scripts', 'admin_music_wiz');




    /* ---------------------------------------------------------------------------------------------
      Get Site Logo Or Set Null
      --------------------------------------------------------------------------------------------- */
function get_custom_logo_url(){
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	$p_img = ( $image[0] !== "" ) ? $image[0] : No_img;
    return $p_img;
}

//End Peaks Script






/* ---------------------------------------------------------------------------------------------
   WHEN THEME GET ACTIVATED CREATE NEW PAGE FOR USERS
   --------------------------------------------------------------------------------------------- */
if (isset($_GET['activated']) && is_admin()){
	Newpage();
	AddMusicMata();
}



function Newpage(){
    $userpages = array("DashBoard","UserProfile","AddMusics","Creations");

	foreach ($userpages as $pnames) {
		# code... 
	$p_title = $pnames;
    $p_content = '';
    $p_template = $pnames.".php"; //ex. template-custom.php. Leave blank if you don't want a custom page template.
  
    //don't change the code bellow, unless you know what you're doing
  
    $page_check = get_page_by_title($p_title);
    $new_page = array(
        'post_type' => 'page',
        'post_title' => $p_title,
        'post_content' => $p_content,
        'post_status' => 'publish',
        'post_author' => 1,
    );
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post($new_page);
        if(!empty($p_template)){
            update_post_meta($new_page_id, '_wp_page_template', $p_template);
        }
    }
	}//End For Eachs

  
}

function dashboard_scripts() {
 if (is_page_template( 'DashBoard.php' ) ): ?>
    <script>alert("Welcome to DashBoard");</script>
  <?php 
 endif;


 if (is_page_template( 'UserProfile.php' ) ): ?>
    <script>alert("Welcome to UserProfile");</script>
  <?php 
 endif;


 if (is_page_template( 'AddMusics.php' ) ):
	do_action('musicload_admin_scripts');
 endif;

 if (is_page_template( 'Creations.php' ) ): ?>
    <script>alert("Welcome to Creations");</script>
  <?php 
 endif;

}
add_action( 'wp_enqueue_scripts', 'dashboard_scripts' );

add_action('acf/save_post', 'realreality_new_music_send_email');
  
  function realreality_new_music_send_email( $post_id ) {
  
	  if( get_post_type($post_id) !== 'music' && get_post_status($post_id) == 'draft' ) {
		  return;
	  }
  
	  if( is_admin() ) {
		  return;
	  }
  
	  $post_title = get_the_title( $post_id );
	  $post_url 	= get_permalink( $post_id );
	  $subject 	= "A New Music Has Been Added to Your Site";
	  $message 	= "Please Review the recipe before publishing:\n\n";
	  $message   .= $post_title . ": " . $post_url;
  
	  $administrators 	= get_users(array(
		  'role'	=> 'administrator'
	  ));
  
	  foreach ($administrators as &$administrator) {
		  wp_mail( $administrator->data->user_email, $subject, $message );
	  }
  
  }  

  /* 
    add_action('after_setup_theme', 'remove_admin_bar');
    function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
	show_admin_bar(false);
    }
    }

    //Disable WordPress Admin Bar for all users 
     add_filter( 'show_admin_bar', '__return_false' );
*/


add_action( 'musicload_admin_scripts', 'musicload_admin_scripts');
function loadadmusic( $hook ) { 
   global $post;
   if ( $hook == 'post-new.php' || $hook == 'post.php' ) :	
	   if ( 'music' === $post->post_type ):
	    $theme_version = "0.03wi";
		wp_enqueue_style( 'realreality_fontawesome',THEME_URL. '/assets/fw/css/all.min.css', [ ], '6.0' );
		wp_enqueue_style( 'Music_Plugin_css', THEME_URL.'/assets/css/music_pl_css.css', [], $theme_version); 
		wp_enqueue_script('Music_Plugin_js', THEME_URL.'/assets/js/music_pl.js', ['jquery'], $theme_version);
		wp_localize_script( 'Music_Plugin_js', 'featureid',get_post_thumbnail_id($post)); 
		wp_localize_script( 'Music_Plugin_js', 'featuresrc',get_the_post_thumbnail_url($post,"full")); 
		?>
		<div class="music_pl_b" id="music_pl_b">Custom Music</div>
		<div class="music_pl_ds" style="display:none">
			<div class="inner">
			<div class="close_box" id="close_box">X <p>close</p></div>
			<div class="box" id="wavegenbox">
				<h2 class="til" >Generate waves</h2>
				<div class="box_wave">
					<div class="psection"> <div class="gen_box" id="genwave">Generete</div><div class="mpprogress"> <div class="mpprogress-bar" id="waveprogress">0%</div></div></div>
					<p class="stext">Offline</p>
					<img src="<?php echo Wavetemp_img; ?>" alt="" style="display:none">
					<div class="mplwave" id="mplwave" style="display:none"></div>
					</div>
				
			</div>
			<div class="box" id="watermakeimg">
			<h2 class="til" >Generate Water Images</h2>
			<div class="box_water">
				<div class="imgbox succ">
				    <img src="<?php echo No_img; ?>" alt="" class="waterimg" id="waterimg"></div>
				<div class="imgbox">
					<img src="<?php echo No_img; ?>" alt="" class="waterimg" id="fimg"></div>
				
				<div class="bandp">
				<div class="mpprogress"><div class="mpprogress-bar" id="waterprogress">0%</div></div>
				<div class="gen_box" id="addwaters">Add WaterMark</div>	
				<p class="watertext">generatewaves</p>
				</div>
			</div>
			</div>
		</div>
		</div>
		<?php
	   endif;

   endif; 

}
add_action( 'admin_enqueue_scripts', 'loadadmusic');








/* ---------------------------------------------------------------------------------------------
   ADD cptui_register_my_cpts
   --------------------------------------------------------------------------------------------- */

/* ---------------------------------------------------------------------------------------------
   ADD cptui_register_my_taxes
   --------------------------------------------------------------------------------------------- */

/* ---------------------------------------------------------------------------------------------
   MMOS FUNCTIONS
   --------------------------------------------------------------------------------------------- */
function get_mmos($post){
	$data = [];
   $site_img = (!get_the_post_thumbnail_url() == false ) ? get_the_post_thumbnail_url() : get_field('site_image');
   $site_img = (empty($site_img)) ? No_img : $site_img;
   $name = get_field('site_name');
   $shot1 = get_field('site_screenshot1');
   $rating = get_field('site_ratings');
   $shot2 = get_field('site_screenshot2');
   $link = get_field('site_link'); 
   $data = ["site_img"=>$site_img,"name"=>$name,"shot1"=>$shot1,"shot2"=>$shot2,"link"=>$link,"rating"=>$rating];
   return $data;
}

function get_music($post){
   $data = [];
   $arts = get_the_term_list( $post, 'artiste', '', ' &nbsp Ft. &nbsp','' ); 
   $arts =  (empty($arts)) ? $arts : 'Unknow Artiste';
   $cover = (!get_the_post_thumbnail_url() == false ) ? get_the_post_thumbnail_url() : get_field('muisc_image');
   $genre = get_field('music_genre');
   $genres = ""; 
   if($genre) {foreach($genre as $t) { $genres = $genres." ".$t->name; } }else{$genres = "Unknow Genre"; }; 
   $cover  = (empty($cover )) ? No_img : $cover;
   $name = get_field('music_name');
   $name = (empty($name)) ? "Unknow Name" : $name;
   $download = get_field('download');
   $download = (empty($download)) ? "0" : $download;
   $peak = get_field('music_peak_url');
   $peak = (empty($peak)) ? Wavetemp_img : $peak;
   $link = get_field('music_link'); 
   $data = ["arts"=>$arts,"cover"=>$cover,"name"=>$name,"download"=>$download,"link"=>$link,"genre"=>$genres,"peak"=>$peak,];
   return $data;
}

function get_p_terms($post,$types,$name){ ?>
 <div class="chips_artiste">
  <?php	
  $terms =  get_the_terms($post, $types);
  if(!empty($terms)): ?>

  <a href="#" class="hd"><div class="artchips artchips_head">
  <p><?php echo $name; ?></p><div class="chipicon hd"></div></div></a>

  <?php foreach ($terms as $term){ 
   $ch = get_term_meta($term->term_id,'ba_artist_image');
   $image = empty($ch) ? No_img  : $ch[0]['url'] ; ?>
    <a href="/artiste/<?php echo $term->slug ?>">
   <div class="artchips">
	   <div class="chipicon">
	   <?php //echo	substr($term->name, 0, 1) ?>
	   <img src="<?php echo $image?>">
	   </div>
   <p><?php echo	$term->name ?></p>
   </div>
   </a>

<?php } endif; ?>

</div>
<?php }; 


function cptui_register_my_cpts() {

	/**
	 * Post Type: Musics.
	 */

	$labels = [
		"name" => esc_html__( "Musics", "realreality" ),
		"singular_name" => esc_html__( "Music", "realreality" ),
	];

	$args = [
		"label" => esc_html__( "Musics", "realreality" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "music",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => "musics",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "music", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-format-audio",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "comments", "author", "page-attributes", "post-formats" ],
		"taxonomies" => [ "artiste", "album", "genre" ],
		"show_in_graphql" => false,
	];

	register_post_type( "music", $args );

	/**
	 * Post Type: Videos.
	 */

	$labels = [
		"name" => esc_html__( "Videos", "realreality" ),
		"singular_name" => esc_html__( "Video", "realreality" ),
	];

	$args = [
		"label" => esc_html__( "Videos", "realreality" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "video", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-format-video",
		"supports" => [ "title", "editor", "thumbnail" ],
		"taxonomies" => [ "category", "post_tag", "artiste", "album", "genre" ],
		"show_in_graphql" => false,
	];

	register_post_type( "video", $args );

	/**
	 * Post Type: MmOs.
	 */

	$labels = [
		"name" => esc_html__( "MmOs", "realreality" ),
		"singular_name" => esc_html__( "Mmo", "realreality" ),
	];

	$args = [
		"label" => esc_html__( "MmOs", "realreality" ),
		"labels" => $labels,
		"description" => "Make Money Online Post. Post Only legit money making Platforms and Offers",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "mmo", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-money-alt",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "comments", "post-formats" ],
		"taxonomies" => [ "category", "post_tag" ],
		"show_in_graphql" => false,
	];

	register_post_type( "mmo", $args );
}
add_action( 'init', 'cptui_register_my_cpts' );


function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Artistes.
	 */

	$labels = [
		"name" => esc_html__( "Artistes", "realreality" ),
		"singular_name" => esc_html__( "Artiste", "realreality" ),
	];

	
	$args = [
		"label" => esc_html__( "Artistes", "realreality" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'artiste', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "artiste",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "artiste", [ "music" ], $args );

	/**
	 * Taxonomy: albums.
	 */

	$labels = [
		"name" => esc_html__( "albums", "realreality" ),
		"singular_name" => esc_html__( "album", "realreality" ),
	];

	
	$args = [
		"label" => esc_html__( "albums", "realreality" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'album', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "album",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "album", [ "music" ], $args );

	/**
	 * Taxonomy: genres.
	 */

	$labels = [
		"name" => esc_html__( "genres", "realreality" ),
		"singular_name" => esc_html__( "genre", "realreality" ),
	];

	
	$args = [
		"label" => esc_html__( "genres", "realreality" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'genre', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "genre",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "genre", [ "music" ], $args );


	/**
	 * Taxonomy: mmotypes.
	 */

	$labels = [
		"name" => __( "mmotypes", "realreality" ),
		"singular_name" => __( "mmotype", "realreality" ),
	];

	
	$args = [
		"label" => __( "mmotypes", "realreality" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'mmotype', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "mmotype",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "mmotype", [ "mmo" ], $args );



}
add_action( 'init', 'cptui_register_my_taxes' );


?>