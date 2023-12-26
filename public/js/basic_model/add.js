$("#form").submit( (e) => {
    e.preventDefault();
    var form_data = $("#form").serialize();
    $.ajax({
        type: "POST",
        url: $("#addSmth")[0].getAttribute("data-route"),
        data: form_data,
        success: function () {
            modalText.innerHTML = 'Добавлено!';
        },
    });
});

modalOk.onclick = function () { 
    location.reload();
};