<?php


/* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */

//define('THEME_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/wp-content/themes/RealReality');
define('THEME_URL', get_template_directory_uri());
define('THEME_PT', get_template_directory());
define('THEME_JSF', get_template_directory_uri()."/assets/js/");
define('THEME_CSF', get_template_directory_uri()."/assets/css/");
//No Image THumbnail 
define('No_img', THEME_URL.'/assets/img/noimage.jpg');
define('Wavetemp_img', THEME_URL.'/assets/img/wavetemp.png');
//define('T_V', wp_get_theme( 'rowling' )->get( 'Version' ));
define('T_V', "1.1");
$theme_version = wp_get_theme( 'rowling' )->get( 'Version' );
$theme_version = "3.d";

if ( ! function_exists( 'rowling_setup' ) ) :
	function rowling_setup() {
		
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
		register_nav_menu( 'primary', __( 'Primary Menu', 'rowling' ) );
		register_nav_menu( 'secondary', __( 'Secondary Menu', 'rowling' ) );
		register_nav_menu( 'social', __( 'Social Menu', 'rowling' ) );

		// Custom logo
		add_theme_support( 'custom-logo', array(
			'height'      => 240,
			'width'       => 320,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'blog-title', 'blog-description' ),
		) );
		
		// Make the theme translation ready
		load_theme_textdomain( 'rowling', get_template_directory() . '/languages' );
		
	}
	add_action( 'after_setup_theme', 'rowling_setup' );
endif;


/* ---------------------------------------------------------------------------------------------
   ENQUEUE JAVASCRIPT
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rowling_load_javascript_files' ) ) :
	function rowling_load_javascript_files() { 
		$theme_version = wp_get_theme( 'rowling' )->get( 'Version' );
		$theme_version = "3.5yi";
		wp_register_script( 'rowling_flexslider', THEME_URL.'/assets/js/flexslider.js', '2.4.0');	
		wp_register_script( 'rowling_scrollTo', THEME_URL.'/assets/js/jquery.scrollTo-min.js', '2.4.0');
		wp_register_script( 'rowling_doubletap', THEME_URL.'/assets/js/doubletaptogo.js', $theme_version, true ); 
		wp_register_script( 'rowling_realityplayers', THEME_URL.'/assets/js/RealityMp3s.js', $theme_version);
	    wp_deregister_script('rowling_global');
		wp_enqueue_script( 'rowling_global', THEME_URL.'/assets/js/global.js', array( 'jquery', 'rowling_flexslider', 'rowling_doubletap','rowling_realityplayers','rowling_scrollTo'), $theme_version, false );
		$ajax_data = array(
			'url'   => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce('global-nonce' ),
		);
		wp_localize_script('rowling_global','gajax',$ajax_data);
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

	}
	add_action( 'wp_enqueue_scripts', 'rowling_load_javascript_files' );
endif;

/* ---------------------------------------------------------------------------------------------
   ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rowling_load_style' ) ) :
	function rowling_load_style() {

		if ( is_admin() ) return;
		$dependencies = array();

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google Fonts: on or off', 'rowling' ) ) {

			// Register Google Fonts
			wp_register_style( 'rowling_google_fonts', '//fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic|Merriweather:700,900,400italic' );
			$dependencies[] = 'rowling_google_fonts';

		}

	    wp_register_style( 'rowling_fontawesome', THEME_URL. '/assets/fw/css/all.min.css', array(), '6.0' );

		$dependencies[] = 'rowling_fontawesome';

	    wp_register_style( 'rowling_deeicon', THEME_URL. '/assets/deeicon/css/deeicon.css', array(), '1.0' );

		$dependencies[] = 'rowling_deeicon';

		wp_enqueue_style( 'rowling_style', THEME_URL. '/style.css', $dependencies, T_V);

	}
	add_action( 'wp_print_styles', 'rowling_load_style' );
endif;


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rowling_add_editor_styles' ) ) :
	function rowling_add_editor_styles() {


		add_editor_style( 'assets/css/rowling-classic-editor-styles.css' ); 

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google Fonts: on or off', 'rowling' ) ) {
			$font_url = '//fonts.googleapis.com/css?family=Lato:400,700,900|Playfair+Display:400,700,400italic';
			add_editor_style( str_replace( ', ', '%2C', $font_url ) );
		}

/**
 * Enqueues JavaScript and CSS for the block editor.
 */

}

add_action( 'init', 'rowling_add_editor_styles' );
endif;



