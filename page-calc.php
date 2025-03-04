<?php
/*
 Template Name: Калькулятор
 */
?>
<?php get_header(); ?>

<main>
    <div class="content">
        <?php the_content();?>
    </div>
    <section class="section calc-arenda__section">
        <div class="container">
            <h1 class="main-title">Калькулятор выгоды</h1>
            <div class="default-page__text">
                <p>Сотрудничать с Бобром выгодно! Рассчитайте свою выгоду и получите интересные предложения.</p>
                <p>В калькуляторе ниже укажите, <strong>сколько килограмм кофе</strong> вам необходимо приобрести и <strong>какую цену за 1 кг</strong> вы платите вашим поставщикам. Калькулятор покажет сумму, которую <strong>вы сэкономите</strong>, приобретая <strong>кофе у Бобра</strong>.</p>
            </div>
            <div class="calc-arenda calc-arenda--desktop">
                <div class="calc-arenda__title">
                    <div class="calc-arenda__title__name">
                        Ваши условия
                    </div>
                    <div class="calc-arenda__title__name">
                        Условия Бобра
                    </div>
                </div>
                <label class="calc-arenda__row">
                    <div class="calc-arenda__row__user">
                        <div class="calc-arenda__row__user__wrap">
                            <div class="calc-arenda__row__user__wrap__block-size">
                                <span id="size-calibration_1" class="block-size__size-calibration"></span>
                                <input id="autosized-input_1" type="number" class="block-size__autosized-input"/>
                            </div>
                            <div class="calc-arenda__row__user__wrap__text">Введите количество кг</div>
                        </div>
                    </div>
                    <div class="calc-arenda__row__name">
                        Количество кофе, <span>кг</span>
                    </div>
                    <div class="calc-arenda__row__bobr color-black">
                        <span class="calc-arenda__row__bobr__span">0</span> кг
                    </div>
                </label>
                <label class="calc-arenda__row">
                    <div class="calc-arenda__row__user">
                        <div class="calc-arenda__row__user__wrap">
                            <div class="calc-arenda__row__user__wrap__block-size">
                                <span id="size-calibration_2" class="block-size__size-calibration">900</span>
                                <input id="autosized-input_2" type="number" class="block-size__autosized-input" value="900"/>
                                <div class="block-size__validation">Минимальная сумма - 900 руб/кг</div>
                            </div>
                            <div class="calc-arenda__row__user__wrap__text">Введите стоимость за 1 кг</div>
                        </div>
                    </div>
                    <div class="calc-arenda__row__name">
                        Цена за 1 кг, <span>₽</span>
                    </div>
                    <div class="calc-arenda__row__bobr">
                        от <span id="calc-arenda__row__bobr__price" class="calc-arenda__row__bobr__price" data-calcArendePrice="900">900</span> ₽
                    </div>
                </label>
            </div>

            <div class="calc-arenda calc-arenda--mobile">
                <div class="calc-arenda__title">
                    <div class="calc-arenda__title__name">
                        Условия Бобра
                    </div>
                </div>
                <div class="calc-arenda__row">
                    <div class="calc-arenda__row__bobr color-black">
                        <span class="calc-arenda__row__bobr__span">0</span> кг
                    </div>
                    <div class="calc-arenda__row__name">
                        Количество кофе, <span>кг</span>
                    </div>
                </div>
                <div class="calc-arenda__row">
                    <div class="calc-arenda__row__bobr">
                        от <span class="calc-arenda__row__bobr__price">900</span> ₽
                    </div>
                    <div class="calc-arenda__row__name">
                        Цена за 1 кг, <span>₽</span>
                    </div>
                </div>
            </div>

            <div class="calc-arenda-banner">
                <div class="calc-arenda-banner__info">
                    <div class="calc-arenda-banner__info__title">
                        Ваша выгода - <span class="calc-arenda-banner__result-sum">0</span>&nbsp;₽
                    </div>
                    <div class="calc-arenda-banner__info__text">
                        Эту сумму можно потратить на приобретение собственной кофемашины в лизинг.
                    </div>
                </div>
            </div>

        </div>
    </section>



    <section class="section product-filter-slider__section">
        <div class="container">
            <h2 class="section-title">Выбрать кофемашину на выгодных условиях </h2>

            <div class="product-filter-slider__filter">
                <?php /* <button class="btn btn-orange product-filter-slider__filter__item" data-filter="multiboiler">Мультибойлер</button> */?>
                <button class="btn btn-orange product-filter-slider__filter__item" data-filter="arenda-superavtomaticheskikh">Суперавтомат</button>
                <button class="btn btn-orange product-filter-slider__filter__item" data-filter="arenda-rozhkovikh">Рожковая</button>
            </div>
            <div class="product-filter-slider__slider-wrap">
                <div class="slider-default product-filter-slider__slider owl-carousel">
                    <?php
                    $GLOBALS['page-template'] = 'calculator';

                    $posts = new WP_Query(array(
                        'posts_per_page'	=> 10,
                        'post_type'		=> 'product_arenda',
                        "post_status"      => "publish",


                    )); ?>

                    <?php if ($posts->have_posts()) : ?>
                        <?php while ($posts->have_posts()) : $posts->the_post(); ?>

                            <?php get_template_part('/template-parts/loop-arenda-item'); ?>

                        <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>

                </div>
            </div>
        </div>
    </section>


    <section class="section calc-leasing__section">
        <div class="container">
            <h2 class="section-title">Калькулятор лизинга</h2>

            <?php
            //http://ionden.com/a/plugins/ion.rangeSlider/demo.html
            //https://github.com/IonDen/ion.rangeSlider?tab=readme-ov-file
            ?>

            <div class="calc-leasing">
                <div class="calc-leasing__item">
                    <div class="calc-leasing__item__title">
                        Стоимость оборудования
                    </div>
                    <div class="calc-leasing__item__slide">
                        <div class="calc-leasing__item__slide__control">
                            <input type="text" id="control-leasing-1" class="control-leasing-slide" value="1400000" />
                        </div>
                        <input type="text" id="calc-leasing-1" name="calc-leasing-1" value="" class="calc-leasing-slide"
                               data-skin="round"
                               data-min="100000"
                               data-max="3000000"
                               data-from="1400000"
                               data-step="1000"
                               data-postfix=" руб"
                        />
                    </div>
                </div>
                <div class="calc-leasing__item">
                    <div class="calc-leasing__item__title">
                        Авансовый платёж
                    </div>
                    <div class="calc-leasing__item__slide">
                        <div class="calc-leasing__item__slide__control">
                            <input type="text" id="control-leasing-2" class="control-leasing-slide" value="25" />
                        </div>
                        <div class="calc-leasing__item__slide__avans-price" data-avansPrice="350000">350 000 руб</div>
                        <input type="text" id="calc-leasing-2" name="calc-leasing-2" value="" class="calc-leasing-slide"
                               data-skin="round"
                               data-min="0"
                               data-max="49"
                               data-from="25"
                               data-step="1"
                               data-postfix="%"
                        />
                    </div>
                </div>
                <div class="calc-leasing__item">
                    <div class="calc-leasing__item__title">
                        Срок лизинга
                    </div>
                    <div class="calc-leasing__item__slide">
                        <div class="calc-leasing__item__slide__control">
                            <input type="text" id="control-leasing-3" class="control-leasing-slide" value="20" />
                        </div>
                        <input type="text" id="calc-leasing-3" name="calc-leasing-3" value="" class="calc-leasing-slide"
                               data-skin="round"
                               data-min="6"
                               data-max="36"
                               data-from="20"
                               data-step="1"
                               data-postfix=" мес"
                        />
                    </div>
                </div>
            </div>

            <div class="calc-leasing-info">
                <div class="calc-leasing-info__item">
                    <div class="calc-leasing-info__item__text">
                        Ежемесячный платеж, включая НДС
                    </div>
                    <div class="calc-leasing-info__item__price calc-leasing-1-result"><span>63 875</span> руб</div>
                </div>
                <div class="calc-leasing-info__item">
                    <div class="calc-leasing-info__item__text">
                        Сумма договора лизинга
                    </div>
                    <div class="calc-leasing-info__item__price calc-leasing-2-result"><span>1 627 500</span> руб</div>
                </div>
                <div class="calc-leasing-info__item">
                    <div class="calc-leasing-info__item__text">
                        Налоговая экономия по договору
                    </div>
                    <div class="calc-leasing-info__item__price calc-leasing-3-result">До <span>542 500</span> руб</div>
                </div>
            </div>

            <button class="btn btn-orange calc-leasing-info__btn btn-modal-open--contact-form-popup btn-add-hidden-info--calc">Подать заявку</button>
        </div>

    </section>


</main>

<?php get_footer(); ?>

