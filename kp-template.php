<!-- kp-template.php -->
<?php
get_header();
$kp_id = get_query_var('kp_id');
$products = get_field('kp_products', $kp_id);
?>
<div class="kp-container">
    <h1>Коммерческое предложение #<?php echo esc_html($kp_id); ?></h1>
    <div class="kp-products">
        <?php foreach ($products as $item):
            $product = wc_get_product($item['product']); ?>
            <div class="kp-product">
                <h2><?php echo esc_html($product->get_name()); ?></h2>
                <p>Цена: <?php echo wc_price($product->get_price()); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <button id="kp-order-btn" data-kp-id="<?php echo esc_attr($kp_id); ?>">Оформить заказ</button>
</div>
<script>
    document.getElementById('kp-order-btn').addEventListener('click', function() {
        let kpId = this.getAttribute('data-kp-id');
        fetch('/wp-admin/admin-ajax.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'action=kp_checkout&kp_id=' + kpId
        })
            .then(response => response.text())
            .then(data => document.querySelector('.kp-container').innerHTML = data);
    });
</script>
<?php get_footer(); ?>


