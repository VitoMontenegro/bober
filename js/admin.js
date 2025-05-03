jQuery(document).ready(function($) {
	
	$('.kp_copy').click(function(e){
		e.preventDefault();
		let id = $(this).data('kp');
		
		navigator.clipboard.writeText('https://bober.services/kp/'+id).then(function() {
		  console.log('Текст успешно скопирован в буфер обмена');
		}, function(err) {
		  console.error('Произошла ошибка при копировании текста: ', err);
		});
		alert('Ссылка скопирована');
	});
	
	$('.submit_kp__btn').click(function(e){
		e.preventDefault();
		let id = $(this).data('kp'),
			email = $('[name="submit_kp_email"]').val();
		$.ajax({
			type : 'POST',
			url : "/wp-admin/admin-ajax.php",
			beforeSend : function( xhr ) {
                $('.submit_kp__btn').text('Загрузка...');
            },
            data : {
                action : 'send_kp',
				id: id,
				email: email
            },
            success : function( data ){
				alert('Письмо отправлено');
				$('.submit_kp__btn').text('Отправить');
            }
        });
	});
	
	$('.kp_pdf-gen').click(function(e){
		e.preventDefault();
		let href = $(this).attr('href'),
			id = $(this).data('kp'); ;
		$.ajax({
			type : 'POST',
			url : "/wp-admin/admin-ajax.php",
			beforeSend : function( xhr ) {
                $('.kp_pdf-gen').text('Загрузка...');
            },
            data : {
                action : 'pdf_gen',
				id_kp: id
            },
            success : function( data ){
				$('.kp_pdf-gen').text('Скачать КП в PDF');
				$('.kp_pdf-gen').removeClass('kp_pdf-gen');
				window.open(href, '_blank');
            }
        });
	});
	
});




jQuery(document).ready(function($) {
	$('.publish_kp_add').click(function(e){
		e.preventDefault();
		let href = $('.kp_pdf-gen').attr('href'),
			id = $('.kp_pdf-gen').data('kp');

		$.ajax({
			type : 'POST',
			url : "/wp-admin/admin-ajax.php",
			beforeSend : function( xhr ) {
				$('.kp_pdf-gen').text('Загрузка...');
				$('.publish_kp_add').val('Загрузка...');
				$('.spinner-duplicate').addClass('is-active');
			},
			data : {
				action : 'pdf_gen',
				id_kp: id
			},
			success : function( data ){
				$('.kp_pdf-gen').text('Скачать КП в PDF');
				$('.kp_pdf-gen').removeClass('kp_pdf-gen');
				// window.open(href, '_blank');
				$('.publish_kp_add-hidden').click();
				$('.publish_kp_add').val('Публикование...');
			}
		});
	});
});

jQuery(document).ready(function($) {
	// Функция для добавления GET-параметра к URL
	function addUrlParameter(name, value) {
		var currentUrl = window.location.href;
		var newUrl = currentUrl + (currentUrl.indexOf('?') !== -1 ? '&' : '?') + name + '=' + value;
		return newUrl;
	}

	// // Обработчик для кнопки .publish_kp
	$('.publish_kp').click(function(e) {
		// e.preventDefault();
		// Добавляем GET-параметр kp=update к URL
		var newUrl = addUrlParameter('kp', 'update');
	});

	// Функция для получения значения параметра из URL
	function getUrlParameter(name) {
		name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
		var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
		var results = regex.exec(location.search);
		return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
	}

	// Проверяем наличие параметра kp=update
	if (getUrlParameter('kp') === 'update') {
		// Выполняем AJAX-запрос для обновления PDF
		var $pdfButton = $('.kp_pdf-gen');
		var href = $pdfButton.attr('href');
		var id = $pdfButton.data('kp');
		console.log('обновление КП');

		$.ajax({
			type: 'POST',
			url: "/wp-admin/admin-ajax.php",
			beforeSend: function(xhr) {
				$pdfButton.text('Загрузка...');
				$('.kp_pdf').addClass('kp_pdf--delay');
			},
			data: {
				action: 'pdf_gen',
				id_kp: id
			},
			success: function(data) {
				$pdfButton.text('Скачать КП в PDF');
				$pdfButton.removeClass('kp_pdf-gen');
				$('.kp_pdf').removeClass('kp_pdf--delay');
			},
			error: function(xhr, status, error) {
				console.log('Ошибка при обновлении PDF: ' + error);
				$('.kp_pdf').removeClass('kp_pdf--delay');
			}
		});

		// Удаляем параметр из URL после выполнения AJAX-запроса
		var newUrl = window.location.href.split('?')[0];
		window.history.pushState({ path: newUrl }, '', newUrl);
	}
});



