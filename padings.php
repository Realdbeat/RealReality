
<div class="chips_artiste">
<?php  $terms = wp_list_pluck( get_the_terms( get_the_ID(), 'artiste' ), 'name');
 $td =  get_the_terms( get_the_ID(), 'artiste' );
  foreach( $td as $term ) {
    $images =  get_term_meta($term->term_id,'ba_artist_image')[0]['url'];
    echo '<a href="/artiste/'.str_replace(' ', '-', $term->term_name).'"><div class="artchips"><div class="chipicon">'.substr($term, 0, 1).'</div>'.$term->term_name.'</div>'.$images.'</a>';
    print_r($td);
  }
  ?>
  </div>







<?php


  
/**
 * Calls the class on the post edit screen

function Music_Peaks_Main(){ return new Music_Peaks_Class(); }

if ( is_admin() )  add_action( 'load-post.php', 'Music_Peaks_Main' );
 */
/** 
 * The Class

class Music_Peaks_Class {
   const LANG = 'Music_Peaks_RealReality';

   public function __construct() {
    add_action( 'add_meta_boxes', array( &$this, 'Music_Peaks_meta_box' ) );
	add_action( 'admin_enqueue_scripts', array( &$this, 'Music_Peaks_editor_styles') );

    }


   public function Music_Peaks_editor_styles(){
	$theme_version = wp_get_theme( 'rowling' )->get( 'Version' );
	$theme_version = "1.3aiwg";
 */
  /**
 * Enqueues JavaScript and CSS for the block editor.


  wp_enqueue_script('Music_Peaks_Wavesurfar', THEME_URL.'/assets/peakscreator/wavesurfer.js',['jquery',],$theme_version, true );
  wp_enqueue_script('Music_Peaks_watermaker', THEME_URL.'/assets/peakscreator/watermark.min.js',['jquery',],$theme_version, true );
  wp_enqueue_script('rowling_scrollTo', THEME_URL.'/assets/js/jquery.scrollTo-min.js', [],$theme_version, true );
  wp_enqueue_script('Music_Peaks_stepbar', THEME_URL.'/assets/peakscreator/stepbar.js',['jquery'],$theme_version, true );
  wp_enqueue_style( 'rowling_fontawesome',THEME_URL. '/assets/fw/css/all.min.css', [ ], '6.0' );
  wp_enqueue_style( 'Music_Peaks_type_css', THEME_URL.'/assets/peakscreator/editor.css', ['rowling_fontawesome'],$theme_version );
  wp_enqueue_script('Music_Peaks', THEME_URL.'/assets/peakscreator/Peakwave.js',[ 'Music_Peaks_Wavesurfar','rowling_scrollTo','jquery','Music_Peaks_watermaker',],$theme_version, true ); 
  wp_localize_script('Music_Peaks','peaksAjax', array('url' => admin_url('admin-ajax.php')));


   }  */
    /**
     * Adds the meta box container

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

     */
    /**
     * Render Meta Box content
 
  public function Music_Peaks_contents(){ ?>
	<div class="peaksmain">
	 <div class="numberpaeks">0/0</div>
     <div id="musicimg" width="100%" height="50px"></div>
     <div class="inputdv">
		<button id="tester">Test Download</button>
	 <button class="button" id="set">Create Peaks Png Images</button></div>
     <div class="imagecom" id="imagecom"> <img src="" alt="" class="doneimg" id="doneimg"/> <i class="fa-solid fa-check"></i></div>
	</div></div> 
   <?php }
}

    */












    



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