/* ---------------------------------------------------------------------------------------------
   ADD WIDGET AREAS
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rowling_sidebar_registration' ) ) :
	function rowling_sidebar_registration() {

		register_sidebar( array(
			'name' 			=> __( 'Sidebar', 'rowling' ),
			'id' 			=> 'sidebar',
			'description' 	=> __( 'Widgets in this area will be shown in the sidebar.', 'rowling' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div></div>'
		) );

	}
	add_action( 'widgets_init', 'rowling_sidebar_registration' ); 
endif;


/* ---------------------------------------------------------------------------------------------
   ADD WIDGET AREAS
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rowling_menu_init' ) ) :
	function rowling_menu_init() {
   /*
   *Add submenu page
   *add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', int $position = null ) */
  wp_enqueue_style( 'Music_Peaks_type_dashcss', THEME_URL.'/assets/form_assets/dashs.css', [],1.6);
  add_submenu_page( "edit.php?post_type=music", "Music Wizard", "<div class='musicss dashicons dashicons-image-filter'>Music Wizard</div>", "manage_options", "edit.php?post_type=music&tab=new",'',3,); }
  add_action('admin_menu', 'rowling_menu_init' );

endif;


/* ---------------------------------------------------------------------------------------------
   INCLUDE REQUIRED FILES
   --------------------------------------------------------------------------------------------- */

// Theme Customizer options.
require get_template_directory() . '/inc/classes/class-rowling-customizer.php';

// Recent Comments widget
require get_template_directory() . '/inc/widgets/recent-comments.php';

// Recent Posts widget
require get_template_directory() . '/inc/widgets/recent-posts.php';


/* ---------------------------------------------------------------------------------------------
   MODIFY WIDGETS
   --------------------------------------------------------------------------------------------- */
 
if ( ! function_exists( 'rowling_unregister_default_widgets' ) ) :
	function rowling_unregister_default_widgets() {

		// Register custom widgets
		register_widget( 'Rowling_Recent_Comments' );
		register_widget( 'Rowling_Recent_Posts' );

		// Unregister replaced widgets
		unregister_widget( 'WP_Widget_Recent_Comments' );
		unregister_widget( 'WP_Widget_Recent_Posts' );

	}
	add_action( 'widgets_init', 'rowling_unregister_default_widgets', 11 );
endif;


