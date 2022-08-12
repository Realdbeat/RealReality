<?php


/* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */

define('THEME_URL', get_template_directory_uri());
//No Image THumbnail 

define('No_img', THEME_URL.'/assets/img/noimage.jpg');

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
		$theme_version = "3.5dd";
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

		$theme_version = wp_get_theme( 'rowling' )->get( 'Version' );
		$theme_version = "1.3et";
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

	    wp_register_style( 'rowling_fontawesome', get_template_directory_uri() . '/assets/fw/css/all.min.css', array(), '6.0' );

		$dependencies[] = 'rowling_fontawesome';

	    wp_register_style( 'rowling_video-js', get_template_directory_uri() . '/assets/css/video-js.css', array(), '6.0' );

		$dependencies[] = 'rowling_video-js';

		wp_enqueue_style( 'rowling_style', get_stylesheet_uri(), $dependencies, $theme_version );

	}
	add_action( 'wp_print_styles', 'rowling_load_style' );
endif;


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rowling_add_editor_styles' ) ) :
	function rowling_add_editor_styles() {
	// vars
	$theme_version = wp_get_theme( 'rowling' )->get( 'Version' );

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

//Custom function added
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




function custom_page_navi( $totalpages=null, $page=null, $end_size=null, $mid_size=null )
{
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





/**
 * Make Ajax Call Gos Public Save For Later
add_action( 'wp_ajax_nopriv_rwpeaks', 'rowling_rwpeaks' );
add_action( 'wp_ajax_nopriv_dlpeaks', 'rowling_dlpeaks' );

 */




/*

add_action( 'post_submitbox_misc_actions', 'custom_button' );

function custom_button(){
        $html  = '<div id="major-publishing-actions" style="overflow:hidden">';
        $html .= '<div id="publishing-action">';
        $html .= '<input type="submit" accesskey="p" tabindex="5" value="Customize Me!" class="button-primary" id="custom" name="publish">';
        $html .= '</div>';
        $html .= '</div>';
        echo $html;
}

*/







/**
 * Calls the class on the post edit screen
 */
function Music_Peaks_Main(){ return new Music_Peaks_Class(); }

if ( is_admin() )  add_action( 'load-post.php', 'Music_Peaks_Main' );

/** 
 * The Class
 */
class Music_Peaks_Class {
   const LANG = 'Music_Peaks_RealReality';

   public function __construct() {
    add_action( 'add_meta_boxes', array( &$this, 'Music_Peaks_meta_box' ) );
	add_action( 'admin_enqueue_scripts', array( &$this, 'Music_Peaks_editor_styles') );
	add_action('wp_ajax_dlwater',array( &$this, 'rowling_dlwater') );
    add_action('wp_ajax_rwpeaks',array( &$this, 'rowling_rwpeaks') );
    add_action('wp_ajax_dlpeaks',array( &$this, 'rowling_dlpeaks') );
    }



  #Register Ajax Call Create Peaks
  public function rowling_rwpeaks(){
   require get_template_directory().'/assets/peakscreator/savewavejs.php';	
  }
   public function rowling_dlpeaks(){
	require get_template_directory().'/assets/peakscreator/remote_dl.php';	
  }
   public function rowling_dlwater(){
	require get_template_directory().'/assets/peakscreator/upload_media.php';	
  }

   public function Music_Peaks_editor_styles(){
	$theme_version = wp_get_theme( 'rowling' )->get( 'Version' );
	$theme_version = "1.4vf";

  /**
 * Enqueues JavaScript and CSS for the block editor.
  */

  wp_enqueue_script('Music_Peaks_Wavesurfar', THEME_URL.'/assets/peakscreator/wavesurfer.js',['jquery',],$theme_version, true );
  wp_enqueue_script('Music_Peaks_watermaker', THEME_URL.'/assets/peakscreator/watermark.min.js',['jquery',],$theme_version, true );
  wp_enqueue_script('rowling_scrollTo', THEME_URL.'/assets/js/jquery.scrollTo-min.js', [],$theme_version, true );
  wp_enqueue_script('Music_Peaks_stepbar', THEME_URL.'/assets/peakscreator/stepbar.js',['jquery'],$theme_version, true );
  wp_enqueue_style( 'rowling_fontawesome',THEME_URL. '/assets/fw/css/all.min.css', [ ], '6.0' );
  wp_enqueue_style( 'Music_Peaks_type', THEME_URL.'/assets/peakscreator/editor.css', ['rowling_fontawesome'],$theme_version );
  wp_enqueue_script('Music_Peaks_type', THEME_URL.'/assets/peakscreator/Musicpeak.js',[ 'Music_Peaks_Wavesurfar','rowling_scrollTo','jquery','Music_Peaks_watermaker',],$theme_version, true ); 
  wp_localize_script('Music_Peaks_type','EpeaksAjax', array('ajaxurl' => admin_url('admin-ajax.php')));


   }
    /**
     * Adds the meta box container
     */
    public function Music_Peaks_meta_box()
    {
        add_meta_box( 
             'Music_Peaks_RealReality'
            ,__( 'Music Peaks RealReality Headline', self::LANG )
            ,array( &$this, 'Music_Peaks_contents' )
            ,'music' 
            ,'advanced'
            ,'high'
        );
    }


    /**
     * Render Meta Box content
     */
    public function Music_Peaks_contents(){ ?>
     <div class="peaksmain">
	 <div class='loading_pin'>Loading...</div>
     <div id="musicimg" width="100%" height="50px"></div>
     <div class="inputdv">
     <div class="button" id="set">Create Peaks Png Images</div>
     </div><div id="e1"></div>
     <div class="imagecom" id="imagecom">
	 <img src="" alt="" class="doneimg" id="doneimg">
	 <i class="fa-solid fa-check"></i></div>
	 <div class='addwater' id='addwater'><i class='fa-solid fa-edit'></i>Add Water Marks</div></div>
	   
	<?php }
}


/**
 * Custom PostViews
 */


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
<?php endif ?>
<?php if ( get_post_type() == 'post' ) :  ?>
<span class="countview"><?php echo $counts; ?><i class="fa fa-eye"></i></span>
<?php endif ?>
<?php
}
/**
 * End Custom PostViews
 */



/**
 * Post Reaction Elements
 */

/**Set Likes Function Add Version 1.3 */
add_action( 'wp_ajax_nopriv_set_like_func', 'set_like_func' );
add_action( 'wp_ajax_simple_set_like_func', 'set_like_func' );
function set_like_func() {
    $countKey = (isset($_POST['type'])) ? $_POST['type'] : "love";
	$postIDs = (isset($_POST['postsid'])) ? $_POST['postsid'] : 1;
    $count = get_post_meta($postIDs, $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postIDs, $countKey);
        add_post_meta($postIDs, $countKey, '1');
    }else{
        $count++;
        update_post_meta($postIDs, $countKey, $count);
    } 
	
	wp_send_json_success($count);
	wp_die();
}


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

?>