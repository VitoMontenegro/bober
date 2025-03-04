<?php
/*
 Template Name: page-users-list
 */
?>
<?php
/*
Template Name: Users List
*/

get_header();

$current_user = wp_get_current_user();

?>

<main>
    <section class="section">
        <div class="container">

            <h1 class="text-align-center">Список пользователей</h1>
            <br>

            <?php
            // Получаем всех пользователей
            $args = array(
                'orderby' => 'ID',
                'order' => 'ASC'
            );
            $users = get_users($args);

            // Массивы для хранения пользователей
            $users_without_pass = array();
            $registered_users = array();

            // Проходим по каждому пользователю
            foreach ($users as $user) {
                $user_get_pass = get_field('user_get_pass', 'user_' . $user->ID);

                if (!$user_get_pass) {
                    $users_without_pass[] = $user;
                } else {
                    $registered_users[] = $user;
                }
            }
            ?>

            <h2>Новые пользователи без пароля</h2>
            <?php if (!empty($users_without_pass)) { ?>
                <table class="user-list__table user-list__table--new-user">
                    <thead>
                    <tr>
                        <th>Имя / Почта</th>
                        <th>Телефон</th>
                        <th>Компания</th>
                        <th>Комментарий</th>
                        <th>Пароль</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users_without_pass as $user) {
                        $user_password = get_user_meta($user->ID, 'user_pass', true);
                        $user_name = $user->display_name;
                        $user_email = $user->user_email;
                        $user_fio = get_user_meta($user->ID, 'billing_first_name', true);
                        $user_phone = get_user_meta($user->ID, 'billing_phone', true);
                        $user_company = get_user_meta($user->ID, 'user_company', true);
                        $user_comment = get_user_meta($user->ID, 'user_comment', true);
                        ?>
                        <tr data-user-id="<?php echo esc_attr($user->ID); ?>">
                            <td>
                                <div class="user_id">id: <?php echo esc_html($user->ID); ?></div>
                                <div class="user_name"><?php echo esc_html($user_name); ?></div>
                                <div class="user_email"><?php echo esc_html($user_email); ?></div>
                                <?php if ($user_fio) { ?>
                                    <div class="user_fio"><?php echo esc_html($user_fio); ?></div>
                                <?php } ?>
                            </td>
                            <td class="user-phone"><?php echo esc_html($user_phone); ?></td>
                            <td class="user-company"><?php echo esc_html($user_company); ?></td>
                            <td class="user-comment"><?php echo $user_comment; ?></td>
                            <td class="user-pass">
                                <button class="user-pass-button user-pass-button-js">Выслать пароль</button>
                            </td>
                            <td class="user-btns">
                                <button class="user-edit-button user-button-js">Редактировать</button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php } else {
                echo 'Нет новых пользователей с неустановленным паролем.';
            } ?>

            <h2>Зарегистрированные пользователи</h2>
            <div class="user-list" data-currentUser="<?php echo $current_user->ID; ?>">
                <table class="user-list__table">
                    <thead>
                    <tr>
                        <th>Имя / Почта</th>
                        <th>Телефон</th>
                        <th>Компания</th>
                        <th>Комментарий</th>
                        <th>
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 50 50" fill="none">
                                <path d="M31.722 33.1607C29.7952 33.1589 28.2318 34.6885 28.2299 36.5771C28.228 38.4656 29.7885 39.9981 31.7152 40C33.642 40.0018 35.2054 38.4723 35.2073 36.5837C35.2073 36.5826 35.2073 36.5815 35.2073 36.5804C35.2055 34.6938 33.6466 33.1644 31.722 33.1607Z" fill="#262626"></path>
                                <path d="M37.9097 16.7858C37.8263 16.7699 37.7414 16.7619 37.6564 16.7618H16.4148L16.0783 14.5556C15.8687 13.0905 14.5902 12.0005 13.0808 12H10.3457C9.60247 12 9 12.5905 9 13.319C9 14.0475 9.60247 14.6381 10.3457 14.6381H13.0842C13.2553 14.6369 13.4001 14.7617 13.4206 14.9283L15.493 28.8508C15.7771 30.6199 17.3295 31.925 19.1566 31.9308H33.1551C34.9142 31.933 36.4317 30.7212 36.7851 29.0322L38.9752 18.3314C39.1164 17.6162 38.6394 16.9242 37.9097 16.7858Z" fill="#262626"></path>
                                <path d="M23.1755 36.4339C23.0936 34.6007 21.5501 33.1576 19.6781 33.164C17.7529 33.2403 16.2553 34.8319 16.3331 36.7189C16.4077 38.5296 17.9104 39.9688 19.7588 40H19.8429C21.7678 39.9173 23.2598 38.3207 23.1755 36.4339Z" fill="#262626"></path>
                            </svg>
                        </th>
                        <th>Менеджер</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($registered_users as $user) {
                        $user_id = $user->ID;
                        $user_name = $user->display_name;
                        $user_email = $user->user_email;
                        $user_fio = get_user_meta($user_id, 'billing_first_name', true);
                        $user_phone = get_user_meta($user_id, 'billing_phone', true);
                        $user_company = get_user_meta($user_id, 'user_company', true);
                        $user_comment = get_user_meta($user_id, 'user_comment', true);
                        $user_moderator = get_field('user_moderator', 'user_' . $user_id); // ACF поле
                        $moderator_name = $user_moderator ? $user_moderator['display_name'] : '-';
                        // Получаем количество заказов пользователя
                        $customer_orders = wc_get_orders(array(
                            'customer_id' => $user_id,
                            'return' => 'ids',
                        ));
                        $order_count = count($customer_orders);

                        // Ссылка на заказы пользователя в админке
                        $orders_link = admin_url('admin.php?page=wc-orders&_customer_user=' . $user_id);
                        ?>
                        <tr data-user-id="<?php echo esc_attr($user_id); ?>">
                            <td>
                                <div class="user_id">id: <?php echo esc_html($user->ID); ?></div>
                                <div class="user_name"><?php echo esc_html($user_name); ?></div>
                                <div class="user_email"><?php echo esc_html($user_email); ?></div>
                                <?php if ($user_fio) { ?>
                                    <div class="user_fio"><?php echo esc_html($user_fio); ?></div>
                                <?php } ?>
                            </td>
                            <td class="user-phone"><?php echo esc_html($user_phone); ?></td>
                            <td class="user-company"><?php echo esc_html($user_company); ?></td>
                            <td class="user-comment"><?php echo $user_comment; ?></td>
                            <td class="user-order_count">
                                <?php if ($order_count > 0) { ?>
                                    <a href="<?php echo esc_url($orders_link); ?>" target="_blank"><?php echo esc_html($order_count); ?></a>
                                <?php } else { ?>
                                    <?php echo esc_html($order_count); ?>
                                <?php } ?>
                            </td>
                            <td class="user-manager"><?php echo esc_html($moderator_name); ?></td>
                            <td class="user-btns">
                                <button class="user-edit-button user-button-js">Редактировать</button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</main>
<?php get_footer(); ?>