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
// $("#send-email-form").on("submit", function(event){
//     event.preventDefault();
//
//     $.ajax({
//         url: $(this).prop('action'),
//         method: 'post',
//         dataType: 'html',
//         data: $(this).serialize(),
//         beforeSend: function () {
//             $('.spinner-container').css('display', 'flex');
//         },
//         complete: function () {
//             $('.spinner-container').css('display', 'none');
//         },
//         error: function (data) {
//             $('.spinner-container').css('display', 'none');
//             console.log(data);
//             let jsonData = JSON.parse(data);
//
//             $('.congratulation-error-content').html(`Ошибочка: ${jsonData.result}`);
//             $('.congratulation-error-alert').show();
//         },
//         success: function(data){
//             let jsonData = JSON.parse(data);
//
//             $('.congratulation-success-content').html(`<p><strong>Почта получателя:</strong> ${jsonData.email}</p><p><strong>Поздравление:</strong> ${jsonData.congratulationMessage}</p>`);
//             $('.congratulation-success-alert').show();
//         }
//     });
// });
