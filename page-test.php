<?php
/*
 Template Name: app-form-new
 */
?>
<?php get_header(); ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/app-form.css">

<main>
    <section class="section app-form__section">
        <div class="container">
            <div class="content">

                <h1>Заявка</h1>

                <script src="<?php echo get_template_directory_uri() . '/js/imask.js';?>"></script>

                <form class="app-form" id="app-form" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="submit_form">

                    <div class="app-form__nav">
                        <button type="button" class="app-form__nav__item app-form__nav__item__step1 is-active">Шаг 1</button>
                        <button type="button" class="app-form__nav__item app-form__nav__item__step2" disabled>Шаг 2</button>
                        <button type="button" class="app-form__nav__item app-form__nav__item__step3" disabled>Шаг 3</button>
                    </div>


                    <div class="app-form__wrap">

                        <!-- STEP 1 -->
                        <div class="app-form__step app-form__step1">
                            <label for="step1-phone" class="app-form__step__item">
                                <span class="app-form__step__item__name">Номер телефона&nbsp;<span class="required">*</span></span>
                                <!--                                <input type="text" id="step1-phone" name="step1-phone" placeholder="+7(XXX) XXX-XX-XX" class="app-form__field-text validation-phone step1-phone">-->
                                <input type="text" id="step1-phone" name="step1-phone" placeholder="+7(___) ___-__-__" class="app-form__field-text validation-phone step1-phone">
                                <span class="app-form__step__item__error step1-phone_error hidden">Введите номер телефона в верном формате</span>
                            </label>
                            <div class="app-form__btns-wrap">
                                <button type="button" class="btn app-form__btn app-form__btn-next app-form__btn-next-step1" disabled>Далее</button>
                            </div>
                        </div>
                        <script>
                            function appForm_scroll(){
                                appForm = document.getElementById('app-form');
                                offset = window.innerWidth > 560 ? 130 : 100;
                                appFormPosition = appForm.getBoundingClientRect().top + window.pageYOffset - offset;

                                // Проверяем текущее положение от верхней части экрана
                                if (window.pageYOffset > appFormPosition) {
                                    window.scrollTo({
                                        top: appFormPosition,
                                        behavior: 'smooth'
                                    });
                                }
                            }



                            document.addEventListener('DOMContentLoaded', function() {

                                const phoneMaskInputs = document.querySelectorAll('.validation-phone');
                                const masksOptions = {
                                    phone: {
                                        mask: '+7 (000) 000-00-00',
                                        // placeholderChar: 'X', // Заменяем "_" на "X"
                                        startsWith: '7',
                                        lazy: false,
                                        country: 'Russia',
                                        overwrite:true,
                                    }
                                };
                                for(const item of phoneMaskInputs) {
                                    new IMask(item, masksOptions.phone);
                                }



                                // var cleave = new Cleave('.validation-phone', {
                                //     delimiters: ['(', ') ', '-', '-'],
                                //     blocks: [2, 3, 3, 2, 2],
                                //     numericOnly: true,
                                //     prefix: '+7',
                                //     noImmediatePrefix: true,
                                //     rawValueTrimPrefix: true
                                // });

                                var phoneInput = document.querySelector('.step1-phone');
                                var errorSpan = document.querySelector('.step1-phone_error');
                                var nextButton = document.querySelector('.app-form__btn-next-step1');
                                var step2NavItem = document.querySelector('.app-form__nav__item__step2');
                                var phoneFullyEntered = false;


                                //Телефон
                                function validatePhone() {
                                    var phoneValue = phoneInput.value;
                                    // var phonePattern = /^\+7\(\d{3}\) \d{3}-\d{2}-\d{2}$/;
                                    var phonePattern = /^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/;

                                    if (phonePattern.test(phoneValue)) {
                                        errorSpan.classList.add('hidden');
                                        phoneInput.classList.remove('is-error');
                                        nextButton.disabled = false;
                                        phoneFullyEntered = true;
                                    } else {
                                        if (phoneFullyEntered) {
                                            errorSpan.classList.remove('hidden');
                                            phoneInput.classList.add('is-error');
                                        }
                                        nextButton.disabled = true;
                                        step2NavItem.disabled = true;
                                        document.querySelector('.app-form__nav__item__step3').setAttribute('disabled', 'true');
                                        phoneFullyEntered = false;
                                    }
                                }
                                phoneInput.addEventListener('blur', function(event) {
                                    errorSpan.classList.remove('hidden');
                                    phoneInput.classList.add('is-error');
                                    validatePhone();
                                });
                                phoneInput.addEventListener('input', function(event) {
                                        validatePhone();
                                });


                                nextButton.addEventListener('click', function() {
                                    // if (nextButton.hasAttribute('disabled')) {
                                    //     event.preventDefault(); // Предотвращаем фокусировку кнопки
                                    //     validatePhone();
                                    // }
                                    if(phoneFullyEntered){
                                        document.querySelector('.app-form__nav__item.is-active').classList.remove('is-active');
                                        step2NavItem.classList.add('is-active');
                                        step2NavItem.disabled = false;

                                        document.querySelector('.app-form__step1').classList.add('hidden');
                                        document.querySelector('.app-form__step2').classList.remove('hidden');
                                        document.querySelector('.app-form__step3').classList.add('hidden');

                                        appForm_scroll();

                                    } else {
                                        validatePhone();
                                        errorSpan.classList.remove('hidden');
                                        phoneInput.classList.add('is-error');
                                    }

                                });

                                document.querySelector('.app-form__nav__item__step1').addEventListener('click', function() {
                                    document.querySelector('.app-form__nav__item.is-active').classList.remove('is-active');
                                    this.classList.add('is-active');

                                    document.querySelector('.app-form__step1').classList.remove('hidden');
                                    document.querySelector('.app-form__step2').classList.add('hidden');
                                    document.querySelector('.app-form__step3').classList.add('hidden');
                                });

                                document.querySelector('.app-form__btn-prev-step2').addEventListener('click', function() {
                                    document.querySelector('.app-form__nav__item.is-active').classList.remove('is-active');
                                    document.querySelector('.app-form__nav__item__step1').classList.add('is-active');

                                    document.querySelector('.app-form__step1').classList.remove('hidden');
                                    document.querySelector('.app-form__step2').classList.add('hidden');
                                    document.querySelector('.app-form__step3').classList.add('hidden');

                                    appForm_scroll();
                                });

                                step2NavItem.addEventListener('click', function() {
                                    if (!this.disabled) {
                                        document.querySelector('.app-form__nav__item.is-active').classList.remove('is-active');
                                        this.classList.add('is-active');

                                        document.querySelector('.app-form__step1').classList.add('hidden');
                                        document.querySelector('.app-form__step2').classList.remove('hidden');
                                        document.querySelector('.app-form__step3').classList.add('hidden');
                                    }
                                });
                            });
                        </script>




                        <!-- STEP 2 -->
                        <div class="app-form__step app-form__step2 hidden">

