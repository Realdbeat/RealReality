jQuery(document).ready(function($) {


	// Toggle mobile menu
	$(".nav-toggle").on("click", function(){	
		$(this).toggleClass("active");
		$(".mobile-menu").slideToggle();
		if ($(".search-toggle").hasClass("active")) {
			$(".search-toggle").removeClass("active");
			$(".search-container").slideToggle();
		}
		return false;
	});
	
	
	// Toggle search container
	$(".search-toggle").on("click", function(){	
		$(this).toggleClass("active");
		$(".search-container").slideToggle();
		if ($(".nav-toggle").hasClass("active")) {
			$(".nav-toggle").removeClass("active");
			$(".mobile-menu").slideToggle();
		}
		return false;
	});

	// Add focus class to menus
	$( '.dropdown-menu a' ).on( 'blur focus', function( e ) {
		$( this ).parents( 'li.menu-item-has-children' ).toggleClass( 'focus' );
	} );
	
	
	// Hide mobile menu/search container at resize
	$(window).resize(function() {
	
		if ($(window).width() >= 850) {
			$(".nav-toggle").removeClass("active");
			$('.mobile-menu').hide();
		}
		
		if ($(window).width() <= 850) {
			$(".search-toggle").removeClass("active");
			$('.search-container').hide();
		}
	
	});
	
	
	// Dropdown menus on touch devices
	$( '.nav-item li:has(ul)' ).doubleTapToGo();
	$( '.secondary-menu li:has(ul)' ).doubleTapToGo();
	
	
	// Load Flexslider
function getGridSize() {
	return (window.innerWidth < 600 ) ? 1 :
	(window.innerWidth < 900 ) ? 1 : 2;
}

function getGridwith() {
	var six = window.innerWidth - 60;
	console.log(six);
	return six;
	
}




    $(".flexslider").flexslider({
        animation: "slide",
        controlNav: true,
        prevText: "",
        nextText: "",
		itemWidth: getGridwith(),
        smoothHeight: true,
		maxItems: 1,
		minItems: 1
    });

	// smooth scroll to the top	
	jQuery(document).ready(function($){
	    $('.to-the-top').click(function(){
	        $("html, body").animate({ scrollTop: 0 }, 500);
	        return false;
	    });
	});
	
	
	// resize videos after container
	var vidSelector = ".post iframe, .post object, .post video";	
	var resizeVideo = function(sSel) {
		$( sSel ).each(function() {
			var $video = $(this),
				$container = $video.parent(),
				iTargetWidth = $container.width();

			if ( !$video.attr("data-origwidth") ) {
				$video.attr("data-origwidth", $video.attr("width"));
				$video.attr("data-origheight", $video.attr("height"));
			}

			var ratio = iTargetWidth / $video.attr("data-origwidth");

			$video.css("width", iTargetWidth + "px");
			$video.css("height", ( $video.attr("data-origheight") * ratio ) + "px");
		});
	};

	resizeVideo(vidSelector);

	$(window).resize(function() {
		resizeVideo(vidSelector);
	});
	


	var progressPath = document.querySelector('.progress path');
	var pathLength = progressPath.getTotalLength();
	progressPath.style.transition = progressPath.style.WebkitTransition =
	'none';
	progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
	progressPath.style.strokeDashoffset = pathLength;
	progressPath.getBoundingClientRect();
	progressPath.style.transition = progressPath.style.WebkitTransition =
	'stroke-dashoffset 300ms linear';


	var updateProgress = function () {
		// calculate values
		var scroll = $(window).scrollTop();
		var height = $(document).height() - $(window).height();
		var percent = Math.round(scroll * 100 / height);
		var progress = pathLength - (scroll * pathLength / height);
		// update dashOffset
		progressPath.style.strokeDashoffset = progress;
		// update progress count
		$('.percent').text(percent+"%");
		}



		updateProgress();
		$(window).scroll(updateProgress);



function nav_resizer(){
var headwidth = document.getElementById('head').offsetWidth;
var sddd = headwidth / 92;
var intvalue = Math.round( sddd );
var children = document.querySelectorAll('.head .nav-item > li').length;
if(intvalue < children ){
var mainitems = children - intvalue;
let i = 0;
let hide_n = 40;
var iop = mainitems+1
console.log(iop+" Items are fond Here");
while (i < iop) {
var intit = intvalue+i;
if(i == 0){
try {
intit = intit - 1;
var item_ele = document.querySelectorAll('.head .nav-item > li')[intit];
if($(item_ele).hasClass( "foo" )){};
$(item_ele).addClass("nav-hide");
$(item_ele).after("<li class='nav-more fa  fa-chevron-circle-up'><span> More</span></li>");

} catch (error) { alert(error); }

}else{

try {
	var item_ele = document.querySelectorAll('.head .nav-item > li')[intit];
	$(item_ele).addClass("nav-hide");
	$(item_ele).css("margin-top",hide_n+"px");
} catch (error) { alert(error);}
  hide_n = hide_n + 40;
} i++; }

}

}

//document.getElementsByClassName('parent')[0];

if( $("#wpadminbar").hasClass( "nojq" ) )
{
$('.nav-top').css('top','70px');
};

window.addEventListener('resize', function(){
 
	if ($(window).width() < 610) { } else { window.location.reload(); }

});



nav_resizer();



$(".nav-more").on("click", function(){	
	$(this).toggleClass("active");
	if ($(this).hasClass("active")) {
			$(this).removeClass("active");
			console.log("none selecte");
			hd("none");
	}
});




	










/*
function hd(str){
	console.log("start Box");
	const boxes = Array.from(document.getElementsByClassName('nav-hide'));
	boxes.forEach(box => {$(box).slideToggle();
	console.log("box Modify")});
}
try {
// Fix up for prefixing
window.AudioContext = window.AudioContext||window.webkitAudioContext;
var context = new AudioContext();
var audioloader = null;
//if(context.state === 'suspended') alert("auto-play failed!!"); 


function callw(){
	audioloader = WaveSurfer.create({
		container: '.audio',
		waveColor: 'violet',
		progressColor: 'red',
		barWidth: 2,
		height: 2,
		backend: 'MediaElement'
	});
	
	audioloader.load('https://drive.google.com/uc?export=download&id=1X94pQKC__T4STuYGL6mctCCX4E_VkEfg');
	console.log(audioloader);
}

 
	console.log(audioloader);

	const playbtn = document.querySelector(".play-btn");
	const stopbtns = document.querySelector(".stop-btn");
	const mutebtn = document.querySelector(".volume-btn");
	const volumeslider = document.querySelector(".volume-slider");
	
	
	playbtn.addEventListener("click", () =>{
		if(audioloader == null){callw()};
		audioloader.playPause();
		if(audioloader.isPlaying()){
			playbtn.classList.add("playing");
		}else{
			playbtn.classList.remove("playing");
		}
	});
	
	
	stopbtns.addEventListener("click", () =>{
		audioloader.stop();
		playbtn.classList.remove("playing");
	});
	
	volumeslider.addEventListener("mouseup", () =>{
	 changevolume(volumeslider.value);
	});
	
	mutebtn.addEventListener("click", () =>{
	if(mutebtn.classList.contains("muted")){
		mutebtn.classList.remove("muted");
		audioloader.setVolume(0.5);
		volumeslider.value = 0;
	}else{
		audioloader.setVolume(0);
		mutebtn.classList.add("muted");
		volumeslider.value = 0;
	}
	});
	
	
	const changevolume =(e) =>{
		if(e == 0){
		mutebtn.classList.add("muted");    
		}else{
		mutebtn.classList.remove("muted");
		}
		audioloader.setVolume(e);
	}
	
	

} catch (error) {
alert(error);	
}



$.ajax({
	url: "https://www.realdbeat.com/music/proxys/",
	type: "GET", 
	crossDomain: true,
	data: {
		"cors": "https://drive.google.com/uc?export=download&id=1X94pQKC__T4STuYGL6mctCCX4E_VkEfg", 
		"method": "GET",
	},
	success: function (data) {
		console.log(data)
	}

 
 });
*/






});

