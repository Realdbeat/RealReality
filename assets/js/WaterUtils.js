$ = jQuery;
var pr = wlist;
var jlist = JSON.parse(pr);
var imalogo = waterlogo;
var  curr_w = 0;
var longpress = false;
var startTime, endTime,dragObj = null, $DOM = $(document), startAtY = 10, endAtY = 270, clickedAtY,
moveEventType = document.ontouchmove  !== null ? 'mousemove' : 'touchmove' ,
endEventType  = document.ontouchend   !== null ? 'mouseup'   : 'touchend'  ;
console.log(jlist);

$(document).on("click", ".donem" ,function(){
  $(".w_td").css('display','none');
  });

$(document).on("click", ".w_td" ,function(){
  alerts("w_td","view");
  });

$(document).on("click", ".w_tb" ,function(){
  if(!longpress){
        $(".w_td").css('display','flex');
        $("#waterimg").attr("src",jlist[curr_w].url);}
  });

$(document).on("click", ".w_t_make" ,function(){
  console.log("This is at int num"+curr_w+" ANd Jlist Lenght is "+jlist.length);
      if(curr_w >= jlist.length){
        $( ".w_t_make" ).addClass( "donem");
        $( ".donem" ).removeClass( "w_t_make" );
        $(".w_tb .in  .badge").css("background","#000");
        $(".w_tb .in  .badge").html('\✔');
      }else{
        $("#waterimg").attr("src",jlist[curr_w].url);
        $( ".w_t_make" ).addClass( "onclic", 250, editimages(jlist[curr_w],curr_w))
        curr_w++;
      }

      console.log(curr_w < jlist.length ? "Yes G and int is "+curr_w:"No G and int is"+curr_w);
  });
 function editimages(obj,nu) {
      nu++;
      $(".w_td").css('display','flex');
      $(".barimg").css('width','10%');
      $(".barimg-text").html('10%');
      $(".w_td .waterh").html("Watering Item "+nu+"/"+jlist.length);
      $("#waterimg").attr("src",obj.url);          
       // watermark from remote source
       const options = { init(img) { img.crossOrigin = 'anonymous' } };
       watermark([obj.url, imalogo], options)
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
         $(".barimg").css('width','20%');
         $(".barimg-text").html('20%');
         return uploadImage;
       })
       .then(function (url){ 
         console.log(url);
         //var pathArray = obj.url.split('/'); 
         //var name = pathArray.pop(); 
         //name = name.split('.')[0];
        var name = obj.url;
         console.log("The File Name is "+name);
         $(".barimg").css('width','50%');
         $(".barimg-text").html('50%');
         $.ajax({
           url: WAjax.url,
           type: 'post',
           data:{action: "replaceimgs", pngstring: url, name: name,imgid: obj.id},
           dataType: "json" }).done(function (a) { 
                console.log(JSON.stringify(a));
                $(".barimg").css('width','100%');
                $(".barimg-text").html('100%');
       if (a.success === false){}else{ $("#waterimg").attr("src",a.data.imageurl); }
        $( ".w_t_make" ).removeClass( "onclic" );
        $( ".w_t_make" ).addClass( "validate");
        setTimeout(function() {
           $( ".w_t_make" ).removeClass( "validate" );
        if(curr_w >= jlist.length){
          $( ".w_t_make" ).addClass( "donem");
          $( ".donem" ).removeClass( "w_t_make" );
          };
      }, 1500 );
        }).fail(function (a) {console.log(JSON.stringify(a)); }); });
     }
     
window.onload = function(){
  draggable('w_tb');
 $(".w_tb" ).draggable();
};

  function draggable(id){
      var obj = document.getElementById(id);
      obj.style.position = "absolute";

      obj.ontouchstart = function(){
        dragObj = obj;
        startTime = new Date().getTime();
        $DOM.on(moveEventType, moveHandler)
        .on(endEventType, stopHandler);
      };

      obj.ontouchend = function(e){ 
        dragObj = null;
        endTime = new Date().getTime();
        longpress = (endTime - startTime < 500) ? false : true; 
      };
    
    }

  function moveHandler(e){
      var x = e.originalEvent.touches[0].pageX;
      var y = e.originalEvent.touches[0].pageY; 
      dragObj.style.left = x +"px";
      dragObj.style.top= y +"px"; 
  }
  
  function stopHandler() {
    $DOM.off(moveEventType, moveHandler)
        .off(endEventType,  stopHandler);
  }


function alerts(action,type) {
  var html = '<div class="alerts">\
  <div class="msg">Are You Sure You Went To Cancel This?</div>\
  <div class="butt">\
   <button class="no"></button>\
   <button class="yes"></button>\
  </div>\
 </div>';
$("body").append(html);

$(document).on("click", ".yes" ,function(){
  $("."+action).css("display","none");
  $(".alerts").remove();
  });

$(document).on("click", ".no" ,function(){
  $(".alerts").css("display","none");
  $(".alerts").remove();
  });

}

/**

  $(function() {
    $( "#button" ).click(function() {
      $( "#button" ).addClass( "onclic", 250, validate);
    });
  
    function validate() {
      setTimeout(function() {
        $( "#button" ).removeClass( "onclic" );
        $( "#button" ).addClass( "validate", 450, callback );
      }, 2250 );
    }
      function callback() {
        setTimeout(function() {
          $( "#button" ).removeClass( "validate" );
        }, 1250 );
      }
    });


    [BROM] FACTORY RESET Selected Model : Xiaomi Redmi 9 Prime
Code Name : lancelot_Redmi 9 prime
Operation : Factory Reset [2]
  Authenticating... OK
  Retrieving data... OK [531.46 KiB]
Initializing data... OK
Waiting for device... COM43
BROM : Failed to handshake with device!
UNLOCKTOOL 2023.01.13.1
Elapsed time : 12 seconds

var $MB = $('#menu_btn'), $M = $('#menu'), 
    $DOM = $(document),
    startAtY = 10, // CSS px
    endAtY = 270,  // CSS #menu height px
    clickedAtY,
    clickEventType = document.ontouchstart !== null ? 'mousedown' : 'touchstart',
    moveEventType = document.ontouchmove  !== null ? 'mousemove' : 'touchmove' ,
    endEventType  = document.ontouchend   !== null ? 'mouseup'   : 'touchend'  ;


var $MB = $('#menu_btn'),
    $M = $('#menu'),
    $DOM = $(document),
    startAtY = 10, // CSS px
    endAtY = 270,  // CSS #menu height px
    clickedAtY,
    clickEventType= document.ontouchstart !== null ? 'mousedown' : 'touchstart',
    moveEventType = document.ontouchmove  !== null ? 'mousemove' : 'touchmove' ,
    endEventType  = document.ontouchend   !== null ? 'mouseup'   : 'touchend'  ;

$MB.on(clickEventType, function( e ) { 

  e.preventDefault();  

  clickedAtY	= e.pageY - $(this).offset().top;
  if(clickEventType === 'touchstart'){
    clickedAtY = e.originalEvent.touches[0].pageY - $(this).offset().top;
  }
  
  $DOM.on(moveEventType, moveHandler)
      .on(endEventType, stopHandler);

});

function moveHandler( e ) {
  var posY = e.pageY - clickedAtY;
  if(moveEventType === 'touchmove') {
    posY = e.originalEvent.touches[0].pageY - clickedAtY;
  }
  posY = Math.min( Math.max(0, posY), endAtY - startAtY);
  $M.css({top: posY});
}

function stopHandler() {
  $DOM.off(moveEventType, moveHandler)
      .off(endEventType,  stopHandler);
}

      */