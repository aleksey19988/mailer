import './bootstrap';
import '../css/app.css';
$("#api-request-form").on("submit", function(event){
    event.preventDefault();

    $.ajax({
        url: 'api/store',
        method: 'post',
        dataType: 'html',
        data: $(this).serialize(),
        beforeSend: function () {
            $('.spinner-container').css('display', 'flex');
        },
        complete: function () {
            $('.spinner-container').css('display', 'none');
        },
        success: function(data){
            let jsonData = JSON.parse(data);
            $('.congratulation-content').html(jsonData.result);
            $('.congratulation-alert').show();
        }
    });
});
