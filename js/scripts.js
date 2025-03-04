// ================================
// ========== javascript ==========


//header
window.addEventListener('DOMContentLoaded', function() {
    var header = document.querySelector('.header');
    var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;



    if (document.body.classList.contains('admin-bar')) { //WITH ADMIN_BAR

        if (scrollPosition > 0) {
            header.classList.add('header--fixed');
        }

        window.addEventListener('scroll', function() {
            scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollPosition > 0) {
                header.classList.add('header--fixed');
            } else {
                header.classList.remove('header--fixed');
            }
        });

    } else { //WITHOUT ADMIN_BAR

        if (scrollPosition > 20) {
            header.classList.add('header--fixed');
        }

        window.addEventListener('scroll', function() {
            scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollPosition > 20) {
                header.classList.add('header--fixed');
            } else {
                header.classList.remove('header--fixed');
            }
        });

    }
});


//main-menu-block
window.addEventListener('DOMContentLoaded', function() {
    var main_menu_block = document.querySelector('.main-menu-block');
    var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

    if (document.body.classList.contains('admin-bar')) { //WITH ADMIN_BAR

        if (scrollPosition > 112) {
            main_menu_block.classList.add('main-menu-block--fixed');
        }
        window.addEventListener('scroll', function () {
            scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollPosition > 112) {
                main_menu_block.classList.add('main-menu-block--fixed');
            } else {
                main_menu_block.classList.remove('main-menu-block--fixed');
            }
        });

    } else { //WITHOUT ADMIN_BAR

        if (scrollPosition > 115) {
            main_menu_block.classList.add('main-menu-block--fixed');
        }
        window.addEventListener('scroll', function () {
            scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollPosition > 115) {
                main_menu_block.classList.add('main-menu-block--fixed');
            } else {
                main_menu_block.classList.remove('main-menu-block--fixed');
            }
        });
    }
});



//humburger

let hamburger = document.querySelector('.header__hamburger');
let mobile_menu = document.querySelector('.header-mobile');
let mobile_background = document.querySelector('.header-mobile__background');
let hamburger_close = document.querySelector('.header-mobile__close');
let body = document.querySelector('body');
const toggleMenu = () => {
    mobile_menu.classList.toggle('header-mobile--active');
    hamburger.classList.toggle('hamburger-close');
    mobile_background.classList.toggle('header-mobile__background--active');
    body.classList.toggle('overflow-hidden');
}
hamburger_close.addEventListener('click', e => {
    e.stopPropagation();
    toggleMenu();
});
hamburger.addEventListener('click', e => {
    e.stopPropagation();
    toggleMenu();
});
document.addEventListener('click', e => {
    let target = e.target;
    let its_mobile_menu = target == mobile_menu || mobile_menu.contains(target);
    let its_hamburger = target == hamburger;
    let mobile_menu_is_active = mobile_menu.classList.contains('header-mobile--active');

    if (!its_mobile_menu && !its_hamburger && mobile_menu_is_active) {
        toggleMenu();
    }
})


//---------

//fancybox
Fancybox.bind("[data-fancybox]", {
    // Your custom options
});




//calculator - field
function update_calc_1() {
    const span = document.getElementById('size-calibration_1');
    const input = document.getElementById('autosized-input_1');
    span.innerText = input.value;

    const span_bobr = document.querySelectorAll('.calc-arenda__row__bobr__span');
    for (let elem of span_bobr) {
        elem.innerText = input.value;
    }
}
function update_calc_2() {
    const span = document.getElementById('size-calibration_2');
    const input = document.getElementById('autosized-input_2')
    span.innerText = input.value;

    if (input.value < 900) {//сначала валидация
        input.classList.add('is-error-validate');
    } else {
        input.classList.remove('is-error-validate');
    }
    if (isNaN(input.value) || input.value < 900) {
        input.value = 900;
        span.innerText = 900;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    if ( document.getElementById('autosized-input_1') ) {
        const input_1 = document.getElementById('autosized-input_1');
        input_1.oninput = update_calc_1;
        input_1.value = "0";
        update_calc_1();
    }
    if ( document.getElementById('autosized-input_2') ) {
        const input_2 = document.getElementById('autosized-input_2');
        input_2.oninput = update_calc_2;
        input_2.value = 900;
        update_calc_2();
    }

})


//calculator - update
function update_calc_result() {
    if($('#autosized-input_1').val() === ''){//Валидация
        $('#autosized-input_1').val('0');
        $('#size-calibration_1').text('0');
        $('#autosized-input_1').select();
    }
    if($('#autosized-input_2').val() === ''){//Валидация
        $('#autosized-input_2').val('0');
        $('#size-calibration_2').text('0');
        $('#autosized-input_2').select();
    }
    if($('#autosized-input_1').val() >= 10000000) {//Валидация
        $('#autosized-input_1').val('10000000');
        $('#size-calibration_1').text('10000000');
        $('.calc-arenda__row__bobr__span').text('10000000');
    }
    if($('#autosized-input_2').val() >= 10000000) {//Валидация
        $('#autosized-input_2').val('10000000');
        $('#size-calibration_2').text('10000000');
    }

    const sum_1 = $('#autosized-input_1').val() * $('#autosized-input_2').val();
    const sum_2 = $('#autosized-input_1').val() * $('#calc-arenda__row__bobr__price').attr('data-calcArendePrice');
    const result = sum_1 - sum_2;
    const resultFormat = new Intl.NumberFormat('ru-RU').format(result);
    $('.calc-arenda-banner__result-sum').text(resultFormat);
}

document.querySelectorAll('.block-size__autosized-input').forEach(e => e.addEventListener('keyup',  function () {
    update_calc_result();
}))
document.querySelectorAll('.block-size__autosized-input').forEach(e => e.addEventListener('keydown',  function () {
    update_calc_result();
}))



// Contact-form-7 Успешная отправка
document.addEventListener('wpcf7mailsent', function(event) {
    //Yandex metrika
    if (event.detail.contactFormId == '15') {
        ym(98047345,'reachGoal','consult-form');
    }
    if (event.detail.contactFormId == '14') {
        ym(98047345,'reachGoal','consult-form');
    }
    if (event.detail.contactFormId == '45588') {
        ym(98047345,'reachGoal','call-a-master');
    }
    if (event.detail.contactFormId == '43913') {
        ym(98047345,'reachGoal','send-rental-form');
    }


    var successMessage = document.createElement('div');
    successMessage.className = 'contact-form__form-output';
    successMessage.innerHTML = '<span class="contact-form__form-output__name">Заявка отправлена!</span>\n' +
        'Спасибо за обращение. Мы скоро с вами свяжемся для уточнения деталей.';

    // Добавляем элемент под форму
    event.target.parentNode.append(successMessage, event.target.nextSibling);
}, false);


//Удаление сообщения об успешной отправке
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('contact-form__submit')) {
        var elements = document.querySelectorAll('.contact-form__form-output');
        elements.forEach(function(element) {
            element.remove();
        });
    }
});


