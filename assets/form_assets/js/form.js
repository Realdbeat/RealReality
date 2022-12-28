
    $ = jQuery;
    $(document).ready(function(){

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;
        
        setProgressBar(current);
        
        $(".next").click(function(){
        var inp =  $(this).parent().parent().find("input");
        if (inp.length !== 0 && $(inp)[0].value == "") {
          $(inp)[0].setCustomValidity("Invalid or Empty ~ "+$(inp).attr("vname"));
          $(inp)[0].reportValidity();
          return false;
        }

        current_fs = $(this).parent().parent().parent().parent();
        next_fs = $(this).parent().parent().parent().parent().next();
        ++current;
        //Add Class Active
        //$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        
        //show the next fieldset
        $(current_fs).removeClass("screenAc");
        $(next_fs).addClass("screenAc");
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
        step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;
        
        current_fs.css({
        'display': 'none',
        'position': 'relative'
        });

       
        next_fs.css({'opacity': opacity});
        
        }, duration: 500 });
        setProgressBar(current);
        });
        
        $(".previous").click(function(){
        
        current_fs = $(this).parent().parent().parent().parent();
        previous_fs = $(this).parent().parent().parent().parent().prev();
        --current;
        console.log("this is the current passiotiob "+current);
        
        //Remove class active
        //$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        
        //show the previous fieldset
        previous_fs.show();
        $(previous_fs).addClass("screenAc");
        
        
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
        step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;
        $(current_fs).removeClass("screenAc");
        current_fs.css({
        'display': 'none',
        'position': 'relative'
        });

        //current_fs.classList.remove("screenAc");
        previous_fs.css({'opacity': opacity});
        },
        duration: 500
        });
        setProgressBar(current);
        });
        
        function setProgressBar(curStep){
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        console.log("This is the back Percents "+ percent)
        $(".screenAc").find(".progress-bar").css("width",percent+"%"); 
        $(".screenAc").find(".progress-text").html(curStep+"/"+steps+" Steps");
        $(".screenAc").find(".steps_field").html("Step "+curStep);
        
        /*.css("width",percent+"%")*/
        }
        
        $(".submit").click(function(){
        return false;
        })
   
        
        $(".skipso").click(function(){
        
         current_fs = $(this).parent().parent().parent().parent();
            next_fs = $(this).parent().parent().parent().parent().parent().find("#startmusic");        
        console.log(next_fs);
        current = current + 4;
        //show the next fieldset
        $(current_fs).removeClass("screenAc");
        $(next_fs).addClass("screenAc");
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
        step: function(now) {
        // for making fielset appear animation
       opacity = 1 - now;
        
        current_fs.css({
        'display': 'none',
        'position': 'relative'
        });

        next_fs.css({'opacity': opacity});
        
        }, duration: 500 });
        setProgressBar(current);
        });


        $(".skipstore").click(function(){
        
            current_fs = $(this).parent().parent().parent().parent();
               next_fs = $(this).parent().parent().parent().parent().parent().find("#musicstoreend");        
           console.log(next_fs)
           current = current + 11;
           //show the next fieldset
           $(current_fs).removeClass("screenAc");
           $(next_fs).addClass("screenAc");
           next_fs.show();
           //hide the current fieldset with style
           current_fs.animate({opacity: 0}, {
           step: function(now) {
           // for making fielset appear animation
          opacity = 1 - now;
           
           current_fs.css({
           'display': 'none',
           'position': 'relative'
           });
   
           next_fs.css({'opacity': opacity});
           
           }, duration: 500 });
           setProgressBar(current);
           });

       for(inps of $("input")) {
        $(inps).on('input', function() {
          if(this.value == ""){
            $(this).parent().parent().find(".btn.next").html("Skip");
          }else{
           this.setCustomValidity("");
           $(this).parent().parent().find(".btn.next").html("Continue");
          }
              });
      };

      $("#musics").submit(function(e){
      e.preventDefault(); 
      var values = {};
      $("#musics :input").each(function() {
      values[this.id] = this.value;
      });
      //addwizmusic

      jQuery.ajax({ url: peaksAjax.url, type: 'post',
        data:{ action: "addwizmusic",pdatas:values }, dataType: "json"
      }).done(function (a) { 
        console.log(JSON.stringify(a));
      }).fail(function (a) {
        console.log(JSON.stringify(a));
      });


      });




// Replace the validation UI for all forms
    for(inps of $("input")) {
        inps.addEventListener( "invalid", function( event ) {
          event.preventDefault();
          var parent =  $(this).parent().parent();
          var errorMessages =  $(this).parent().parent().find(".error-message");
          $(errorMessages).remove();
        parent.append("<div class='error-message'>" + this.validationMessage + "</div>" ).hide().fadeIn();
      }, true );
      
      $(inps).keyup(function () {
        if (this.value != "") {
          var errorMessages =  $(this).parent().parent().find(".error-message");
          $(errorMessages).remove();
        }
    });
    
    }; 

  
// Uploading files
			var file_frame;
			var wp_media_post_id = ""; // Store the old id
			var set_to_post_id = ""; // Set this

			jQuery('#pickimg').on('click', function( event ){

				event.preventDefault();

				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', 1 );
					// Open frame
					file_frame.open();
					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					//wp.media.model.settings.post.id = set_to_post_id;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();

					// Do something with attachment.id and/or attachment.url here
					$('#coverimg').attr('src', attachment.url );
					$('#musiccoverlinks').html(attachment.url);
					$('#field_6278863e1bd53').val(attachment.id);
					// Restore the main post ID
					//wp.media.model.settings.post.id = wp_media_post_id;
				});

					// Finally, open the modal
					file_frame.open();
			}); 
  
  
  });













        /*         
        var data = $('.activeInput')
        .toArray()
        .reduce((accumulator, element) => {
          accumulator[element.name] = element.value;
          return accumulator;
        }, {});   
   {"artstagename":"","artfirstn":"","artlastn":"","facebooklink":"","twitterlink":"","instgramklink":"","tiktoklink":"","musiclink":"","musiccoverlink":"","musicgenre":"","downloadklink":"","musicpeakurl":"","applelink":"","spotifylink":"","youtubelink":"","deezerlink":"","googleplaylink":"","amazonlink":"","soundcloudlink":"","boomplaylink":"","grovelink":"","shazamlink":"","tidallink":"","audiomacklink":"","descriptionlink":"","submitall":""}            

*/