<!--                            <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=03fa993a-9103-41c8-a992-8c27266fb092" type="text/javascript"></script>-->
                            <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=fee8b248-ad15-4021-958f-525f5f127909" type="text/javascript"></script>


                            <!-- STEP 2 - map -->
                            <div class="app-form__step__map-wrap">
                                <div id="step2_map" class="app-form__step__map step2_map"></div>

                                <label for="step2-address" class="app-form__step__item">
                                    <span class="app-form__step__item__name">Адрес&nbsp;<span class="required">*</span></span>
<!--                                    <input type="text" id="step2-address" name="step2-address" class="app-form__field-text validation-address step2-address">-->
                                    <textarea id="step2-address" name="step2-address"
                                              class="app-form__field-textarea validation-address step2-address"
                                              rows="1" style="height: 50px;"></textarea>

                                    <script>
                                        document.addEventListener("input", function (event) {
                                            if (event.target.matches("#step2-address")) {
                                                event.target.style.height = "auto"; // Сброс высоты перед вычислением
                                                event.target.style.height = event.target.scrollHeight + "px"; // Новая высота
                                            }
                                        });
                                    </script>

                                    <div class="step2-address__hint"></div>
                                    <span class="app-form__step__item__error step2-address_error hidden">Неверный формат</span>
                                </label>

                            </div>


                            <script type="text/javascript">
                                ymaps.ready(init);

                                function init() {
                                    var map = new ymaps.Map("step2_map", {
                                        center: [59.9343, 30.3351], // Санкт-Петербург
                                        zoom: 10
                                    });

                                    var userPlacemark; // Глобальная переменная для метки

                                    function adjustTextareaHeight() {
                                        var textarea = document.getElementById("step2-address");
                                        if (textarea) {
                                            textarea.style.height = "auto"; // Сброс высоты перед вычислением
                                            textarea.style.height = textarea.scrollHeight + "px"; // Новая высота
                                        }
                                    }

                                    function addPlacemark(coords) {
                                        if (userPlacemark) {
                                            userPlacemark.geometry.setCoordinates(coords); // Обновляем существующую метку
                                        } else {
                                            userPlacemark = new ymaps.Placemark(coords, {}, {
                                                preset: 'islands#blueCircleDotIconWithCaption',
                                                draggable: true
                                            });
                                            map.geoObjects.add(userPlacemark);

                                            userPlacemark.events.add('dragend', function (e) {
                                                var newCoords = e.get('target').geometry.getCoordinates();
                                                getAddress(newCoords);
                                            });
                                        }
                                        getAddress(coords);
                                    }

                                    // Определение геопозиции пользователя
                                    ymaps.geolocation.get({
                                        provider: 'browser',
                                        mapStateAutoApply: true
                                    }).then(function (result) {
                                        var userLocation = result.geoObjects.position;
                                        map.setCenter(userLocation, 14);
                                        addPlacemark(userLocation);
                                    });

                                    // Автозаполнение адреса при вводе
                                    $('#step2-address').on('input', function () {
                                        var address = $(this).val();
                                        $(this).val(address);
                                        adjustTextareaHeight(); // Изменяем высоту при вводе

                                        if (address.length > 2) {
                                            // suggestAddress(address); //TODO
                                        } else {
                                            $('.step2-address__hint').hide();
                                        }
                                    });

                                    // Обработчик клика по карте — теперь будет ставиться метка
                                    map.events.add('click', function (e) {
                                        var coords = e.get('coords');
                                        addPlacemark(coords);
                                    });

                                    function getAddress(coords) {
                                        ymaps.geocode(coords).then(function (res) {
                                            var firstGeoObject = res.geoObjects.get(0);
                                            $('#step2-address').val(firstGeoObject.getAddressLine());
                                            $('#step2-address').removeClass('is-error');
                                            $('.step2-address_error').addClass('hidden');
                                            adjustTextareaHeight(); // Изменяем высоту при обновлении адреса
                                        });
                                    }

                                    function suggestAddress(query) {
                                        $.ajax({
                                            url: 'https://search-maps.yandex.ru/v1/',
                                            data: {
                                                text: query,
                                                apikey: '2907eddb-94d2-4fbd-8151-6caa3cf4f242',
                                                lang: 'ru_RU',
                                                type: 'geo',
                                                results: 3
                                            },
                                            success: function (data) {
                                                if (data && data.features && data.features.length > 0) {
                                                    var suggestions = data.features.map(function (feature) {
                                                        return feature.properties.GeocoderMetaData.text;
                                                    });
                                                    showSuggestions(suggestions);
                                                } else {
                                                    $('.step2-address__hint').hide();
                                                }
                                            },
                                            error: function (xhr, status, error) {
                                                console.error('Ошибка при получении подсказок:', error);
                                                $('.step2-address__hint').hide();
                                            }
                                        });
                                    }

                                    function showSuggestions(suggestions) {
                                        var hintContainer = $('.step2-address__hint');
                                        hintContainer.empty();

                                        suggestions.forEach(function (suggestion) {
                                            var suggestionElement = $('<div>').text(suggestion);
                                            suggestionElement.on('click', function () {
                                                $('#step2-address').val(suggestion);
                                                hintContainer.hide();
                                                adjustTextareaHeight(); // Изменяем высоту при выборе подсказки
                                            });
                                            hintContainer.append(suggestionElement);
                                        });

                                        if (suggestions.length > 0) {
                                            hintContainer.show();
                                        } else {
                                            hintContainer.hide();
                                        }
                                    }

                                    // Наблюдатель за изменениями в окне подсказки Яндекса
                                    const observer = new MutationObserver((mutations) => {
                                        mutations.forEach((mutation) => {
                                            const addressElement = document.querySelector('[class*="islets_card__address"]');
                                            if (addressElement) {
                                                let address = addressElement.innerText.trim();
                                                $('#step2-address').val(address);
                                                $('#step2-address').removeClass('is-error');
                                                $('.step2-address_error').addClass('hidden');
                                                adjustTextareaHeight(); // Изменяем высоту при выборе адреса из подсказки

                                                // Получаем координаты и ставим метку
                                                ymaps.geocode(address).then(function (res) {
                                                    if (res.geoObjects.get(0)) {
                                                        var coords = res.geoObjects.get(0).geometry.getCoordinates();
                                                        addPlacemark(coords);
                                                    }
                                                });
                                            }
                                        });
                                    });

                                    observer.observe(document.body, {
                                        childList: true,
                                        subtree: true
                                    });

                                    // Обработка клика на геообъекты
                                    map.geoObjects.events.add('click', function (e) {
                                        var geoObject = e.get('target');
                                        if (geoObject.properties.get('metaDataProperty')) {
                                            var address = geoObject.properties.get('metaDataProperty').GeocoderMetaData.text;
                                            $('#step2-address').val(address);
                                            adjustTextareaHeight(); // Изменяем высоту при выборе объекта на карте
                                        } else {
                                            var coords = geoObject.geometry.getCoordinates();
                                            getAddress(coords);
                                        }
                                    });

                                    // Закрытие подсказки, когда получена информация об организации
                                    const closeBalloon = () => {
                                        const closeButton = document.querySelector('.ymaps-2-1-79-balloon__close-button');
                                        if (closeButton) {
                                            closeButton.click();
                                        }
                                    };

                                    const addressObserver = new MutationObserver((mutations) => {
                                        mutations.forEach((mutation) => {
                                            const addressElement = document.querySelector('[class*="islets_card__address"]');
                                            if (addressElement) {
                                                closeBalloon();
                                            }
                                        });
                                    });

                                    addressObserver.observe(document.body, {
                                        childList: true,
                                        subtree: true
                                    });
                                }
                            </script>

                            <style>
                                ymaps.ymaps-2-1-79-panel-pane {
                                    opacity: 0!important;
                                    pointer-events: none!important;
                                    height: 0px!important;
                                    max-height: 0px!important;
                                    overflow: hidden;
                                }
                                .ymaps-2-1-79-balloon_layout_panel {
                                    height: 0 !important;
                                }
                            </style>

                            <!-- STEP 2 - fields -->
                            <div class="app-form__step__fields">

                                <label for="step2-place-name" class="app-form__step__item">
                                    <span class="app-form__step__item__name">Название заведения&nbsp;<span class="required">*</span></span>
                                    <input type="text" id="step2-place-name" name="step2-place-name" class="app-form__field-text validation-place-name step2-place-name">
                                    <span class="app-form__step__item__error step2-place-name_error hidden">Неверный формат</span>
                                </label>

                                <label for="step2-working-hours" class="app-form__step__item">
                                    <span class="app-form__step__item__name">Время работы заведения&nbsp;<span class="required">*</span></span>
                                    <select id="step2-working-hours" name="step2-working-hours" class="app-form__field-select validation-working-hours step2-working-hours">
                                        <option value="8:00-21:00">с 8:00 до 21:00</option>
                                        <option value="9:00-22:00">с 9:00 до 22:00</option>
                                        <option value="10:00-22:00">с 10:00 до 22:00</option>
                                        <option value="24/7">Круглосуточно</option>
                                    </select>
                                    <span class="app-form__step__item__error step2-working-hours_error hidden">Неверный формат</span>
                                </label>

                                <label for="step2-place-phone" class="app-form__step__item">
                                    <span class="app-form__step__item__name">Телефон торговой точки&nbsp;<span class="required">*</span></span>
                                    <input type="text" id="step2-place-phone" name="step2-place-phone" placeholder="+7(___) ___-__-__" class="app-form__field-text validation-phone validation-place-phone step2-place-phone">
                                    <span class="app-form__step__item__error step2-place-phone_error hidden">Введите номер телефона в верном формате</span>
                                </label>
                            </div>

                            <div class="app-form__btns-wrap">
                                <button type="button" class="btn app-form__btn app-form__btn-prev app-form__btn-prev-step2">Назад</button>
                                <button type="button" class="btn app-form__btn app-form__btn-next app-form__btn-next-step2" disabled>Далее</button>
                            </div>

                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const placeNameInput = document.getElementById('step2-place-name');
                                const addressInput = document.getElementById('step2-address');
                                const placePhoneInput = document.querySelector('.step2-place-phone');

                                const placeNameError = document.querySelector('.step2-place-name_error');
                                const addressError = document.querySelector('.step2-address_error');
                                const placePhoneError = document.querySelector('.step2-place-phone_error');

                                const step3NavItem = document.querySelector('.app-form__nav__item__step3');

                                const nextButton = document.querySelector('.app-form__btn-next-step2');

                                let placeNameTouched = false;
                                let phoneTouched = false;
                                let addressTouched = false;

                                // Валидация "Адрес"
                                function validateAddress() {
                                    if (!addressTouched) return false; // Если поле ещё не было затронуто, не валидируем

                                    const addressValue = addressInput.value.trim();
                                    const hasLetters = /[а-яА-ЯёЁa-zA-Z]/.test(addressValue); // Проверка на наличие букв
                                    const hasOnlyNumbers = /^\d+$/.test(addressValue); // Проверка, что только цифры

                                    if (addressValue.length > 0 && hasLetters) {
                                        addressError.classList.add('hidden'); // Ошибку скрываем, если есть буквы
                                        addressInput.classList.remove('is-error'); // Ошибку скрываем, если есть буквы
                                        return true;
                                    } else {
                                        addressError.classList.remove('hidden'); // Показываем ошибку, если пусто или только цифры
                                        addressInput.classList.add('is-error'); // Показываем ошибку, если пусто или только цифры
                                        return false;
                                    }
                                }


                                function triggerAddressValidation() {
                                    addressTouched = true;
                                    validateAddress();
                                    toggleNextButton();
                                }

                                addressInput.addEventListener('blur', triggerAddressValidation);
                                addressInput.addEventListener('keyup', triggerAddressValidation);
                                placeNameInput.addEventListener('blur', triggerAddressValidation);
                                placeNameInput.addEventListener('keyup', triggerAddressValidation);
                                placePhoneInput.addEventListener('blur', triggerAddressValidation);

                                // Валидация "Название заведения"
                                function validatePlaceName() {
                                    if (!placeNameTouched) return false;

                                    const placeName = placeNameInput.value.trim();
                                    const hasLetters = /[а-яА-ЯёЁa-zA-Z]/.test(placeName); // Есть ли буквы
                                    const isValidFormat = /^[а-яА-ЯёЁa-zA-Z0-9\s\-,]+$/.test(placeName); // Разрешённые символы

                                    if (hasLetters && isValidFormat) {
                                        placeNameError.classList.add('hidden');
                                        placeNameInput.classList.remove('is-error');
                                        return true;
                                    } else {
                                        placeNameError.classList.remove('hidden');
                                        placeNameInput.classList.add('is-error');
                                        return false;
                                    }
                                }

                                function triggerPlaceNameValidation() {
                                    placeNameTouched = true;
                                    validatePlaceName();
                                    toggleNextButton();
                                }

                                placeNameInput.addEventListener('blur', triggerPlaceNameValidation);
                                placeNameInput.addEventListener('keyup', triggerPlaceNameValidation);

                                // Маска и валидация "Телефон"
                                // var cleaveStep2 = new Cleave('.step2-place-phone', {
                                //     delimiters: ['(', ') ', '-', '-'],
                                //     blocks: [2, 3, 3, 2, 2],
                                //     numericOnly: true,
                                //     prefix: '+7',
                                //     noImmediatePrefix: true,
                                //     rawValueTrimPrefix: true
                                // });


                                phoneFullyEnteredStep2 = false;
                                // Валидация телефона
                                function validatePhoneStep2() {
                                    var phoneValue = placePhoneInput.value;
                                    // var phonePattern = /^\+7\(\d{3}\) \d{3}-\d{2}-\d{2}$/;
                                    var phonePattern = /^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/;

                                    if (phonePattern.test(phoneValue)) {
                                        placePhoneError.classList.add('hidden');
                                        placePhoneInput.classList.remove('is-error');
                                        phoneFullyEnteredStep2 = true;
                                        return true;
                                    } else {
                                        if (phoneFullyEnteredStep2) {
                                            placePhoneError.classList.remove('hidden');
                                            placePhoneInput.classList.add('is-error');
                                        }
                                        phoneFullyEnteredStep2 = false;
                                        return false;
                                    }
                                }

                                placePhoneInput.addEventListener('blur', function () {
                                    placePhoneError.classList.remove('hidden');
                                    placePhoneInput.classList.add('is-error');
                                    phoneTouched = true;
                                    validatePhoneStep2();
                                    toggleNextButton();
                                });

                                placePhoneInput.addEventListener('input', function (event) {
                                    phoneTouched = true;
                                    validatePhoneStep2();
                                    toggleNextButton();
                                });


                                // Проверка всех полей
                                function isFormValid() {
                                    return validateAddress() && validatePlaceName() && validatePhoneStep2();
                                }

                                // Активация/деактивация кнопки "Далее"
                                function toggleNextButton() {
                                    if (isFormValid()) {
                                        nextButton.removeAttribute('disabled');

                                    } else {
                                        nextButton.setAttribute('disabled', 'true');
                                        step3NavItem.setAttribute('disabled', 'true');

                                    }
                                }

                                // Повторная проверка при клике на "Далее"
                                nextButton.addEventListener('click', function (event) {
                                    if (!isFormValid()) {
                                        event.preventDefault();
                                        placeNameTouched = true;
                                        phoneTouched = true;
                                        addressTouched = true;

                                        validateAddress();
                                        validatePlaceName();
                                        validatePhoneStep2();
                                        toggleNextButton();
                                    } else {

                                        document.querySelector('.app-form__nav__item.is-active').classList.remove('is-active');
                                        step3NavItem.classList.add('is-active');
                                        step3NavItem.disabled = false;

                                        document.querySelector('.app-form__step1').classList.add('hidden');
                                        document.querySelector('.app-form__step2').classList.add('hidden');
                                        document.querySelector('.app-form__step3').classList.remove('hidden');

                                        appForm_scroll();

                                    }
                                });


                                step3NavItem.addEventListener('click', function() {
                                    if (!this.disabled) {
                                        document.querySelector('.app-form__nav__item.is-active').classList.remove('is-active');
                                        this.classList.add('is-active');

                                        document.querySelector('.app-form__step1').classList.add('hidden');
                                        document.querySelector('.app-form__step2').classList.add('hidden');
                                        document.querySelector('.app-form__step3').classList.remove('hidden');
                                    }
                                });


                            });
                        </script>



                        <!-- STEP 3 -->
                        <div class="app-form__step app-form__step3 hidden">


                            <script src="https://cdn.jsdelivr.net/npm/browser-image-compression@1.0.15/dist/browser-image-compression.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/compressorjs@1.0.6/dist/compressor.min.js"></script>
