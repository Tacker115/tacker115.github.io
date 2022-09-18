$(function (){
	
	var header = $("#header"),
		headerH = $("#header").innerHeight(),
		vid = document.getElementById('vid'),
		scrollOffset = $(window).scrollTop();
	
	/* Fixed Header */
	checkScroll(scrollOffset);
	fixScroll(scrollOffset);
	
	$(window).on("scroll", function() {
		
		scrollOffset = $(this).scrollTop();
		checkScroll(scrollOffset);
		fixScroll(scrollOffset);
	});
	
	$(window).resize(function() {
        let windowW = window.innerWidth;
		if (windowW >= 771) {
			$(".mask").removeClass("active");
			header.removeClass("active");
			$("#nav").removeClass("active");
			$(".nav-toggle").removeClass("active");
		}
    });
	
	function checkScroll(scrollOffset) {
		
		if (scrollOffset >= headerH) {
			header.addClass("fixed");
		} else {
			header.removeClass("fixed");
		}
	}
	
	/* Animation OnScroll */
	function onEntry(entry) {
	  entry.forEach(change => {
		if (change.isIntersecting) {
		 change.target.classList.add('element-show');
		}
	  });
	}

	let options = {
	  threshold: [0.5] };
	let observer = new IntersectionObserver(onEntry, options);
	let elements = document.querySelectorAll('.element-animation');

	for (let elm of elements) {
	  observer.observe(elm);
	}
	
	/* Fixed Header */
	$("[data-scroll]").on("click", function(event) {
		
		
		var blockId = $(this).data('scroll'),
			blockOffset = $(blockId).offset().top;
			
		$("#nav a").removeClass("active");
		$(this).addClass("active");
		
		$("html, body").animate({
			scrollTop: blockOffset
		}, 700);

	});
	
	function fixScroll(scrollOffset) {

	var	aboutHC = document.getElementById('about').getBoundingClientRect().top, 
		servicesHC = document.getElementById('services').getBoundingClientRect().top, 
		workHC = document.getElementById('work').getBoundingClientRect().top, 
		priceHC = document.getElementById('contacts').getBoundingClientRect().top;
			
		if (priceHC < 1) {
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#contacts"]').addClass("active");
		}
			
		else if (servicesHC < 1) {
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#services"]').addClass("active");
		}
					
		else if (workHC < 1) {
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#work"]').addClass("active");
		}
			
		else if (aboutHC < 1) {
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#about"]').addClass("active");
		}
		
		else {			
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#home"]').addClass("active");
		}
	}
	
	/* Nav toggle */
	$("#nav_toggle").on("click", function(event) {
		event.preventDefault();
		
		$("#header").toggleClass("active");
		$("#nav").toggleClass("active");
		$(this).toggleClass("active");
		$(".mask").toggleClass("active");
	});

	$("#scroll__down").on("click", function(event) {
		event.preventDefault();
		var blockAboutOffset = $("#about").offset().top;
		
		$("html, body").animate({
			scrollTop: blockAboutOffset
		}, 700);
	});
	
	/* Video */
	$("#video-block").on("click", function(event) {
		event.preventDefault(); 
		
		if (vid.paused) {
			vid.play();
			$("#video-block").removeClass('paused');
		  } else {
			vid.pause();
			$("#video-block").addClass('paused');
		  };
		});
	
	/* Sliders */
	$("[data-slider1]").slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1
	});
	
	$("[data-slider2]").slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1
	});
	
});