<?php

/* ---------------------------------------------------------------------------------------------
   CUSTOMIZER SETTINGS
   --------------------------------------------------------------------------------------------- */

if ( ! class_exists( 'Rowling_Customize' ) ) :
	class Rowling_Customize {

		public static function register( $wp_customize ) {

			/* SECTION: ROWLING OPTIONS */

			$wp_customize->add_section( 'rowling_options', array(
				'title' 		=> __( 'Options for Rowling', 'rowling' ),
				'priority' 		=> 10,
				'capability' 	=> 'edit_theme_options',
				'description' 	=> __( 'Allows you to customize theme settings for Rowling.', 'rowling' ),
			) );

			/* SETTING: ACCENT COLOR */

			$wp_customize->add_setting( 'accent_color', array(
				'default' 			=> '#0093C2',
				'type' 				=> 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color'
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'rowling_accent_color', array(
				'label' 	=> __( 'Accent Color', 'rowling' ),
				'section' 	=> 'rowling_options',
				'settings' 	=> 'accent_color',
				'priority' 	=> 10,
			) ) );



			/* SETTING: PRIMARY COLOR */

			$wp_customize->add_setting( 'primary_color', array(
				'default' 			=> '#0093C2',
				'type' 				=> 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color'
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'rowling_primary_color', array(
				'label' 	=> __( 'Primary Color', 'rowling' ),
				'section' 	=> 'rowling_options',
				'settings' 	=> 'primary_color',
				'priority' 	=> 10,
			) ) );
			
			/*Add Google Api Key to Settings */ 
			$wp_customize->add_setting( 'gdrive_api', array(
				'default' 			=> 'bg',
				'type' => 'option',
				'sanitize_callback' => 'sanitize_text'
			) );

           $wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,'rowling_options',
		   array(
          'label' => esc_html__( 'Google Api Key', 'rowling' ),
          'section' => 'rowling_options',
          'type' => 'option',
		  'settings' 	=> 'gdrive_api', ) 
		   ) ); 
		   
		// Sanitize text
		function sanitize_text( $text ) {
			return sanitize_text_field( $text );
		}




			/* SETTING: CUSTOM LOGO */

			// Only display the Customizer section for the rowling_logo setting if it already has a value.
			// This means that site owners with existing logos can remove them, but new site owners can't add them.
			// Since v2.0.0, the core custom_logo setting (in the Site Identity Customizer panel) should be used instead.
			if ( get_theme_mod( 'rowling_logo' ) ) {
				
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rowling_logo', array(
					'label'    => __( 'Logo', 'rowling' ),
					'section'  => 'rowling_options',
					'settings' => 'rowling_logo',
				) ) );
				
				$wp_customize->add_setting( 'rowling_logo', array( 
					'sanitize_callback' => 'esc_url_raw'
				) );

			}
			
		}




		public static function header_output() {

			$accent_default = '#0093C2';
			$accent = get_theme_mod( 'accent_color', $accent_default );

			$primary_default = '#0093C2';
			$primary = get_theme_mod( 'primary_color', $primary_default );
           /**Start Color Contract */ 
			$r = hexdec(substr($accent, 1, 2));
			$g = hexdec(substr($accent, 3, 2));
			$b = hexdec(substr($accent, 5, 2));
			$yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
			$colorcont = ($yiq >= 128) ? 'black' : 'white'; 

			/**Start Color Contract */ 
			$r = hexdec(substr($primary, 1, 2));
			$g = hexdec(substr($primary, 3, 2));
			$b = hexdec(substr($primary, 5, 2));
			$yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
			$precont = ($yiq >= 128) ? 'black' : 'white'; 

            /**End Color Contract */
            $modif = false;
            $modif = ( ! $accent || $accent == $accent_default) ? true : false ;
            $modif = ( ! $primary || $primary == $primary_default) ? true : false ;
			
			if ($modif) return;

			echo '<!-- Customizer CSS -->';
			echo '<style type="text/css">';

			self::generate_css( 'a', 'color', $accent." !important" );

			self::generate_css( '.blog-title a:hover', 'color', $accent );
			self::generate_css( '.navigation .section-inner', 'background-color', $accent );
			self::generate_css( '.primary-menu ul li:hover > a', 'color', $accent );
			self::generate_css( '.search-container .search-button:hover', 'color', $accent );

			self::generate_css( '.sticky .sticky-tag', 'background-color', $accent );
			self::generate_css( '.sticky .sticky-tag:after', 'border-right-color', $accent );
			self::generate_css( '.sticky .sticky-tag:after', 'border-left-color', $accent );
			self::generate_css( '.post-categories', 'color', $accent );
			self::generate_css( '.single .post-meta a', 'color', $accent );
			self::generate_css( '.single .post-meta a:hover', 'border-bottom-color', $accent );
			self::generate_css( '.single-post .post-image-caption .fa', 'color', $accent );
			self::generate_css( '.related-post .category', 'color', $accent );

			self::generate_css( 'p.intro', 'color', $accent );
			self::generate_css( 'blockquote:after', 'color', $accent );
			self::generate_css( 'fieldset legend', 'background-color', $accent );

			self::generate_css( 'button, .button, .faux-button, :root .wp-block-button__link, :root .wp-block-file__button, input[type="button"], input[type="reset"], input[type="submit"]', 'background-color', $accent );

			self::generate_css( 'button, .button, .faux-button, :root .wp-block-button__link, :root .wp-block-file__button, input[type="button"], input[type="reset"], input[type="submit"]', 'color',  $colorcont."!important" );

			self::generate_css( 'button:hover, .button:hover, .faux-button:hover, :root .wp-block-button__link:hover, :root .wp-block-file__button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover', 'background-color', $colorcont."!important"  );
			
			self::generate_css( 'button:hover, .button:hover, .faux-button:hover, :root .wp-block-button__link:hover, :root .wp-block-file__button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover', 'border-color',$accent."!important"  ); 

			self::generate_css( 'button:hover, .button:hover, .faux-button:hover, :root .wp-block-button__link:hover, :root .wp-block-file__button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover', 'color',  $accent."!important" );

			self::generate_css( ':root .has-accent-color', 'color', $accent );
			self::generate_css( ':root .has-accent-background-color', 'background-color', $accent );

			self::generate_css( '.page-edit-link', 'color', $accent );
			self::generate_css( '.post-content .page-links a:hover', 'background-color', $accent );
			self::generate_css( '.post-tags a:hover', 'background-color', $accent );
			self::generate_css( '.post-tags a:hover:before', 'border-right-color', $accent );
			self::generate_css( '.post-navigation h4 a:hover', 'color', $accent );
            self::generate_css( '.music_icon', 'color', $accent );
             self::generate_css( '.music_store_title', 'color', $accent );
            self::generate_css( '.music_icon:hover', 'color', $precont);

			self::generate_css( '.comments-title-container .fa', 'color', $accent );
			self::generate_css( '.comment-reply-title .fa', 'color', $accent );
			self::generate_css( '.comments .pingbacks li a:hover', 'color', $accent );
			self::generate_css( '.comment-header h4 a', 'color', $accent );
			self::generate_css( '.bypostauthor .comment-author-icon', 'background-color', $accent );
			self::generate_css( '.comments-nav a:hover', 'color', $accent );
			self::generate_css( '.pingbacks-title', 'border-bottom-color', $accent );

			self::generate_css( '.archive-title', 'border-bottom-color', $accent );
			self::generate_css( '.archive-nav a:hover', 'color', $accent );

			self::generate_css( '.widget-title', 'border-bottom-color', $accent );	           
			self::generate_css( '.widget-content .textwidget a:hover', 'color', $accent );
			self::generate_css( '.widget_archive li a:hover', 'color', $accent );
			self::generate_css( '.widget_categories li a:hover', 'color', $accent );
			self::generate_css( '.widget_meta li a:hover', 'color', $accent );
			self::generate_css( '.widget_nav_menu li a:hover', 'color', $accent );
			self::generate_css( '.widget_rss .widget-content ul a.rsswidget:hover', 'color', $accent );
			self::generate_css( '#wp-calendar thead th', 'color', $accent );
			self::generate_css( '#wp-calendar tfoot a:hover', 'color', $accent );
			self::generate_css( '.widget .tagcloud a:hover', 'background-color', $accent );
			self::generate_css( '.widget .tagcloud a:hover:before', 'border-right-color', $accent );
			self::generate_css( '.footer .widget .tagcloud a:hover', 'background-color', $accent );
			self::generate_css( '.footer .widget .tagcloud a:hover:before', 'border-right-color', $accent );
			self::generate_css( '.wrapper .search-button:hover', 'color', $accent );

			self::generate_css( '.to-the-top', 'background-color', $accent );
			self::generate_css( '.credits .copyright a:hover', 'color', $accent );
            //Form Css Customizer
			self::generate_css( '#progressbar li.active:before,  #progressbar li.active:after', 'background', $accent );
			self::generate_css( '#msform .action-button', 'background', $accent );
            self::generate_css( '#msform input:focus , #msform textarea:focus', 'outline', ' 1px solid '.$accent );
			self::generate_css( '#msform .action-button:hover, #msform .action-button:focus', 'box-shadow', ' 0 0 0 2px white, 0 0 0 3px'.$accent );

			self::generate_css( '.nav-toggle', 'background-color', $accent );
			self::generate_css( '.mobile-menu', 'background-color', $accent );
            self::generate_css( '.artist-box-contain::after', 'background-color', $accent );
            self::generate_css( '.artist-box-contain::before', 'background-color', $accent );
            self::generate_css( '.outer-artiste::after', 'background-color', $accent );
            self::generate_css( '.outer-artiste::before', 'background-color', $accent );
            self::generate_css( '.music-contain .info', 'background-color', $accent );
            self::generate_css( '.music-contain .download', 'background-color', $accent );
            self::generate_css( '.blog-logo img', 'border-color', $accent );
            self::generate_css( '.head', 'background-color', $accent );
            self::generate_css( '.credits', 'background-color', $accent );
            self::generate_css( '.progress', 'background-color', $accent );
            self::generate_css( '.logo', 'background-color', $accent );
            self::generate_css( '.flexslider .slides .sbox', 'background-color', $accent );
            self::generate_css( '.logo', 'border-color', $accent );
            self::generate_css( '.audio-wapper,.audio', 'background-color', $accent );
            self::generate_css( '.comment-author', 'background-color', $accent );
            self::generate_css( '.audio-wapper,.audio', 'color', $colorcont);
            self::generate_css( '.comment-meta', 'background-color', $accent );
            self::generate_css( '.comment-meta::before', 'border-bottom-color', $accent );
            self::generate_css( '.comment-meta', 'color', $colorcont."!important");
            self::generate_css( '.comment-meta a', 'color', $colorcont."!important");
            self::generate_css( '.metas-item a', 'color', $colorcont."!important");
            self::generate_css( '.social-menu li a', 'background-color', $accent );
            self::generate_css( '.social-menu li a', 'color', $colorcont."!important");
            self::generate_css( '.comment-author a', 'color', $colorcont."!important");
            self::generate_css( '.artchips', 'background-color', $accent );
            self::generate_css( '.artchips a', 'color', $colorcont."!important");
            self::generate_css( '.flexslider .slides a', 'color', $colorcont."!important");
			self::generate_css( '.social-menu li a:hover', 'color', $accent."!important");
            self::generate_css( '.audio-wapper a,.audio a', 'color', $colorcont."!important");
            self::generate_css( '.progressbar', 'background', $precont."!important");
            self::generate_css( '.progress .percent', 'color', $colorcont);
            self::generate_css( '.music-contain .download', 'color', $colorcont."!important");
            self::generate_css( '.music-contain .info a', 'color', $colorcont."!important");
            self::generate_css( '.music-contain .info', 'color', $colorcont."!important");
            self::generate_css( '.credits a ', 'color', $colorcont."!important");
            self::generate_css( '.credits blockquote p', 'color', $accent." !important");
            self::generate_css( '.credits .wp-block-heading', 'color', $colorcont." !important");

            self::generate_css( '.to-the-top .fa', 'color', $primary);
            self::generate_css( '.nav-item > li > a', 'color', $colorcont."!important");
            self::generate_css( '.credits p', 'color', $colorcont."!important");
            self::generate_css( '.post-meta', 'color', $colorcont."!important");
			self::generate_css( '.post-meta a', 'color', $colorcont."!important");
			self::generate_css( '.single-music .post-image .music-metas a', 'color', $colorcont."!important");
			self::generate_css( '.single-music .post-image .music-metas', 'color', $colorcont."!important");
			self::generate_css( '.post-meta', 'background-color', $accent );
            self::generate_css( 'a.comment-reply-link', 'color', $colorcont."!important");
			self::generate_css( 'a.comment-reply-link', 'background-color', $accent );
            self::generate_css( '.post-image', 'color', $colorcont."!important");
			self::generate_css( '.post-image', 'background-color', $accent );
            self::generate_css( 'span.terms a', 'color', $colorcont."!important");
			self::generate_css( 'span.terms a', 'background-color', $accent );
            self::generate_css( '.nav-item ul li', 'background-color', $accent );
			self::generate_css( '.nav-item ul li > a', 'color', $colorcont."!important");
            self::generate_css( 'a.comment-reply-link:hover', 'color', $accent."!important");
			self::generate_css( 'a.comment-reply-link:hover', 'background-color',$colorcont  );
            self::generate_css( 'span.terms a:hover', 'color', $accent."!important");
			self::generate_css( 'span.terms a:hover', 'background-color',$colorcont  );
            self::generate_css( 'span.terms a:hover', 'border-color',$accent  );
            self::generate_css( '.nav-item ul li:hover', 'background-color',$colorcont."!important");
            self::generate_css( '.nav-item ul li:hover > a', 'color',$accent."!important");
            self::generate_css( '.single-post .post-image', 'background-color', $accent );
            self::generate_css( '.single-post .post-image .post-image-caption', 'color', $colorcont."!important");
            self::generate_css( '.single-post .post-image .post-image-caption .fa', 'color', $colorcont."!important");
			self::generate_css( '.nav-item  > li.menu-item-has-children:before,
			.nav-item > li.menu-item-has-children:after', 'border-top-color', $colorcont."!important"); 
            self::generate_css( '.nav-item > li:hover > a', 'color',  $accent."!important");
            self::generate_css( '.nav-more', 'color', $colorcont."!important");
            self::generate_css( '.nav-more:hover', 'color', $precont."!important");			
            self::generate_css( '.to-the-top:hover > .fa', 'color', $colorcont);
            self::generate_css( '.mobile-menu a', 'color', $colorcont."!important");
            self::generate_css( '.nav-toggle .bar', 'background', $colorcont."!important");
            self::generate_css( '.to-the-top', 'border-color', $primary );
            self::generate_css( '.musics', 'background-color', $primary );
            self::generate_css( '.progress svg.progress-circle path', 'stroke', $primary );

			echo '</style>';
			echo '<!--/Customizer CSS-->';
				
		}

		public static function generate_css( $selector, $style, $value, $prefix='', $postfix='', $echo=true ) {
			$return = '';
			if ( $value ) {
				$return = sprintf( '%s { %s:%s; }',
					$selector,
					$style,
					$prefix.$value.$postfix
				);
				if ( $echo ) echo $return;
			}
			return $return;
		}

	}

	add_action( 'customize_register', array( 'Rowling_Customize', 'register' ) );
	add_action( 'wp_head', array( 'Rowling_Customize', 'header_output' ) );

endif;