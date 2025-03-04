
//Users list
document.addEventListener('DOMContentLoaded', function () {
    if (typeof ajax_object === 'undefined') {
        console.error('scripts-moderator.js: ajax_object is not defined');
        return;
    }

    document.querySelectorAll('.user-button-js').forEach(function (button) {
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var current_user = document.querySelector('.user-list').getAttribute('data-currentUser');
            var userId = row.getAttribute('data-user-id');
            var phoneCell = row.querySelector('.user-phone');
            var companyCell = row.querySelector('.user-company');
            var commentCell = row.querySelector('.user-comment');
            var btn_pass = row.querySelector('.user-pass-button-js');

            if (this.textContent === 'Редактировать') {

                if(btn_pass){
                    btn_pass.setAttribute("disabled", "true");
                }

                var phone = phoneCell.textContent;
                var company = companyCell.textContent;
                var comment = commentCell.textContent;

                // Сохраняем старые значения в data-атрибуты
                phoneCell.setAttribute('data-old-value', phone);
                companyCell.setAttribute('data-old-value', company);
                commentCell.setAttribute('data-old-value', comment);

                $(row).addClass('user-edit-current-tr');

                phoneCell.innerHTML = '<textarea class="edit-phone">' + phone + '</textarea>';
                companyCell.innerHTML = '<textarea class="edit-company">' + company + '</textarea>';
                commentCell.innerHTML = '<textarea class="edit-comment">' + comment + '</textarea>';
                this.textContent = 'Сохранить';

                // Добавляем кнопку отмены
                var cancelButton = document.createElement('button');
                cancelButton.textContent = 'Отменить';
                cancelButton.classList.add('user-cancel-button');
                cancelButton.classList.add('user-cancel-button-js');
                this.parentNode.insertBefore(cancelButton, this.nextSibling);

                // Добавляем обработчик события для кнопки отмены
                cancelButton.addEventListener('click', function () {

                    if(btn_pass){
                        btn_pass.removeAttribute("disabled");
                    }

                    // Восстанавливаем старые значения
                    phoneCell.textContent = phoneCell.getAttribute('data-old-value');
                    companyCell.textContent = companyCell.getAttribute('data-old-value');
                    commentCell.textContent = commentCell.getAttribute('data-old-value');

                    // Убираем класс редактирования
                    $(row).removeClass('user-edit-current-tr');

                    // Удаляем кнопку отмены
                    cancelButton.remove();

                    // Меняем текст кнопки редактирования обратно
                    button.textContent = 'Редактировать';
                });
            } else {
                var newPhone = row.querySelector('.edit-phone').value;
                var newCompany = row.querySelector('.edit-company').value;
                var newComment = row.querySelector('.edit-comment').value;

                $(row).removeClass('user-edit-current-tr');

                button.textContent = 'Сохраняем...';

                var data = {
                    action: 'save_user_data',
                    current_user: current_user,
                    user_id: userId,
                    user_phone: newPhone,
                    user_company: newCompany,
                    user_comment: newComment,
                    security: ajax_object.ajax_nonce
                };

                fetch(ajax_object.ajax_url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams(data).toString()
                })
                    .then(response => response.json())
                    .then(response => {
                        if (response.success) {
                            phoneCell.textContent = newPhone;
                            companyCell.textContent = newCompany;
                            commentCell.textContent = newComment;
                            this.textContent = 'Редактировать';

                            // Удаляем кнопку отмены
                            var cancelButton = this.nextSibling;
                            if (cancelButton && cancelButton.classList.contains('user-cancel-button-js')) {
                                cancelButton.remove();
                            }

                            if(btn_pass){
                                btn_pass.removeAttribute("disabled");
                            }
                        } else {
                            alert('Ошибка сохранения данных');

                            if(btn_pass){
                                btn_pass.removeAttribute("disabled");
                            }
                        }
                    });
            }
        });
    });



    document.querySelectorAll('.user-pass-button-js').forEach(function (button) {
        button.addEventListener('click', function () {

            var row = this.closest('tr');
            var user_id = row.getAttribute('data-user-id');
            var user_btn_pass = row.querySelector('.user-pass-button-js');
            var user_email = row.querySelector('.user_email').textContent;

            // Отправляем AJAX запрос
            var data = {
                action: 'send_user_email',
                user_id: user_id,
                user_email: user_email,
                security: ajax_object.ajax_nonce
            };

            user_btn_pass.textContent = 'Высылаем...';
            fetch(ajax_object.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams(data)
            })
        .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Письмо отправлено');
                        row.querySelector('.user-pass-button-js').remove();
                        row.querySelector('.user-pass').textContent = 'Пароль выслан';
                        row.classList.add('tr-edited');
                    } else {
                        console.log('Ошибка: ' + data.data);
                        user_btn_pass.textContent = 'Высылать пароль';
                    }
                })
                .catch(error => console.error('Ошибка:', error));

        });
    });



});