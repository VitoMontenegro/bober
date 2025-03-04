// Кнопка "Категории BIO"
// $('.api-update__test').on('click', function () {
//     $.ajax({
//         type : 'POST',
//         url : "/wp-admin/admin-ajax.php",
//         data : {
//             action : 'api_update_test'
//         },
//         success : function( data ){
//             // console.log(data);
//             $('.api-update').prepend(data);
//
//         },
//         error: function(xhr, status, error) { // if error occured
//             console.log('XHR ERROR ' + status + error + xhr.ResponseText + XMLHttpRequest.status);
//           },
//     });
// });

$('.api-update__btn--get-all-id').on('click', function () {
    $('.api-update__btn--get-all-id ~ .api-update__panel__indicator').html('<div class="icon-preloader"></div>');
    $('.api-update__btn--get-all-id').addClass('btn-disabled');
    $.ajax({
        type : 'POST',
        url : "/wp-admin/admin-ajax.php",
        data : {
            action : 'api_update_category'
        },
        beforeSend : function( xhr ) {
            // $('.api-update__panel__indicator.active').html('in process');
        },
        success : function( data ){
            // console.log(data);
            $('.api-update__info').prepend(data);
            $('.api-update__btn--get-all-id ~ .api-update__panel__indicator').html('<div class="icon-done"></div>');
            $('.api-update__btn--get-all-id').addClass('btn-disabled');
            $('.api-update__btn--get-all-product-id').removeClass('btn-disabled');
            $('.api-update__btn--difference').removeClass('btn-disabled');

        },
        error: function(xhr, status, error) { // if error occured
            console.log('XHR ERROR ' + status + error + xhr.ResponseText + XMLHttpRequest.status);
            $('.api-update__btn--get-all-id').removeClass('btn-disabled');
            $('.api-update__btn--get-all-id ~ .api-update__panel__indicator').html('XHR ERROR ' + status + error + xhr.ResponseText + XMLHttpRequest.status);
        },
    });
})


// Кнопка "Товары BIO"
$(document).on('click','.api-update__info__btn--get-ids-prod', function () {

    $(this).parents('.api-update__info__main').find('.product-item').remove();
    $(this).parents('.api-update__info__main').find('.count').remove();
    $(this).parents('.api-update__info__main').find('.is-done').removeClass('is-done');
    $(this).parents('.api-update__info__main').find('.is-error').removeClass('is-error');
    $(this).parents('.api-update__info__main').find('.api-update__info__message').html('<div class="icon-preloader"></div>');

    // $('.api-update__panel__btn-main-2 ~ .api-update__panel__indicator').addClass('active').html('<div class="icon-preloader"></div>');
    // $(this).addClass('btn-disabled');
    idсat = $(this).attr('data-idсat');
    var count_cat = $('#'+idсat+' .api-cat-item').length;
    $('#'+idсat+' .api-cat-item').each(function (i) {
        cat_id = $(this).attr('id');
        $.ajax({
            type : 'POST',
            url : "/wp-admin/admin-ajax.php",
            data : {
                cat_id : cat_id,
                action : 'api_update_cat_products' // экшен для wp_ajax_ и wp_ajax_nopriv_
            },

            beforeSend : function( xhr ) {
                // $('.api-update__info').prepend(cat_id);
                // $('.api-update__info').prepend(cat_id + '-error');
            },
            success : function( data ){
                console.log(data);
                if (data.substr(0,5) == 'ERROR'){
                    data_error = data.split('^^^');
                    $('#'+ data_error[1] ).addClass('is-error');
                    $('#'+ data_error[1] ).parents('.api-update__info__main').find('.api-update__info__message').html('Ошибка с получением товаров<br>Нажмите кнопку "Товары BIO"')
                    return false;
                }

                data_2 = data.split('---');
                $('#'+ data_2[0] ).append(' ' + data_2[1]);
                $('#'+ data_2[0] ).addClass('item-update');
                // $('.api-update__panel__btn-main-2 ~ .api-update__panel__indicator').html('');
            },
            error: function(xhr, status, error) {
                console.log('XHR ERROR ' + status + error + xhr.ResponseText + XMLHttpRequest.status);
                $('.api-update__info').prepend(cat_id + status);
                // $('.api-update__panel__btn-main-2 ~ .api-update__panel__indicator').html('XHR ERROR ' + status + error + xhr.ResponseText + XMLHttpRequest.status);

            },
        });
    });
})



$( document ).ajaxStop(function() {
    console.log( "ajaxStop" );
    $( ".icon-preloader" ).remove();
    if($(".api-cat-item.active .product-item").length == 0){
        $( ".api-cat-item.active .count" ).remove();
        $( ".api-cat-item.active" ).addClass('is-done');
        $( ".api-cat-item.active" ).removeClass('item-update');
        $( ".api-cat-item.active" ).removeClass('active');
    }


});