//Доп скрытые поля для Форм
jQuery(document).ready(function($) {

    // Получаем текущий URL страницы
    var currentPageUrl = window.location.href;
    $('.contact-form__hidden--text-page').val(currentPageUrl);

    // Получаем h1
    var pageTitle = $('h1').text();
    pageTitle = pageTitle.replace(/\n/g, '').trim(); //уберём перенос строк
    $('.contact-form__hidden--text-title').val(pageTitle);

    //btn-add-hidden-info--checkboxes-block
    $('.btn-add-hidden-info--checkboxes-block').on('click', function(event){
        var texts = [];
        $('.checkboxes-block__item__checkbox:checked').each(function() {
            var text = $(this).siblings('.checkboxes-block__item__text').text();
            texts.push(text);
        });
        var combinedText = texts.join(', ');
        $('.contact-form__hidden--text-info').val(combinedText);
    });

    //btn-add-hidden-info--calc
    $('.btn-add-hidden-info--calc').on('click', function(event){

        $('.modal-block__title--js').html($('.btn-add-hidden-info--calc').text());//сброс заголовка

        var leasing_text = 'Стоимость оборудования: ' + $('#control-leasing-1').val() + ' руб;\n';
            leasing_text += 'Авансовый платёж: ' + $('#control-leasing-2').val() + '% (' + $('.calc-leasing__item__slide__avans-price').text() + ');\n';
            leasing_text += 'Срок лизинга: ' + $('#control-leasing-3').val() + ' мес;\n';
            leasing_text += 'Ежемесячный платеж, включая НДС: ' + $('.calc-leasing-1-result').text() + ';\n';
            leasing_text += 'Сумма договора лизинга: ' + $('.calc-leasing-2-result').text() + ';\n';
            leasing_text += 'Налоговая экономия по договору: ' + $('.calc-leasing-3-result').text() + ';\n';

        $('.contact-form__hidden--text-info').val(leasing_text);
    });
	
	if($('div').is('.kp_manager')){
		$('.kp_manager').show().insertAfter($('h1'));
	}
	
	if($('body').is('.admin-bar.woocommerce-cart.logged-in')){
		setTimeout(function(){
			// $('<a class="kp_download" href="#">Скачать КП</a>').insertAfter($('.wc-block-cart__submit'));
			$('<a class="kp_create" href="#">Создать КП</a>').insertAfter($('.wc-block-cart__submit'));
		}, 2000);
		
		$('body').on('click', '.kp_download', function(e){
			e.preventDefault();
			
			$.ajax({
				type : 'POST',
				url : "/wp-admin/admin-ajax.php",
				data : {
					action : 'pdf_gen_pure'
				},
				beforeSend : function( xhr ) {
					$('.kp_download').text( 'Загружаем...' );
					//$('.product-filter-slider__slider-wrap').addClass('is-loading');
				},
				success : function( data ){
					$('.kp_download').text( 'Скачать КП' );
					window.open(data, '_blank');
				}

			});
		});

        $('body').on('click', '.kp_create', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: "/wp-admin/admin-ajax.php",
                data: {
                    action: 'kp_create_post',
                },
                beforeSend: function(xhr) {
                    $('.kp_create').text( 'Создание...' );
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.data.redirect_url;
                        $('.kp_create').text( 'Перенаправление...' );
                    } else {
                        alert(response.data);
                        $('.kp_create').text( 'Создать КП' );
                    }
                },
                error: function(xhr, status, error) {
                    alert('Произошла ошибка: ' + error);
                    $('.kp_create').text( 'Создать КП' );
                }
            });
        });


	}

});






//Добавление в корзину
// function addToCart(product_id) {
//     // var quantity = jQuery('input[name="quantity"]').val();
//     var product_title = $('[data-preloader="'+product_id+'"]').attr('data-title');
//     $('[data-preloader="'+product_id+'"]').addClass('active');
//     jQuery.ajax({
//         url: "/wp-admin/admin-ajax.php",
//         type: 'POST',
//         data: {
//             action: 'add_to_cart',
//             product_id: product_id,
//             quantity: 1,
//         },
//         success: function(response) {
//             if($('#add-to-cart-message').length) {
//                 $('#add-to-cart-message').html(response);
//             }
//             $('.wish-modal-block__product-name').html(product_title);
//             $('.modal-block__cart-add').addClass('modal-open');
//             $('.modal-blur-wrapper').addClass('modal-open');
//
//             $('[data-preloader]').removeClass('active')
//
//             var cartCountElement = jQuery('.header__flex__right__soc__cart__num');
//             var count = cartCountElement.attr('data-count');
//             count++;
//             cartCountElement.text(count);
//             cartCountElement.attr('data-count',count);
//
//             // Если счетчик больше 0, добавляем класс 'active' к родительскому элементу
//             if (count > 0) {
//                 jQuery('.header__flex__right__cart').addClass('active');
//             } else {
//                 jQuery('.header__flex__right__cart').removeClass('active');
//             }
//         }
//     });
// }

