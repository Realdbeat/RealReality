jQuery(document).ready(function($) { 
  /**Open And Close Meta Box */
  jQuery(document).on('click', '#Music_Peaks_RealReality .handlediv' ,function(){
   $('#Music_Peaks_RealReality').removeClass('closed');
   $('#Music_Peaks_RealReality').addClass('open');

  });
  /**HTMLImageElement Get Canvas */
    HTMLImageElement.prototype.getCanvasFromImage = function(){
      const canvas = document.createElement('canvas');
      canvas.width = this.width;
      canvas.height = this.height;
      const ctx = canvas.getContext('2d');
      ctx.drawImage(this, 0, 0);
      return canvas;
    };
    /**Loader Screen*/   
    var loading_pin = jQuery(".loading_pin");
    //$(loading_pin).css('display','flex');
    //$(loading_pin).css('display','none');

    /**Get All Meta Part Componet */
    var editor = document.querySelectorAll("[data-name='muisc_image']");
    var imgkey = $(editor).attr("data-key");
    var targetDiv = editor[0].querySelectorAll("[data-name='image']");
    var work = document.querySelectorAll("[data-name='music_peak_url']"); 
    var workid = jQuery(work).attr("data-key");

    /**CheckUrl Type GDrive Or Extarnal Link */
    function checkurltype(url){
        var link = "";
        var type = "";
        var title = "";
        if(url.includes("drive.google.com")){
            const urlParams = new URLSearchParams(url);
            if(urlParams.has('id')){
             title = urlParams.get('id');
             link = url;
            }else{
              var pathArray = url.split('/'); 
              title = pathArray[5];
              link = "https://drive.google.com/uc?export=download&id="+pathArray[5];
            }
            type = "drive";
        }else{
            var pathArray = url.split('/'); 
            title = pathArray.pop();
            link = link;
            type = "ext";
        }
        return Array(link,type,title);
    }


  /**Step Added To Progresss */
     function setstepbar(intss){
    try {
        console.log("ADD to #e1");
        jQuery('#e1').empty();
    jQuery('#e1').stepbar({
                  items: ['Donwloading', 'Check And Validete File', 'Peaks Creating'],
                  itemsdone: ['Donwloaded', 'Check And Validete File Done', 'Peaks Created'],
                  color: '#84B1FA',
                  fontColor: '#000',
                  selectedColor: '#2bff2b',
                  selectedFontColor: '#fff',
                  current: intss
  });
    } catch (error) {
   console.log(error);  
    }
  }
    var mlink = jQuery("[data-name='music_link']");
    var mlinkid = jQuery(mlink).attr("data-key");


  /**Create Paek Onclick */
  jQuery(document).on("click", "#set" ,function(){
     $(loading_pin).css('display','flex'); 
    var dlink = $("#acf-"+mlinkid).val();
    if (dlink != ""){ setstepbar(1); checkurltype(dlink);};
     $(loading_pin).css('display','none'); 
});



  $(document).on("input", "#acf-"+mlinkid, function () {
  var mlinkdone = $("#acf-"+mlinkid).val();
  $("#acf-"+mlinkid).val(checkurltype(mlinkdone)[0]);
  console.log(mlinkdone);
  });





});