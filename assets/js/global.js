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
    $(".flexslider").flexslider({
        animation: "slide",
        controlNav: false,
        prevText: "",
        nextText: "",
        smoothHeight: true   
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
	window.location.reload();
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


function hd(str){
	console.log("start Box");
	const boxes = Array.from(document.getElementsByClassName('nav-hide'));
	boxes.forEach(box => {$(box).slideToggle();
	console.log("box Modify")});
}
});




