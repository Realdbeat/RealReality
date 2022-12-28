$=jQuery;
var numi = 0;
var num = 0;
jQuery(document).ready(function($) { 
var afcimg = $("[name='acf[field_6278863e1bd53]']");
var afcimgid = $(afcimg).val();
var afcimgsrc = $(afcimg).next().find("img").attr("src");
var fimgid = featureid;
var fimgsrc = featuresrc;
$("#waterimg").attr("src",afcimgsrc);
$("#fimg").attr("src",fimgsrc);
$(".watertext").html("this is feature img id /n"+fimgid+"and thids is src /n"+fimgsrc+" and this is afc imgage src /n"+afcimgsrc);

$("#genwave").on("click", function(){
    setProgressBar(4,num,"waveprogress");
    num++;
});



$("#addwaters").on("click", function(){
    setProgressBar(4,numi,"waterprogress");
    numi++; 
//animation
});


$("#close_box").on("click", function(){
    $(".music_pl_ds").css("display","none"); 
});


$("#music_pl_b").on("click", function(){
    $(".music_pl_ds").css("display","flex"); 
});




});


function setProgressBar(total,curStep,elem){
    if(curStep === 5){
    $("#"+elem).css("animation","none"); 
    numi = 0;
    num = 0;
    }else{
    var percent = parseFloat(100 / total) * curStep;
    percent = percent.toFixed();
    $("#"+elem).css("width",percent+"%"); 
    $("#"+elem).html(percent+"%");
    console.log(curStep);
    }
}



//