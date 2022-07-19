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

	var	aboutHC = document.getElementById('about').getBoundingClientRect().top,
		blogHC = document.getElementById('blog').getBoundingClientRect().top;

		if (blogHC < 1) {
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
		header.toggleClass("active");
		$("#nav").toggleClass("active");
		$(this).toggleClass("active");
	});

	/* Fixed Header */
	$(".load-more").on("click", function(event) {
		event.preventDefault();

		$(".works-footer").addClass("d-none");
		$(".works-card:nth-child(n)").css("display","flex");
	});

	/* Modal */
	const modalCall = $("[data-modal]");
	const modalClose = $("[data-close]");
	modalCall.on("click", function (event) {
		event.preventDefault();
		let $this = $(this);
		let modalId = $this.data('modal');
		$(modalId).addClass('show');
		$("#body").addClass("hidden");

		setTimeout(function() {
			$(modalId).find('.modal__dialog').css({
				transform: "rotateX(0)"
			});
		}, 300);

		$("[data-slider1]").slick('setPosition');
	})

	modalClose.on("click", function (event) {
		event.preventDefault();
		let $this = $(this);
		let modalParent = $this.parents('.modal-w');

		modalParent.find('.modal__dialog').css({
			transform: "rotateX(90deg)"
		});

		setTimeout(function() {
			modalParent.removeClass('show');
			$("#body").removeClass("hidden");
		}, 300);
	})

	$('.modal-w').on("click", function (event) {
		let $this = $(this);
		$this.find('.modal__dialog').css({
			transform: "rotateX(90deg)"
		});

		setTimeout(function() {
			$this.removeClass('show');
			$("#body").removeClass("hidden");
		}, 300);
	})
	$('.modal__dialog').on("click", function (event) {
		event.stopPropagation();
	})

	/* Slider */
	$("[data-slider1]").slick({
		infinite: true,
		fade: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		dots: true
	});

	$('.slickPrev').on("click", function (event) {
		event.preventDefault();
		$("[data-slider1]").slick('slickPrev');
	})
	$('.slickNext').on("click", function (event) {
		event.preventDefault();
		$("[data-slider1]").slick('slickNext');
	})
});