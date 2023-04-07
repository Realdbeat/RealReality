<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">	
 <meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" >
 <meta name="google-site-verification" content="TY_72icU34pgoz8qjjxTDiW2p95TXcW7-G3X7IXRNl4" />
 <?php wp_head(); ?>
 <!-- Global site tag (gtag.js) - Google Analytics -->
 <script async src="https://www.googletagmanager.com/gtag/js?id=UA-110994211-1"></script>
 <script data-ad-client="ca-pub-6379087110292816" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
 <script>(function(s,u,z,p){s.src=u,s.setAttribute('data-zone',z),p.appendChild(s);})(document.createElement('script'),'https://inklinkor.com/tag.min.js',5855760,document.body||document.documentElement)</script>
 <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-110994211-1');
 </script>
</head>
	
<body <?php body_class(); ?>>
    <?php 
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();  }?>

		<a class="skip-link button" href="#site-content"><?php _e( 'Skip to the content', 'realreality' ); ?></a>
		

		<!-- .navigation -->
		<?php 

$custom_logo_id 	= get_theme_mod( 'custom_logo' );
$legacy_logo_url 	= get_theme_mod( 'realreality_logo' );
$blog_title_elem 	= ( ( is_front_page() || is_home() ) && ! is_page() ) ? 'h1' : 'div';
$blog_title_class 	= $custom_logo_id ? 'blog-logo' : 'blog-title';

$blog_title 		= get_bloginfo( 'title' );
$blog_description 	= get_bloginfo( 'description' );

if ( $custom_logo_id  || $legacy_logo_url ) : 

	$custom_logo_url = $legacy_logo_url ? $legacy_logo_url : wp_get_attachment_image_url( $custom_logo_id, 'small' );
endif;
	?>


<header class="nav-top">
<div class="inner-head">
<div class="logo"><img src="<?php echo esc_url( $custom_logo_url ); ?>"/></div>

<div class="head" id="head">
<div class="nav-toggle">
	<div class="bars">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
    </div>
</div>
 <ul class="nav-item reset-list-style dropdown-menu">
						
						<?php if ( has_nav_menu( 'primary' ) ) {

							$nav_args = array( 
								'container' => '',
								'items_wrap'		=>	'%3$s',
								'theme_location' => 'primary'
							);
																		
							wp_nav_menu( $nav_args ); 
						
						} else {

							$list_pages_args = array(
								'container' => '',
								'title_li' 	=> ''
							);

							wp_list_pages( $list_pages_args );
							
						} ?>
															
					</ul>
</div>

<div class="progress">
  <div class="percent"></div>
  <svg class="progress-circle" width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="xMinYMin meet" class="svg-content">
  <path d="
      M50,1
      a49,49 0 0,1 0,98
      a49,49 0 0,1 0,-98
      "/>
  </svg> 
</div><!-- .progress -->
</div><!-- .inner-head -->

<?php if (has_nav_menu( 'social' ) ) : ?>
		
		<div class="top-nav">
			<?php if ( has_nav_menu( 'social' ) ) : ?>
			
					<ul class="social-menu reset-list-style">
						<?php 
						wp_nav_menu( array(
							'theme_location'	=>	'social',
							'container'			=>	'',
							'container_class'	=>	'menu-social',
							'items_wrap'		=>	'%3$s',
							'menu_id'			=>	'menu-social-items',
							'menu_class'		=>	'menu-items',
							'depth'				=>	1,
							'link_before'		=>	'<span class="screen-reader-text">',
							'link_after'		=>	'</span>',
							'fallback_cb'		=>	'',
						) );
						echo '<li id="menu-item-151" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-151"><a class="search-toggle" href="?s"><span class="screen-reader-text">Search</span></a></li>';
						?>
					</ul><!-- .social-menu -->

				<?php endif; ?>
			
		</div><!-- .top-nav -->
		
<?php endif; ?>
	
	<div class="search-container">
		
		<div class="section-inner">
		
			<?php get_search_form(); ?>
		
		</div><!-- .section-inner -->
		
	</div><!-- .search-container -->



<ul class="mobile-menu reset-list-style">
				
				<?php 
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( $nav_args ); 
				} else {
					wp_list_pages( $list_pages_args );
				}
				?>
				
</ul><!-- .mobile-menu -->


</header>


		<main id="site-content">