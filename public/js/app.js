import './bootstrap';
import '../css/app.css';
$("#api-request-form").on("submit", function(event){
    event.preventDefault();

    $.ajax({
        url: $(this).prop('action'),
        method: 'post',
        dataType: 'html',
        data: $(this).serialize(),
        beforeSend: function () {
            $('.spinner-container').css('display', 'flex');
        },
        complete: function () {
            $('.spinner-container').css('display', 'none');
        },
        error: function (data) {
            $('.spinner-container').css('display', 'none');
            let jsonData = JSON.parse(data);

            $('.congratulation-error-content').html(`Ошибочка: ${jsonData.result}`);
            $('.congratulation-error-alert').show();
        },
        success: function(data){
            let jsonData = JSON.parse(data);

            $('.congratulation-success-content').html(`<p><strong>Вопрос:</strong> ${jsonData.requestMessage}</p><p><strong>Ответ:</strong> ${jsonData.responseMessage}</p>`);
            $('.congratulation-success-alert').show();
        }
    });
});
$("#send-email-form").on("submit", function(event){
    event.preventDefault();

    $.ajax({
        url: $(this).prop('action'),
        method: 'post',
        dataType: 'html',
        data: $(this).serialize(),
        beforeSend: function () {
            $('.spinner-container').css('display', 'flex');
        },
        complete: function () {
            $('.spinner-container').css('display', 'none');
        },
        error: function (data) {
            $('.spinner-container').css('display', 'none');
            let jsonData = JSON.parse(data);
            let requestLogged = jsonData.requestLogged ? 'Да' : 'Нет';
            let emailLogged = jsonData.emailLogged ? 'Да' : 'Нет';

            $('.congratulation-error-content').html(`<p>Ошибочка: ${jsonData.result}</p><p>Удалось ли залогировать запрос к chatGPT: ${requestLogged}</p><p>Удалось ли залогировать сформированное письмо: ${emailLogged}</p>`);
            $('.congratulation-error-alert').show();
        },
        success: function(data){
            let jsonData = JSON.parse(data);
            let requestLogged = jsonData.requestLogged ? 'Да' : 'Нет';
            let emailLogged = jsonData.emailLogged ? 'Да' : 'Нет';

            $('.congratulation-success-content').html(`<p><strong>Почта получателя:</strong> ${jsonData.email}</p><p style="white-space: pre-line"><strong>Поздравление:</strong><br>${jsonData.congratulationMessage}</p><p><strong>Удалось ли залогировать запрос к chatGPT: </strong>${requestLogged}</p><p><strong>Удалось ли залогировать сформированное письмо: </strong>${emailLogged}</p>`);
            $('.congratulation-success-alert').show();
        }
    });
});