<!--                            <script src="--><?php //echo get_template_directory_uri();?><!--/js/ffmpeg/ffmpeg-core.js"></script>-->

                            <!-- STEP 3 - fields -->
                            <div class="app-form__step__fields">


                                <label for="step3-status" class="app-form__step__item">
                                    <span class="app-form__step__item__name">Состояние оборудование:</span>
                                    <select id="step3-status" name="step3-status" class="app-form__field-select validation-status step3-status">
                                        <option value="coffee_make">Кофе готовить возможно</option>
                                        <option value="coffee_NOT_make">Кофе НЕ приготовить</option>
                                    </select>
                                    <!--                                    <span class="app-form__step__item__error step3-status_error hidden">Неверный формат</span>-->
                                </label>

                                <label for="step3-desc" class="app-form__step__item">
                                    <span class="app-form__step__item__name">Описание проблемы (причина вызова)&nbsp;<span class="required">*</span></span>
                                    <textarea id="step3-desc" name="step3-desc" rows="5" cols="33" class="app-form__field-textarea validation-desc step3-desc"></textarea>
                                    <span class="app-form__step__item__error step3-desc_error_min hidden">Минимальное количество символов 15</span>
                                    <span class="app-form__step__item__error step3-desc_error_max hidden">Максимальное количество символов 1000</span>
                                </label>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const textarea = document.getElementById('step3-desc');
                                        const errorMin = document.querySelector('.step3-desc_error_min');
                                        const errorMax = document.querySelector('.step3-desc_error_max');
                                        const submitButton = document.querySelector('.app-form__btn-next-step-send');
                                        let textarea15wordsEntered = false;

                                        function validateMaxLength() {
                                            const textLength = textarea.value.length;

                                            if (textLength > 1000) {
                                                errorMax.classList.remove('hidden');
                                                textarea.classList.add('is-error');
                                                submitButton.disabled = true;
                                            } else {
                                                errorMax.classList.add('hidden');
                                                textarea.classList.remove('is-error');
                                            }

                                            if (textLength >= 15 && textLength <= 1000) {
                                                submitButton.disabled = false;
                                            }
                                        }

                                        function validateMinLength() {
                                            const textLength = textarea.value.length;

                                            if (textLength >= 15) {
                                                textarea15wordsEntered = true;
                                            }

                                            if (textarea15wordsEntered) {
                                                if (textLength < 15) {
                                                    errorMin.classList.remove('hidden');
                                                    textarea.classList.add('is-error');
                                                    submitButton.disabled = true;
                                                } else {
                                                    errorMin.classList.add('hidden');
                                                    textarea.classList.remove('is-error');
                                                }
                                            }

                                            if (textLength >= 15 && textLength <= 1000) {
                                                submitButton.disabled = false;
                                            }
                                        }

                                        textarea.addEventListener('input', function() {
                                            validateMaxLength();
                                            validateMinLength();
                                        });

                                        textarea.addEventListener('blur', function() {
                                            textarea15wordsEntered = true;
                                            validateMaxLength();
                                            validateMinLength();
                                        });

                                        // submitButton.addEventListener('mouseover', function() {
                                        //     if (submitButton.disabled) {
                                        //         textarea15wordsEntered = true;
                                        //         validateMaxLength();
                                        //         validateMinLength();
                                        //     }
                                        // });

                                    });
                                </script>


                                <div class="app-form__step__item app-form__step__item--upload-files">

                                    <div id="uploadForm">
                                        <label class="app-form__step__item__name" for="fileInput">Добавить фото:</label>
                                        <input type="file" id="fileInput" name="uploaded_files[]" accept="image/*,video/*" multiple style="display: none;">

