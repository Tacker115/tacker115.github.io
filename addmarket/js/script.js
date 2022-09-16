$(function (){

    const header = $("#header"),
        headerH = header.innerHeight() - 20,
        navli = $("#nav li"),
        modalCall = $("[data-modal]"),
        modalClose = $(".modal-w"),
        modalQuestion = $("[data-question]"),
        forFirst = $('#question1').find('.form_radio'),
        forScnd = $('#question2').find('.form_radio'),
        forFrth = $('#question4').find('.form_radio'),
        question1 = $('#question1 input[name="radio1"]'),
        question2 = $('#question2 input[name="radio2"]'),
        question3 = $('#question3'),
        question4 = $('#question4 input[name="radio3"]'),
        question5 = $('#question5'),
        question6 = $('#question6'),
        button1 = $('#button1'),
        button2 = $('#button2'),
        button3 = $('#button3'),
        button4 = $('#button4'),
        button5 = $('#button5'),
        button6 = $('#button6');

    let scrollOffset = $(window).scrollTop(),
        a = [];

    /* Nav menu */
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
        let	servicesHC = document.getElementById('services').getBoundingClientRect().top,
            priceHC = document.getElementById('price').getBoundingClientRect().top,
            aboutHC = document.getElementById('about').getBoundingClientRect().top;
        if (aboutHC < 1) {
            navli.removeClass("active");
            $('#nav li[data-scroll="#about"]').addClass("active");
        }
        else if (priceHC < 1) {
            navli.removeClass("active");
            $('#nav li[data-scroll="#price"]').addClass("active");
        }
        else if (servicesHC < 1) {
            navli.removeClass("active");
            $('#nav li[data-scroll="#services"]').addClass("active");
        }
        else {
            navli.removeClass("active");
            $('#nav li[data-scroll="#home"]').addClass("active");
        }
    }

    $("[data-scroll]").on("click", function(event) {
        event.preventDefault();

        let blockId = $(this).data('scroll'),
            blockOffset = $(blockId).offset().top;

        navli.removeClass("active");
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

    /* Slider */
    $("[data-slider1]").slick({
        infinite: true,
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true
    });

    /* Go up */
    $(".go-up").on("click", function(event) {
        event.preventDefault();
        let homeO = $("#home").offset().top;

        $("html, body").animate({
            scrollTop: homeO
        }, 1500);
    });

    /* Modal */
    ModalClosing();
    function ModalClosing () {
        modalClose.find('.modal__dialog').css({
            transform: "rotateX(90deg)"
        });
        setTimeout(function() {
            modalClose.removeClass('show');
            $("#body").removeClass("hidden");
        }, 300);
    };
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
    });
    modalClose.on("click", function (event) {
        ModalClosing();
    });
    $('.modal__dialog').on("click", function (event) {
        event.stopPropagation();
    })

    /* Switcher radio */
    function switcherRadio (forWhat) {
        $(forWhat).on("click", function (event) {
            $(forWhat).removeClass("active");
            $(this).addClass("active");
            $(forWhat).find('input').attr('checked', false);
            $(this).find('input').attr('checked', true);
        });
    };

    /* Quiz */
    //Сохраняем ссылку на стандартный метод jQuery
    var originalAddClassMethod = jQuery.fn.addClass;
    //Переопределяем
    $.fn.addClass = function(){
        var result = originalAddClassMethod.apply(this, arguments);
        //Инициализируем событие смены класса
        $(this).trigger('active');
        return result;
    }
    function checkInput (thisInput,inputSubmit) {
        let inputCount = thisInput.find('input').length,
            empty = thisInput.find('input').filter(function() { return $(this).val() !== ""; }),
            inputCountNotNull = empty.length;

        if (inputCountNotNull == inputCount)
        {
            inputSubmit.attr('disabled', false);
        }
        else
        {
            inputSubmit.attr('disabled', true);
        }
        $(thisInput).on("change", function (event) {
            event.preventDefault();
            empty = thisInput.find('input').filter(function() { return $(this).val() !== ""; });
            inputCountNotNull = empty.length;
            if (inputCountNotNull == inputCount)
            {
                inputSubmit.attr('disabled', false);
            }
            else
            {
                inputSubmit.attr('disabled', true);
            }
        })
    };
    function checkCheckbox (thisInput, inputSubmit) {
        if(thisInput.is(":checked"))
        {
            inputSubmit.attr('disabled', false);
        }
        else
        {
            inputSubmit.attr('disabled', true);
        }
        $(inputSubmit).on("click", function (event) {
            event.preventDefault();
            if(thisInput.is(":checked"))
            {
                inputSubmit.attr('disabled', false);
            }
            else
            {
                inputSubmit.attr('disabled', true);
            }
        })
    };
    $('#question1').bind('active', function(){
        a[0] = $('#question1 .form_radio.active').find('label').text();
        switcherRadio(forFirst);
        checkCheckbox(question1, button1);
    });
    $('#question2').bind('active', function(){
        a[1] = $('#question2 .form_radio.active').find('label').text();
        switcherRadio(forScnd);
        checkCheckbox(question2, button2);
    });
    $('#question3').bind('active', function(){
        checkInput(question3,button3);
        $('#text-1').on('change, input', function() {
            a[2] = $('#text-1').val();
        });
    });
    $('#question4').bind('active', function(){
        a[3] = $('#question4 .form_radio.active').find('label').text();
        switcherRadio(forFrth);
        checkCheckbox(question4, button4);
    });
    $('#question5').bind('active', function(){
        checkInput(question5,button5);
        $('#text-2').on('change, input', function() {
            a[4] = $('#text-2').val();
        });
        $('#text-3').on('change, input', function() {
            a[5] = $('#text-3').val();
        });

    });
    $('#question6').bind('active', function(){
        checkInput(question6,button6);
        $('#text-4').on('change, input', function() {
            a[6] = $('#text-4').val();
        });
        $('#text-5').on('change, input', function() {
            a[7] = $('#text-5').val();
        });
        $('#text-6').on('change, input', function() {
            a[8] = $('#text-6').val();
        });
    });
    $('#modal-finish').bind('active', function(){
        setTimeout(function() {
            ModalClosing();
        }, 3000);
        setTimeout(function() {
            a = [];
            $(".modal__dialog").removeClass("active");
            $("#modal-start").addClass('active');
            location.reload();
            //console.log(a); тестируем запись данных в массив
        }, 4000);
        //console.log(a); тестируем очистку массива
    });
    modalQuestion.on("click", function (event) {
        event.preventDefault();
        let $this = $(this);
        let modalId = $this.data('question');
        $(".modal__dialog").removeClass("active");
        $(modalId).addClass('active');
    });
});