// ==================================
// ==================================
// ============= jQuery =============
jQuery(document).ready(function ($) {


    // Калькулятор Лизинга

    //Разделение на тысячные
    function numberWithSpaces(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    }
    //Ввод только цифр
    function allowOnlyNumbers(event) {
        var charCode = (event.which) ? event.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            event.preventDefault();
        }
    }

    var $slider_leasing_1 = $("#calc-leasing-1");
    var $control_leasing_1 = $("#control-leasing-1");
    var $slider_leasing_2 = $("#calc-leasing-2");
    var $control_leasing_2 = $("#control-leasing-2");
    var $slider_leasing_3 = $("#calc-leasing-3");
    var $control_leasing_3 = $("#control-leasing-3");

    // Slider 1
    $slider_leasing_1.ionRangeSlider({
        skin: "round",
        min: 100000,
        max: 3000000,//максимальное #calc-leasing-1
        from: 1400000,
        step: 1000,
        postfix: " руб",
        onStart: function(data) {
            $control_leasing_1.val(numberWithSpaces(data.from));
        },
        onChange: function(data) {
            $control_leasing_1.val(numberWithSpaces(data.from));
        },
        onFinish: function(data) {
            $control_leasing_1.val(numberWithSpaces(data.from));
        }
    });

    var sliderInstance1 = $slider_leasing_1.data("ionRangeSlider");

    $control_leasing_1.on("input", function() {
        var val = $(this).val().replace(/\s+/g, '');

        if (val < 100000) {
            val = 100000;
        } else if (val > 3000000) {//максимальное #calc-leasing-1
            val = 3000000;//максимальное #calc-leasing-1
        }

        sliderInstance1.update({
            from: val
        });

        $(this).val(numberWithSpaces(val));
    });

    $control_leasing_1.on("keypress", allowOnlyNumbers);

    // Slider 2
    $slider_leasing_2.ionRangeSlider({
        skin: "round",
        min: 0,
        max: 49,
        from: 25,
        step: 1,
        postfix: "%",
        onStart: function(data) {
            $control_leasing_2.val(data.from);
        },
        onChange: function(data) {
            $control_leasing_2.val(data.from);
        },
        onFinish: function(data) {
            $control_leasing_2.val(data.from);
        }
    });

    var sliderInstance2 = $slider_leasing_2.data("ionRangeSlider");

    $control_leasing_2.on("input", function() {
        var val = $(this).val().replace(/\s+/g, '');

        if (val < 0) {
            val = 0;
        } else if (val > 49) {
            val = 49;
        }

        sliderInstance2.update({
            from: val
        });

        $(this).val(val);
    });

    $control_leasing_2.on("keypress", allowOnlyNumbers);

    // Slider 3
    $slider_leasing_3.ionRangeSlider({
        skin: "round",
        min: 6,
        max: 36,
        from: 20,
        step: 1,
        postfix: " мес",
        onStart: function(data) {
            $control_leasing_3.val(data.from);
        },
        onChange: function(data) {
            $control_leasing_3.val(data.from);
        },
        onFinish: function(data) {
            $control_leasing_3.val(data.from);
        }
    });

    var sliderInstance3 = $slider_leasing_3.data("ionRangeSlider");

    $control_leasing_3.on("input", function() {
        var val = $(this).val().replace(/\s+/g, '');

        if (val < 6) {
            val = 6;
        } else if (val > 36) {
            val = 36;
        }

        sliderInstance3.update({
            from: val
        });

        $(this).val(val);
    });

    $control_leasing_3.on("keypress", allowOnlyNumbers);


    //Calculator
    let lastGoalTime = 0;
    const goalInterval = 5000; // 5 секунд
    $('.calc-leasing').on('change',function() {

        var stoimost_obrudovaniya = parseFloat($('#calc-leasing-1').val().replace(/\s+/g, ''));

        var avansovii_platyozh_field = (stoimost_obrudovaniya / 100) * $('#calc-leasing-2').val();
        $('.calc-leasing__item__slide__avans-price').attr('data-avansPrice',avansovii_platyozh_field);
        $('.calc-leasing__item__slide__avans-price').html(avansovii_platyozh_field.toLocaleString() + " руб");

        var avansovii_platyozh = $('.calc-leasing__item__slide__avans-price').attr('data-avansPrice');
        var srok_lizinga = parseFloat($('#calc-leasing-3').val());

        var summa_finansirovaniya = stoimost_obrudovaniya - avansovii_platyozh;
        var udorozhanie = summa_finansirovaniya * 0.13/12 * srok_lizinga;
        var summa_dogovora = stoimost_obrudovaniya + udorozhanie;
        var yezhemesyachnii_platyozh = (summa_dogovora - avansovii_platyozh) / srok_lizinga;
        var ekonomiya_na_NDS = (stoimost_obrudovaniya + udorozhanie) / 120 * 20;
        var raskhodi_na_protsenti = (udorozhanie) / 120 * 100;
        var amortizatsiya = stoimost_obrudovaniya / 120 * 100 / srok_lizinga * srok_lizinga;
        var ekonomiya_na_naloge_na_pribil = (raskhodi_na_protsenti + amortizatsiya) * 0.2;
        var obshchaya_ekonomiya_na_nalogakh = ekonomiya_na_NDS + ekonomiya_na_naloge_na_pribil;

        //
        $('.calc-leasing-1-result span').text(yezhemesyachnii_platyozh.toFixed(0));
        $('.calc-leasing-2-result span').text(summa_dogovora.toFixed(0));
        $('.calc-leasing-3-result span').text(obshchaya_ekonomiya_na_nalogakh.toFixed(0));

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        }
        $('.calc-leasing-1-result span').text(numberWithCommas($('.calc-leasing-1-result span').text()))
        $('.calc-leasing-2-result span').text(numberWithCommas($('.calc-leasing-2-result span').text()))
        $('.calc-leasing-3-result span').text(numberWithCommas($('.calc-leasing-3-result span').text()))


        //Calculator for product
        var stoimost_obrudovaniya_24 = parseFloat($('#calc-leasing-1').val().replace(/\s+/g, ''));
        // var term = parseInt($('#calc-leasing-2').val());
        var avansovii_platyozh_24 = $('.calc-leasing__item__slide__avans-price').attr('data-avansPrice');
        var srok_lizinga_24 = 24;

        var summa_finansirovaniya_24 = stoimost_obrudovaniya_24 - avansovii_platyozh_24;
        var udorozhanie_24 = summa_finansirovaniya_24 * 0.13/12 * srok_lizinga_24;
        var summa_dogovora_24 = stoimost_obrudovaniya_24 + udorozhanie_24;
        var yezhemesyachnii_platyozh_24 = (summa_dogovora_24 - avansovii_platyozh_24) / srok_lizinga_24;

        $('.product-card__price__real .price').text(numberWithCommas(yezhemesyachnii_platyozh_24.toFixed(0)))
        // $('.product-detail__info-block__price__current .value').text(numberWithCommas(yezhemesyachnii_platyozh_24.toFixed(0)))

        //Метрика
        // Проверяем, прошло ли достаточно времени с последнего срабатывания цели
        const currentTime = new Date().getTime();
        if (currentTime - lastGoalTime > goalInterval) {
            ym(98047345, 'reachGoal', 'use-calc');
            lastGoalTime = currentTime;
        }

    });


    //youtube
    $('.youtube-video__preview').on('click', function () {
        video_id = $(this).attr('data-idYoutube');
        video_wrap = $(this).parents('.youtube-video__wrap').find('.youtube-video__iframe-block').attr('id');

        $(this).parents('.youtube-video__wrap').find('.youtube-video__hidden-btn-play').fadeOut(250);
        $(this).fadeOut(250);

        if($(this).parents('.iframe-full-video').length){
            $(this).parents('.iframe-full-video').find('.iframe-full-video__text-top').hide();
            $(this).parents('.iframe-full-video').find('.iframe-full-video__text-bottom').hide();
        }

        new YT.Player(video_wrap, {
            videoId: video_id,
            events: {
                onReady: e => e.target.playVideo()
            }
        });

    })





    // header-mobile menu
    $('.header-mobile__menu .header-menu .menu-item.menu-item-has-children').on('click', function (item) {
        item.stopPropagation();
        $(this).toggleClass('open');

    });
    //---------

    //flex-partners__item__links__item--last
    $('.flex-partners__item__links__item--last').on('click', function () {
        $(this).parent('.flex-partners__item__links').removeClass('items-hide');
        $(this).remove();
    })
    //---------

    //sliders
    $('.slider-default--cert').owlCarousel({
        loop: true,
        // items:5,
        autoWidth: true,
        margin:12,
        center:true,
        nav:true,
        navText: ['<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">\n' +
        '<rect width="44" height="44" rx="22" fill="#EB6025"/>\n' +
        '<path fill-rule="evenodd" clip-rule="evenodd" d="M16.5633 23.025C15.9834 22.4539 15.9834 21.5279 16.5633 20.9568L23.1922 14.4283C23.7721 13.8572 24.7122 13.8572 25.2921 14.4283C25.872 14.9994 25.872 15.9254 25.2921 16.4965L19.7132 21.9909L25.2921 27.4853C25.872 28.0564 25.872 28.9824 25.2921 29.5535C24.7122 30.1246 23.7721 30.1246 23.1922 29.5535L16.5633 23.025Z" fill="white"/>\n' +
        '</svg>', '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">\n' +
        '<rect width="44" height="44" rx="22" transform="matrix(-1 0 0 1 44 0)" fill="#EB6025"/>\n' +
        '<path fill-rule="evenodd" clip-rule="evenodd" d="M27.4367 23.025C28.0166 22.4539 28.0166 21.5279 27.4367 20.9568L20.8078 14.4283C20.2279 13.8572 19.2878 13.8572 18.7079 14.4283C18.128 14.9994 18.128 15.9254 18.7079 16.4965L24.2868 21.9909L18.7079 27.4853C18.128 28.0564 18.128 28.9824 18.7079 29.5535C19.2878 30.1246 20.2279 30.1246 20.8078 29.5535L27.4367 23.025Z" fill="white"/>\n' +
        '</svg>'],
    });


    $('.slider-logos').owlCarousel({
        loop: true,
        items:5,
        // autoWidth: true,
        margin:38,
        center:true,
        nav:true,
        navText: ['<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">\n' +
        '<rect width="44" height="44" rx="22" fill="#EB6025"/>\n' +
        '<path fill-rule="evenodd" clip-rule="evenodd" d="M16.5633 23.025C15.9834 22.4539 15.9834 21.5279 16.5633 20.9568L23.1922 14.4283C23.7721 13.8572 24.7122 13.8572 25.2921 14.4283C25.872 14.9994 25.872 15.9254 25.2921 16.4965L19.7132 21.9909L25.2921 27.4853C25.872 28.0564 25.872 28.9824 25.2921 29.5535C24.7122 30.1246 23.7721 30.1246 23.1922 29.5535L16.5633 23.025Z" fill="white"/>\n' +
        '</svg>', '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">\n' +
        '<rect width="44" height="44" rx="22" transform="matrix(-1 0 0 1 44 0)" fill="#EB6025"/>\n' +
        '<path fill-rule="evenodd" clip-rule="evenodd" d="M27.4367 23.025C28.0166 22.4539 28.0166 21.5279 27.4367 20.9568L20.8078 14.4283C20.2279 13.8572 19.2878 13.8572 18.7079 14.4283C18.128 14.9994 18.128 15.9254 18.7079 16.4965L24.2868 21.9909L18.7079 27.4853C18.128 28.0564 18.128 28.9824 18.7079 29.5535C19.2878 30.1246 20.2279 30.1246 20.8078 29.5535L27.4367 23.025Z" fill="white"/>\n' +
        '</svg>'],
        responsive: {
            0: {
                items:2.2,
                margin:24,
                center: true,
                startPosition: 1,
            },
            481: {
                items:4,
                margin:24,
                center: true,
                startPosition: 1,
            },
            801: {
                items:4,
                margin:24,
                center: false,
            },
            1071: {
                items:4,
                margin:24,
                center: false,
            },
            1261: {
                items:5,
                margin:24,
                center: true,
            }
        }
    });

    $('.block-text-slider__slider').owlCarousel({
        loop: false,
        items:3,
        autoWidth: true,
        margin:8,
        // center:false,
        dots:false,
        nav:true,
        navText: ['<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">\n' +
        '<rect width="44" height="44" rx="22" fill="#EB6025"/>\n' +
        '<path fill-rule="evenodd" clip-rule="evenodd" d="M16.5633 23.025C15.9834 22.4539 15.9834 21.5279 16.5633 20.9568L23.1922 14.4283C23.7721 13.8572 24.7122 13.8572 25.2921 14.4283C25.872 14.9994 25.872 15.9254 25.2921 16.4965L19.7132 21.9909L25.2921 27.4853C25.872 28.0564 25.872 28.9824 25.2921 29.5535C24.7122 30.1246 23.7721 30.1246 23.1922 29.5535L16.5633 23.025Z" fill="white"/>\n' +
        '</svg>', '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">\n' +
        '<rect width="44" height="44" rx="22" transform="matrix(-1 0 0 1 44 0)" fill="#EB6025"/>\n' +
        '<path fill-rule="evenodd" clip-rule="evenodd" d="M27.4367 23.025C28.0166 22.4539 28.0166 21.5279 27.4367 20.9568L20.8078 14.4283C20.2279 13.8572 19.2878 13.8572 18.7079 14.4283C18.128 14.9994 18.128 15.9254 18.7079 16.4965L24.2868 21.9909L18.7079 27.4853C18.128 28.0564 18.128 28.9824 18.7079 29.5535C19.2878 30.1246 20.2279 30.1246 20.8078 29.5535L27.4367 23.025Z" fill="white"/>\n' +
        '</svg>'],
        responsive: {
            0: {
                items:2,
            },
            881: {
                items:3,
            },
            1201: {
                items:3,
            }
        }
    });



    var swiper_blog = new Swiper(".blog-slider", {
        slidesPerView: "auto",
        spaceBetween: 24,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                spaceBetween: 12,
                centeredSlides: true,
                initialSlide: 1,
            },
            460: {
                spaceBetween: 12,
                centeredSlides: false,
                initialSlide: 0,
            },
            1120: {
                spaceBetween: 24,
                centeredSlides: false,
                initialSlide: 0,
            },
        },
    });
    var swiper_review = new Swiper(".review-slider", {
        slidesPerView: "auto",
        spaceBetween: 24,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".review-slider .swiper-button__nav__button--next",
            prevEl: ".review-slider .swiper-button__nav__button--prev",
        },
        breakpoints: {
            0: {
                spaceBetween: 12,
                centeredSlides: true,
                initialSlide: 1,
            },
            460: {
                spaceBetween: 12,
                centeredSlides: false,
                initialSlide: 0,
            },
            1120: {
                spaceBetween: 24,
                centeredSlides: false,
                initialSlide: 0,
            },
        },
    });




    $('.before-after-cards__slider').owlCarousel({
        loop: false,
        autoWidth: true,
        margin:20,
        center: true,
        dots:false,

        nav:false,
        // navText: ['<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">\n' +
        // '<rect width="44" height="44" rx="22" fill="#EB6025"/>\n' +
        // '<path fill-rule="evenodd" clip-rule="evenodd" d="M16.5633 23.025C15.9834 22.4539 15.9834 21.5279 16.5633 20.9568L23.1922 14.4283C23.7721 13.8572 24.7122 13.8572 25.2921 14.4283C25.872 14.9994 25.872 15.9254 25.2921 16.4965L19.7132 21.9909L25.2921 27.4853C25.872 28.0564 25.872 28.9824 25.2921 29.5535C24.7122 30.1246 23.7721 30.1246 23.1922 29.5535L16.5633 23.025Z" fill="white"/>\n' +
        // '</svg>', '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">\n' +
        // '<rect width="44" height="44" rx="22" transform="matrix(-1 0 0 1 44 0)" fill="#EB6025"/>\n' +
        // '<path fill-rule="evenodd" clip-rule="evenodd" d="M27.4367 23.025C28.0166 22.4539 28.0166 21.5279 27.4367 20.9568L20.8078 14.4283C20.2279 13.8572 19.2878 13.8572 18.7079 14.4283C18.128 14.9994 18.128 15.9254 18.7079 16.4965L24.2868 21.9909L18.7079 27.4853C18.128 28.0564 18.128 28.9824 18.7079 29.5535C19.2878 30.1246 20.2279 30.1246 20.8078 29.5535L27.4367 23.025Z" fill="white"/>\n' +
        // '</svg>'],
        responsive: {
            0: {
                margin:10,
                center: false,
                dots:true,
            },
            561: {
                margin:20,
                center: true,
                dots:false,
            },
            1261: {
                margin:20,
                center: true,
                dots:false,
            }
        }
    });
    //---------


    //custom scrollbar
    $(window).on("load",function(){
        $(".custom-scroll").mCustomScrollbar({
            theme:"bober-orange",
        });
    });

    //custom scrollbar
    function custom_scroll_price_table(){
        if ($(window).width() <= 720) {
            $(".custom-scroll--horizontal").mCustomScrollbar({
                theme: "bober-orange-horizontal",
            });
        }
    };
    $(window).on("load",function(){
        custom_scroll_price_table(); //иниц
        $(window).resize(function() { //проверка при изменении окна браузера
            custom_scroll_price_table();
        });
    });
    $(document).ready(function() {
        // Инициализация кастомного скроллбара
        $(".custom-scroll--horizontal").mCustomScrollbar({
            theme: "bober-orange-horizontal",
        });

        // Обновление кастомного скроллбара каждые 2 секунды
        // setInterval(function() {
        //     $(".custom-scroll").mCustomScrollbar("update");
        //     $(".custom-scroll--horizontal").css("max-height", "2000px");
        //     console.log('12');
        // }, 2000);
    });

    //custom scrollbar - catalog
    // function custom_scroll_catalog(){
    //     if ($(window).width() >= 860) {
    //         $(".custom-scroll--horizontal").mCustomScrollbar("update");
    //     } else {
    //         $(".custom-scroll--horizontal").mCustomScrollbar("destroy");
    //     }
    // };
    $(window).on("load",function(){
        // if ($(window).width() >= 860) {
        $(".catalog-custom-scroll").mCustomScrollbar({
            theme: "bober-orange",
        });
        // }
        // $(window).resize(function() { //проверка при изменении окна браузера
        //     custom_scroll_catalog();
        // });
    });



    //---------
    //contact-form__is-mobile
    $('.contact-form__is-mobile__btn').on('click', function () {
        $(this).parents('.contact-form__is-mobile').fadeOut('200');
        $(this).parents('.contact-form__section').find('.contact-form__is-desktop').fadeIn('200').removeClass('contact-form__is-desktop');
    })

    //---------
    //faq-block

    faqToggles = $('.faq-block__item__head');
    $('.faq-block__item:first-child').toggleClass('js-faq-item-open'); //Первый item открыт
    $('.faq-block__item:first-child').find('.faq-block__item__content').slideToggle(200); //Первый item открыт
    faqToggles.click(function () {
        $(this).parents('.faq-block__item').toggleClass('js-faq-item-open');
        $(this).parents('.faq-block__item').find('.faq-block__item__content').slideToggle(200);
    });

    faqBtnOpenAll = $('.faq-block__btn--js');
    faqBtnOpenAll.click(function () {
        if($(this).hasClass('faq-block__btn--open-all')) {
            $(this).parents('.faq-block__section').find('.faq-block__item').addClass('js-faq-item-open');
            $(this).parents('.faq-block__section').find('.faq-block__item__content').slideDown(200);
            $(this).text('Закрыть все');
            $(this).removeClass('faq-block__btn--open-all');
        } else {
            $(this).parents('.faq-block__section').find('.faq-block__item').removeClass('js-faq-item-open');
            $(this).parents('.faq-block__section').find('.faq-block__item__content').slideUp(200);
            $(this).text('Открыть все');
            $(this).addClass('faq-block__btn--open-all');
        }
    });
    //---------

    //faq - product

    faq_prod_Toggles = $('.product-desc__faq__item__head');
    $('.product-desc__faq__item:first-child').toggleClass('js-faq-item-open'); //Первый item открыт
    $('.product-desc__faq__item:first-child').find('.product-desc__faq__item__content').slideToggle(200); //Первый item открыт
    faq_prod_Toggles.click(function () {
        $(this).parents('.product-desc__faq__item').toggleClass('js-faq-item-open');
        $(this).parents('.product-desc__faq__item').find('.product-desc__faq__item__content').slideToggle(200);
    });

    //---------

    //accordion-price

    accordion_Toggles = $('.accordion-price__head');
    // $('.main-title + .accordion-price').toggleClass('js-accordion-price-item-open'); //Первый item открыт
    // $('.main-title + .accordion-price').find('.accordion-price__content').slideToggle(200); //Первый item открыт
    accordion_Toggles.click(function () {
        $(this).parents('.accordion-price').toggleClass('js-accordion-price-item-open');
        $(this).parents('.accordion-price').find('.accordion-price__content').slideToggle(200);
    });

    //---------

    //popup
    //open popup
    $('.btn-modal-open--1').on('click', function(event){
        event.preventDefault();
        $('.modal-block__1').addClass('modal-open');
        $('.modal-blur-wrapper').addClass('modal-open');
    });
    $('.btn-modal-open--call').on('click', function(event){
        event.preventDefault();
        $('.modal-block__call').addClass('modal-open');
        $('.modal-blur-wrapper').addClass('modal-open');
    });
    $('.btn-modal-open--contact-form-popup').on('click', function(event){
        event.preventDefault();
        $('.modal-block__contact-form-popup').addClass('modal-open');
        $('.modal-blur-wrapper').addClass('modal-open');
    });
    $('.btn-modal-open--contact-form-arenda').on('click', function(event){
        event.preventDefault();
        $('.modal-block__contact-form-arenda').addClass('modal-open');
        $('.modal-blur-wrapper').addClass('modal-open');
    });

    //close popup - .close-modal
    $('.modal-block').on('click', function(event){
        if( event.target.closest('.close-modal') ) {
            event.preventDefault();
            $(this).removeClass('modal-open');
            $('.modal-blur-wrapper').removeClass('modal-open');
            $('.contact-form__hidden--text-info').val('');//сброс инфо поля
            $('.modal-block__title--js').html($('.modal-block__title--js').attr('data-defaultTitle'));//сброс заголовка

        }
    });
    //close popup - ESC
    $(document).keyup(function(event){
        if(event.which=='27'){
            $('.modal-block').removeClass('modal-open');
            $('.modal-blur-wrapper').removeClass('modal-open');
            $('.contact-form__hidden--text-info').val('');//сброс инфо поля
            $('.modal-block__title--js').html($('.modal-block__title--js').attr('data-defaultTitle'));//сброс заголовка

        }
    });
    //close popup - .modal-blur-wrapper
    $('.modal-blur-wrapper').on('click', function(event){
        event.preventDefault();
        $('.modal-block').removeClass('modal-open');
        $('.modal-blur-wrapper').removeClass('modal-open');
        $('.contact-form__hidden--text-info').val('');//сброс инфо поля
        $('.modal-block__title--js').html($('.modal-block__title--js').attr('data-defaultTitle'));//сброс заголовка

    });
    //---------



    // //проверка всех слайдеров
    // function catalog_slider_check() {
    //     $('.slider-default').each(function() {
    //         var $this = $(this);
    //         var size_windows = $(window).width();
    //         var catalog_slider_item_count = $this.find(".slider-default__item").length; // Количество слайдов в текущем слайдере
    //         var catalog_slider_item_width = $this.find(".slider-default__item").outerWidth(true); // Размер одного слайда в текущем слайдере
    //         var catalog_slider_total = catalog_slider_item_count * catalog_slider_item_width; // Размер текущего слайдера
    //
    //         if (size_windows <= catalog_slider_total) {
    //             catalog_slider_on($this); // Запуск инициализации слайдера для текущего элемента
    //         }
    //     });
    // }
    // //иниц слайдера
    // function catalog_slider_on($slider) {
    //     $.each($slider,function(index,value){
    //         // console.log('Индекс: ' + index + '; Значение: ' + value);
    //         $(value).owlCarousel({
    //             loop: true,
    //             margin: 0,
    //             items:5,
    //             autoWidth: true,
    //             margin:12,
    //             center:true,
    //         });
    //     })
    //     // $(value).owlCarousel({
    //     //     loop: true,
    //     //     margin: 0,
    //     //     responsiveClass: true,
    //     //     // autoWidth: true,
    //     // });
    // }
    // // Проверка при изменении размера окна браузера
    // $(window).resize(function() {
    //     catalog_slider_check();
    // });
    // //Первая проверка при загрузке страницы
    // catalog_slider_check();


    //filter calculator product
    function product_filter_slider() {
        $('.product-filter-slider__slider').owlCarousel({
            loop: false,
            // autoWidth: true,
            // margin: 20,
            nav: true,
            center: false,
            items: 3,

            navText: ['<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">\n' +
            '<rect width="44" height="44" rx="22" fill="#EB6025"/>\n' +
            '<path fill-rule="evenodd" clip-rule="evenodd" d="M16.5633 23.025C15.9834 22.4539 15.9834 21.5279 16.5633 20.9568L23.1922 14.4283C23.7721 13.8572 24.7122 13.8572 25.2921 14.4283C25.872 14.9994 25.872 15.9254 25.2921 16.4965L19.7132 21.9909L25.2921 27.4853C25.872 28.0564 25.872 28.9824 25.2921 29.5535C24.7122 30.1246 23.7721 30.1246 23.1922 29.5535L16.5633 23.025Z" fill="white"/>\n' +
            '</svg>', '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">\n' +
            '<rect width="44" height="44" rx="22" transform="matrix(-1 0 0 1 44 0)" fill="#EB6025"/>\n' +
            '<path fill-rule="evenodd" clip-rule="evenodd" d="M27.4367 23.025C28.0166 22.4539 28.0166 21.5279 27.4367 20.9568L20.8078 14.4283C20.2279 13.8572 19.2878 13.8572 18.7079 14.4283C18.128 14.9994 18.128 15.9254 18.7079 16.4965L24.2868 21.9909L18.7079 27.4853C18.128 28.0564 18.128 28.9824 18.7079 29.5535C19.2878 30.1246 20.2279 30.1246 20.8078 29.5535L27.4367 23.025Z" fill="white"/>\n' +
            '</svg>'],
            responsive: {
                0: {
                    items: 2,
                    margin:6,
                },
                681: {
                    items: 2,
                    margin:6,
                },
                1161: {
                    items: 3,
                    margin:0,
                },
            }
        });
    }
    product_filter_slider();

    $('.product-filter-slider__filter__item').click( function( event ) {
        filter = $(this).attr('data-filter');
        $('.product-filter-slider__filter__item').removeClass('active');
        if(filter == 'all'){ //сброс
            $(this).attr('data-filter', $(this).attr('data-filter-old'));
            $(this).attr('data-filter-old', filter);
            $(this).removeClass('active');
            $(this).blur();
        } else {
            $(this).attr('data-filter', 'all');
            $(this).attr('data-filter-old', filter);
            $(this).addClass('active');
        }

        $.ajax({
            type : 'POST',
            url : "/wp-admin/admin-ajax.php",
            data : {
                filter : filter, // номер текущей страниц
                action : 'loadmore' // экшен для wp_ajax_ и wp_ajax_nopriv_
            },
            beforeSend : function( xhr ) {
                // button.text( 'Загружаем...' );
                $('.product-filter-slider__slider-wrap').addClass('is-loading');
            },
            success : function( data ){

                $('.product-filter-slider__slider-wrap').removeClass('is-loading');
                $('.product-filter-slider__slider-wrap').html( data );
                product_filter_slider();

            }

        });

    } );


    $('.calc-arenda__row').on('click',function () {
        $(this).find('.block-size__autosized-input').select();
    })

    //wishlist
    $(document).on('click','.item-card__btn-wish', function () {

        $id = $(this).data('id');
        wishlist = '';
        wishlistCount = $('.header__flex__right__soc__wish__num').html();

        if($.cookie('wishlist')) { //если кука есть

            if ($.cookie('wishlist').indexOf(String($id)) > -1) {
                //уберём id из списка
                wishlist = $.cookie('wishlist').replace(String($id), '');//уберём из списка
                wishlist = wishlist.replace('  ', ' ').trim();//уберём проблемы
                $('.item-card__btn-wish[data-id="'+String($id)+'"]').removeClass('active');

                //уберём карточку если на стр. избранное
                if($('.main__wishlist').length) {
                    $('.item-card__btn-wish[data-id="'+String($id)+'"]').parents('.product-card').hide(250);
                }

                //счётчик -
                wishlistCount--;

            } else {
                //добавим id в список
                wishlist = $.cookie('wishlist') + ' ' + $id;//внесём в список
                $('.item-card__btn-wish[data-id="'+$id+'"]').addClass('active');

                //модальное окно
                wish_name = $('.item-card__btn-wish[data-id="'+$id+'"]').data('title');
                $('.wish-modal-block__transport-name').html(wish_name);
                $('.modal-block__wish-add').addClass('modal-open');
                $('.modal-blur-wrapper').addClass('modal-open');
                wishlistCount++;
            }

        } else { //если кука не объявлена
            wishlist = $id;
            $('.item-card__btn-wish[data-id="'+$id+'"]').addClass('active');

            //модальное окно
            wish_name = $('.item-card__btn-wish[data-id="'+$id+'"]').data('title');
            $('.wish-modal-block__transport-name').html(wish_name);
            $('.modal-block__wish-add').addClass('modal-open');
            $('.modal-blur-wrapper').addClass('modal-open');
            //счётчик
            wishlistCount = 1;
        }

        $('.header__flex__right__soc__wish__num').html(wishlistCount);//счётчик
        $('.header__flex__right__soc__wish__num').attr('data-count',wishlistCount);//счётчик

        if(wishlistCount == 0){
            $('.header__flex__right__soc__wish').removeClass('is-active');
        } else {
            $('.header__flex__right__soc__wish').addClass('is-active');
        }

        $.cookie('wishlist', wishlist, { //кука
            expires: 3000,
            path: '/'
        });
    });




    //catalog + filter

    //filter on-off
    $('.filter-item__on-off__label__checkbox').on('change', function () {
        page = 1;
        page_arenda = 1;
        if($('.filter-item__on-off__label__checkbox').is(':checked')){
            $('.catalog__filter').removeClass('catalog__filter--disabled');
            $('.catalog__list-wrap__current-filter').removeClass('current-filter--disabled');
            product_catalog_filter();
        } else {
            $('.catalog__filter').addClass('catalog__filter--disabled');
            $('.catalog__list-wrap__current-filter').addClass('current-filter--disabled');
            product_catalog_filter_off();
        }
    });

    //filter sort
    $('.filter-item__sort').on('click', function () {
        if($(this).hasClass('active')){ //отжали
            $('.filter-item__sort').removeClass('active');
        } else {
            $('.filter-item__sort').removeClass('active');
            $(this).addClass('active');
        }

        product_catalog_filter();
    });



    //filter more
    $('.filter-item__more').on('click', function () {
        $(this).remove();
    })
    //filter mobile open
    $('.catalog__filter__mobile').on('click', function () {
        $('.catalog__filter__wrap').toggleClass('catalog__filter__wrap--open');
        $('.catalog__filter__wrap').toggle();
        $(this).toggleClass('catalog__filter__mobile--open');
        $('.catalog__filter').toggleClass('catalog__filter--open');
        $('.modal-blur-wrapper__catalog-filter').toggleClass('modal-open');
    });
    //TODO resize anf scroll
    $(window).resize(function () {
        if ($(window).width() >= 860) {
            $('.catalog__filter__wrap').removeClass('catalog__filter__wrap--open');
            $('.catalog__filter__wrap').show();
            $('.catalog__filter__wrap').css("display","");
            $(this).removeClass('catalog__filter__mobile--open');
            $('.catalog__filter').removeClass('catalog__filter--open');
            $('.modal-blur-wrapper__catalog-filter').removeClass('modal-open');
        }
    })
    //Close filter mob
    $('.modal-blur-wrapper__catalog-filter').on('click', function(event){
        event.preventDefault();
        $('.catalog__filter__wrap').removeClass('catalog__filter__wrap--open');
        $('.catalog__filter__wrap').css("display","");
        $('.catalog__filter__mobile').removeClass('catalog__filter__mobile--open');
        $('.catalog__filter').removeClass('catalog__filter--open');
        $('.modal-blur-wrapper__catalog-filter').removeClass('modal-open');
    });
    $(document).keyup(function(event){
        if(event.which=='27'){
            $('.catalog__filter__wrap').removeClass('catalog__filter__wrap--open');
            $('.catalog__filter__wrap').css("display","");
            $('.catalog__filter__mobile').removeClass('catalog__filter__mobile--open');
            $('.catalog__filter').removeClass('catalog__filter--open');
            $('.modal-blur-wrapper__catalog-filter').removeClass('modal-open');
        }
    });
    //close popup - .close-modal
    $('.catalog__filter').on('click', function(event){
        if( event.target.closest('.catalog__filter__close-modal') ) {
            event.preventDefault();
            $('.catalog__filter__wrap').removeClass('catalog__filter__wrap--open');
            $('.catalog__filter__wrap').css("display","");
            $('.catalog__filter__mobile').removeClass('catalog__filter__mobile--open');
            $('.catalog__filter').removeClass('catalog__filter--open');
            $('.modal-blur-wrapper__catalog-filter').removeClass('modal-open');
        }
    });



    //price reset
    $(document).on('click',".current-filter__item--price-reset", function( event ) {
        $('[name="filter_price_from"]').val('');
        $('[name="filter_price_to"]').val('');
        product_catalog_filter();
    } );





    //new
    var page = 1;
    $('#load-more').on('click', function() {
        page++;
        load_more_products(page);
    });
    var page_arenda = 1;
    $('#load-more-arenda').on('click', function() {
        page_arenda++;
        load_more_arenda(page_arenda);
    });


    function load_more_products(page) {
        console.log(page);
        var filters = get_filters();
        filters.page = page;
        filters.action = 'load_more_products';

        $.ajax({
            type: 'POST',
            url: "/wp-admin/admin-ajax.php",
            data: filters,
            beforeSend: function(xhr) {
                $('#load-more').text('Загрузка...');
            },
            success: function(data) {
                $('#load-more').text('Загрузить ещё');
                $('.catalog__list').append(data);

                if ($('#no-more-products').length) {
                    $('#load-more').hide();
                }
            }
        });
    }
    function load_more_arenda(page) {
        console.log(page);
        var filters = get_filters();
        filters.page = page;
        filters.action = 'load_more_arenda';

        $.ajax({
            type: 'POST',
            url: "/wp-admin/admin-ajax.php",
            data: filters,
            beforeSend: function(xhr) {
                $('#load-more-arenda').text('Загрузка...');
            },
            success: function(data) {
                $('#load-more-arenda').text('Загрузить ещё');
                $('.catalog__list').append(data);

                if ($('#no-more-products').length) {
                    $('#load-more-arenda').hide();
                }
            }
        });
    }

    $('.catalog__filter__item__price input').on('keyup', function () {
        //Сбрасываем счётчик пагинации
        page = 1;
        page_arenda = 1;
        product_catalog_filter();

    })

    $('.filter-item__checkbox').on('change', function () {
        //Сбрасываем счётчик пагинации
        page = 1;
        page_arenda = 1;
        product_catalog_filter();
    })



    function product_catalog_filter(){
        //Сбрасываем счётчик пагинации
        page = 1;
        page_arenda = 1;
        var filters = get_filters();
        if($('.catalog__section').hasClass('is-catalog-arenda')){
            filters.action = 'arenda_filter';
        } else {
            filters.action = 'product_catalog_filter';
        }
        console.log(filters);

        $.ajax({
            type: 'POST',
            url: "/wp-admin/admin-ajax.php",
            data: filters,
            beforeSend: function(xhr) {
                $('.catalog__list').addClass('is-loading');
            },
            success: function(data) {
                $('.catalog__list').removeClass('is-loading');
                $('.catalog__list').html(data);

                if ($('#no-more-products').length) {
                    $('#load-more').hide();
                    $('#load-more-arenda').hide();
                } else {
                    $('#load-more').show();
                    $('#load-more-arenda').show();
                }
            }
        });
    };


    function get_filters() {
        var filters = {};
        filters.sort = $('.filter-item__sort.active').attr('data-sort');
        filters.filter_price_from = $('input[name="filter_price_from"]').val();
        filters.filter_price_to = $('input[name="filter_price_to"]').val();
        filters.term_cat = $('.catalog__list').attr('data-term');
        filters.term_tag = $('.catalog__list').attr('data-tag');

        //В наличии
        if($('.filter-item__checkbox.is-inAccess:checked').length) {
            filters.inAccess = 'on';
        }

        //Атрибуты
        $('.filter-item__checkbox.is-attribute:checked').each(function() {
            var name = $(this).attr('name');
            if (!filters[name]) {
                filters[name] = [];
            }
            filters[name].push($(this).val());
        });
        // Страны
        filters.product_country = [];
        $('.filter-item__checkbox.is-country:checked').each(function() {
            filters.product_country.push($(this).val());
        });
        // Метки
        filters.product_brand = [];
        $('.filter-item__checkbox.is-brand:checked').each(function() {
            filters.product_brand.push($(this).val());
        });

        // Продукция - степень обжарки
        filters.production_degree_roasting = [];
        $('.filter-item__checkbox.is-production_degree_roasting:checked').each(function() {
            filters.production_degree_roasting.push($(this).val());
        });
        // Продукция - Страна выращивания
        filters.production_country = [];
        $('.filter-item__checkbox.is-production_country:checked').each(function() {
            filters.production_country.push($(this).val());
        });
        // Продукция - Вес
        filters.production_weight = [];
        $('.filter-item__checkbox.is-production_weight:checked').each(function() {
            filters.production_weight.push($(this).val());
        });
        // Продукция - Весовой
        filters.production_tea_weight = [];
        $('.filter-item__checkbox.is-production_tea_weight:checked').each(function() {
            filters.production_tea_weight.push($(this).val());
        });
        // Продукция - Пакетированный
        filters.production_tea_bagged = [];
        $('.filter-item__checkbox.is-production_tea_bagged:checked').each(function() {
            filters.production_tea_bagged.push($(this).val());
        });
        // Продукция - Чай
        filters.production_tea_color = [];
        $('.filter-item__checkbox.is-production_tea_color:checked').each(function() {
            filters.production_tea_color.push($(this).val());
        });

        //Каталог категории
        if ($('.catalog__list[data-tax]').length) {
            var taxString = $('.catalog__list[data-tax]').attr('data-tax');
            // Удаляем пробелы и пустые строки, затем разбиваем строку на массив
            filters.term_cat = taxString.split(',').map(function(item) {
                return item.trim();
            }).filter(function(item) {
                return item.length > 0;
            });
        }


        //product_api
        if ($('.catalog__list[data-productApi]').length) {
            filters.product_api = $('.catalog__list[data-productApi]').attr('data-productApi');
        }


        //Аренда
        if ($('.catalog__list[data-type]').length) {
            var taxString = $('.catalog__list[data-type]').attr('data-type');
            // Удаляем пробелы и пустые строки, затем разбиваем строку на массив
            filters.term_arenda = taxString.split(',').map(function(item) {
                return item.trim();
            }).filter(function(item) {
                return item.length > 0;
            });
        }

        filters.product_arenda_mark = [];
        $('.filter-item__checkbox.is-product_arenda_mark:checked').each(function() {
            filters.product_arenda_mark.push($(this).val());
        });

        filters.product_arenda_type = [];
        $('.filter-item__checkbox.is-product_arenda_type:checked').each(function() {
            filters.product_arenda_type.push($(this).val());
        });
        filters.product_arenda_subtype = [];
        $('.filter-item__checkbox.is-product_arenda_subtype:checked').each(function() {
            filters.product_arenda_subtype.push($(this).val());
        });

        filters.product_arenda_group = [];
        $('.filter-item__checkbox.is-product_arenda_group:checked').each(function() {
            filters.product_arenda_group.push($(this).val());
        });

        filters.product_arenda_group_height = [];
        $('.filter-item__checkbox.is-product_arenda_group_height:checked').each(function() {
            filters.product_arenda_group_height.push($(this).val());
        });

        filters.product_arenda_func = [];
        $('.filter-item__checkbox.is-product_arenda_func:checked').each(function() {
            filters.product_arenda_func.push($(this).val());
        });

        filters.product_arenda_performance = [];
        $('.filter-item__checkbox.is-product_arenda_performance:checked').each(function() {
            filters.product_arenda_performance.push($(this).val());
        });

        return filters;
    }


    function product_catalog_filter_off(){
        term_cat = '';
        term_tag = '';
        product_api = '';
        term_arenda = '';

        if($('.catalog__list[data-term]').length){
            term_cat = $('.catalog__list[data-term]').attr('data-term');
        }
        if($('.catalog__list[data-tag]').length){
            term_tag = $('.catalog__list[data-tag]').attr('data-tag');
        }
        if($('.catalog__list[data-productApi]').length){
            product_api = $('.catalog__list[data-productApi]').attr('data-productApi');
        }


        if ($('.catalog__list[data-tax]').length) {
            term_cat = [];
            var taxString = $('.catalog__list[data-tax]').attr('data-tax');
            // Удаляем пробелы и пустые строки, затем разбиваем строку на массив
            term_cat = taxString.split(',').map(function(item) {
                return item.trim();
            }).filter(function(item) {
                return item.length > 0;
            });
        }

        if ($('.catalog__list[data-type]').length) {
            term_arenda = [];
            var taxString = $('.catalog__list[data-type]').attr('data-type');
            // Удаляем пробелы и пустые строки, затем разбиваем строку на массив
            term_arenda = taxString.split(',').map(function(item) {
                return item.trim();
            }).filter(function(item) {
                return item.length > 0;
            });
        }

        if($('.catalog__section').hasClass('is-catalog-arenda')){
            action_filter = 'arenda_filter';
        } else {
            action_filter = 'product_catalog_filter';
        }

        $.ajax({
            type : 'POST',
            url : "/wp-admin/admin-ajax.php",
            data : {
                term_cat : term_cat,
                term_tag : term_tag,
                product_api : product_api,
                term_arenda : term_arenda,
                action : action_filter
            },
            beforeSend : function( xhr ) {
                $('.catalog__list').addClass('is-loading');
            },
            success : function( data ){
                $('.catalog__list').removeClass('is-loading');
                $('.catalog__list').html( data );
            }
        });
    }

});


