<?php 
/**
 * Template Name: Add Music Pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage RealRiality
 * @since 1.2.0
 */
acf_form_head();
get_header(); ?>

<div class="wrapper section-inner group">
<div class="content addmusic">
<?php
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




function np_nullpost(){
	$name = $_REQUEST["title"];
	$content = $_REQUEST["content"];
	if( post_exists($name) == 0 ) {
	$new_post = array(
						'post_title' => $name,
						'post_status'   => 'publish',
						'post_content'   => $content,
						'post_type' => 'music'
						);
						if ($pid = wp_insert_post($new_post)){
						add_post_meta($pid, 'name', $name);
						set_post_thumbnail($pid,$thumbid);
						echo "<div class='updated notice is-dismissible'><h2>succesfully Add Null Post</h2> <p>".$name."</p></div>";	
						} else {echo "<div class='error notice is-dismissible'><h2>Error Adding</h2> <p>".$name."</p></div>"; }
					
					} else { 
					
					echo "<div class='error notice is-dismissible'><h2>Already Exits</h2> <p>".$name."</p></div>";
					
					}	
}

?>



<!-- multistep form -->
<form id="msform">
  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Account Setup</li>
    <li>Social Profiles</li>
    <li>Stores Profiles</li>
    <li>Personal Details</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Your Music Name & Cover</h2>
    <h3 class="fs-subtitle">This is step 1</h3>
	<div class="imgpicker">
	<img id="myprefix-preview-image" src="<?php echo No_img;?>" /> 
	<div class="actions"><i id="addwater" class="fa-solid fa-upload"></i></div>
	<input type="hidden" id="myprefix_image_id" value="<?php //echo esc_attr( $image_id ); ?>" />
    </div>
    <input type="text" name="musicname" id="musicname" placeholder="Music Name" />
    <input type="text" name="musicgenre" placeholder="Music Genre" />
    <input type="text" name="musiclink" placeholder="Music Link EG* https://drive.google.com/dl=773" />
    <textarea name="content" placeholder="Music Words and #tags"></textarea>
    <input type="button" name="next" id="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Stores Profiles</h2>
    <h3 class="fs-subtitle">Your presence on the Stores network</h3>
    <input type="text" name="apple" placeholder="apple" />
    <input type="text" name="Spotify" placeholder="Spotify" />
    <input type="text" name="youtube" placeholder="Youtube" />
    <input type="text" name="deezer" placeholder="Deezer" />
    <input type="text" name="googlePlay" placeholder="GooglePlay" />
    <input type="text" name="spotify" placeholder="Spotify" />
    <input type="text" name="amazon" placeholder="Amazon" />
    <input type="text" name="soundCloud" placeholder="SoundCloud" />
    <input type="text" name="boomplay" placeholder="boomplay" />
    <input type="text" name="grove" placeholder="Grove" />
    <input type="text" name="shazam" placeholder="Shazam" />
    <input type="text" name="tidal" placeholder="Tidal" />
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" id="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Social Profiles</h2>
    <h3 class="fs-subtitle">Your presence on the social network</h3>
    <input type="text" name="twitter" placeholder="Twitter" />
    <input type="text" name="facebook" placeholder="Facebook" />
    <input type="text" name="gplus" placeholder="Google Plus" />
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" id="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Personal Details</h2>
    <h3 class="fs-subtitle">We will never sell it</h3>
    <input type="text" name="fname" placeholder="First Name" />
    <input type="text" name="lname" placeholder="Last Name" />
    <input type="text" name="phone" placeholder="Phone" />
    <textarea name="address" placeholder="Address"></textarea>
    <input type="button" name="previous" id="previous" class="previous action-button" value="Previous" />
    <input type="submit" name="submit" class="submit action-button" value="Submit" />
  </fieldset>
</form>


</div>		
 </div><!-- .content -->

</div><!-- .wrapper -->

<?php get_footer(); ?>