$fields = array(
  'field_627885d01bd4e',	// image
  'field_627886021bd50',	// ingredients
  'field_6278862f1bd52',	// directions
  'field_628fe50acd000',	// category
          'field_6278863e1bd53',	// category
          'field_62f955f695168',	//apple
          'field_62f9561095169',	//Spotify
          'field_62f956259516a',	//Youtube
          'field_62f956359516b',	//Deezer
          'field_62f9564a9516c',	//GooglePlay
          'field_62f956629516d',	//Amazon
          'field_62f9566b9516e',	//SoundCloud
          'field_62f956829516f',	//boomplay
          'field_62f9569d50915',	//Grove
         'field_62f956ad50916',	//Shazam
         'field_62f956ca50917',	//Tidal
         'field_62f9569d50915'	//Grove 
 );
acf_register_form(array(
  'id'		    	=> 'new-music',
  'post_id'	    	=> 'new_music',
  'new_post'			=> array(
    'post_type'		=> 'music',
    'post_status'	=> 'draft'
  ),
  'post_title'		=> true,
  'post_content'  	=> true,
  'uploader'      	=> 'basic',
  'return'			=> home_url('thank-your-for-submitting-your-recipe'),
  'fields'				=> $fields,
  'submit_value'		=> 'Submit a New Music!'
  ));
// Load the form
acf_form('new-music');














  
/**
 * Calls the class on the post edit screen



function Water_Mark_Main(){ return new Water_Mark_Class(); }

if ( is_admin() )  add_action( 'load-post.php', 'Water_Mark_Main' );

  /** 
 * The Class
 */

class Water_Mark_Class {
  const LANG = 'Water_Mark_Roling';
  public function __construct() { 
   add_action( 'add_meta_boxes', array( &$this, 'Water_Mark_meta_box' ) );
 add_action( 'admin_enqueue_scripts', array( &$this, 'Water_Mark_editor_styles') );
   }


  public function Water_Mark_editor_styles(){
   /*
   * Enqueues JavaScript and CSS for the block editor.
   */	
    $theme_version = wp_get_theme( 'rowling' )->get( 'Version' );
   $theme_version = "1.3";
    wp_enqueue_script('Water_Mark_watermaker', THEME_URL.'/assets/peakscreator/watermark.min.js',['jquery',],$theme_version, true );
    wp_enqueue_script('Water_Mark_stepbar', THEME_URL.'/assets/peakscreator/stepbar.js',['jquery'],$theme_version, true );
    wp_enqueue_style( 'rowling_fontawesome',THEME_URL. '/assets/fw/css/all.min.css', [ ], '6.0' );
    wp_enqueue_style( 'Water_Mark_type_css', THEME_URL.'/assets/peakscreator/editor.css', ['rowling_fontawesome'],$theme_version );
    wp_enqueue_script('Music_Peaks', THEME_URL.'/assets/peakscreator/water.js',['Water_Mark_stepbar','jquery','Water_Mark_watermaker',],$theme_version, true ); 
    wp_localize_script('Music_Peaks','waterAjax', array('url' => admin_url('admin-ajax.php')));
}


   /**
    * Adds the meta box container
    */



 public function Water_Mark_meta_box(){
       add_meta_box( 
           'Water_Mark_Roling'
           ,__( 'Music Peaks RealReality Headline', self::LANG )
           ,array( &$this, 'Water_Mark_contents' )
           ,'' 
           ,'advanced'
           ,'high');
 }


   /**
    * Render Meta Box content
    */
 public function Water_Mark_contents(){ ?>
 <div class="water">
   <button id="watermark" class="button">Label Featured Image</button>
   </div> 
 <script>
  jQuery(document).on('click', '#watermark', function(){ 	
 alert("<?php echo get_post_thumbnail_id();?>");
  });
 </script>
  <?php }



}