$(window).on("load",function(){
    var swiper = new Swiper(".map-gallery__slider", {
        direction: swiperGetDirection(),
        slidesPerView: "auto",
        spaceBetween: 11,
        on: {
            resize: function () {
                swiper.changeDirection(swiperGetDirection());
            },
        },

        pagination: {
            el: ".map-gallery__slider__pagination",
            clickable: true,
        },
    });
});
function swiperGetDirection() {
    var windowWidth = window.innerWidth;
    var direction = window.innerWidth <= 900 ? 'horizontal' : 'vertical';

    return direction;
}




var galleryThumbs = new Swiper(".product-detail__gallery-thumbs", {
    centeredSlides: true,
    centeredSlidesBounds: true,
    slidesPerView: 5,
    watchOverflow: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    direction: 'vertical'
});

var galleryMain = new Swiper(".product-detail__gallery-main", {
    watchOverflow: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    preventInteractionOnTransition: true,
    // navigation: {
    //     nextEl: '.swiper-button-next',
    //     prevEl: '.swiper-button-prev',
    // },
    effect: 'fade',
    fadeEffect: {
        crossFade: true
    },
    thumbs: {
        swiper: galleryThumbs
    }
});

galleryMain.on('slideChangeTransitionStart', function() {
    galleryThumbs.slideTo(galleryMain.activeIndex);
});

