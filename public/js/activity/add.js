$("#form").submit( (e) => {
    e.preventDefault();
    var form_data = $("#form").serialize();
    $.ajax({
        type: "POST",
        url: "/api/activity/add_activity_api",
        data: form_data,
        success: function () {
            modalText.innerHTML = 'Наградное действие добавлено!';
        },
    });
});

modalOk.onclick = function () { 
    location.reload();
};