/* ---------------------------------------------------------------------------------------------
   CHECK FOR JAVASCRIPT
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rowling_html_js_class' ) ) {
	function rowling_html_js_class () {

		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";

	}
	add_action( 'wp_head', 'rowling_html_js_class', 1 );
}


/* ---------------------------------------------------------------------------------------------
   RELATED POSTS FUNCTION
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rowling_related_posts' ) ) :
	function rowling_related_posts( $number_of_posts = 3 ) { 
		?>
		
		<div class="related-posts">
			
			<p class="related-posts-title"><?php _e( 'Read Next', 'rowling' ); ?> &rarr;</p>
			
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

if ( ! function_exists( 'rowling_archive_navigation' ) ) :
	function rowling_archive_navigation() {

		get_template_part( 'pagination' );

	}
endif;


/* ---------------------------------------------------------------------------------------------
   CUSTOM READ MORE TEXT
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rowling_modify_read_more_link' ) ) :
	function rowling_modify_read_more_link() {

		return '<p><a class="more-link" href="' . get_permalink() . '">' . __( 'Read More', 'rowling' ) . '</a></p>';

	}
	add_filter( 'the_content_more_link', 'rowling_modify_read_more_link' );
endif;


/* ---------------------------------------------------------------------------------------------
   BODY CLASSES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rowling_body_classes' ) ) :
	function rowling_body_classes( $classes ) {
	
		// If has post thumbnail
		if ( is_single() && has_post_thumbnail() ){
			$classes[] = 'has-featured-image';
		}
		
		return $classes;

	}
	add_filter( 'body_class', 'rowling_body_classes' );
endif;


/* ---------------------------------------------------------------------------------------------
   GET COMMENT EXCERPT LENGTH
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rowling_get_comment_excerpt' ) ) :
	function rowling_get_comment_excerpt( $comment_ID = 0, $num_words = 20 ) {

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

if ( ! function_exists( 'rowling_flexslider' ) ) :
	function rowling_flexslider( $size ) {

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

if ( ! function_exists( 'rowling_comment' ) ) :
	function rowling_comment( $comment, $args, $depth ) {

		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		
			<?php __( 'Pingback:', 'rowling' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'rowling' ), '<span class="edit-link">', '</span>' ); ?>
			
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
						<span class="screen-reader-text"><?php _e( 'Comment by post author', 'rowling' ); ?></span>
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
							<div class="fa fw fa-clock-o"></div><a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php echo get_comment_date( get_option( 'date_format' ) ); ?></a>
							<?php edit_comment_link( __( 'Edit', 'rowling' ), '<div class="fa fw fa-wrench"></div>', '' ); ?>
						</div>
						
						<?php if ( '0' == $comment->comment_approved ) : ?>
					
							<div class="comment-awaiting-moderation fright">
								<div class="fa fw fa-exclamation-circle"></div><?php _e( 'Awaiting moderation', 'rowling' ); ?>
							</div>
							
						<?php else :

							comment_reply_link( array( 
								'reply_text' 	=> __( 'Reply', 'rowling' ),
								'depth'			=> $depth, 
								'max_depth' 	=> $args['max_depth'],
								'before'		=> '<div class="fright"><div class="fa fw fa-reply"></div>',
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

if ( ! function_exists( 'rowling_add_block_editor_features' ) ) :
	function rowling_add_block_editor_features() {

		/* Block Editor Features ------------- */

		add_theme_support( 'align-wide' );

		/* Block Editor Palette -------------- */

		$accent_color = get_theme_mod( 'accent_color', '#0093C2' );

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> _x( 'Accent', 'Name of the accent color in the Block Editor palette', 'rowling' ),
				'slug' 	=> 'accent',
				'color' => $accent_color,
			),
			array(
				'name' 	=> _x( 'Black', 'Name of the black color in the Block Editor palette', 'rowling' ),
				'slug' 	=> 'black',
				'color' => '#111',
			),
			array(
				'name' 	=> _x( 'Dark Gray', 'Name of the dark gray color in the Block Editor palette', 'rowling' ),
				'slug' 	=> 'dark-gray',
				'color' => '#333',
			),
			array(
				'name' 	=> _x( 'Medium Gray', 'Name of the medium gray color in the Block Editor palette', 'rowling' ),
				'slug' 	=> 'medium-gray',
				'color' => '#555',
			),
			array(
				'name' 	=> _x( 'Light Gray', 'Name of the light gray color in the Block Editor palette', 'rowling' ),
				'slug' 	=> 'light-gray',
				'color' => '#777',
			),
			array(
				'name' 	=> _x( 'White', 'Name of the white color in the Block Editor palette', 'rowling' ),
				'slug' 	=> 'white',
				'color' => '#fff',
			),
		) );

		/* Block Editor Font Sizes ----------- */

		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' 		=> _x( 'Small', 'Name of the small font size in Block Editor', 'rowling' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the Block Editor.', 'rowling' ),
				'size' 		=> 15,
				'slug' 		=> 'small',
			),
			array(
				'name' 		=> _x( 'Normal', 'Name of the normal font size in Block Editor', 'rowling' ),
				'shortName' => _x( 'N', 'Short name of the normal font size in the Block Editor.', 'rowling' ),
				'size' 		=> 17,
				'slug' 		=> 'normal',
			),
			array(
				'name' 		=> _x( 'Large', 'Name of the large font size in Block Editor', 'rowling' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the Block Editor.', 'rowling' ),
				'size' 		=> 24,
				'slug' 		=> 'large',
			),
			array(
				'name' 		=> _x( 'Larger', 'Name of the larger font size in Block Editor', 'rowling' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the Block Editor.', 'rowling' ),
				'size' 		=> 28,
				'slug' 		=> 'larger',
			),
		) );

	}
	add_action( 'after_setup_theme', 'rowling_add_block_editor_features' );
endif;


/* ---------------------------------------------------------------------------------------------
   BLOCK EDITOR EDITOR STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rowling_block_editor_styles' ) ) :
	function rowling_block_editor_styles() {

		$theme_version = wp_get_theme( 'rowling' )->get( 'Version' );
		$dependencies = array();

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google Fonts: on or off', 'rowling' ) ) {
			wp_register_style( 'rowling-block-editor-styles-font', '//fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic|Merriweather:700,900,400italic', false, 1.0, 'all' );
			$dependencies[] = 'rowling-block-editor-styles-font';
		}

		// Enqueue the editor styles
		wp_enqueue_style( 'rowling-block-editor-styles', get_theme_file_uri( '/assets/css/rowling-block-editor-styles.css' ), $dependencies, $theme_version, 'all' );

	}
	add_action( 'enqueue_block_editor_assets', 'rowling_block_editor_styles', 1 );
endif;

/* ---------------------------------------------------------------------------------------------
   INCLUDE ALL OTHER POST TYPE FUNCTION
   --------------------------------------------------------------------------------------------- */