galleryThumbs.on('transitionStart', function(){
    galleryMain.slideTo(galleryThumbs.activeIndex);
});



$('.js-smooth-scrolling').click(function() {
    var scrollName = $(this).attr('data-scroll'),
        scrollElem = $(scrollName),
        scrollTop = scrollElem.offset().top;

    $('html, body').animate({
        scrollTop: scrollTop
    }, 500);
});





//product-desc__flex__item--last
$('.product-desc__flex__item--last').on('click', function () {
    $(this).parent('.product-desc__flex').removeClass('product-desc__flex--hide-items-mobile');
    $(this).remove();
})




//api-cat-list__item__more
$('.api-cat-list__item__more').on('click', function () {
    $(this).addClass('active');
})
$('.api-cat-list__item__more__close').on('click', function () {
    $(this).parents('.api-cat-list__item--lvl-1').find('.api-cat-list__item__more').removeClass('active');
})



jQuery(document).ready(function($) {
    // Функция для изменения текста уведомления
    function updateNotificationText() {
        $('.woocommerce-NoticeGroup-checkout .woocommerce-error li[data-id="billing_phone"]').each(function() {
            var currentText = $(this).text();
            var newText = currentText.replace('Платежи ', '');
            $(this).text(newText);
        });
    }

    // Настройка MutationObserver для отслеживания изменений в DOM
    var targetNode = document.querySelector('.woocommerce-NoticeGroup-checkout');
    var config = { childList: true, subtree: true };

    var callback = function(mutationsList, observer) {
        for (var mutation of mutationsList) {
            if (mutation.type === 'childList') {
                updateNotificationText();
            }
        }
    };

    var observer = new MutationObserver(callback);

    // Начать наблюдение за целевым узлом
    if (targetNode) {
        observer.observe(targetNode, config);
    }

    // Также вызываем функцию сразу, на случай если уведомление уже есть
    updateNotificationText();
});



