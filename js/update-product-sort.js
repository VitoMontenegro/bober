
jQuery(document).ready(function($) {
    $('#update-product-sort').on('click', function(e) {
        e.preventDefault();
        var button = $(this);
        button.prop('disabled', true).text('Обновление...');

        $.ajax({
            url: updateProductSortAjax.ajax_url,
            type: 'POST',
            data: {
                action: 'update_product_sort',
                security: updateProductSortAjax.nonce
            },
            success: function(response) {
                if (response.success) {
                    alert(response.data);
                } else {
                    alert('Ошибка: ' + response.data);
                }
            },
            error: function() {
                alert('Произошла ошибка при выполнении запроса.');
            },
            complete: function() {
                button.prop('disabled', false).text('Обновить');
            }
        });
    });
});