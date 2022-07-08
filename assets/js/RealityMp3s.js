jQuery(document).ready(function($) {  
    (function(d) {
  processClips(); 
   function processClips() {
      clips = jQuery('audio');
      clips.activeClip = "";
           for (var i = clips.length - 1; i >= 0; i--) {
            processProgressBar(clips[i]);
            processResetButton(clips[i]);
            processPlayPauseDiv(clips[i]);
            processClip(clips[i]);
        }
 }

   function processProgressBar(clip) {
       var ids = clip.id[clip.id.length-1];
      var progress = jQuery('[id="progress'+ids+'"]')[0]; 
          
           progress.rect = progress.getBoundingClientRect();
           progress.clip = clip;
           clip.progress = progress;

           progress.onclick = function(xy) {
               processClickTouch(xy, this);
           }

           progress.ontouchstart = function(xy) {
               processClickTouch(xy, this);
           }

           function processClickTouch(mouseEvent, progressBar) {
               progressBar.clip.currentTime =
                   progressBar.clip.duration *
                   ((mouseEvent.clientX -
                       progressBar.rect.left) /
                   (progressBar.rect.right - progressBar.rect.left));
           }
       }

   function processResetButton(clip) {
    var ids = clip.id[clip.id.length-1];
    var resetButton = jQuery('[id="stop-btn'+ids+'"]')[0];
           resetButton.clip = clip;
           
           resetButton.onclick = function(mouseEvent) {
            clip.currentTime = 0;
            clip.pause();
           var pb = d.getElementById("playb0");
            pb.classList.remove("pause");
            pb.classList.add("play");
            //console.log(pb);
           }
       }

   function processPlayPauseDiv(clip) {
    var ids = clip.id[clip.id.length-1];
    var playPauseDiv =  jQuery('#playb'+ids)[0];
           playPauseDiv.clip = clip;
           clip.playPauseDiv = playPauseDiv;

  playPauseDiv.onclick = function(mouseEvent) { 
            if (this.classList.contains("pause")) {
                    clip.pause();
                    this.classList.remove("pause");
                    this.classList.add("play");
               } else {

                if (typeof(clips.activeClip.id) != "undefined") {
                var ids = clips.activeClip.id[clips.activeClip.id.length-1];
                var playPauseDiv =  jQuery('#playb'+ids)[0];
                    playPauseDiv.classList.remove("pause");
                    playPauseDiv.classList.add("play");
                    clips.activeClip.pause();

                }

                    clip.play();
                    this.classList.remove("play");
                    this.classList.add("pause");
               }
           }
       }


   function processClip(clip) {  
  clip.ontimeupdate = function() {
    var ids = clip.id[clip.id.length-1]; 
               var id = this.id;
               var progress = (this.currentTime / this.duration) * 100; 
               jQuery('#progressbar'+ids)[0].style.width = progress + '%';
               if (this.currentTime == this.duration) {
                   this.currentTime = 0;
                   jQuery('#progressbar'+ids)[0].style.width = "0%";

                   this.playPauseDiv.classList.add("play");
               } 


           }

           clip.onpause = function() {
               clips.activeClip = "";
               this.classList.add("play");

           }

           clip.onplay = function() {
               clips.activeClip = this;
               this.classList.add("pause");

           }
       }

})(document);

});