//checkout
// document.addEventListener('DOMContentLoaded', function() {
//     const checkbox_postponement = document.querySelector('.customer_details_checkbox__item__input--postponement');
//     function updatePostponementClass() {
//         postponementTotalBlock = document.querySelector('.postponement-total');
//         if (checkbox_postponement.checked) {
//             postponementTotalBlock.classList.add('postponement-total--get');
//         } else {
//             postponementTotalBlock.classList.remove('postponement-total--get');
//         }
//     }
//     checkbox_postponement.addEventListener('change', updatePostponementClass);
//     updatePostponementClass();
// });

//checkout
document.addEventListener('DOMContentLoaded', function() {
    const checkbox_postponement = document.querySelector('.customer_details_checkbox__item__input--postponement');

    if (checkbox_postponement) {
        function updatePostponementClass() {
            const postponementTotalBlock = document.querySelector('.postponement-total');
            if (postponementTotalBlock) {
                if (checkbox_postponement.checked) {
                    postponementTotalBlock.classList.add('postponement-total--get');
                } else {
                    postponementTotalBlock.classList.remove('postponement-total--get');
                }
            }
        }

        checkbox_postponement.addEventListener('change', updatePostponementClass);
        updatePostponementClass();
    }
});









// Кнопка наверх
$(window).scroll(function() {
    if ($(window).scrollTop() > 300) {
        $('.slide-page-up').addClass('show');
    } else {
        $('.slide-page-up').removeClass('show');
    }
});
$(".slide-page-up").on('click', function(e){
    e.preventDefault();
    $('body,html').animate({scrollTop: 0}, 400);
    $('.slide-page-up').removeClass('show');
    $('.slide-page-up').blur();
});