jQuery(document).ready(function($) {
	if ($('body').hasClass('post-type-kp')) {
	// Отслеживаем клик на кнопку "Обновить PDF"
		$('#publish').click(function (e) {
			// Сохраняем ссылку на кнопку
			var $button = $(this);

			// Добавляем обработчик события AJAX завершения сохранения записи
			$(document).ajaxComplete(function (event, xhr, settings) {
				// Проверяем, что это запрос на сохранение записи
				if (settings.data && settings.data.indexOf('action=editpost') !== -1) {
					// Выполняем AJAX-запрос для обновления PDF
					$('.kp_pdf-gen').each(function () {
						var $pdfButton = $(this);
						var href = $pdfButton.attr('href');
						var id = $pdfButton.data('kp');

						$.ajax({
							type: 'POST',
							url: "/wp-admin/admin-ajax.php",
							beforeSend: function (xhr) {
								$pdfButton.text('Загрузка...');
								$('#publish').val('Загрузка...');
								$('.spinner-duplicate').addClass('is-active');
							},
							data: {
								action: 'pdf_gen',
								id_kp: id
							},
							success: function (data) {
								$('.spinner-duplicate').removeClass('is-active');
								$('#publish').val('Pdf создан');
								$pdfButton.text('Скачать КП в PDF');
								$pdfButton.removeClass('kp_pdf-gen');
								window.open(href, '_blank');
							}
						});
					});

					// Удаляем обработчик, чтобы он не срабатывал повторно
					$(document).off('ajaxComplete');
				}
			});
		});
	}
});



//Выбор категории в "Продукции"
jQuery(document).ready(function($) {
	var urlParams = new URLSearchParams(window.location.search);
	var productCat = urlParams.get('product_cat');

	if (productCat) {
		// Устанавливаем значение категории
		$('#product_catchecklist input[value="' + productCat + '"]').prop('checked', true);
	}
});

document.addEventListener('DOMContentLoaded', function() {
	const accordionHeads = document.querySelectorAll('.accordion__head:not(.posts--empty)');

	accordionHeads.forEach(head => {
		head.addEventListener('click', function(event) {
			// Проверяем, был ли клик по ссылке создания товара
			if (event.target.classList.contains('custom-produkcziya__title__link')) {
				return;
			}

			const content = this.nextElementSibling;
			const isActive = this.classList.contains('active');

			// Закрываем все аккордеоны на том же уровне
			const parentAccordion = this.closest('.accordion');
			const siblingHeads = parentAccordion.querySelectorAll('.accordion__head');

			siblingHeads.forEach(h => {
				if (h.nextElementSibling) {
					h.classList.remove('active');
					h.nextElementSibling.style.display = 'none';
				}
			});

			// Переключаем состояние текущего аккордеона
			if (isActive) {
				this.classList.remove('active');
				content.style.display = 'none';
			} else {
				this.classList.add('active');
				content.style.display = 'block';
			}
		});
	});
});





