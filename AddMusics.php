<?php 
ob_start();
/**
 * Template Name: Add Music Pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage RealRiality
 * @since 1.2.0
 */
?>
<?php
if(is_admin()) { echo "<div class='overad'>"; }else{
    wp_head();
    acf_form_head(); }; ?>
<div class="musicbar">
    <div class="btns home" onclick="history.back()"><i class="fa-solid fa-house-fire"></i></div>
    <div class="btns cancle" onclick="history.back()"><i class="fa-solid fa-eject"></i></div>
</div>
<form id="musics">
 <div class="courses-container">
    <fieldset> <!--Artiste Stage Name-->    
        <div class="course">
            <div class="course-preview"> 
                <i class="fa-solid fa-microphone"  ></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        1/23 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 8</h6>
                <h2>Artiste Stage Name</h2>
                <div class="linkhelp" id="tesa">
                    <p><i class="fa-solid fa-microphone" ></i></p>
                    <input type="text" id="artstagename" vname="Artiste Name"  name="artstagename" placeholder="eg* Realdbeat" >
                </div>
                <div class="btnp">
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset> <!--Artiste Real Name-->     
        <div class="course">
            <div class="course-preview"> 
                <i class="fa-solid fa-address-card"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        3/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 9</h6>
                <h2>Artiste Real Name</h2>
                <div class="linkhelp">
                    <p><i class="fa-solid fa-address-card"></i></p>
                    <input type="text" id="artfirstn" vname="First Name"  name="artfirstn" placeholder="eg* Amos">
                    <input type="text" id="artlastn"  vname="Last Name"  name="artlastn" placeholder="eg* Don">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>  <!--Facebook Link-->       
        <div class="course">
            <div class="course-preview"> 
                <i class="fab fa-facebook"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        1/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 2</h6>
                <h2>Facebook Profile & Page Link</h2>
                <div class="linkhelp">
                    <p><i class="fab fa-facebook"></i></p>
                    <p class="foll">https://www.facebook.com/</p>
                    <input type="text" id="facebooklink"  vname="Facebook Link"  name="facebooklink" placeholder="eg* Realdbeat">
                </div>
                <div class="btnp">
                    <div class="btn skipso">Skip Socials</div>
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>  <!--Twitter Link-->       
        <div class="course">
            <div class="course-preview"> 
                    <i class="fab fa-instagram"></i> 
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        2/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 3</h6>
                <h2>Instagram Link</h2>
                <div class="linkhelp">
                    <p><i class="fab fa-instagram"></i> </p>
                    <p class="foll">https://www.instagram.com/</p>
                    <input type="text" id="twitterlink" vname="Twitter Link"  name="twitterlink" placeholder="eg* Realdbeat">
                </div>
                <div class="btnp">
                <div class="btn previous">Back</div>
                <div class="btn next">Skip</div>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset>  <!--Instgram link-->       
        <div class="course">
            <div class="course-preview"> 
                    <i class="fab fa-twitter"></i> 
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        3/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 5</h6>
                <h2>Twitter Link</h2>
                <div class="linkhelp">
                    <p><i class="fab fa-twitter"></i></p>
                    <p class="foll">https://www.Instgram.com/</p>
                    <input type="text" id="instgramlink"  vname="Instgram Link"  name="instgramlink" placeholder="eg* Realdbeat">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>   <!--Tiktok link-->      
        <div class="course">
            <div class="course-preview"> 
                    <i class="fab fa-tiktok"></i> 
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        3/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 6</h6>
                <h2>Tiktok Link</h2>
                <div class="linkhelp">
                    <p><i class="fab fa-tiktok"></i></p>
                    <p class="foll">https://www.tiktok.com/</p>
                    <input type="text" id="tiktoklink" vname="Tiktok Link"  name="tiktoklink" placeholder="eg* Realdbeat">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset id="startmusic"> <!--music Name-->     
        <div class="course">
            <div class="course-preview"> 
                <i class="fa-solid fa-signature"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        3/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 7</h6>
                <h2>Music Names</h2>
                <div class="linkhelp">
                    <p>Music Name</p>
                    <input type="text" id="musiclink"  vname="Music Link"  name="musiclink" placeholder="eg* Erima">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset> <!--music cover-->       
        <div class="course">
            <div class="course-preview"> 
                    <img src="cover.jpg" alt="" srcset="">
                    <i class="fa-solid fa-camera"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        0/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 1</h6>
                <h2>Music Cover Link Or File</h2>
                <div class="linkhelp">
                 <p><i class="fa-solid fa-link"></i></p>
                <input type="text" id="musiccoverlink" vname="Music Cover Link"  name="musiccoverlink" placeholder="eg* https://gasgjgfaskjf.com/gshgsh.jpg">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                <div class="btn next">Skip</div></div>
            </div>
        </div>
    </fieldset>
    <fieldset>    <!--music genre-->     
        <div class="course">
            <div class="course-preview"> 
                <i class="fa-solid fa-dna"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        3/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 9</h6>
                <h2>music genre</h2>
                <div class="linkhelp">
                    <p><i class="fa-solid fa-dna"></i></p>
                    <input type="text" id="musicgenre"  vname="Music Genre"  name="musicgenre" placeholder="eg* Amos">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>    <!--Music Download Url-->     
        <div class="course">
            <div class="course-preview"> 
                <i class="fa fa-download"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        3/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 9</h6>
                <h2>Music Url or Google drive link</h2>
                <div class="linkhelp">
                    <p> <i class="fa fa-download"></i></p>
                    <input type="text" id="downloadklink"  vname="Music Download Url"  name="downloadklink" placeholder="eg* https://gasgjgfaskjf.com/gshgsh.mp3">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>    <!--music peak url-->     
        <div class="course">
            <div class="course-preview"> 
                <i class="fa-solid fa-file-waveform"  id="gcpeak"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        3/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 9</h6>
                <h2>music peak url</h2>
                <div class="linkhelp">
                    <p><i class="fa-solid fa-file-waveform"></i></p> 
                    <img id="musicpeakurl" src="<?php echo Wavetemp_img; ?>" alt="" srcset="">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>  <!--Apple Link-->       
        <div class="course">
            <div class="course-preview"> 
                <i class="fab fa-app-store"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        1/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 2</h6>
                <h2>Apple Music Link || Profile </h2>
                <div class="linkhelp">
                    <p><i class="fab fa-app-store"></i></p>
                    <input type="text" id="applelink" vname="Apple Link"  name="applelink" placeholder="eg* https://music.apple.com/us/album/infinity-feat-omah-lay/1530136977?i=1530136980">
                </div>
                <div class="btnp">
                    <div class="btn skipstore">Skip Stores</div>
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>  <!--Spotify Link-->       
        <div class="course">
            <div class="course-preview"> 
                <i class="fab fa-spotify"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        1/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 2</h6>
                <h2>Spotify Music Link || Profile </h2>
                <div class="linkhelp">
                    <p><i class="fab fa-spotify"></i></p>
                    <input type="text" id="spotifylink"  vname="Spotify Link"  name="spotifylink" placeholder="eg* https://open.spotify.com/track/5DS9LiyEdw2zY8bM6kjjgM">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>  <!--Youtube Link-->       
        <div class="course">
            <div class="course-preview"> 
                <i class="fab fa-youtube"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        1/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 2</h6>
                <h2>Youtube Music Link || Profile </h2>
                <div class="linkhelp">
                    <p><i class="fab fa-youtube"></i></p>
                    <input type="text" id="youtubelink"  vname="Youtube Link"  name="youtubelink" placeholder="eg* https://music.youtube.com/watch?v=SVgKjicBXwI">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>  <!--Deezer Link-->       
        <div class="course">
            <div class="course-preview"> 
                <i class="fab fa-deezer"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        1/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 2</h6>
                <h2>Deezer Music Link || Profile </h2>
                <div class="linkhelp">
                    <p><i class="fab fa-deezer"></i></p>
                    <input type="text" id="deezerlink" vname="Deezer Link"  name="deezerlink" placeholder="eg* https://www.deezer.com/track/1068382592">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>  <!--GooglePlay Link-->       
        <div class="course">
            <div class="course-preview"> 
                <i class="fab fa-google-play"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        1/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 2</h6>
                <h2>GooglePlay Music Link || Profile </h2>
                <div class="linkhelp">
                    <p><i class="fab fa-google-play"></i></p>
                    <input type="text" id="googleplaylink" vname="GooglePlay Link"  name="googleplaylink" placeholder="eg* https://www.googleplay.com/track/1068382592">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>  <!--Amazon Link-->       
        <div class="course">
            <div class="course-preview"> 
                <i class="fab fa-amazon"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        1/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 2</h6>
                <h2>Amazon Music Link || Profile </h2>
                <div class="linkhelp">
                    <p><i class="fab fa-amazon"></i></p>
                    <input type="text" id="amazonlink" vname="Amazon Link"  name="amazonlink" placeholder="eg* https://www.Amazon.com/track/1068382592">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>  <!--SoundCloud Link-->       
        <div class="course">
            <div class="course-preview"> 
                <i class="fab fa-soundcloud"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        1/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 2</h6>
                <h2>SoundCloud Music Link || Profile </h2>
                <div class="linkhelp">
                    <p><i class="fab fa-soundcloud"></i></p>
                    <input type="text" id="soundcloudlink" vname="SoundCloud Link"  name="soundcloudlink" placeholder="eg* https://www.SoundCloud.com/track/1068382592">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>  <!--boomplay Link-->       
        <div class="course">
            <div class="course-preview"> 
                <i class="icon-boomplay"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        1/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 2</h6>
                <h2>boomplay Music Link || Profile </h2>
                <div class="linkhelp">
                    <p><i class="icon-boomplay"></i></p>
                    <input type="text" id="boomplaylink" vname="boomplay Link"  name="boomplaylink" placeholder="eg* https://www.boomplay.com/track/1068382592">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>  <!--Grove Link-->       
        <div class="course">
            <div class="course-preview"> 
                <i class="icon-Grove"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        1/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 2</h6>
                <h2>Grove Music Link || Profile </h2>
                <div class="linkhelp">
                    <p><i class="icon-Grove"></i></p>
                    <input type="text" id="grovelink" vname="Grove Link"  name="grovelink" placeholder="eg* https://www.Grove.com/track/1068382592">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>  <!--Shazam Link-->       
        <div class="course">
            <div class="course-preview"> 
                <i class="icon-Shazam"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        1/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 2</h6>
                <h2>Shazam Music Link || Profile </h2>
                <div class="linkhelp">
                    <p><i class="icon-Shazam"></i></p>
                    <input type="text" id="shazamlink" vname="Shazam Link"  name="shazamlink" placeholder="eg* https://www.Shazam.com/track/1068382592">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>  <!--Tidal Link-->       
        <div class="course">
            <div class="course-preview"> 
                <i class="icon-tidal"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        1/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 2</h6>
                <h2>Tidal Music Link || Profile </h2>
                <div class="linkhelp">
                    <p><i class="icon-tidal"></i></p>
                    <input type="text" id="tidallink" vname="Tidal Link"  name="tidallink" placeholder="eg* https://www.Tidal.com/track/1068382592">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset>  <!--Audiomack Link--> 
        <div class="course">
            <div class="course-preview"> 
                <i class="icon-audiomack"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        1/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 2</h6>
                <h2>Audiomack Music Link || Profile </h2>
                <div class="linkhelp">
                    <p><i class="icon-audiomack"></i></p>
                    <input type="text" id="audiomacklink" vname="Audiomack Link"  name="audiomacklink" placeholder="eg* https://www.Audiomack.com/track/1068382592">
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <div class="btn next">Skip</div>
                    </div>
            </div>
        </div>
    </fieldset>
    <fieldset id="musicstoreend">    <!--Music Description-->     
        <div class="course">
            <div class="course-preview"> 
                <i class="fa-solid fa-feather"></i>
            </div>
            <div class="course-info">
                <div class="progress-container">
                    <div class="progress"> <div class="progress-bar"></div></div>
                    <span class="progress-text">
                        3/3 Steps
                    </span>
                </div>
               <h6 class="steps_field">Step 9</h6>
                <h2>Music Description</h2>
                <div class="linkhelp">
                    <p><i class="fa-solid fa-feather"></i></p>
                    <textarea type="text" id="descriptionlink" vname="Music Description"  name="descriptionlink" placeholder="eg* https://gasgjgfaskjf.com/gshgsh.mp3"></textarea>
                </div>
                <div class="btnp">
                    <div class="btn previous">Back</div>
                    <button class="btn done" id="submitall" vname="Submit Button"  name="submitall">Submit Music</button>
                    </div>
            </div>
        </div>
    </fieldset>
</div>
</form> 

<?php if(is_admin()) {   echo "</div>"; };?>


