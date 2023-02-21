/*
* Add Peak Create To Music Edit!
* @2022 @stepCreator
*/
jQuery(document).ready(function($) { 
HTMLImageElement.prototype.getCanvasFromImage = function(){
  const canvas = document.createElement('canvas');
  canvas.width = this.width;
  canvas.height = this.height;
  const ctx = canvas.getContext('2d');
  ctx.drawImage(this, 0, 0);
  return canvas;
};
var fg = jQuery("body.wp-admin.block-editor-page");
jQuery(fg[0]).after("<div class='loading_pin'>Loading...</div>");
var loading_pin = jQuery(".loading_pin");
//$(loading_pin).css('display','flex');
//$(loading_pin).css('display','none');
var editor = document.querySelectorAll("[data-name='muisc_image']");
var imgkey = $(editor).attr("data-key");
console.log("Data Key Is "+imgkey);
var targetDiv = editor[0].querySelectorAll("[data-name='image']");
jQuery(targetDiv).css("width","250px");
jQuery(targetDiv).css("height","250px");
$(targetDiv).after("<div class='addwater' id='addwater'><i class='fa-solid fa-edit'></i>Add Water Marks</div>");



    var work = document.querySelectorAll("[data-name='music_peak_url']"); 
    var workid = jQuery(work).attr("data-key");



function writepeaks(a,b, c) {
var url = a; 
var path = b; 
var title = c;  
var audioloader  = WaveSurfer.create({ container: '#musicimg', waveColor: '#fff', progressColor: 'red', backgroundColor: '#000', barWidth: 2, });
audioloader.load(a);
audioloader.on('ready', function(){
setTimeout(function () {
  var dataURL = audioloader.exportImage();
  console.log("Png Done");
  jQuery('#imagecom').css("display","flex");
  jQuery('#imagecom').scrollTo(5);
  jQuery('#doneimg').attr('src',dataURL);
$(loading_pin).css('display','flex');
   jQuery.ajax({
                    url: EpeaksAjax.ajaxurl,
                    type: 'post',
                    data:{
                        action: "rwpeaks",
                        mp3file: path,
                        mp3name: title,
                        mp3png:  dataURL },
                        dataType: "json"
                }).done(function (res) {
                   $(loading_pin).css('display','none'); 
                   try { 
                       if (res.success == true){
                        jQuery("#acf-"+workid).val(res.data);
                        console.log(dataURL);
                        setstepbar(4);  
                    }else{   setstepbar(1); } } catch (error) {
                       console.log(error+" and res is "+res); 
                   }
                    console.log(res);
                }).fail(function (a, g, c) { $(loading_pin).css('display','none');  });
         }, 9000);


      

}); 


}

function editimages() {
 $(loading_pin).css('display','flex'); 
 $(editor).after("<div class='my-editor'></div>");
 var editor = document.querySelectorAll("[data-name='muisc_image']");
 $(editor).after("<div class='my-editor'></div>");
 var targetDiv = editor[0].querySelectorAll("[data-name='image']");
 var inputimg = document.querySelectorAll('[name="acf['+imgkey+']"]'); 
               
  // watermark from remote source
  const options = { init(img) { img.crossOrigin = 'anonymous' } };

  watermark([targetDiv[0].src, 'https://www.realdbeat.com/wp-content/uploads/2022/02/R-D.png'], options)
  .dataUrl((uploadImage, logo) => {
    const context = uploadImage.getContext('2d');
   // const canvas = targetDiv[0].getCanvasFromImage();
    const logoResizedHeight = uploadImage.height;
    const logoResizedWidth = uploadImage.width ;
    const posX = (uploadImage.width - logoResizedWidth) / 2;
    const posY = (uploadImage.height - logoResizedHeight) / 2;
    context.save();
    context.globalAlpha = 0.2;
    context.drawImage(logo, posX, posY, logoResizedWidth, logoResizedHeight);
    context.restore();
    return uploadImage;
  })
  .then(function (url){ 
    console.log(url);
    var pathArray = targetDiv[0].src.split('/'); 
    var name = pathArray.pop(); 
    name = name.split('.')[0];
    console.log("The File Name is "+name+" And Url is "+url)
    jQuery.ajax({
      url: EpeaksAjax.ajaxurl,
      type: 'post',
      data:{action: "dlwater", pngstring: url, name: name},
      dataType: "json" }).done(function (a) { 
           console.log(JSON.stringify(a));
            if (a.success === false){
                alert("error geting saveing file Error is "+a.data.error);
                $(loading_pin).css('display','none'); 
              }else{
                
                alert("done saveing"); 
                targetDiv[0].src = a.data.imageurl;
                inputimg[0].value = a.data.imageid;
               $(loading_pin).css('display','none');
              
              }
              }).fail(function (a, c, b) {$(loading_pin).css('display','none'); }); });
}



/*
* On Download Functions Music Edit!
* @2022 @stepCreator
  watermark([targetDiv[0].src, 'https://www.realdbeat.com/wp-content/uploads/2022/02/R-D.png'], options)
  .image(watermark.image.lowerRight(0.5))
  .then(img =>  );


*/        

function downloadpeaks(a,b,c) {
  $(loading_pin).css('display','flex');     
  var res = "";
        var title = c;
        var link = a;
        var type = b;
        try {
      jQuery.ajax({
        url: EpeaksAjax.ajaxurl,
        type: 'post',
        data:{action: "dlpeaks", type: type, url: link, title: title},
        dataType: "json" }).done(function (a) { 
             console.log(JSON.stringify(a));
              if (a.success === false){ setstepbar(1); alert("error geting mp3 file Error is "+a.data)}else{ 
                 // setstepbar(2); console.log("done downloading Music"+a);
               writepeaks(a.data[1], a.data[0], title);
                }
                }).fail(function (a, c, b) {setstepbar(1);  $(loading_pin).css('display','none'); });
                   
                } catch (error) {
                    res = "error200"+b;
                    $(loading_pin).css('display','none'); 
                    }  } 
     
jQuery(document).on("click", "#set" ,function(){
        var dlink = jQuery("#peakslinks").val();
        setstepbar(1);
        $(loading_pin).css('display','flex'); 
       checkurltype(dlink); 
    
    });
       
jQuery(document).on("click", "#addwater" ,function(){
  editimages();   
    });
    

/*
* Get Url Type Function Music Edit!
* @2022 @stepCreator
*var url = "https://drive.google.com/uc?export=download&id=1X94pQKC__T4STuYGL6mctCCX4E_VkEfg"; 
*var url = "https://naijaloaded.store/wp-content/uploads/2019/05/Softwave-Komod-Vibes.mp3";
*/


/*


jQuery(document).on('click', '#testcheck', function(){   
downloadpeaks("https://drive.google.com/uc?export=download&id=1X94pQKC__T4STuYGL6mctCCX4E_VkEfg");
})
   

* Create Peaks Png Functions Music Edit!
* @2022 @stepCreator
    audioloader.on('waveform-ready', function(){ });
    audioloader.on('waveform-ready', function(){ });
    function writepeaks(url,path, title) {
            audioloader.load(url);
            url = url;
            path = path;
            title = title;
            console.log(url); 
            // save waveform image as data url (png format by default)
    
         //  setTimeout(function () {  }, 5000);  
    }
   */   
    

    /*
    * Testing Functions Music Edit!
    * @2022 @stepCreator
    */
    
    
    /*   fetch("https://drive.google.com/uc?export=download&id=1X94pQKC__T4STuYGL6mctCCX4E_VkEfg", {
                    method: 'GET',
                    mode: 'no-cors',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                       })
                .then((response) => response.blob())
                .then((blob) => {
                // 2. Create blob link to download
                 const url = window.URL.createObjectURL(new Blob([blob]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', `sample.xlsx`);
                 // 3. Append to html page
                 document.body.appendChild(link);
                 // 4. Force download
                 link.click();
                 // 5. Clean up and remove the link
                 link.parentNode.removeChild(link);
                });               
                    
                    
                    */  


/*
* Set StepBar Functions Music Edit!
* @2022 @stepCreator
*/

    /*
     var intn = 1; 
    
     setstepbar(intn);
    
     jQuery(document).on("click", "#set" ,function(){
                    console.log("click works"+intn);
                    jQuery('#e1').empty();
                    intn = (intn === 6) ? 1 : intn;
                    setstepbar(intn);
                      console.log("Item Number Is "+intn);
             intn++ });
    
    const interval = setInterval(function() {
        jQuery('#e1').empty();
        intn = (intn === 6) ? 1 : intn;
        setstepbar(intn);
        intn++;
        console.log("Auto Add At "+intn)
      }, 5000);
    
    var work = document.querySelectorAll("[data-name='music_peak_url']"); 
    var workid = jQuery(work).attr("data-key");
    var workhtml = '<div class="peaksmain">\
     <div id="musicimg" width="100%" height="50px"></div>\
     <div class="inputdv">\
     <p class="decr">Add The Music Url Here eg* https://drive.google.com/file=bihdfsujiiu to create The Music Peaks Png Image</p>\
     <input type="url" value="" id="peakslinks" placeholder="Add The Music Url Here eg* https://drive.google.com/file=bihdfsujiiu">\
     <div class="button" id="set">Create Peaks Png Images</div>\
     </div><div id="e1"></div>\
     <div class="imagecom" id="imagecom">\
	   <img src="" alt="" class="doneimg" id="doneimg">\
	   <i class="fa-solid fa-check"></i></div></div>';
     $(work).after("<div id='peakmain'>"+workhtml+"</div>"); 
     /*clearInterval(interval);*/
     console.log("don adding");
    });
    
     