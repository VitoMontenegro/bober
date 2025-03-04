<?php
/*
 Template Name: app-form-new
 */
?>
<?php get_header(); ?>
<main>
    <section class="section app-form__section">
        <div class="container">
            <div class="content">

                <h1>Заявка</h1>


<!--                <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>-->
<!--                <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/addons/cleave-phone.ru.js"></script>-->
                <script src="<?php echo get_template_directory_uri() . '/js/imask.js';?>"></script>



                <div class="app-form">
                    <div class="app-form__nav">
                        <button class="app-form__nav__item app-form__nav__item__step1 is-active">Шаг 1</button>
                        <button class="app-form__nav__item app-form__nav__item__step2" disabled>Шаг 2</button>
                        <button class="app-form__nav__item app-form__nav__item__step3" disabled>Шаг 3</button>
                    </div>


                    <div class="app-form__wrap">

                        <!-- STEP 1 -->
                        <div class="app-form__step app-form__step1">
                            <label for="step1-phone" class="app-form__step__item">
                                <span class="app-form__step__item__name">Номер телефона:</span>
<!--                                <input type="text" id="step1-phone" name="step1-phone" placeholder="+7(XXX) XXX-XX-XX" class="app-form__field-text validation-phone step1-phone">-->
                                <input type="text" id="step1-phone" name="step1-phone" placeholder="+7(___) ___-__-__" class="app-form__field-text validation-phone step1-phone">
                                <span class="app-form__step__item__error step1-phone_error hidden">Введите номер телефона в верном формате</span>
                            </label>
                            <div class="app-form__btns-wrap">
                                <button class="btn app-form__btn app-form__btn-next app-form__btn-next-step1" disabled>Далее</button>
                            </div>
                        </div>
                        <script>
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
                                        nextButton.disabled = false;
                                        phoneFullyEntered = true;
                                    } else {
                                        if (phoneFullyEntered) {
                                            errorSpan.classList.remove('hidden');
                                        }
                                        nextButton.disabled = true;
                                        step2NavItem.disabled = true;
                                        phoneFullyEntered = false;
                                    }
                                }
                                phoneInput.addEventListener('blur', function(event) {
                                    errorSpan.classList.remove('hidden');
                                    validatePhone();
                                });
                                phoneInput.addEventListener('keyup', function(event) {
                                    if (!/^\d$/.test(event.key) && event.key !== 'Backspace' && event.key !== 'Delete') {
                                        errorSpan.classList.remove('hidden');
                                        validatePhone();
                                    } else {
                                        validatePhone();
                                    }
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
                                    } else {
                                        validatePhone();
                                        errorSpan.classList.remove('hidden');
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

                            <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=fee8b248-ad15-4021-958f-525f5f127909" type="text/javascript"></script>


                            <!-- STEP 2 - map -->
                            <div class="app-form__step__map-wrap">
                                <div id="step2_map" class="app-form__step__map step2_map"></div>

                                <label for="step2-address" class="app-form__step__item">
                                    <span class="app-form__step__item__name">Адрес:</span>
                                    <input type="text" id="step2-address" name="step2-address" class="app-form__field-text validation-address step2-address">
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


                                    // Определение геопозиции пользователя
                                    ymaps.geolocation.get({
                                        provider: 'browser',
                                        mapStateAutoApply: true
                                    }).then(function (result) {
                                        var userLocation = result.geoObjects.position;
                                        map.setCenter(userLocation, 14);
                                        var userPlacemark = new ymaps.Placemark(userLocation, {}, {
                                            preset: 'islands#blueCircleDotIconWithCaption',
                                            draggable: true
                                        });
                                        map.geoObjects.add(userPlacemark);

                                        userPlacemark.events.add('dragend', function (e) {
                                            var coords = e.get('target').geometry.getCoordinates();
                                            getAddress(coords);
                                        });

                                        getAddress(userLocation);
                                    });

                                    // Автозаполнение адреса при вводе
                                    $('#step2-address').on('input', function () {
                                        var address = $(this).val();
                                        $(this).val(address.replace(/[^а-яА-ЯёЁ0-9,\s\-]/g, '')); // Разрешаем буквы, цифры, запятые и тире

                                        if (address.length > 2) { // Только если более 2 символов
                                            // suggestAddress(address); //TODO
                                        } else {
                                            $('.step2-address__hint').hide();
                                        }
                                    });

                                    function getAddress(coords) {
                                        ymaps.geocode(coords).then(function (res) {
                                            var firstGeoObject = res.geoObjects.get(0);
                                            $('#step2-address').val(firstGeoObject.getAddressLine());
                                        });
                                    }

                                    function suggestAddress(query) {
                                        $.ajax({
                                            url: 'https://search-maps.yandex.ru/v1/',
                                            data: {
                                                text: query,
                                                apikey: 'eec0d969-2573-4382-acc5-431776807804',
                                                lang: 'ru_RU',
                                                type: 'geo'
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

                                                // Получаем координаты и ставим метку
                                                ymaps.geocode(address).then(function (res) {
                                                    if (res.geoObjects.get(0)) {
                                                        var coords = res.geoObjects.get(0).geometry.getCoordinates();
                                                        // addPlacemark(coords);
                                                        map.setCenter(coords, 14);
                                                    }
                                                });
                                            }
                                        });
                                    });

                                    observer.observe(document.body, {
                                        childList: true,
                                        subtree: true
                                    });

                                    // Обработка клика на карте
                                    map.events.add('click', function (e) {
                                        var coords = e.get('coords');
                                        getAddress(coords);
                                    });

                                    // Обработка клика на геообъекты
                                    map.geoObjects.events.add('click', function (e) {
                                        var geoObject = e.get('target');
                                        if (geoObject.properties.get('metaDataProperty')) {
                                            var address = geoObject.properties.get('metaDataProperty').GeocoderMetaData.text;
                                            $('#step2-address').val(address);
                                        } else {
                                            var coords = geoObject.geometry.getCoordinates();
                                            getAddress(coords);
                                        }
                                    });
                                }
                            </script>


                            <!-- STEP 2 - fields -->
                            <div class="app-form__step__fields">

                                <label for="step2-place-name" class="app-form__step__item">
                                    <span class="app-form__step__item__name">Название заведения:</span>
                                    <input type="text" id="step2-place-name" name="step2-place-name" class="app-form__field-text validation-place-name step2-place-name">
                                    <span class="app-form__step__item__error step2-place-name_error hidden">Неверный формат</span>
                                </label>

                                <label for="step2-working-hours" class="app-form__step__item">
                                    <span class="app-form__step__item__name">Время работы заведения:</span>
                                    <select id="step2-working-hours" name="step2-working-hours" class="app-form__field-select validation-working-hours step2-working-hours">
                                        <option value="8:00-21:00">с 8:00 до 21:00</option>
                                        <option value="9:00-22:00">с 9:00 до 22:00</option>
                                        <option value="10:00-22:00">с 10:00 до 22:00</option>
                                        <option value="24/7">Круглосуточно</option>
                                    </select>
                                    <span class="app-form__step__item__error step2-working-hours_error hidden">Неверный формат</span>
                                </label>

                                <label for="step2-place-phone" class="app-form__step__item">
                                    <span class="app-form__step__item__name">Телефон торговой точки:</span>
                                    <input type="text" id="step2-place-phone" name="step2-place-name" placeholder="+7(___) ___-__-__" class="app-form__field-text validation-phone validation-place-phone step2-place-phone">
                                    <span class="app-form__step__item__error step2-place-phone_error hidden">Введите номер телефона в верном формате</span>
                                </label>
                            </div>

                            <div class="app-form__btns-wrap">
                                <button class="btn app-form__btn app-form__btn-prev app-form__btn-prev-step2">Назад</button>
                                <button class="btn app-form__btn app-form__btn-next app-form__btn-next-step2" disabled>Далее</button>
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
                                        return true;
                                    } else {
                                        addressError.classList.remove('hidden'); // Показываем ошибку, если пусто или только цифры
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
                                        return true;
                                    } else {
                                        placeNameError.classList.remove('hidden');
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
                                        phoneFullyEnteredStep2 = true;
                                        return true;
                                    } else {
                                        if (phoneFullyEnteredStep2) {
                                            placePhoneError.classList.remove('hidden');
                                        }
                                        phoneFullyEnteredStep2 = false;
                                        return false;
                                    }
                                }

                                placePhoneInput.addEventListener('blur', function () {
                                    placePhoneError.classList.remove('hidden');
                                    phoneTouched = true;
                                    validatePhoneStep2();
                                    toggleNextButton();
                                });

                                placePhoneInput.addEventListener('keyup', function (event) {
                                    if (!/^\d$/.test(event.key) && event.key !== 'Backspace' && event.key !== 'Delete') {
                                        placePhoneError.classList.remove('hidden');
                                        validatePhoneStep2();
                                    } else {
                                        phoneTouched = true;
                                        validatePhoneStep2();
                                        toggleNextButton();
                                    }
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


<!--                            <script src="https://cdn.jsdelivr.net/npm/browser-image-compression@1.0.15/dist/browser-image-compression.js"></script>-->
<!--                            <script src="https://cdn.jsdelivr.net/npm/compressorjs@1.0.6/dist/compressor.min.js"></script>-->
<!--                            <script src="https://cdn.jsdelivr.net/npm/@ffmpeg/ffmpeg@0.12.15/dist/umd/ffmpeg.min.js"></script>-->
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/videoconverter.js/1.0.0/videoconverter.min.js"></script>

                            <script>
                                async function compressVideo(file) {
                                    return new Promise((resolve, reject) => {
                                        const reader = new FileReader();
                                        reader.readAsArrayBuffer(file);

                                        reader.onload = async function () {
                                            try {
                                                const videoConverter = new VideoConverter();
                                                const options = {
                                                    maxSizeMB: 1, // Устанавливаем ограничение в 1 МБ
                                                    maxWidthOrHeight: 1280, // Ограничение по размеру
                                                    quality: 0.7, // Качество (1 - без потерь, 0 - максимальное сжатие)
                                                    format: 'mp4'
                                                };

                                                const compressedBlob = await videoConverter.compress(new Uint8Array(reader.result), options);
                                                resolve(new Blob([compressedBlob], { type: 'video/mp4' }));
                                            } catch (error) {
                                                console.error("Ошибка при сжатии видео:", error);
                                                reject(error);
                                            }
                                        };

                                        reader.onerror = function (error) {
                                            reject(error);
                                        };
                                    });
                                }
                            </script>





                            <!-- STEP 3 - fields -->
                            <div class="app-form__step__fields">


                                <label for="step3-status" class="app-form__step__item">
                                    <span class="app-form__step__item__name">Состояние оборудование:</span>
                                    <select id="step3-status" name="step3-status" class="app-form__field-select validation-status step3-status">
                                        <option value="coffee_make">Кофе готовить возможно </option>
                                        <option value="coffee_not_make">Кофе НЕ приготовить</option>
                                    </select>
<!--                                    <span class="app-form__step__item__error step3-status_error hidden">Неверный формат</span>-->
                                </label>

                                <label for="step3-desc" class="app-form__step__item">
                                    <span class="app-form__step__item__name">Описание проблемы (причина вызова):</span>
                                    <textarea id="step3-desc" name="step3-desc" rows="5" cols="33" class="app-form__field-textarea validation-desc step3-desc"></textarea>
                                </label>


                                <div class="app-form__step__item">

                                    <form id="uploadForm">
                                        <label for="fileInput">Добавить фото/видео:</label>
                                        <input type="file" id="fileInput" accept="image/*,video/*" multiple onchange="handleFileSelect(event)">
                                    </form>
                                    <div id="previewContainer"></div>
                                </div>


                                <span class="app-form__step__item__name">Желаемая дата выполнения заявки:</span>

                                <div class="app-form__btns-wrap">
                                    <button class="btn app-form__btn app-form__btn-prev app-form__btn-prev-step3">Назад</button>
                                    <button class="btn app-form__btn app-form__btn-next app-form__btn-next-step-send" disabled>Отправить заявку</button>
                                </div>

                            </div>
                            <style>
                                .preview {
                                    position: relative;
                                    display: inline-block;
                                    margin: 10px;
                                }
                                .preview img, .preview video {
                                    max-width: 200px;
                                    max-height: 200px;
                                }
                                .preview .remove-btn {
                                    position: absolute;
                                    top: 5px;
                                    right: 5px;
                                    background: red;
                                    color: white;
                                    border: none;
                                    border-radius: 50%;
                                    cursor: pointer;
                                }
                            </style>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    document.querySelector('.app-form__btn-prev-step3').addEventListener('click', function() {
                                        document.querySelector('.app-form__nav__item.is-active').classList.remove('is-active');
                                        document.querySelector('.app-form__nav__item__step2').classList.add('is-active');

                                        document.querySelector('.app-form__step1').classList.add('hidden');
                                        document.querySelector('.app-form__step2').classList.remove('hidden');
                                        document.querySelector('.app-form__step3').classList.add('hidden');
                                    });
                                });

                                const allowedImageExtensions = ['jpeg', 'jpg', 'png', 'ico', 'gif', 'tiff', 'webp', 'eps', 'svg'];
                                const allowedVideoExtensions = ['mov', 'mpeg', 'mpeg1', 'mpeg2', 'mpeg4', 'mp4', 'mpg', 'avi', 'wmv', 'mpegps', 'flv', '3gpp', 'webm', 'dnxhr', 'prores', 'cineform', 'hevc'];

                                function getFileExtension(filename) {
                                    return filename.split('.').pop().toLowerCase();
                                }

                                function isImage(file) {
                                    const extension = getFileExtension(file.name);
                                    return allowedImageExtensions.includes(extension);
                                }

                                function isVideo(file) {
                                    const extension = getFileExtension(file.name);
                                    return allowedVideoExtensions.includes(extension);
                                }

                                async function compressImage(file) {
                                    const options = {
                                        maxSizeMB: 7,
                                        maxWidthOrHeight: 1920,
                                        useWebWorker: true
                                    };
                                    try {
                                        const compressedFile = await imageCompression(file, options);
                                        return compressedFile;
                                    } catch (error) {
                                        console.error(error);
                                    }
                                }


                                function createPreview(file, isImage) {
                                    const previewContainer = document.getElementById('previewContainer');
                                    const preview = document.createElement('div');
                                    preview.className = 'preview';

                                    const removeBtn = document.createElement('button');
                                    removeBtn.className = 'remove-btn';
                                    removeBtn.innerHTML = '×';
                                    removeBtn.onclick = () => {
                                        previewContainer.removeChild(preview);
                                        document.getElementById('fileInput').value = '';
                                    };

                                    if (isImage) {
                                        const img = document.createElement('img');
                                        img.src = URL.createObjectURL(file);
                                        preview.appendChild(img);
                                    } else {
                                        const video = document.createElement('video');
                                        video.src = URL.createObjectURL(file);
                                        video.controls = true;
                                        preview.appendChild(video);
                                    }

                                    preview.appendChild(removeBtn);
                                    previewContainer.appendChild(preview);
                                }

                                async function handleFileSelect(event) {
                                    const files = event.target.files;

                                    if (!files.length) {
                                        alert('Пожалуйста, выберите файл.');
                                        return;
                                    }

                                    for (const file of files) {
                                        const extension = getFileExtension(file.name);

                                        if (isImage(file)) {
                                            if (file.size > 7 * 1024 * 1024) { // 7MB
                                                const compressedFile = await compressImage(file);
                                                createPreview(compressedFile, true);
                                                console.log('Compressed Image:', compressedFile);
                                                // Upload compressed image
                                            } else {
                                                createPreview(file, true);
                                                console.log('Image:', file);
                                                // Upload image
                                            }
                                        } else if (isVideo(file)) {
                                            if (file.size > 1 * 1024 * 1024) { // 1MB
                                                const compressedFile = await compressVideo(file);
                                                createPreview(compressedFile, false);
                                                console.log('Compressed Video:', compressedFile);
                                                // Upload compressed video
                                            } else {
                                                createPreview(file, false);
                                                console.log('Video:', file);
                                                // Upload video
                                            }
                                        } else {
                                            alert('Недопустимый формат файла.');
                                        }
                                    }
                                }
                            </script>



                    </div>
                </div>
            </div>
        </div>
    </section>


    <style>
        /*GENERAL*/
        .hidden {
            display: none;
        }

        .app-form__section h1 {
            text-align: center;
        }
        .app-form {
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
        }
        .app-form__nav {
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            position: relative;
        }

        .app-form__nav__item {
            position: relative;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.07);
            background: #ededed;
            color: #664d47;
            border-radius: 16px 16px 0 0;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            min-width: 140px;
            font-size: 20px;
            cursor: pointer;
            font-weight: 600;
            outline: none;
        }
        .app-form__nav__item:before {
            content: '';
            display: block;
            width: 120%;
            height: 25px;
            position: absolute;
            background: #fff;
            bottom: -25px;
            border-radius: 10px;
            pointer-events: none;
        }

        .app-form__wrap {
            box-shadow: 0 0 80px 0 rgba(0, 0, 0, 0.07);
            border-radius: 20px;
            background-color: #fff;
            padding:35px;
            z-index: 1;
            position: relative;
        }
        .app-form__nav__item.is-active {
            background: #fff;
            cursor: auto;
        }
        button.app-form__nav__item[disabled] {
            cursor: auto;
            pointer-events: none;
            opacity: 0.5;
        }

        .app-form__step__item {
            display: block;
            position: relative;
            margin-bottom: 20px;
        }
        .app-form__step__item__name {
            font-weight: 400;
            font-size: 18px;
            padding-left: 2px;
            display: block;
            margin-bottom: 5px;
        }
        .app-form__field-text {
            border-radius: 8px;
            padding: 15px 15px 15px 15px;
            width: 312px;
            height: 50px;
            border: none;
            background: rgba(250, 240, 235, 0.5);
            outline: none;
            font-weight: 700;
            font-size: 16px;
            line-height: 100%;
            color: #664d47;
            width: 100%;
        }
        .app-form__field-select {
            border-radius: 8px;
            padding: 15px 15px 15px 15px;
            height: 50px;
            border: none;
            background: rgba(250, 240, 235, 0.5);
            outline: none;
            font-weight: 700;
            font-size: 16px;
            line-height: 100%;
            color: #664d47;
            width: 100%;
            border-right: 15px solid transparent;
            cursor: pointer;
            margin-bottom: 5px;
        }

        .app-form__step__item__error {
            font-weight: 600;
            font-size: 18px;
            padding-left: 2px;
            display: block;
        }
        .app-form__step__item__error.hidden {
            display: block;
            opacity: 0;
            pointer-events: none;
            visibility: hidden;
        }

        .app-form__field-textarea {
            border-radius: 8px;
            padding: 15px 15px 15px 15px;
            width: 312px;
            height: 150px;
            border: none;
            background: rgba(250, 240, 235, 0.5);
            outline: none;
            font-weight: 700;
            font-size: 16px;
            line-height: 20px;
            color: #664d47;
            width: 100%;
            resize: none;
        }

        .app-form__btns-wrap {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            width: 100%;
            margin-top: 20px;
        }
        .app-form__btn {
            border-radius: 8px;
            background-color: #EB6025;
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            line-height: 100%;
            border: none;
            min-height: 50px;
            min-width: 170px;
            cursor: pointer;
        }
        .app-form__btn:hover {
            background-color: #ffe4d9;
            color: #EB6025;
        }

        .app-form__btn[disabled] {
            opacity: 0.5;
            background-color: #ffe4d9;
            color: #EB6025;
            cursor: auto;
        }

        /*STEP2*/
        .step2_map {
            width: 100%;
            height: 450px;
            margin-bottom: 15px;
            border-radius: 10px 10px 0 0;
            overflow: hidden;
        }
        .step2-address__hint {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            display: none;
            position: absolute;
            background: white;
            z-index: 1000;
        }
        .step2-address__hint div {
            padding: 5px;
            cursor: pointer;
        }
        .step2-address__hint div:hover {
            background: #f0f0f0;
        }


        /*RESPONSIVE*/
        @media (max-width: 560px){
            .app-form__wrap {
                padding: 25px;
            }
            .app-form__nav__item {
                padding: 10px;
                min-width: 90px;
                font-size: 16px;
            }
            .app-form__btn {
                min-height: 45px;
                min-width: 140px;
            }
        }

        @media (max-width: 420px){
            .app-form__btns-wrap {
                gap: 10px;
            }
            .app-form__btn {
                flex-grow: 1;
                min-width: 100px;
            }
        }
        @media (max-width: 365px){
            .app-form__wrap {
                padding: 20px;
            }
            .app-form__nav__item:before {
                height: 15px;
                bottom: -15px;
            }
            .app-form__nav__item {
                min-width: 80px;
            }

        }
    </style>

</main>

<?php get_footer(); ?>