*/







  
/**
 * Calls the class on the post edit screen
 */


 function Water_Mark_Main(){ return new Water_Mark_Class(); }

 if ( is_admin() )  add_action( 'load-post.php', 'Water_Mark_Main' );
 
   /** 
  * The Class
  */
 
 class Water_Mark_Class {
    const LANG = 'Water_Mark_Roling';
    public function __construct() { 
     add_action( 'add_meta_boxes', array( &$this, 'Water_Mark_meta_box' ) );
   add_action( 'admin_enqueue_scripts', array( &$this, 'Water_Mark_editor_styles') );
     }
 
 
    public function Water_Mark_editor_styles(){
     /*
     * Enqueues JavaScript and CSS for the block editor.
     */	
      $theme_version = wp_get_theme( 'rowling' )->get( 'Version' );
     $theme_version = "1.3";
      wp_enqueue_script('Water_Mark_watermaker', THEME_URL.'/assets/peakscreator/watermark.min.js',['jquery',],$theme_version, true );
      wp_enqueue_script('Water_Mark_stepbar', THEME_URL.'/assets/peakscreator/stepbar.js',['jquery'],$theme_version, true );
      wp_enqueue_style( 'rowling_fontawesome',THEME_URL. '/assets/fw/css/all.min.css', [ ], '6.0' );
      wp_enqueue_style( 'Water_Mark_type_css', THEME_URL.'/assets/peakscreator/editor.css', ['rowling_fontawesome'],$theme_version );
      wp_enqueue_script('Music_Peaks', THEME_URL.'/assets/peakscreator/water.js',['Water_Mark_stepbar','jquery','Water_Mark_watermaker',],$theme_version, true ); 
      wp_localize_script('Music_Peaks','waterAjax', array('url' => admin_url('admin-ajax.php')));
  }
 
 
     /**
      * Adds the meta box container
      */
 
 
 
   public function Water_Mark_meta_box(){
         add_meta_box( 
             'Water_Mark_Roling'
             ,__( 'Music Peaks RealReality Headline', self::LANG )
             ,array( &$this, 'Water_Mark_contents' )
             ,'' 
             ,'advanced'
             ,'high');
   }
 
 
     /**
      * Render Meta Box content
      */
   public function Water_Mark_contents(){ ?>
   <div class="water">
     <button id="watermark" class="button">Label Featured Image</button>
     </div> 
   <script>
    jQuery(document).on('click', '#watermark', function(){ 	
   alert("<?php echo get_post_thumbnail_id();?>");
    });
   </script>
    <?php }
 
 if( function_exists('acf_add_local_field_group') ):

  acf_add_local_field_group(array(
    'key' => 'group_640e15180466f',
    'title' => 'mmos_metas',
    'fields' => array(
      array(
        'key' => 'field_640e151f96f44',
        'label' => 'Site Name',
        'name' => 'site_name',
        'type' => 'text',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'aria-label' => '',
        'default_value' => '',
        'maxlength' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
      ),
      array(
        'key' => 'field_640e156b96f45',
        'label' => 'Site Image',
        'name' => 'site_image',
        'type' => 'image',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'aria-label' => '',
        'return_format' => 'url',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
        'preview_size' => 'medium',
      ),
      array(
        'key' => 'field_640e158396f46',
        'label' => 'Site ScreenShot1',
        'name' => 'site_screenshot1',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'aria-label' => '',
        'return_format' => 'url',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
        'preview_size' => 'medium',
      ),
      array(
        'key' => 'field_640e15be96f47',
        'label' => 'Site ScreenShot2',
        'name' => 'site_screenshot2',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'aria-label' => '',
        'return_format' => 'url',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
        'preview_size' => 'medium',
      ),
      array(
        'key' => 'field_640e15f096f48',
        'label' => 'Site Ratings',
        'name' => 'site_ratings',
        'type' => 'number',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'aria-label' => '',
        'default_value' => 5,
        'min' => 0,
        'max' => 5,
        'placeholder' => '',
        'step' => '',
        'prepend' => '',
        'append' => '',
      ),
      array(
        'key' => 'field_640e167496f49',
        'label' => 'Site Link',
        'name' => 'site_link',
        'type' => 'url',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'aria-label' => '',
        'default_value' => '',
        'placeholder' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'mmo',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
  
  endif;
 
 }