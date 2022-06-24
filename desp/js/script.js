$(function (){
	var header = $("#header"),
		headerH = $("#header").innerHeight() - 20,
		scrollOffset = $(window).scrollTop();

	/* Fixed Header */
	checkScroll(scrollOffset);
	fixScroll(scrollOffset);

	$(window).on("scroll", function() {
		scrollOffset = $(this).scrollTop();
		fixScroll(scrollOffset);
		checkScroll(scrollOffset);
	});

	function checkScroll(scrollOffset) {
		if (scrollOffset >= headerH) {
			header.addClass("fixed");
		} else {
			header.removeClass("fixed");
		}
	}

	function fixScroll(scrollOffset) {

	var		aboutHC = document.getElementById('about').getBoundingClientRect().top,
			contactsHC = document.getElementById('contacts').getBoundingClientRect().top,
			blogHC = document.getElementById('blog').getBoundingClientRect().top;

		if (contactsHC < 1) {
			$("#nav li").removeClass("active");
			$('#nav li a[data-scroll="#contacts"]').parent().addClass("active");
		}

		else if (blogHC < 1) {
			$("#nav li").removeClass("active");
			$('#nav li a[data-scroll="#blog"]').parent().addClass("active");
		}

		else if (aboutHC < 1) {
			$("#nav li").removeClass("active");
			$('#nav li a[data-scroll="#about"]').parent().addClass("active");
		}

		else {
			$("#nav li").removeClass("active");
			$('#nav li a[data-scroll="#home"]').parent().addClass("active");
		}
	}

	/* Fixed Header */
	$("[data-scroll]").on("click", function(event) {
		event.preventDefault();

		var blockId = $(this).data('scroll'),
			blockOffset = $(blockId).offset().top;

		$("#nav li a").removeClass("active");
		$(this).addClass("active");

		$("html, body").animate({
			scrollTop: blockOffset
		}, 700);

	});

	/* Nav toggle */
	$("#nav_toggle").on("click", function(event) {
		event.preventDefault();

		$("#body").toggleClass("hidden");
		$("#header").toggleClass("active");
		$("#nav").toggleClass("active");
		$(this).toggleClass("active");
	});

	/* Fixed Header */
	$(".load-more").on("click", function(event) {
		event.preventDefault();

		$(".works-footer").addClass("d-none");
		$(".works-card:nth-child(n)").css("display","flex");
	});

});