/*
* Add Peak Create To Music Edit!
* @2022 @stepCreator
*/

var rootp = "/wp-content/themes/realreality/assets/peakscreator/";
var work = document.querySelectorAll("[data-name='music_peak_url']"); 
var workid = jQuery(work).attr("data-key");
jQuery(document).ready(function($) { 
    console.log("start adding");
    jQuery("#acf-"+workid).val("working new shit ssss");
    $(work).after("<div id='peakmain'></div>");
   try {
        $("#peakmain").load(rootp+"display.html");  
        var workid = jQuery("[data-name='music_peak_url']").attr("data-key");
        jQuery("[id="+workid+"]").val("working shit");
     } catch (error) {
       console.log(error);

   }
    console.log("don adding");
    });

/*
* On Download Functions Music Edit!
* @2022 @stepCreator
*/

jQuery(document).on('click', '#testcheck', function(){   
    downloadpeaks("https://drive.google.com/uc?export=download&id=1X94pQKC__T4STuYGL6mctCCX4E_VkEfg");

})

function downloadpeaks(a) { 
    var res = "";
    var title = "";
    var link = ""
    try {
 const urlParams = new URLSearchParams(a);
  if(urlParams.has('id')){
   title = urlParams.get('id');
   link = a;
  }else{
    var url_add = a;
    var pathArray = url_add.split('/'); 
    title = pathArray[5];
    link = "https://drive.google.com/uc?export=download&id"+pathArray[5];
  }
  jQuery.ajax({
                url: EpeaksAjax.ajaxurl,
                type: 'post',
                data:{
                    action: "dlpeaks",
                    id: link,
                    title: title},
                    dataType: "text"
            }).done(function (a) {
               res = JSON.parse(a);
               if (res.data == "error"){
                setit(1);
               }else{
                    setit(2); 
                    console.log("done downloading Music"+res.data)
                    writepeaks(res.data, title);
            }
                
            }).fail(function (a, c, b) {
                setit(1);
            });
                
            } catch (error) { 
                res = "error200"+b;
                }     

          return res; 
 } 
 
jQuery(document).on("click", "#set" ,function(){
    var dlink = jQuery("#peakslinks").val();
    setit(1);
   // https://drive.google.com/uc?export=download&id=1X94pQKC__T4STuYGL6mctCCX4E_VkEfg
    downloadpeaks(dlink);

});



/*
* Create Peaks Png Functions Music Edit!
* @2022 @stepCreator
*/
function writepeaks(path, title) {
    try {
        jQuery.ajax({
                url: EpeaksAjax.ajaxurl,
                type: 'post',
                data:{
                    action: "rwpeaks",
                    mp3file: path,
                    mp3name: title },
                    dataType: "json"
            }).done(function (res) {
               try { 
                   if (res.success == true){
                    jQuery("#acf-"+workid).val(res.data);
                    setit(4);  
                }else{   setit(1);  
                     } } catch (error) {
                   console.log(error+" and res is "+res);
               }
                console.log(res);
            }).fail(function (a, g, c) {

                 })
        } catch (error) {
            console.log(error);
            }         
}

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
  function setit(intss){
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
    console.log("ADDING COMPLETE TO #E1")
      } catch (error) {
     console.log(error);  
      }
    }
/*
 var intn = 1; 

 setit(intn);

 jQuery(document).on("click", "#set" ,function(){
                console.log("click works"+intn);
                jQuery('#e1').empty();
                intn = (intn === 6) ? 1 : intn;
                setit(intn);
                  console.log("Item Number Is "+intn);
         intn++ });

const interval = setInterval(function() {
    jQuery('#e1').empty();
    intn = (intn === 6) ? 1 : intn;
    setit(intn);
    intn++;
    console.log("Auto Add At "+intn)
  }, 5000);
 
 /*clearInterval(interval);*/

 