//
//
// Кнопка "Все товары BIO"
$('.api-update__btn--get-all-product-id').on('click', function () {

    $(this).addClass('btn-disabled');
    $('.api-update__info__main').find('.product-item').remove();
    $('.api-update__info__main').find('.count').remove();
    $('.api-update__info__main').find('.is-done').removeClass('is-done');
    $('.api-update__info__main').find('.is-error').removeClass('is-error');
    $('.api-update__info__main').find('.api-update__info__message').html('<div class="icon-preloader"></div>');


    // $('.api-update__panel__btn-main-2 ~ .api-update__panel__indicator').addClass('active').html('<div class="icon-preloader"></div>');
    // $('.api-update__panel__btn-main-2').addClass('btn-disabled');

    $('.api-update__info__main .api-cat-item').each(function () {
        cat_id = $(this).attr('id');
        $.ajax({
            type : 'POST',
            url : "/wp-admin/admin-ajax.php",
            data : {
                cat_id : cat_id,
                action : 'api_update_cat_products' // экшен для wp_ajax_ и wp_ajax_nopriv_
            },

            beforeSend : function( xhr ) {
                // $('.api-update__info').prepend(cat_id);
                // $('.api-update__info').prepend(cat_id + '-error');
            },
            success : function( data ){
                // console.log(data);
                if (data.substr(0,5) == 'ERROR'){
                    console.log(data);
                    data_error = data.split('^^^');
                    $('#'+ data_error[1] ).addClass('is-error');
                    $('#'+ data_error[1] ).parents('.api-update__info__main').find('.api-update__info__message').html('Ошибка с получением товаров<br>Нажмите кнопку "Товары BIO"')
                    return false;
                }

                data_2 = data.split('---');
                $('#'+ data_2[0] ).append(' ' + data_2[1]);
                $('#'+ data_2[0] ).addClass('item-update');
                // $('.api-update__panel__btn-main-2 ~ .api-update__panel__indicator').html('');


            },
            error: function(xhr, status, error) {
                console.log('XHR ERROR ' + status + error + xhr.ResponseText + XMLHttpRequest.status);
                $('.api-update__info').prepend(cat_id + status);

            },
        });
    })

})
//
//







$('.api-update__btn--difference').on('click', function () {
    $('.api-update__current__sku span').each(function () {
        current_product_id = $(this).attr('data-sku');
        $('.api-cat-item .product-item[id="'+current_product_id+'"]').remove();
    });
    $('.child.api-cat-item.item-update').each(function () {
        var productItems = $(this).find('.product-item');
        if (productItems.length > 0) {
            var count = productItems.length;
            console.log('Остаток: ' + count);
            $(this).find('.count').html('('+count+')');
        } else {
            $(this).addClass('is-done');
            $(this).find('.count').remove();
        }
    });
});



$(document).on('click','.child.api-cat-item.item-update', function () {
    var productItems = $(this).find('.product-item');

    $(this).addClass('active');
    $(this).removeClass('is-error');



    // Функция для выполнения AJAX запроса
    function performAjax(products_id) {
        return $.ajax({
            type : 'POST',
            url : "/wp-admin/admin-ajax.php",
            // async: false,
            data : {
                // cat_id : cat_id,
                products_id : products_id,
                action : 'api_update_products' // экшен для wp_ajax_ и wp_ajax_nopriv_
            },
            success : function( data ){

                // console.log(data);
                if (data.substr(0,5) == 'ERROR'){
                    console.log(data);
                    data_2 = data.split('---');
                    $('#'+ data_2[1] ).addClass('error');
                    return false;
                }
                $('#'+ data ).remove();

            },
            error: function(xhr, status, error) {
                if (status === 'timeout' || xhr.status === 502 || xhr.status === 504) {
                    console.log(xhr.status+' - ' );
                }
                console.log(xhr);
                $('.api-cat-item.item-update.active').addClass('is-error');
                $('.api-cat-item.item-update.active').removeClass('active');

                return false;
            },
        });
    }



    // Функция для последовательного выполнения AJAX запросов
    function processItems(index) {
        if (index < productItems.length) {
            var products_id = productItems.eq(index).attr('id');
            performAjax(products_id).done(function(data) {
                // Обработка успешного ответа
                processItems(index + 1);
            }).fail(function(xhr, status, error) {
                // Обработка ошибки
                processItems(index + 1);
            });
        }
    }



    processItems(0);




    //
    //
    // $(this).find('.product-item').each(function () {
    //
    //     products_id = $(this).attr('id');
    //
    //
    //
    //
    // })



})



//Кнопка "Обновить"
$(document).on('click','.api-update__info__btn--get-ids-prods-all', function () {
    var productItems = $(this).parents('.api-update__info__main').find('.product-item');

    // $(this).addClass('active');
    // $(this).removeClass('is-error');



    // Функция для выполнения AJAX запроса
    function performAjax(products_id) {
        return $.ajax({
            type : 'POST',
            url : "/wp-admin/admin-ajax.php",
            // async: false,
            data : {
                // cat_id : cat_id,
                products_id : products_id,
                action : 'api_update_products' // экшен для wp_ajax_ и wp_ajax_nopriv_
            },
            success : function( data ){

                // console.log(data);
                if (data.substr(0,5) == 'ERROR'){
                    console.log(data);
                    data_2 = data.split('---');
                    $('#'+ data_2[1] ).addClass('error');
                    return false;
                }
                $('#'+ data ).remove();

            },
            error: function(xhr, status, error) {
                if (status === 'timeout' || xhr.status === 502 || xhr.status === 504) {
                    console.log(xhr.status+' - ' );
                }
                console.log(xhr);
                $('.api-cat-item.item-update.active').addClass('is-error');
                $('.api-cat-item.item-update.active').removeClass('active');

                return false;
            },
        });
    }



    // Функция для последовательного выполнения AJAX запросов
    function processItems(index) {
        if (index < productItems.length) {
            var products_id = productItems.eq(index).attr('id');
            performAjax(products_id).done(function(data) {
                // Обработка успешного ответа
                processItems(index + 1);
            }).fail(function(xhr, status, error) {
                // Обработка ошибки
                processItems(index + 1);
            });
        }
    }



    processItems(0);




    //
    //
    // $(this).find('.product-item').each(function () {
    //
    //     products_id = $(this).attr('id');
    //
    //
    //
    //
    // })



})