//Catalog accordion
$('.catalog__filter__item__title.is-accordion').on('click', function () {
    $(this).parents('.catalog__filter__item').toggleClass('is-open');
    $(this).parents('.catalog__filter__item').find('.catalog__filter__item__list').slideToggle(0);
});
//Catalog accordion cat
$('.catalog__filter__item__cat__parent.is-accordion').on('click', function () {
    $(this).parents('.catalog__filter__item__cat').toggleClass('is-open');
    $(this).parents('.catalog__filter__item__cat').find('.catalog__filter__item__cat__ul').slideToggle(0);
});



$('.header__search').on('mouseover',function () {
    $('.header__search').addClass('result-active');
})
$('.header__search__btn-open').on('click',function () {
    $(this).parents('.header__search').toggleClass('is-active');
})
$(document).click(function(event) {
    if (!$(event.target).closest('.header__flex__right__search').length) {
        $('.header__flex__right__search').removeClass('result-active');
    }
});


//ajax search -- New
jQuery(document).ready(function($) {
    function handleSearchInput(inputSelector, resultSelector, context, titleSelector) {
        $(inputSelector).on('input', function() {
            var searchQuery = $(this).val();
            if (titleSelector) {
                $(titleSelector).find('span').text(searchQuery);
            }

            $word_num = 3;
            if(inputSelector=='#search-page-input'){
                $word_num = 1;
            }

            if (searchQuery.length >= $word_num) {
                $.ajax({
                    url: '/wp-admin/admin-ajax.php',
                    type: 'POST',
                    data: {
                        action: 'product_search',
                        query: searchQuery,
                        context: context // Передаем контекст запроса
                    },
                    beforeSend: function(xhr) {
                        if(context=='header'){
                            $('.header__search__result').addClass('is-loading');
                        } else if(context=='search-page'){
                            $('.search__page__result').addClass('is-loading');
                        }
                    },
                    success: function(response) {
                        if(context=='header'){
                            $('.header__search__result').removeClass('is-loading');
                        } else if(context=='search-page'){
                            $('.search__page__result').removeClass('is-loading');
                        }
                        $(resultSelector).html(response);
                    }
                });
            } else {
                $(resultSelector).html('');
            }
        });
    }

    // Handle search input for header
    handleSearchInput('#header-search-input', '#header-search-result-inner', 'header');

    // Handle search input for search page
    handleSearchInput('#search-page-input', '#search-page-result-inner', 'search-page', 'h1');

    // Update h1 text on page load if there's a query in the URL
    var initialQuery = $('#search-page-input').val();
    if (initialQuery) {
        if (initialQuery.length > 0) {
            $('h1').find('span').text(initialQuery);
        }
    }
});
//ajax search -- OLD
// jQuery(document).ready(function($) {
//     $('#header-search-input').on('input', function() {
//         var searchQuery = $(this).val();
//         if (searchQuery.length >= 3) {
//             $.ajax({
//                 url: '/wp-admin/admin-ajax.php',
//                 type: 'POST',
//                 data: {
//                     action: 'product_search',
//                     query: searchQuery
//                 },
//                 beforeSend : function( xhr ) {
//                     $('.header__search__result').addClass('is-loading');
//                 },
//                 success: function(response) {
//                     $('.header__search__result').removeClass('is-loading');
//                     $('#header-search-result-inner').html(response);
//                 }
//             });
//         } else {
//             $('#header-search-result-inner').html('');
//         }
//     });
// });


//fix cart for KP
jQuery(document).ready(function($) {
	function kp_note(){
		if($('body').hasClass('kp-page') && !$('body').hasClass('logged-in') && $('.kp_cart_note').length==0){
			var kp_note = $('<div class="kp_cart_note">Для того, чтобы приобрести товары со скидкой <a target="_blank" href="https://bober.services/my-account/">войдтие или зарегестрируйтесь</a></div>');
			kp_note.insertBefore($('.wc-block-cart__submit'));
			$('.wc-block-cart__submit').remove();
		}
	}
	$(window).scroll(function(){kp_note()});
	setTimeout(function(){
		kp_note();
	}, 1000);
});
