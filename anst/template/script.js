$(function (){
	
	var header = $("#header"),
		introH = $("#intro").innerHeight(), //скролл от intro
		scrollOffset = $(window).scrollTop(); //текущий скролл
	
	/* Fixed Header */
	checkScroll(scrollOffset);
	fixScroll(scrollOffset);
	
	$(window).on("scroll", function() {
		
		scrollOffset = $(this).scrollTop();
		checkScroll(scrollOffset);
		fixScroll(scrollOffset);
	});
	
	function checkScroll(scrollOffset) {
		
		if (scrollOffset >= introH) {
			header.addClass("fixed");
		} else {
			header.removeClass("fixed");
		}
	}
	
	function fixScroll(scrollOffset) {

	var	aboutHC = document.getElementById('about').getBoundingClientRect().top, //скролл от about
		serviceHC = document.getElementById('service').getBoundingClientRect().top, //скролл от service
		workHC = document.getElementById('work').getBoundingClientRect().top, //скролл от work
		blogHC = document.getElementById('blog').getBoundingClientRect().top, //скролл от blog
		footerHC = document.getElementById('footer').getBoundingClientRect().top, //скролл от footer
		bodyHC = document.querySelector('body').getBoundingClientRect().bottom;
			
		if (footerHC < 1 || bodyHC < window.innerHeight + 1) {
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#footer"]').addClass("active");
		}
			
		else if (blogHC < 1) {
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#blog"]').addClass("active");
		}
					
		else if (workHC < 1) {
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#work"]').addClass("active");
		}
			
		else if (serviceHC < 1) {
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#service"]').addClass("active");
		}
		
		else {			
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#about"]').addClass("active");
		}
	}
	
	/* Fixed Header */
	$("[data-scroll]").on("click", function(event) {
		event.preventDefault();
		
		var blockId = $(this).data('scroll'),
			blockOffset = $(blockId).offset().top;
			
		$("#nav a").removeClass("active");
		$(this).addClass("active");
		
		$("html, body").animate({
			scrollTop: blockOffset
		}, 700);

	});
	
	/* Button Slider 1 click */
	$("[data-section]").on("click", function(event) {
		event.preventDefault();
		
		var blockId2 = $(this).data('section'),
			blockOffset2 = $(blockId2).offset().top;
		
		$("html, body").animate({
			scrollTop: blockOffset2
		}, 700);

	});
	
	/* Menu nav toggle */
	$("#nav_toggle").on("click", function(event) {
		event.preventDefault();
		
		$("#nav").toggleClass("active");
		$(this).toggleClass("active");
	});
	
	/* Collapse*/
	$("[data-collapse]").on("click", function(event) {
		event.preventDefault();
		
		var blockId = $(this).data("collapse");
		
		$(this).toggleClass("active");
	});
	
	/* Sliders */
	$("[data-slider1]").slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 4000,
		arrows : false,

	  	fade: true
	});
	
	$("[data-slider2]").slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1
	});
	
	/* Script for 1st slider */
	$('[data-slider1]').on('beforeChange', function(event, slick, currentSlide, nextSlide)
	{
		$(".slider__item").removeClass("active");
		$(".slider__item[data-slider-item="+nextSlide+"]").addClass("active");
	});
	

	/* Add class to slider */
	$("#cls").children(".slick-arrow").addClass("dark");
	
});