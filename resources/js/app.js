$("#api-request-form").on("submit", function(event){
    event.preventDefault();

    $.ajax({
        url: $(this).prop('action'),
        method: 'post',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function () {
            $('.spinner-container').css('display', 'flex');
        },
        complete: function () {
            $('.spinner-container').css('display', 'none');
        },
        error: function (data) {
            $('.spinner-container').css('display', 'none');
            $('.congratulation-error-content').html(`Ошибочка: ${data.result}`);
            $('.congratulation-error-alert').show();
        },
        success: function(data){
            $('.congratulation-success-content').html(`<p><strong>Вопрос:</strong> ${data.requestMessage}</p><p><strong>Ответ:</strong> ${data.responseMessage}</p>`);
            $('.congratulation-success-alert').show();
        }
    });
});
$("#send-email-form").on("submit", function(event){
    event.preventDefault();

    $.ajax({
        url: $(this).prop('action'),
        method: 'post',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function () {
            $('.spinner-container').css('display', 'flex');
        },
        complete: function () {
            $('.spinner-container').css('display', 'none');
        },
        error: function (data) {
            $('.spinner-container').css('display', 'none');
            let requestLogged = data.requestLogged ? 'Да' : 'Нет';
            let emailLogged = data.emailLogged ? 'Да' : 'Нет';

            $('.congratulation-error-content').html(`<p>Ошибочка: ${data.result}</p><p>Удалось ли залогировать запрос к chatGPT: ${data}</p><p>Удалось ли залогировать сформированное письмо: ${emailLogged}</p>`);
            $('.congratulation-error-alert').show();
        },
        success: function(data){
            let requestLogged = data.requestLogged ? 'Да' : 'Нет';
            let emailLogged = data.emailLogged ? 'Да' : 'Нет';

            $('.congratulation-success-content').html(`<p><strong>Почта получателя:</strong> ${data.email}</p><p style="white-space: pre-line"><strong>Поздравление:</strong><br>${data.congratulationMessage}</p><p><strong>Удалось ли залогировать запрос к chatGPT: </strong>${requestLogged}</p><p><strong>Удалось ли залогировать сформированное письмо: </strong>${emailLogged}</p>`);
            $('.congratulation-success-alert').show();
        }
    });
});