if ( ! function_exists( 'include_all_cpt' ) ) :
    function include_all_cpt( $query ) {
    if ( is_home() && $query->is_main_query() ) {
        $query->set('post_type', array( 'post', 'music', 'video') );
    }
    }
    add_action('pre_get_posts', 'include_all_cpt');
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
        
        $theme_version = wp_get_theme( 'rowling' )->get( 'Version' );
	    $theme_version = "1.4ui";

		wp_enqueue_script('rowling_formjs', THEME_URL.'/assets/form_assets/js/form.js', ['jquery',], $theme_version);
		wp_enqueue_style( 'rowling_fontawesome',THEME_URL. '/assets/fw/css/all.min.css', [ ], '6.0' );
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

add_action('acf/save_post', 'rowling_new_music_send_email');
  
  function rowling_new_music_send_email( $post_id ) {
  
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
		wp_enqueue_style( 'rowling_fontawesome',THEME_URL. '/assets/fw/css/all.min.css', [ ], '6.0' );
		wp_enqueue_style( 'Music_Plugin_css', THEME_URL.'/assets/css/music_pl_css.css', [], $theme_version); 
		wp_enqueue_script('Music_Plugin_js', THEME_URL.'/assets/js/music_pl.js', ['jquery'], $theme_version);
		wp_localize_script( 'Music_Plugin_js', 'featureid',get_post_thumbnail_id($post)); 
		wp_localize_script( 'Music_Plugin_js', 'featuresrc',get_the_post_thumbnail_url($post,"full")); 
		watermake();
		?>
<!--		<div class="music_pl_b" id="music_pl_b">Custom Music</div>
		<div class="music_pl_ds">
			<div class="inner">
			<div class="close_box" id="close_box">X <p>close</p></div>
			<div class="box" id="wavegenbox">
				<h2 class="til" >Generate waves</h2>
				<div class="box_wave">
					<div class="psection"> <div class="gen_box" id="genwave">Generete</div><div class="mpprogress"> <div class="mpprogress-bar" id="waveprogress">0%</div></div></div>
					<p class="stext">Offline</p>
					<img src="<?php //echo Wavetemp_img; ?>" alt="" style="display:none">
					<div class="mplwave" id="mplwave" style="display:none"></div>
					</div>
				
			</div>
			<div class="box" id="watermakeimg">
			<h2 class="til" >Generate Water Images</h2>
			<div class="box_water">
				<div class="imgbox succ">
				    <img src="<?php //echo No_img; ?>" alt="" class="waterimg" id="waterimg"></div>
				<div class="imgbox">
					<img src="<?php //echo No_img; ?>" alt="" class="waterimg" id="fimg"></div>
				
				<div class="bandp">
				<div class="mpprogress"><div class="mpprogress-bar" id="waterprogress">0%</div></div>
				<div class="gen_box" id="addwaters">Add WaterMark</div>	
				<p class="watertext">generatewaves</p>
				</div>
			</div>
			</div>
		</div>
		</div> --->
		<?php
	   endif;

   endif; 

}
add_action( 'admin_enqueue_scripts', 'loadadmusic');