jQuery(document).ready(function($) {
	function formatPrice(price) {
		return Math.round(price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + ' ₽';
	}

	function updateTotalPrice() {
		var totalPrice = 0;
		$('.kp_main_acf-repeater__product-item__info__price_result').each(function() {
			var price = parseFloat($(this).text().replace(/[^\d]/g, ''));
			if (!isNaN(price)) {
				totalPrice += price;
			}
		});
		var totalPrice_old = 0;
		$('.kp_main_acf-repeater__product-item__info__price-old').each(function() {
			var price_old = parseFloat($(this).text().replace(/[^\d]/g, ''));
			var count = parseFloat($(this).next().attr('data-count'));
			if (!isNaN(price_old)) {
				totalPrice_old += price_old * count;
			}
		});
		if(totalPrice !== totalPrice_old){
			$('.kp_main_acf-result-price .acf-input').html('<div class="price-old">'+formatPrice(totalPrice_old)+'</div><div class="price">'+formatPrice(totalPrice)+'</div>');
		} else {
			$('.kp_main_acf-result-price .acf-input').html('<div class="price">'+formatPrice(totalPrice)+'</div>');
		}

	}

	function updateProductDetails(row) {
		var productId = row.find('select[name*="[field_670f316e05514]"]').val();
		var count = row.find('input[name*="[field_670f42aef200e]"]').val() || 1;
		var price = row.find('input[name*="[field_6735b75c618d5]"]').val();
		var sale = row.find('input[name*="[field_670f326805516]"]').val();
		var type = row.find('select[name*="[field_670f31d605515]"]').val();

		if (productId) {
			var productItem = row.find('.kp_main_acf-repeater__product-item');
			if (productItem.length === 0) {
				productItem = $('<div class="kp_main_acf-repeater__product-item">' +
					'<div class="kp_main_acf-repeater__product-item__img"></div>' +
					'<div class="kp_main_acf-repeater__product-item__title"></div>' +
					'<div class="kp_main_acf-repeater__product-item__info">' +
					'<div class="kp_main_acf-repeater__product-item__info__top">' +
					'<div class="kp_main_acf-repeater__product-item__info__price-old"></div>' +
					'<div class="kp_main_acf-repeater__product-item__info__count"></div>' +
					'</div>' +
					'<div class="kp_main_acf-repeater__product-item__info__mid">' +
					'<div class="kp_main_acf-repeater__product-item__info__price"></div>' +
					'<div class="kp_main_acf-repeater__product-item__info__count"></div>' +
					'</div>' +
					'<div class="kp_main_acf-repeater__product-item__info__bottom">' +
					'<div class="kp_main_acf-repeater__product-item__info__price_result"></div>' +
					'</div>' +
					'</div></div>');
				row.find('td[data-name="product"] .acf-input').after(productItem);
			}

			productItem.addClass('is-loading');

			$.ajax({
				url: ajaxurl,
				type: 'POST',
				data: {
					action: 'get_product_details',
					product_id: productId,
				},
				success: function(response) {
					if (response.success) {
						var productData = response.data;

						productItem.find('.kp_main_acf-repeater__product-item__img').html('<img src="' + productData.image + '" alt="' + productData.title + '">');
						productItem.find('.kp_main_acf-repeater__product-item__title').html('<a href="'+productData.link+'" target="_blank">'+productData.title+'</a><div class="price">Цена: '+formatPrice(parseFloat(productData.price))+'</div>');
						productItem.find('.kp_main_acf-repeater__product-item__info__count').text(' x '+count);
						productItem.find('.kp_main_acf-repeater__product-item__info__count').attr('data-count',count);

						var actualPrice = parseFloat(productData.price);
						var finalPrice = actualPrice;
						var oldPrice = formatPrice(actualPrice);

						if (price) {
							oldPrice = parseFloat(price);
							finalPrice = parseFloat(price);
						} else if (sale) {
							if (type === 'percent') {
								finalPrice = actualPrice - (actualPrice * parseFloat(sale) / 100);
							} else if (type === 'number') {
								finalPrice = actualPrice - parseFloat(sale);
							}
							oldPrice = formatPrice(actualPrice);
						}

						if (price && sale) {
							oldPrice = formatPrice(parseFloat(price));
							if (type === 'percent') {
								finalPrice = parseFloat(price) - (parseFloat(price) * parseFloat(sale) / 100);
							} else if (type === 'number') {
								finalPrice = parseFloat(price) - parseFloat(sale);
							}
						}

						productItem.find('.kp_main_acf-repeater__product-item__info__price-old').text(oldPrice);
						productItem.find('.kp_main_acf-repeater__product-item__info__price').text(formatPrice(finalPrice));

						var priceResult = finalPrice * count;
						productItem.find('.kp_main_acf-repeater__product-item__info__price_result').text(formatPrice(priceResult));

						if (sale) {
							productItem.addClass('is-price-old');
						} else {
							productItem.removeClass('is-price-old');
						}

						productItem.removeClass('is-loading');
						updateTotalPrice();
					}
				}
			});
		}
	}

	// Обновление при загрузке страницы
	$('.kp_main_acf-repeater .acf-row').each(function() {
		updateProductDetails($(this));
	});

	// Обновление при изменении поля "product"
	$(document).on('change', '.kp_main_acf-repeater .acf-row select[name*="[field_670f316e05514]"]', function() {
		var row = $(this).closest('.acf-row');
		updateProductDetails(row);
	});

	// Обновление при изменении полей "price", "sale", "count"
	$(document).on('change', '.kp_main_acf-repeater .acf-row input[name*="[field_6735b75c618d5]"], .kp_main_acf-repeater .acf-row input[name*="[field_670f42aef200e]"], .kp_main_acf-repeater .acf-row input[name*="[field_670f326805516]"], .kp_main_acf-repeater .acf-row select[name*="[field_670f31d605515]"]', function() {
		var row = $(this).closest('.acf-row');
		updateProductDetails(row);
		$('.kp__wrap').addClass('is-disabled');
		$('.pdf_upd.kp').addClass('is-disabled');

		// Обновляем URL
		var currentUrl = new URL(window.location.href);
		currentUrl.searchParams.set('kp', 'update');
		window.history.replaceState(null, '', currentUrl.toString());
	});
});
