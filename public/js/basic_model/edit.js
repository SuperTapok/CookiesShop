$("#form").submit( (e) => {
    e.preventDefault();
    var form_data = $("#form").serialize();
    $.ajax({
        type: "POST",
        url: $("#editSmth")[0].getAttribute("data-route"),
        data: form_data,
        success: function () {
            modalText.innerHTML = 'Изменено!';
        },
    });
});