<!--                                        <input type="file" id="fileInput" accept="image/*" multiple onchange="handleFileSelect(event)" style="display: none;">-->
                                        <?php //<input type="file" id="fileInput" accept="image/*,video/*" multiple onchange="handleFileSelect(event)" style="display: none;">?>
                                        <button type="button" id="uploadButton" onclick="document.getElementById('fileInput').click();">Загрузить</button>
                                        <div id="previewContainer"></div>
                                    </div>
                                </div>

                                <div class="app-form__step__item">
                                    <span class="app-form__step__item__name">Желаемая дата выполнения заявки:</span>
                                    <input type="text" name="step3_datepicker" class="datepicker_info" readonly>
                                    <div id="datepicker-container"></div>
                                </div>

                                <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

                                <script>
                                    $(document).ready(function() {
                                        // Устанавливаем русскую локализацию
                                        $.datepicker.regional['ru'] = {
                                            closeText: 'Закрыть',
                                            prevText: 'Пред',
                                            nextText: 'След',
                                            currentText: 'Сегодня',
                                            monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
                                                'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
                                            monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
                                                'Июл','Авг','Сен','Окт','Ноя','Дек'],
                                            dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
                                            dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
                                            dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
                                            weekHeader: 'Нед',
                                            dateFormat: 'dd.mm.yy',
                                            firstDay: 1,
                                            isRTL: false,
                                            showMonthAfterYear: false,
                                            yearSuffix: ''
                                        };
                                        $.datepicker.setDefaults($.datepicker.regional['ru']);

                                        // Инициализация календаря в контейнере
                                        $("#datepicker-container").datepicker({
                                            minDate: 0,
                                            dateFormat: "dd.mm.yy",
                                            onSelect: function(dateText) {
                                                $(".datepicker_info").val(dateText);
                                            }
                                        });
                                    });
                                </script>


                                <div class="app-form__btns-wrap">
                                    <button type="button" class="btn app-form__btn app-form__btn-prev app-form__btn-prev-step3">Назад</button>
                                    <button type="submit" class="btn app-form__btn app-form__btn-next app-form__btn-next-step-send" disabled>Отправить заявку</button>
                                </div>

                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    document.querySelector('.app-form__btn-prev-step3').addEventListener('click', function() {
                                        document.querySelector('.app-form__nav__item.is-active').classList.remove('is-active');
                                        document.querySelector('.app-form__nav__item__step2').classList.add('is-active');

                                        document.querySelector('.app-form__step1').classList.add('hidden');
                                        document.querySelector('.app-form__step2').classList.remove('hidden');
                                        document.querySelector('.app-form__step3').classList.add('hidden');

                                        appForm_scroll();
                                    });
                                });
                            </script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const fileInput = document.getElementById('fileInput');
                                    const previewContainer = document.getElementById('previewContainer');

                                    const allowedImageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'webp', 'svg'];

                                    function getFileExtension(filename) {
                                        return filename.split('.').pop().toLowerCase();
                                    }

                                    function isImage(file) {
                                        return allowedImageExtensions.includes(getFileExtension(file.name));
                                    }

                                    function createPreview(file) {
                                        const reader = new FileReader();
                                        reader.onload = function (e) {
                                            const preview = document.createElement('div');
                                            preview.className = 'preview';

                                            const fileName = document.createElement('div');
                                            fileName.className = 'preview-name';
                                            fileName.textContent = file.name;

                                            const img = document.createElement('img');
                                            img.src = e.target.result;
                                            img.style.maxWidth = '175px';

                                            const removeBtn = document.createElement('div');
                                            removeBtn.className = 'remove-btn';
                                            removeBtn.innerHTML = '×';
                                            removeBtn.onclick = function () {
                                                previewContainer.removeChild(preview);
                                                updateFileList();
                                            };

                                            preview.appendChild(fileName);
                                            preview.appendChild(img);
                                            preview.appendChild(removeBtn);
                                            previewContainer.appendChild(preview);
                                        };
                                        reader.readAsDataURL(file);
                                    }

                                    function updateFileList() {
                                        const previews = previewContainer.querySelectorAll('.preview');
                                        if (previews.length === 0) {
                                            fileInput.value = ''; // Очистить поле выбора файла
                                        }
                                    }

                                    async function handleFileSelect(event) {
                                        const files = event.target.files;
                                        const previewContainer = document.getElementById('previewContainer');
                                        const existingFileNames = Array.from(previewContainer.children).map(child => child.querySelector('.preview-name').textContent);

                                        if (previewContainer.children.length + files.length > 6) {
                                            alert('Можно загружать не более 6 изображений.');
                                            return;
                                        }

                                        for (const file of files) {
                                            if (!isImage(file)) {
                                                alert('Недопустимый формат файла: ' + file.name);
                                                continue;
                                            }

                                            if (existingFileNames.includes(file.name)) {
                                                alert(`Файл с именем "${file.name}" уже добавлен.`);
                                                continue;
                                            }

                                            // Оптимизируем изображение
                                            const compressedFile = await imageCompression(file, {
                                                maxSizeMB: 4, // Максимальный размер 4MB
                                                maxWidthOrHeight: 1920,
                                                useWebWorker: true
                                            });

                                            createPreview(compressedFile);
                                        }
                                    }

                                    fileInput.addEventListener('change', handleFileSelect);
                                });
                            </script>


                            <!--SEND-->
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const form = document.getElementById('app-form');
                                    const submitButton = document.querySelector('.app-form__btn-next-step-send');
                                    const successMessage = document.querySelector('.app-form__success');
                                    const previewContainer = document.getElementById('previewContainer');

                                    form.addEventListener('submit', function (event) {
                                        event.preventDefault();

                                        const formData = new FormData(form);

                                        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                                            method: 'POST',
                                            body: formData
                                        })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.success) {

                                                    document.querySelector('.app-form__nav').remove();
                                                    document.querySelector('.app-form__step1').remove();
                                                    document.querySelector('.app-form__step2').remove();
                                                    document.querySelector('.app-form__step3').remove();
                                                    successMessage.classList.remove('hidden');
                                                    appForm_scroll();

                                                    form.reset();
                                                    previewContainer.innerHTML = ''; // Очищаем превью изображений
                                                } else {
                                                    alert(data.data); // Выводим сообщение об ошибке
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Ошибка:', error);
                                                alert('Ошибка при отправке формы');
                                            });
                                    });
                                });
                            </script>

                        </div>

                        <div class="app-form__success hidden">
                            <div class="app-form__success__wrap">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/icon-check-success.png" width="100" alt="успех" class="app-form__success__img">
                                <div class="app-form__success__text">
                                    Заявка отправлена! Спасибо за обращение. <br class="app-form__success__text__br">Мы скоро с вами свяжемся для уточнения деталей.
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
    </section>

</main>



<?php get_footer(); ?>
