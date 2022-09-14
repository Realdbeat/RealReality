jQuery(document).ready(function($) { 
//**Get All Meta Part Componet 
//$("#editor").append('');


//Open And Close Meta Box
$(document).on("click", "#Music_Peaks_RealReality .handlediv" ,function(){
var vo =  $("#Music_Peaks_RealReality .handlediv");
});

//Select All Elements Onload
var imagetowatermake = document.querySelectorAll("[data-name='muisc_image']");
var imgkey = $(imagetowatermake).attr("data-key");
var imgframe = imagetowatermake[0].querySelectorAll("[data-name='image']");
var musiclinks = $("[data-name='music_link']"); 
var musiclinksid = $(musiclinks).attr("data-key");
var musiclinkv = $(musiclinks).find("#acf-"+musiclinksid);
//use as console.log($(musiclinkv).val());
var peakslinks = $("[data-name='music_peak_url']"); 
var peakslinksid = $(peakslinks).attr("data-key");
var peaklinkv = $(peakslinks).find("#acf-"+peakslinksid);
//use as console.log($(peaklinkv).val());
var donearray = Array();





/**
Add WaterMake Create Button */
$(musiclinks).find(".acf-input-wrap.acf-url.-valid").append('<i class="fa-solid fa-file-waveform" id="cpeak"></i>');


$(".show-if-value .acf-actions.-hover").append('<div id="addwater"><i class="fa-solid fa-file-waveform"></i></div>');
$(document).on("click", "#addwater" ,function(){
    editimages();
});




$(".show-if-value .acf-actions.-hover").append('<div id="testnew"><i class="fa-solid fa-file"></i></div>');
$(document).on("click", "#testnew" ,function(){
var p =  $(this).parent().parent();
var imgel = p.find("[data-name='image']");
var url = imgel[0].src;
  jQuery.ajax({
    url: peaksAjax.url,
    type: 'POST',
    data:{action: "replaceimg", pngstring: url},
    crossDomain: true,
    dataType: "json"  }).done(function (a) { 
          if (a.success === false){
              loader(false,"Fatal Error","error geting saveing file Error is "+a.data.error);
            }else{
              alert(a.data);
              loader(false,"Succefully Save","done Saveing");
            
            }
            }).fail(function (a) { loader(false,"Fatal Error","Error "+a.statusText); });
});






//String To Array Converter Function
function strToarr(str){
var arr = str.split(',');
console.log(arr);
return arr
}
// How To Call It strToarr("Rose,Lotus,Sunflower,Marogold,Tulip,Jasmine")



//Function Prototype Canvars From Image For WaterMake Creator
HTMLImageElement.prototype.getCanvasFromImage = function(){
    const canvas = document.createElement('canvas');
    canvas.width = this.width;
    canvas.height = this.height;
    const ctx = canvas.getContext('2d');
    ctx.drawImage(this, 0, 0);
    return canvas;
  };

//How to Use  const canvas = mainimg[0].getCanvasFromImage();

//Function Add Progress Using Stepbar.js
function setstepbar(intss){ try {
        jQuery('#e1').empty();
    jQuery('#e1').stepbar({
                  items: ['Donwloading', 'Check And Validete File', 'Peaks Creating'],
                  itemsdone: ['Donwloaded', 'Check And Validete File Done', 'Peaks Created'],
                  color: '#84B1FA',
                  fontColor: '#000',
                  selectedColor: '#ffff01',
                  selectedFontColor: '#000',
                  donetextColor: '#696868',
                  textColor: '#fff',
                  current: intss
  }); } catch (error) { console.log(error);}
}


//Function CheckUrl Type GDrive Or Extarnal Link 
async function  checkurltype(url){
let res;
try {
    if(url.includes("drive.google.com")){
       var type = "drive";
          res = gdrivename(url).then((name)=>{
            console.log(Array(name.data.id,type,name.data.name));
          return Array(name.data.id,type,name.data.name); }); 
          }else{
            var pathArray = url.split('/'); 
            title = pathArray.pop();
            link = url;
            type = "ext";
        res = Array(link,type,title);      
        } 

 return res     
} catch (error) {
  console.error(error);
}        
    }

//Function Get FileName From Gdrive
async function gdrivename(gdid) {
  let result;
  try {
        let ids;
        const urlParams = new URLSearchParams(gdid);
        if(urlParams.has('id')){ids = urlParams.get('id'); }else{ var pathArray = gdid.split('/'); ids = pathArray[5]; }
      result = await $.ajax({
        url: peaksAjax.url,
        type: 'post',
        data:{action: "gdrivegetname",gdriveid: ids},
        dataType: "json" });

      return result;
  } catch (error) {
      console.error(error);
  }
}


//Function Loader Screen Show or Hidden
function loader(bl,hd,msg) {
   var loading_pin = $(".loading_pin");
   $('.loadtexth').html(hd) ;
   $('.loadtextm').html(msg) ;
   if(bl){$(loading_pin).css('display','flex')
        }else{
    setTimeout(function () { $(loading_pin).css('display','none')  }, 5000);
   }    
}




//** 
//*Now Starting Main Functions 
//*Download Write And Save Functions

//Water Maker Generator
function editimages() {
    loader(true,"Generating Images","Generating Water Make Images");
    var imgContainer = $("[data-name='muisc_image']");
    var mainimg = $(imgContainer).find("[data-name='image']");
    var imgkey = $(imgContainer).attr("data-key");
    var inputimg = $('[name="acf['+imgkey+']"]');     
    // watermark from remote source
    const options = {
      init(img) {
        img.crossOrigin = 'anonymous'
      }
    };
 watermark([mainimg[0].src, 'https://www.realdbeat.com/wp-content/uploads/2022/02/R-D.png'], options)
      .dataUrl((uploadImage, logo) => {
        const context = uploadImage.getContext('2d');
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
        var pathArray = mainimg[0].src.split('/'); 
        var name = pathArray.pop(); 
        //name = name.split('.')[0];
        //name = mainimg[0].src;
        jQuery.ajax({
          url: peaksAjax.url,
          type: 'POST',
          data:{action: "replaceimgs", pngstring: url, imgname: name},
          crossDomain: true,
          dataType: "json"  }).done(function (a) { 
                if (a.success === false){
                    loader(false,"Fatal Error","error geting saveing file Error is "+a.data.error);
                  }else{
                    mainimg[0].src = a.data.imageurl;
                    inputimg[0].value = a.data.imageid;
                    loader(false,"Succefully Save","done Saveing");
                  
                  }
                  }).fail(function (a) { loader(false,"Fatal Error","Error "+a.statusText); }); });
    }


//Downloading Music Now
function downloadpeaks(ldata) {    
      var res = "";
            var title = ldata[2];
            var link = ldata[0];
            var type = ldata[1];
            try {
          jQuery.ajax({
            url: peaksAjax.url,
            type: 'post',
            data:{action: "downloadmp3", type: type, url: link, title: title},
            dataType: "json" }).done(function (a) { 
                 console.log(JSON.stringify(a));
                  if (a.success === false){ 
                    setstepbar(1);
                    loader(false,"Success But Failed Error is "+a.data)
                  }else{ 
                  setstepbar(2); 
                  console.log("done downloading Music"+a);
                   writepeaks(a.data[1], a.data[0], title);
                    }
                    }).fail(function (a, c, b) {setstepbar(1); loader(false,"Failed And Error is "+b); console.log(a,b,c) });
                       
                    } catch (error) { loader(false,"Fatal Failed Error is "+error)  }  
                      
  } 


//Write Function

function writepeaks(a,b, c) {
  $("#musicimg").empty();
  var url = a; 
  var path = b; 
  var title = c;  
jQuery('.peaksmain').css("display","flex");
  var audioloader  = WaveSurfer.create({ container: '#musicimg', waveColor: '#fff', progressColor: 'red', backgroundColor: '#000', barWidth: 2, });
  audioloader.load(url);
  audioloader.on('ready', function(){
  setTimeout(function () {
    var dataURL = audioloader.exportImage();
    console.log("Png Done");
    jQuery('#imagecom').css("display","flex");
    jQuery('#doneimg').attr('src',dataURL);
     jQuery.ajax({
                      url: peaksAjax.url,
                      type: 'post',
                      data:{
                          action: "generatewaves",
                          mp3file: path,
                          mp3name: title,
                          mp3png:  dataURL },
                          dataType: "json"
                  }).done(function (res) { 
                     try { 
                         if (res.success == true){
                          donearray.push(res.data);
                          $(peaklinkv).val(donearray.join(", "));
                          console.log(dataURL);
                          loader(false,"Success Paek Generated","Success Paek Generated");
                          setstepbar(4);  
                      }else{ setstepbar(1); 
                        loader(false,"Fatal Error","Success But Failed Error is "+res.data);
                      } } catch (error) {loader(false,"Fatal Error","Fatal Failed Error is "+error) }
                      console.log(res);
                  }).fail(function (a, b, c) { loader(false,"Fatal Error","Failed And Error is "+c);  });
           }, 9000);
  
  
        
  
  }); 
  
  
  }


//dl testing point
jQuery(document).on("click", "#tester" ,function(){

});






/**Create Paek Onclick */
$(document).on("click", "#cpeak" ,function(){
  var plinks = $(musiclinkv).val();
  var parrays = strToarr(plinks);
  var curr = 0;
  parrays.forEach(mlink => {
  curr++;
  loader(true,"Creating Peak Image","Creating Peak Image At "+curr+"/"+parrays.length+" And Link is "+mlink); 
  setstepbar(1);
  checkurltype(mlink).then((data)=>{downloadpeaks(data); });
  //setTimeout(function () { loader(false,"Close Now") }, 3000); 
   });
});


/**
 $(document).on("input", "#acf-"+mlinkid, function () {

 });

 */


//End Doc
});