/*	
*React Buttons Love,Wow And Sad
*/

function addlikes(obddjs,pasid){
	jQuery('#'+obddjs).addClass("gone");
	console.log(obddjs+" and is is "+pasid);
    var userEmail = getCookie(obddjs+pasid); 
	(userEmail)? exitid(obddjs,"alert error"," Music Already") : likeajax(obddjs,pasid);
};

function exitid(obddjs,type,msg){ 
	jQuery('#'+obddjs).removeClass("gone");
	jQuery('body').append("<div class='"+type+"'>"+obddjs+msg+"</div>");
	jQuery(".alert").fadeOut(1500);
}

function likeajax(elm,pid){
	jQuery.ajax({
		url: gajax.url,
		type: 'POST',
		data:{action: "set_like_func", nonce_ajax : gajax.nonce, type: elm, postsid: pid},
		crossDomain: true,
		dataType: "json"
	    }).done(function (res) {
			jQuery('#'+elm+'>p').html(res.data);
			setCookie(elm+pid,"yes");
			exitid(elm,"alert succ"," Music Succesfully")
			console.log(res.data);
		}).fail(function (a) {
			exitid(obddjs,"alert error"," ,There is An Error")
			console.log(JSON.stringify(a));
		});
}


function setCookie(name,value) {
    var expires = ";Fri, 31 Dec 9999 23:59:59 GMT";
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}


function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