function AddMusicMata(){
if( function_exists('acf_add_local_field_group') ):
 acf_add_local_field_group(array(
		'key' => 'group_6278856b6038d',
		'title' => 'Music Metas',
		'fields' => array(
			array(
				'key' => 'field_627885d01bd4e',
				'label' => 'music name',
				'name' => 'music_name',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_627886021bd50',
				'label' => 'music genre',
				'name' => 'music_genre',
				'type' => 'taxonomy',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'taxonomy' => 'genre',
				'field_type' => 'checkbox',
				'add_term' => 1,
				'save_terms' => 0,
				'load_terms' => 0,
				'return_format' => 'object',
				'multiple' => 0,
				'allow_null' => 0,
			),
			array(
				'key' => 'field_6278862f1bd52',
				'label' => 'music link',
				'name' => 'music_link',
				'type' => 'url',
				'instructions' => 'separate by commers eg* http;//fhjg.com/ggp.mp3,http;//fhjg.com/ggp.mp3,http;//fhjg.com/ggp.mp3',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_628fe50acd000',
				'label' => 'music peak url',
				'name' => 'music_peak_url',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_6278863e1bd53',
				'label' => 'muisc image',
				'name' => 'muisc_image',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'addwatercon',
					'id' => '',
				),
				'return_format' => 'url',
				'preview_size' => 'full',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array(
				'key' => 'field_62f955f695168',
				'label' => 'apple',
				'name' => 'apple',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_62f9561095169',
				'label' => 'Spotify',
				'name' => 'spotify',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'https://open.spotify.com/',
			),
			array(
				'key' => 'field_62f956259516a',
				'label' => 'Youtube',
				'name' => 'youtube',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_62f956359516b',
				'label' => 'Deezer',
				'name' => 'deezer',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_62f9564a9516c',
				'label' => 'GooglePlay',
				'name' => 'googleplay',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_62f956629516d',
				'label' => 'Amazon',
				'name' => 'amazon',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_62f9566b9516e',
				'label' => 'SoundCloud',
				'name' => 'soundcloud',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_62f956829516f',
				'label' => 'boomplay',
				'name' => 'boomplay',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_62f9569d50915',
				'label' => 'Grove',
				'name' => 'grove',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_62f956ad50916',
				'label' => 'Shazam',
				'name' => 'shazam',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_62f956ca50917',
				'label' => 'Tidal',
				'name' => 'tidal',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_62fcf9c2b0bdd',
				'label' => 'tiktok',
				'name' => 'tiktok',
				'type' => 'text',
				'instructions' => 'separate by commers eg* http;//fhjg.com/ggp.mp3,http;//fhjg.com/ggp.mp3,http;//fhjg.com/ggp.mp3',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_62fcfb15b0bde',
				'label' => 'twitter',
				'name' => 'twitter',
				'type' => 'text',
				'instructions' => 'separate by commers eg* http;//fhjg.com/ggp.mp3,http;//fhjg.com/ggp.mp3,http;//fhjg.com/ggp.mp3',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_6383ae92b26dc',
				'label' => 'artfirstn',
				'name' => 'artfirstn',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_6383ae9bb26dd',
				'label' => 'artlastn',
				'name' => 'artlastn',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_6383aeaab26de',
				'label' => 'audiomacklink',
				'name' => 'audiomacklink',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_6383aeb4b26df',
				'label' => 'descriptionlink',
				'name' => 'descriptionlink',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_6383aed7b26e0',
				'label' => 'facebooklink',
				'name' => 'facebooklink',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_6383aee0b26e1',
				'label' => 'instgramlink',
				'name' => 'instgramlink',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'music',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'format',
			1 => 'categories',
			2 => 'tags',
		),
		'active' => true,
		'description' => '',
	));
endif;
}




function watermake(){
	global $post;
	wp_enqueue_script('Watermaker', THEME_JSF.'watermark.min.js',['jquery',],T_V,true);
	wp_enqueue_script('W_M', THEME_JSF.'WaterUtils.js',['Watermaker','jquery','jquery-ui-draggable'],T_V,true);
	wp_enqueue_style('W_M_CSS', THEME_CSF.'watercss.css', [], T_V);
	wp_localize_script( 'W_M', 'waterlogo', get_custom_logo_url());	
	wp_localize_script('W_M','WAjax', array('url' => admin_url('admin-ajax.php')));
	$arr = [];
	$pid = get_post_thumbnail_id($post); 
	$purl = get_the_post_thumbnail_url($post,"full");
	if (!empty($pid)) {
		$pobj = array("id"=> $pid, "url" => $purl);
		array_push($arr,$pobj);
	}
	//$id = get_post_meta($postID, 'post_views_count', true );
    // first, get the image ID returned by ACF acf[]
	$image_id = get_field('field_6278863e1bd53');
	if (!empty($image_id)) {
	$pobj = array("id"=> $image_id["id"], "url" =>  $image_id["url"]);
	array_push($arr,$pobj );
     } 
	$bgs = count($arr) == 0 ? "none": "flex";
	wp_localize_script( 'W_M', 'wlist', json_encode($arr));	
    wp_localize_script( 'W_M', 'postid', $post->ID);	
    ?>
	<button class="w_tb"  id="w_tb" >
		<div class="in">
			Water Image 
			<span class="badge" style="display:<?php echo $bgs?>"><?php echo count($arr); ?></span>
	    </div>
    </button>
	<div class="w_td"  style="display: none">
		<h2 class="waterh">0/0</h2>
    <div class="w_d_inner">
		<div class="barimg" style="background-image: url('<?php echo get_custom_logo_url();?>');"><div class="barimg-text">0%</div></div>
		<img id="waterimg" src="<?php echo No_img; ?>" alt="">
	</div>
	<button class="w_t_make" id="w_t_make"></button>

	</div>
	
	<?php
}







?>